<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class events extends CI_Controller
{
    
    var $session_data;
    
    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('event'));
        $this->session_data = $this->session->userdata('user_session');
    }
    
    /*
     *   List all event if the id is null
     *   Single event if id is passed
     *   Param1(optional) : event id
     *   Param2(optional) : any text (e.g. : notification)
    */
    function viewEvent($id = null, $type = null) {
        if (is_null($id)) {
            
            $schools = new School();
            if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                $school = null;
            } else if ($this->session_data->role == '3') {
                $school = $schools->getSchoolOfRector($this->session_data->id);
            } else if ($this->session_data->role == '4') {
                $school = $schools->getSchoolOfDean($this->session_data->id);
            } else if ($this->session_data->role == '5') {
                $school = $schools->getSchoolOfTeacher($this->session_data->id);
            } else if ($this->session_data->role == '6') {
                $school = $schools->getSchoolOfStudent($this->session_data->id);
            }
            
            if (!is_null($school)) {
                $temp = array();
                foreach ($school as $value) {
                    $temp[] = $value->id;
                }
            } else {
                $temp = null;
            }
            
            $event = new Event();
            $event_details = $event->getEvents($temp);
            $data['events'] = $event_details;
            
            $data['running_events_ids'] = $event->getRunningEventIDS();
            $data['manager_events_ids'] = $event->getRunningEventAsManager($this->session_data->id);
            
            $this->layout->view('events/view', $data);
        } else {
            if ($type == 'notification') {
                Notification::updateNotification('event_invitation', $this->session_data->id, $id);
            }
            
            $event = new Event();
            $event->where('id', $id)->get();
            if ($event->result_count() == 1) {
                $data['event_detail'] = $event;
                $this->layout->view('events/view_single', $data);
            } else {
                redirect(base_url() . 'event', 'refresh');
            }
        }
    }
    
    //Add the event.
    function addEvent() {
        if ($this->input->post() !== false) {
            $event = new Event();
            
            if ($_FILES['event_image']['name'] != '') {
                $image = $this->uploadImage();
                if (isset($image['error'])) {
                    $this->session->set_flashdata('file_errors', $image['error']);
                    redirect(base_url() . 'event/add', 'refresh');
                } else if (isset($image['upload_data'])) {
                    $event->image = $image['upload_data']['file_name'];
                }
            }
            
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_name';
                if ($this->input->post($temp) != '') {
                    $event->$temp = $this->input->post($temp);
                } else {
                    $event->$temp = $this->input->post('en_name');
                }
            }
            $event->eventcategory_id = $this->input->post('eventcategory_id');
            
            if ($this->input->post('event_for') == 'A') {
                $event->event_for = 'AC';
                $school = new School();
                $event->school_id = implode(',', $school->getAllSchoolIdFromAcademy($this->input->post('academy_id')));
            } else if ($this->input->post('event_for') == 'S') {
                $event->event_for = 'SC';
                $event->school_id = implode(',', $this->input->post('school_id'));
            } else {
                $event->event_for = 'ALL';
                $event->school_id = '0';
            }
            
            $event->city_id = $this->input->post('city_id');
            $event->date_from = date('Y-m-d', strtotime($this->input->post('date_from')));
            $event->date_to = date('Y-m-d', strtotime($this->input->post('date_to')));
            $event->manager = implode(',', array_unique($this->input->post('manager')));
            $event->description = $this->input->post('description');
            $event->user_id = $this->session_data->id;
            $event->save();

            $email = new Email();
            //get the mail templates
            $email->where('type', 'event_manager')->get();
            $message = $email->message;

            //replace appropriate varaibles
            $message = str_replace('#event_name', $this->input->post('en_name'), $message);
            $message = str_replace('#from_date', date('Y-m-d', strtotime($this->input->post('date_from'))), $message);
            $message = str_replace('#to_date', date('Y-m-d', strtotime($this->input->post('date_to'))), $message);
            $message = str_replace('#location', getFullLocationByCity($this->input->post('city_id')), $message);
            $message = str_replace('#event_created_by', $this->session_data->name, $message);

            foreach ($this->input->post('manager') as $manager) {
                if($manager != $this->session_data->id){
                    $notification = new Notification();
                    $notification->type = 'N';
                    $notification->notify_type = 'event_manager';
                    $notification->from_id = $this->session_data->id;
                    $notification->to_id = $manager;
                    $notification->object_id = $event->id;
                    $notification->data = serialize($this->input->post());
                    $notification->save();

                    $user_details = userNameEmail($manager);
                    $check_privacy = unserialize($user_details['email_privacy']);
                    if (is_null($check_privacy) || $check_privacy == false || !isset($check_privacy['event_manager']) || $check_privacy['event_manager'] == 1) {
                        //Send Mail to user
                        $message = str_replace('#user', $user_details['name'], $message);
                        //Send Email
                        $option = array();
                        $option['tomailid'] = $user_details['email'];
                        $option['subject'] = $email->subject;
                        $option['message'] = $message;
                        if (!is_null($email->attachment)) {
                            $option['attachement'] = 'assets/email_attachments/' . $email->attachment;
                        }
                        send_mail($option);
                    }
                }
            }
            $this->session->set_flashdata('success', $this->lang->line('event_add_success'));
            redirect(base_url() . 'event', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('event'));
            
            $event_category = new Eventcategory();
            $event_category->order_by($this->session_data->language . '_name', 'ASC');
            $event_category->get();
            $data['event_categories'] = $event_category;
            
            $city = new City();
            $city->order_by($this->session_data->language . '_name', 'ASC');
            $city->get();
            $data['cities'] = $city;
            
            $academy = New Academy();
            if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                $data['academies'] = $academy->get();
            } else if ($this->session_data->role == '3') {
                $data['academies'] = $academy->getAcademyOfRector($this->session_data->id);
            } else if ($this->session_data->role == '4') {
                $data['academies'] = $academy->getAcademyOfDean($this->session_data->id);
            } else if ($this->session_data->role == '5') {
                $data['academies'] = $academy->getAcademyOfTeacher($this->session_data->id);
            } else if ($this->session_data->role == '6') {
                $data['academies'] = $academy->getAcademyOfStudent($this->session_data->id);
            } else {
                $data['academies'] = NULL;
            }
            
            $school = new School();
            if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                $data['schools'] = $school->get();
            } else if ($this->session_data->role == '3') {
                $data['schools'] = $school->getSchoolOfRector($this->session_data->id);
            } else if ($this->session_data->role == '4') {
                $data['schools'] = $school->getSchoolOfDean($this->session_data->id);
            } else if ($this->session_data->role == '5') {
                $data['schools'] = $school->getSchoolOfTeacher($this->session_data->id);
            } else if ($this->session_data->role == '6') {
                $data['schools'] = $school->getSchoolOfStudent($this->session_data->id);
            } else {
                $data['schools'] = NULL;
            }
            
            $role = new Role();
            $data['roles'] = $role->where('is_manager', 1)->get();
            
            $this->layout->view('events/add', $data);
        }
    }
    
    /*
     *   Edit the event
     *   Param1(required) : event id
    */
    function editEvent($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $event = new Event();
                $event->where('id', $id)->get();
                
                if ($_FILES['event_image']['name'] != '') {
                    $image = $this->uploadImage();
                    if (isset($image['error'])) {
                        $this->session->set_flashdata('file_errors', $image['error']);
                        redirect(base_url() . 'event/edit/' . $id, 'refresh');
                    } else if (isset($image['upload_data'])) {
                        if ($event->image != 'no-cover.jpg') {
                            if (file_exists('assets/img/event_images/' . $event->image)) {
                                unlink('assets/img/event_images/' . $event->image);
                            }
                        }
                        $event->image = $image['upload_data']['file_name'];
                    }
                }
                
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_name';
                    if ($this->input->post($temp) != '') {
                        $event->$temp = $this->input->post($temp);
                    } else {
                        $event->$temp = $this->input->post('en_name');
                    }
                }
                $event->eventcategory_id = $this->input->post('eventcategory_id');
                
                if ($this->input->post('event_for') == 'A') {
                    $event->event_for = 'AC';
                    $school = new School();
                    $event->school_id = implode(',', $school->getAllSchoolIdFromAcademy($this->input->post('academy_id')));
                } else if ($this->input->post('event_for') == 'S') {
                    $event->event_for = 'SC';
                    $event->school_id = implode(',', $this->input->post('school_id'));
                } else {
                    $event->event_for = 'ALL';
                    $event->school_id = '0';
                }
                
                $event->city_id = $this->input->post('city_id');
                $event->date_from = date('Y-m-d', strtotime($this->input->post('date_from')));
                $event->date_to = date('Y-m-d', strtotime($this->input->post('date_to')));
                $event->manager = implode(',', array_unique($this->input->post('manager')));
                $event->description = $this->input->post('description');
                $event->user_id = $this->session_data->id;
                $event->save();
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'event', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('event'));
                
                $events = new Event();
                $data['event'] = $events->where('id', $id)->get();

                $redirect = true;
                if (hasPermission('events', 'editEvent') || in_array($this->session_data->id, explode(',', $events->manager))) {
                    $redirect = false;
                }
                if($redirect){
                     $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                    redirect(base_url(), 'refresh');
                }
                
                $event_category = new Eventcategory();
                $event_category->order_by($this->session_data->language . '_name', 'ASC');
                $event_category->get();
                $data['event_categories'] = $event_category;
                
                $city = new City();
                $city->order_by($this->session_data->language . '_name', 'ASC');
                $city->get();
                $data['cities'] = $city;
                
                $academy = new Academy();
                $academy->order_by($this->session_data->language . '_academy_name', 'ASC');
                $academy->get();
                $data['academies'] = $academy;
                
                $school = new School();
                $school->order_by($this->session_data->language . '_school_name', 'ASC');
                $school->get();
                $data['schools'] = $school;
                
                if ($events->event_for == 'AC') {
                    $school->where_in('id', $events->school_id)->get();
                    $data['academy_id'] = $school->academy_id;
                }
                
                $role = new Role();
                $data['roles'] = $role->where('is_manager', 1)->get();
                
                $selected_manager = new User();
                $data['selected_manager'] = $selected_manager->where_in('id', explode(',', $events->manager))->get();
                
                $this->layout->view('events/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'event', 'refresh');
        }
    }
    
    /*
     *   Delete the event
     *   Param1(required) : event id
    */
    function deleteEvent($id) {
        if (!empty($id)) {
            $event = new Event();
            $event->where('id', $id)->get();

            $redirect = true;
            if (hasPermission('events', 'deleteEvent') || in_array($this->session_data->id, explode(',', $event->manager))) {
                $redirect = false;
            }
            if($redirect){
                 $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                redirect(base_url(), 'refresh');
            }

            if ($event->image != 'no-cover.jpg') {
                if (file_exists('assets/img/event_images/' . $event->image)) {
                    unlink('assets/img/event_images/' . $event->image);
                }
            }

            $obj_eventinvitation = new Eventinvitation();
            $obj_eventinvitation->delete($event);

            $obj_eventattendance = new Eventattendance();
            $obj_eventattendance->delete($event);

            $event->delete();
            
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
        }
        redirect(base_url() . 'event', 'refresh');
    }
    
    //upload the event image keep the original image and conver the image in 780*450 & 300*200 scale
    function uploadImage() {
        $this->upload->initialize(array('upload_path' => "./assets/img/event_images/original", 'allowed_types' => 'jpg|jpeg|gif|png|bmp', 'overwrite' => FALSE, 'remove_spaces' => TRUE, 'encrypt_name' => TRUE));
        
        if (!$this->upload->do_upload('event_image')) {
            $data = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data('event_image'));
            
            $image = str_replace(' ', '_', $data['upload_data']['file_name']);
            $this->load->helper('image_manipulation/image_manipulation');
            include_lib_image_manipulation();
            
            $magicianObj = new imageLib('./assets/img/event_images/original/' . $image);
            
            $magicianObj->resizeImage(780, 450, 'landscape');
            $magicianObj->saveImage('./assets/img/event_images/780X450/' . $image, 100);
            
            $magicianObj->resizeImage(300, 200, 'landscape');
            $magicianObj->saveImage('./assets/img/event_images/300X200/' . $image, 100);
        }
        
        return $data;
    }
    
    /*
     *   Take Attendance of the Students
     *   Param1(required) : event id
    */
    function takeEventAttendance($event_id) {
        
        //check Event it is passed or not
        if (!empty($event_id)) {
            $event_detail = new Event();
            $event_detail->where('id', $event_id)->get();
            
            $redirect = true;
            if (hasPermission('events', 'takeEventAttendance') || in_array($this->session_data->id, explode(',', $event_detail->manager))) {
                $redirect = false;
            }
            
            if($redirect){
                 $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                redirect(base_url(), 'refresh');
            }

            $manager_events_ids = $event_detail->getRunningEventAsManager($this->session_data->id);
            
            //Check data exits or not
            if ($event_detail->result_count() == 1) {
                if ($this->session_data->role > 2) {
                    if (!in_array($event_id, $manager_events_ids) && !in_array($this->session_data->id, explode(',', $event_detail->manager))) {
                        $this->session->set_flashdata('error', $this->lang->line('no_manager_attendance_error'));
                        redirect(base_url() . 'event', 'refresh');
                    }
                }
                
                //Check where the data is post or render view
                if ($this->input->post() !== false) {
                    $data_post = $this->input->post();
                    $obj_event_invitations = new Eventinvitation();
                    $current_date = get_current_date_time()->get_date_for_db();
                    $students = $obj_event_invitations->getStudentsForEvent($event_id, $current_date);
                    $event_ratting_score = new Eventcategory($event_detail->eventcategory_id);
                    
                    foreach ($students as $student) {
                        if (is_null($student['attendance']) || $student['attendance'] == 0) {
                            if ($event_ratting_score->has_point == 1) {
                                $obj_score_history = new Scorehistory();
                                $obj_score_history->meritStudentScore($student['id'], 'xpr', $event_ratting_score->xpr, 'Attending Event');
                                $obj_score_history->meritStudentScore($student['id'], 'war', $event_ratting_score->war, 'Attending Event');
                                $obj_score_history->meritStudentScore($student['id'], 'sty', $event_ratting_score->sty, 'Attending Event');
                            }
                        }
                        
                        $obj_event_attendance = new Eventattendance();
                        $obj_event_attendance->where(array('event_id' => $event_id, 'student_id' => $student['id'], 'event_date' => $current_date))->get();
                        $obj_event_attendance->event_id = $event_id;
                        $obj_event_attendance->student_id = $student['id'];
                        $obj_event_attendance->event_date = $current_date;
                        $obj_event_attendance->attendance = $data_post['student'][$student['id']];
                        $obj_event_attendance->user_id = $this->session_data->id;
                        $obj_event_attendance->save();
                    }
                    
                    $this->session->set_flashdata('success', $this->lang->line('Attendance taken Successfully'));
                    redirect(base_url() . 'event/attendance/' . $event_id, 'refresh');
                } else {
                    
                    //set array for view part
                    $data['event_detail'] = $event_detail;
                    
                    $obj_event_invitations = new Eventinvitation();
                    $current_date = get_current_date_time()->get_date_for_db();
                    $data['event_students'] = $obj_event_invitations->getStudentsForEvent($event_id, $current_date);
                    
                    $data['show_save_button'] = false;
                    $running_events_ids = $event_detail->getRunningEventIDS();
                    if (in_array($event_id, $running_events_ids)) {
                        $data['show_save_button'] = true;
                    }
                    $this->layout->view('events/take_attendance', $data);
                }
            } else {
                $this->session->set_flashdata('error', $this->lang->line('no_data_exit'));
                redirect(base_url() . 'event', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'event', 'refresh');
        }
    }
    
    /*
     *   Send invitations to Users
     *   Param1(required) : event id
    */
    function sendEventInvitation($event_id) {
        
        //check Event it is passed or not
        if (!empty($event_id)) {
            $event_detail = new Event();
            $event_detail->where('id', $event_id)->get();

            $redirect = true;
            if (in_array($this->session_data->id, explode(',', $event_detail->manager))) {
                $redirect = false;
            }

            if($redirect){
                 $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                redirect(base_url(), 'refresh');
            }
            
            //Check data exits or not
            if ($event_detail->result_count() == 1) {
                
                //Check where the data is post or render view
                if ($this->input->post() !== false) {
                    $user_ids = array();
                    
                    //Get the Individuals ids
                    if ($this->input->post('to_individuals') !== false) {
                        $user_ids[] = $this->input->post('to_individuals');
                    }
                    
                    //Get the Academy ids
                    if ($this->input->post('to_academies') !== false) {
                        foreach ($this->input->post('to_academies') as $academy_id) {
                            $user_ids[] = $this->_getIds('to_academies', $academy_id);
                        }
                    }
                    
                    //Get the School ids
                    if ($this->input->post('to_schools') !== false) {
                        foreach ($this->input->post('to_schools') as $school_id) {
                            $user_ids[] = $this->_getIds('to_schools', $school_id);
                        }
                    }
                    
                    //Get the Clans ids
                    if ($this->input->post('to_clans') !== false) {
                        foreach ($this->input->post('to_clans') as $clan_id) {
                            $user_ids[] = $this->_getIds('to_clans', $clan_id);
                        }
                    }
                    
                    //Get the Students ids
                    if ($this->input->post('to_students') !== false) {
                        $user_ids[] = $this->input->post('to_students');
                    }
                    
                    $email = new Email();
                    
                    //get the mail templates
                    $email->where('type', 'event_invitation')->get();
                    $message = $email->message;
                    
                    if (!empty($event_detail->image)) {
                        $path = 'assets/img/event_images/' . $event_detail->image;
                        if (file_exists($path)) {
                            $base64 = base_url() . $path;
                            $image = '<img src="' . $base64 . '" style="width:25%"/>';
                        } else {
                            $image = '&nbsp;';
                        }
                    } else {
                        $image = '&nbsp;';
                    }
                    
                    //replace appropriate varaibles
                    $message = str_replace('#event_name', $event_detail->en_name, $message);
                    $message = str_replace('#from_date', date('d-m-Y', strtotime($event_detail->date_from)), $message);
                    $message = str_replace('#to_date', date('d-m-Y', strtotime($event_detail->date_to)), $message);
                    $message = str_replace('#location', getFullLocationByCity($event_detail->city_id), $message);
                    $message = str_replace('#event_image', $image, $message);
                    $user_info = userNameAvtar($event_detail->user_id);
                    $message = str_replace('#event_created_by', $user_info['name'], $message);
                    $message = str_replace('#invitation_send_by', $this->session_data->name, $message);
                    
                    //Now from multidimensional array make single dimensional and get only unique values
                    $user_ids = array_unique(MultiArrayToSinlgeArray($user_ids));
                    
                    //Short the array
                    sort($user_ids);
                    
                    //loop through each user
                    foreach ($user_ids as $user) {
                        
                        //Save - Update the Invitation
                        $invitations = new Eventinvitation();
                        $invitations->where(array('event_id' => $event_id, 'from_id' => $this->session_data->id, 'to_id' => $user))->get();
                        $invitations->event_id = $event_id;
                        $invitations->from_id = $this->session_data->id;
                        $invitations->to_id = $user;
                        $invitations->save();
                        
                        if ($user == $this->session_data->id) {
                            continue;
                        } else {
                            
                            //Send notification to User
                            $notification = new Notification();
                            $notification->type = 'N';
                            $notification->notify_type = 'event_invitation';
                            $notification->from_id = $this->session_data->id;
                            $notification->to_id = $user;
                            $notification->object_id = $event_detail->id;
                            $notification->data = serialize(array_merge(objectToArray($event_detail->stored), $this->input->post()));
                            $notification->save();
                            
                            $user_details = userNameEmail($user);
                            $check_privacy = unserialize($user_details['email_privacy']);
                            if (is_null($check_privacy) || $check_privacy == false || !isset($check_privacy['event_invitation']) || $check_privacy['event_invitation'] == 1) {
                                
                                //Send Mail to user
                                $message = str_replace('#user', $user_details['name'], $message);
                                
                                //Send Email
                                $option = array();
                                $option['tomailid'] = $user_details['email'];
                                $option['subject'] = $email->subject;
                                $option['message'] = $message;
                                if (!is_null($email->attachment)) {
                                    $option['attachement'] = 'assets/email_attachments/' . $email->attachment;
                                }
                                send_mail($option);
                            }
                        }
                    }
                    
                    $this->session->set_flashdata('success', $this->lang->line('invitation_send_successfully'));
                    redirect(base_url() . 'event/view/' . $event_id, 'refresh');
                } else {
                    
                    //set array for view part
                    $data['event_detail'] = $event_detail;
                    $data['users'] = $this->_getUsers();
                    $data['academies'] = $this->_getAcademies();
                    $data['schools'] = $this->_getSchools();
                    $data['clans'] = $this->_getClans();
                    $data['students'] = $this->_getStudents();
                    $this->layout->view('events/send_invitation', $data);
                }
            } else {
                $this->session->set_flashdata('error', $this->lang->line('no_data_exit'));
                redirect(base_url() . 'dashboard', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh');
        }
    }
    
    //get the related Users
    private function _getUsers() {
        
        //Role Super Admin get all user
        if ($this->session_data->role == 1) {
            $user = new User();
            return $user->where('status', 'A')->get();
        }
        
        //Role Admin get all user
        if ($this->session_data->role == 2) {
            $user = new User();
            return $user->where(array('role_id <>' => 1, 'status' => 'A'))->get();
        }
        
        //Role Rector
        if ($this->session_data->role == 3) {
            $array = array();
            
            $academy = new Academy();
            
            //Get related Rector of Rector
            $array[] = $academy->getRelatedRectorsByRector($this->session_data->id);
            
            $school = new School();
            
            //Get related Deans of Rector
            $array[] = $school->getRelatedDeansByRector($this->session_data->id);
            
            $class = new Clan();
            
            //Get related Teacher of Rector
            $array[] = $class->getRelatedTeachersByRector($this->session_data->id);
            
            $user_detail = new Userdetail();
            
            //Get related Students of Rector
            $array[] = $user_detail->getRelatedStudentsByRector($this->session_data->id);
            
            $user = new User();
            
            //convert multi array to single and from that get unique id details
            return $user->getUsersDetails(array_unique(MultiArrayToSinlgeArray($array)));
        }
        
        //Role Dean
        if ($this->session_data->role == 4) {
            $array = array();
            
            $academy = new Academy();
            
            //Get related Rector of Dean
            $array[] = $academy->getRelatedRectorsByDean($this->session_data->id);
            
            $school = new School();
            
            //Get related Dean of Dean
            $array[] = $school->getRelatedDeansByDean($this->session_data->id);
            
            $class = new Clan();
            
            //Get related Teacher of Dean
            $array[] = $class->getRelatedTeachersByDean($this->session_data->id);
            
            $user_detail = new Userdetail();
            
            //Get related Student of Dean
            $array[] = $user_detail->getRelatedStudentsByDean($this->session_data->id);
            
            $user = new User();
            
            //convert multi array to single and from that get unique id details
            return $user->getUsersDetails(array_unique(MultiArrayToSinlgeArray($array)));
        }
        
        //Role Teacher
        if ($this->session_data->role == 5) {
            $array = array();
            
            $academy = new Academy();
            
            //Get related Rector of Teacher
            $array[] = $academy->getRelatedRectorsByTeacher($this->session_data->id);
            
            $school = new School();
            
            //Get related Dean of Teacher
            $array[] = $school->getRelatedDeansByTeacher($this->session_data->id);
            
            $class = new Clan();
            
            //Get related Teacher of Teacher
            $array[] = $class->getRelatedTeachersByTeacher($this->session_data->id);
            
            $user_detail = new Userdetail();
            
            //Get related Student of Teacher
            $array[] = $user_detail->getRelatedStudentsByTeacher($this->session_data->id);
            
            $user = new User();
            
            //convert multi array to single and from that get unique id details
            return $user->getUsersDetails(array_unique(MultiArrayToSinlgeArray($array)));
        }
        
        //Role Student
        if ($this->session_data->role == 6) {
            $array = array();
            
            $academy = new Academy();
            
            //Get related Rector of Student
            $array[] = $academy->getRelatedRectorsByStudent($this->session_data->id);
            
            $school = new School();
            
            //Get related Dean of Student
            $array[] = $school->getRelatedDeansByStudent($this->session_data->id);
            
            $class = new Clan();
            
            //Get related Teacher of Student
            $array[] = $class->getRelatedTeachersByStudent($this->session_data->id);
            
            $user_detail = new Userdetail();
            
            //Get related Student of Student
            $array[] = $user_detail->getRelatedStudentsByStudent($this->session_data->id);
            
            $user = new User();
            
            //convert multi array to single and from that get unique id details
            return $user->getUsersDetails(array_unique(MultiArrayToSinlgeArray($array)));
        }
    }
    
    //get the related Academies
    private function _getAcademies() {
        
        //Role Super Admin get all Academies
        if ($this->session_data->role == 1) {
            $academy = new Academy();
            return $academy->get();
        }
        
        //Role Super Admin get all Academies
        if ($this->session_data->role == 2) {
            $academy = new Academy();
            return $academy->get();
        }
        
        //Role Rector then get all academies related to rector
        if ($this->session_data->role == 3) {
            $academy = new Academy();
            return $academy->getAcademyOfRector($this->session_data->id);
        }
        
        //Role Dean then get all academies related to dean
        if ($this->session_data->role == 4) {
            $academy = new Academy();
            return $academy->getAcademyOfDean($this->session_data->id);
        }
        
        //Role Teacher then get all academies related to teacher
        if ($this->session_data->role == 5) {
            $academy = new Academy();
            return $academy->getAcademyOfTeacher($this->session_data->id);
        }
        
        //Role Student then get all academies related to student
        if ($this->session_data->role == 6) {
            $academy = new Academy();
            return $academy->getAcademyOfStudent($this->session_data->id);
        }
    }
    
    //get the related Schools
    private function _getSchools() {
        
        //Role Super Admin get all Schools
        if ($this->session_data->role == 1) {
            $school = new School();
            return $school->get();
        }
        
        ///Role Admin get all Schools
        if ($this->session_data->role == 2) {
            $school = new School();
            return $school->get();
        }
        
        //Role Rector then get all schools related to rector
        if ($this->session_data->role == 3) {
            $school = new School();
            return $school->getSchoolOfRector($this->session_data->id);
        }
        
        //Role Dean then get all schools related to dean
        if ($this->session_data->role == 4) {
            $school = new School();
            return $school->getSchoolOfDean($this->session_data->id);
        }
        
        //Role Teacher then get all schools related to teacher
        if ($this->session_data->role == 5) {
            $school = new School();
            return $school->getSchoolOfTeacher($this->session_data->id);
        }
        
        //Role Student then get all schools related to student
        if ($this->session_data->role == 6) {
            $school = new School();
            return $school->getSchoolOfStudent($this->session_data->id);
        }
    }
    
    //get the related Clans
    private function _getClans() {
        
        //Role Super Admin get all Clans
        if ($this->session_data->role == 1) {
            $clan = new Clan();
            return $clan->get();
        }
        
        //Role Admin get all Clans
        if ($this->session_data->role == 2) {
            $clan = new Clan();
            return $clan->get();
        }
        
        //Role Rector then get all clans related to rector
        if ($this->session_data->role == 3) {
            $clan = new Clan();
            return $clan->getClanOfRector($this->session_data->id);
        }
        
        //Role Dean then get all clans related to dean
        if ($this->session_data->role == 4) {
            $clan = new Clan();
            return $clan->getClanOfDean($this->session_data->id);
        }
        
        //Role Teacher then get all clans related to teacher
        if ($this->session_data->role == 5) {
            $clan = new Clan();
            return $clan->getClanOfTeacher($this->session_data->id);
        }
        
        //Role Student then get all clans related to student
        if ($this->session_data->role == 6) {
            $clan = new Clan();
            return $clan->getClanOfStudent($this->session_data->id);
        }
    }
    
    //get the related Students
    private function _getStudents() {
        
        //Role Super Admin then get all students
        if ($this->session_data->role == 1) {
            $student = new User();
            return $student->where(array('role_id' => 6, 'status' => 'A'))->get();
        }
        
        //Role Admin then get all students
        if ($this->session_data->role == 2) {
            $student = new User();
            return $student->where(array('role_id' => 6, 'status' => 'A'))->get();
        }
        
        //Role Rector then get all students related to rector
        if ($this->session_data->role == 3) {
            $student = new Userdetail();
            $array = $student->getRelatedStudentsByRector($this->session_data->id);
            
            $user = new User();
            return $user->getUsersDetails($array);
        }
        
        //Role Dean then get all students related to dean
        if ($this->session_data->role == 4) {
            $student = new Userdetail();
            $array = $student->getRelatedStudentsByDean($this->session_data->id);
            
            $user = new User();
            return $user->getUsersDetails($array);
        }
        
        //Role Teacher then get all students related to teacher
        if ($this->session_data->role == 5) {
            $student = new Userdetail();
            $array = $student->getRelatedStudentsByTeacher($this->session_data->id);
            
            $user = new User();
            return $user->getUsersDetails($array);
        }
        
        //Role Student then get all students related to sudent
        if ($this->session_data->role == 6) {
            $student = new Userdetail();
            $array = $student->getRelatedStudentsByStudent($this->session_data->id);
            
            $user = new User();
            return $user->getUsersDetails($array);
        }
    }
    
    /*
     *   get the user id
     *   Param1(required) : to_academies | to_schools | to_clans
     *   Param2(required) : academy_id   | school_id  | clan_id
     *   return : array of the user ids.
    */
    private function _getIds($type, $id) {
        if ($type == 'to_academies') {
            $array = array();
            
            $academy = new Academy();
            
            //get all the rectors ids of an academy
            $array[] = $academy->getRecotrsByAcademy($id);
            
            $school = new School();
            
            //get all the deans ids of an academy
            $array[] = $school->getDeansByAcademy($id);
            
            $clan = new Clan();
            
            //get all the teachers ids of an academy
            $array[] = $clan->getTeachersByAcademy($id);
            
            $user = new Userdetail();
            
            //get all the students ids of an academy
            $array[] = $user->getStudentsByAcademy($id);
            
            //convert multi array to single and from that get unique ids
            $array = array_unique(MultiArrayToSinlgeArray($array));
            sort($array);
            
            return $array;
        }
        
        if ($type == 'to_schools') {
            $array = array();
            
            $academy = new Academy();
            
            //get all the rectors ids of an school
            $array[] = $academy->getRecotrsBySchool($id);
            
            $school = new School();
            
            //get all the deans ids of an school
            $array[] = $school->getDeansBySchool($id);
            
            $clan = new Clan();
            
            //get all the teachers ids of an school
            $array[] = $clan->getTeachersBySchool($id);
            
            $user = new Userdetail();
            
            //get all the students ids of an school
            $array[] = $user->getStudentsBySchool($id);
            
            //convert multi array to single and from that get unique ids
            $array = array_unique(MultiArrayToSinlgeArray($array));
            sort($array);
            
            return $array;
        }
        
        if ($type == 'to_clans') {
            $array = array();
            
            $academy = new Academy();
            
            //get all the rectors ids of an clan
            $array[] = $academy->getRecotrsByClan($id);
            
            $school = new School();
            
            //get all the deans ids of an clan
            $array[] = $school->getDeansByClan($id);
            
            $clan = new Clan();
            
            //get all the teachers ids of an clan
            $array[] = $clan->getTeachersByClan($id);
            
            $user = new Userdetail();
            
            //get all the students ids of an clan
            $array[] = $user->getStudentsByClan($id);
            
            //convert multi array to single and from that get unique ids
            $array = array_unique(MultiArrayToSinlgeArray($array));
            sort($array);
            
            return $array;
        }
    }
}
