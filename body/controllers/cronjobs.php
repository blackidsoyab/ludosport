<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class cronjobs extends CI_Controller
{
    
    var $session_data;
    
    //for Sending Mail Priority
    var $mail_priority = array('U', 'H', 'N', 'L');
    
    function __construct() {
        parent::__construct();
        $this->session_data = $this->session->userdata('user_session');
    }
    
    //Send mail to Users
    public function sendRegularMail() {
        $this->_getMails(10);

        return true;
    }
    
    /*
     *   Get the Mails from DB and send it to users
     *   Param1(int-required) : Limit for sending mail at a time
     *   Param2(int-optional) : Set the Priority 0 => Urgent to 3 => Low
     *   Param3(int)          : Self use for function.
    */
    private function _getMails($limit, $priority = 0, $count = 0) {
        if (array_key_exists($priority, $this->mail_priority)) {
            $mail = new Mailbox();
            $mail->where(array('type' => $this->mail_priority[$priority], 'status' => 0));
            $mail->limit($limit);
            $mails = $mail->get();
            $total_records = $mail->where(array('type' => $this->mail_priority[$priority], 'status' => 0))->count();
            if ($mail->result_count() > 0) {
                $temp_count = 0;
                foreach ($mails as $value) {
                    $option = array();
                    $option['tomailid'] = $value->to_email;
                    $option['subject'] = $value->subject;
                    $option['message'] = $value->message;
                    if (!is_null($value->attachment)) {
                        $option['attachement'] = 'assets/email_attachments/' . $value->attachment;
                    }
                    
                    if (send_mail($option)) {
                        $mail->where('id', $value->id)->update('status', 1);
                        $count++;
                        $temp_count++;
                    }
                    
                    if ($count >= $limit) {
                        break;
                    } else if ($total_records == $temp_count && ($limit - $temp_count) > 0) {
                        $this->getMails($limit, ++$priority, $count);
                    }
                }
            } else {
                $this->getMails($limit, ++$priority, $count);
            }
        }

        return true;
    }
    
    //Save All
    public function saveAll() {
        $date_1 = date('Y-m-d', strtotime('+1 day', strtotime(get_current_date_time()->get_date_for_db())));
        $date_2 = date('Y-m-d', strtotime('+1 week', strtotime(get_current_date_time()->get_date_for_db())));
        $dates = generateDates($date_1, $date_2);
        $this->_getAndSaveClanDate($dates);
        $this->_getAndSaveTeacherAttendance($dates);
        $this->_getAndSaveStudentAttendance($dates);

        return true;
    }
    
    //Clan Dates
    public function clanDate() {
        $date_1 = date('Y-m-d', strtotime('+1 day', strtotime(get_current_date_time()->get_date_for_db())));
        $date_2 = date('Y-m-d', strtotime('+1 week', strtotime(get_current_date_time()->get_date_for_db())));
        $dates = generateDates($date_1, $date_2);
        $this->_getAndSaveClanDate($dates);

        return true;
    }
    
    /*
     *   Get & Save the Clan Dates
     *   Param1(Date-required) : Date
    */
    private function _getAndSaveClanDate($dates) {
        if (!is_null($dates) && count($dates) > 0) {
            foreach ($dates as $date) {
                $day_numeric = date('N', strtotime($date));
                $clans = New Clan();
                $details = $clans->getClansByDayForCronJob($day_numeric);
                
                if ($details) {
                    foreach ($details as $value) {
                        if (strtotime($date) >= strtotime($value->clan_from) && strtotime($date) <= strtotime($value->clan_to)) {
                            $obj_clan_date = new Clandate();
                            $check_point_1 = $obj_clan_date->where(array('clan_id' => $value->id, 'clan_shift_from' => $date))->get();
                            if ($check_point_1->result_count() == 0) {
                                $obj_clan_date = new Clandate();
                                $check_point_2 = $obj_clan_date->where(array('clan_id' => $value->id, 'clan_date' => $date))->get();
                                if ($check_point_2->result_count() == 0) {
                                    $obj_clan_date->type = 'R';
                                    $obj_clan_date->clan_id = $value->id;
                                    $obj_clan_date->clan_date = $date;
                                    $obj_clan_date->user_id = 0;
                                    $obj_clan_date->save();
                                }
                            }
                        }
                    }
                }
            }
        }

        return true;
    }
    
    //Teacher Attendance
    public function teacherAttendance() {
        $date_1 = date('Y-m-d', strtotime('+1 day', strtotime(get_current_date_time()->get_date_for_db())));
        $date_2 = date('Y-m-d', strtotime('+1 week', strtotime(get_current_date_time()->get_date_for_db())));
        $dates = generateDates($date_1, $date_2);
        $this->_getAndSaveTeacherAttendance($dates);

        return true;
    }
    
    /*
     *   Get & Save the Teacher Attendance
     *   Param1(Date-required) : Date
    */
    private function _getAndSaveTeacherAttendance($dates) {
        if (!is_null($dates) && count($dates) > 0) {
            foreach ($dates as $date) {
                $day_numeric = date('N', strtotime($date));
                $clans = New Clan();
                $details = $clans->getClansByDayForCronJob($day_numeric);
                
                if ($details) {
                    foreach ($details as $value) {
                        if (strtotime($date) >= strtotime($value->clan_from) && strtotime($date) <= strtotime($value->clan_to)) {
                            $attadence = new Teacherattendance();
                            $attadence->where(array('clan_id' => $value->id, 'clan_date' => $date, 'teacher_id' => $value->teacher_id))->get();
                            if ($attadence->result_count() == 0) {
                                $attadence->clan_date = $date;
                                $attadence->clan_id = $value->id;
                                $attadence->teacher_id = $value->teacher_id;
                                $attadence->attendance = 1;
                                $attadence->user_id = 0;
                                $attadence->save();
                            }
                        }
                    }
                }
            }
        }

        return true;
    }
    
    // Student Attendance
    public function studentAttendance() {
        $date_1 = date('Y-m-d', strtotime('+1 day', strtotime(get_current_date_time()->get_date_for_db())));
        $date_2 = date('Y-m-d', strtotime('+1 week', strtotime(get_current_date_time()->get_date_for_db())));
        $dates = generateDates($date_1, $date_2);
        $this->_getAndSaveStudentAttendance($dates);

        return true;
    }
    
    /*
     *   Get & Save the Student Attendance
     *   Param1(Date-required) : Date
    */
    private function _getAndSaveStudentAttendance($dates) {
        if (!is_null($dates) && count($dates) > 0) {
            foreach ($dates as $date) {
                $day_numeric = date('N', strtotime($date));
                $clans = New Clan();
                $details = $clans->getClansByDayForCronJob($day_numeric);
                
                if ($details) {
                    foreach ($details as $value) {
                        if (strtotime($date) >= strtotime($value->clan_from) && strtotime($date) <= strtotime($value->clan_to)) {
                            $obj_student = new Userdetail();
                            $obj_student->where(array('clan_id' => $value->id, 'status' => 'A'))->get();
                            
                            foreach ($obj_student as $student) {
                                if (strtotime($student->first_lesson_date) > strtotime($date)) {
                                    continue;
                                } else {
                                    $attadence = new Attendance();
                                    
                                    //Check any record exit for date and student
                                    $attadence->where(array('clan_date' => $date, 'student_id' => $student->student_master_id))->get();
                                    if ($attadence->result_count() == 1) {
                                        $attadence->attendance = $attadence->attendance;
                                    } else {
                                        $attadence->attendance = 1;
                                    }
                                    $attadence->clan_date = $date;
                                    $attadence->student_id = $student->student_master_id;
                                    $attadence->user_id = 0;
                                    $attadence->save();
                                }
                            }
                        }
                    }
                }

                $evolution_clans = New Evolutionclan();
                $evolution_details = $evolution_clans->getClansByDateForCronJob($date);
                
                if ($evolution_details) {
                    foreach ($evolution_details as $evolution) {
                        $obj_student = new Evolutionstudent();
                        $obj_student->where(array('evolutionclan_id' => $evolution->id, 'status' => 'A'))->get();
                        
                        foreach ($obj_student as $student) {
                            if (strtotime($student->timestamp) > strtotime($date)) {
                                continue;
                            } else {
                                $attadence = new Evolutionattendance();
                                
                                //Check any record exit for date and student
                                $attadence->where(array('evolutionclan_id' => $evolution->id, 'clan_date' => $date, 'student_id' => $student->student_id))->get();
                                if ($attadence->result_count() == 1) {
                                    $attadence->attendance = $attadence->attendance;
                                } else {
                                    $attadence->attendance = 1;
                                }
                                $attadence->evolutionclan_id = $evolution->id;
                                $attadence->clan_date = $date;
                                $attadence->student_id = $student->student_id;
                                $attadence->user_id = 0;
                                $attadence->save();
                            }
                        }
                    }
                }
            }
        }

        return true;
    }
    
    /*
     *   Check for the Challenge whos result time is over.
     *   Param1(Date-required) : current date
    */
    public function checkOverDueDuel($date = null) {
        if (is_null($date)) {
            $strtotime = strtotime(get_current_date_time()->get_date_for_db());
        } else {
            $strtotime = strtotime($date);
        }
        
        $obj_challenge = new Challenge();
        
        //get all the challenges which accepted from both side and still not played
        $obj_challenge->where(array('from_status' => 'A', 'to_status' => 'A', 'result_status' => 'MNP'))->get();
        if ($obj_challenge->result_count() > 0) {
            foreach ($obj_challenge as $challenge) {
                if($challenge->result_status == 'MNP'){
                    $over_due_date = strtotime('+7 day', strtotime(date('Y-m-d', strtotime($challenge->played_on))));
                    if ($strtotime >= $over_due_date) {
                        $challenge->result = 0;
                        $challenge->result_status = 'SP';
                        $challenge->save();
                    }
                } else if($challenge->result_status == 'CW'){
                    $over_due_date = strtotime('+101 min', strtotime($challenge->status_changed_on));
                    if ($strtotime >= $over_due_date) {
                        $challenge->result = 0;
                        $challenge->result_status = 'CO';
                        $challenge->save();

                        $challenge_victory_unconfirmed = systemRatingScore('challenge_victory_unconfirmed');
                        $obj_score = new Scorehistory();
                        $obj_score->demeritStudentScore($challenge->result_declare_by, $challenge_victory_unconfirmed['type'], $challenge_victory_unconfirmed['score'], 'Challenge victory is not confirmend by oppnent');
                    }
                }
            }
        }

        return true;
    }

}