<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class clans extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('clan'));
        $this->session_data = $this->session->userdata('user_session');
    }

    function viewClan($id = null, $type = null) {
        $academy = New Academy();
        if ($this->session_data->role == '1' || $this->session_data->role == '2') {
            $academy->get();
            $temp = array();
            foreach ($academy as $ac) {
                foreach ($ac->school->get() as $school) {
                    $temp[] = $school;
                }
            }
            $data['schools'] = $temp;
        } else {
            $school = new School();
            $data['schools'] = $school->getSchoolOfRector($this->session_data->id);
        }

        if (is_null($id)) {
            $this->layout->view('clans/view', $data);
        } else if (!is_null($id) && $type == "list_clan_school_wise") {
            $data['school_id'] = $id;
            $this->layout->view('clans/view', $data);
        } else {
            if ($type == 'notification') {
                Notification::updateNotification('teacher_assign_class', $this->session_data->id, $id);
            }

            $obj = new Clan();
            $data['clan'] = $obj->where('id', $id)->get();
            $this->layout->view('clans/view_single', $data);
        }
    }

    function addClan() {
        if ($this->input->post() !== false) {
            $obj = new Clan();
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_class_name';
                if ($this->input->post($temp) != '') {
                    $obj->$temp = $this->input->post($temp);
                } else {
                    $obj->$temp = $this->input->post('en_class_name');
                }
            }

            $obj->academy_id = $this->input->post('academy_id');
            $obj->school_id = $this->input->post('school_id');
            $obj->teacher_id = implode(',', $this->input->post('teacher_id'));
            $obj->level_id = $this->input->post('level_id');
            $obj->lesson_day = implode(',', $this->input->post('lesson_day'));
            $obj->lesson_from = strtotime($this->input->post('lesson_from'));
            $obj->lesson_to = strtotime($this->input->post('lesson_to'));

            if ($this->input->post('same_addresss') != '1') {
                $obj->same_address = 0;
                $obj->address = $this->input->post('address');
                $obj->postal_code = $this->input->post('postal_code');
                $obj->city_id = $this->input->post('city_id');
                $obj->state_id = $this->input->post('state_id');
                $obj->country_id = $this->input->post('country_id');
                $obj->phone_1 = $this->input->post('phone_1');
                $obj->phone_2 = @$this->input->post('phone_2');
                $obj->email = $this->input->post('email');
            } else {
                $school = new School();
                $school->where('id', $this->input->post('school_id'))->get();
                $obj->same_address = 1;
                $obj->address = $school->address;
                $obj->postal_code = $school->postal_code;
                $obj->city_id = $school->city_id;
                $obj->state_id = $school->state_id;
                $obj->country_id = $school->country_id;
                $obj->phone_1 = $school->phone_1;
                $obj->phone_2 = $school->phone_2;
                $obj->email = $school->email;
            }

            $obj->user_id = $this->session_data->id;
            $obj->save();

            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'clan', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('clan'));

            $users = New User();
            $data['users'] = $users->getUsersByRole(5);

            $countries = New Country();
            $data['countries'] = $countries->get();

            $level = New Level();
            $data['levels'] = $level->get();

            $academy = New Academy();
            if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                $data['academies'] = $academy->get();
            } else {
                $data['academies'] = $academy->getAcademyOfRector($this->session_data->id);
            }


            $this->layout->view('clans/add', $data);
        }
    }

    function editClan($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $obj = new Clan();
                $obj->where('id', $id)->get();
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_class_name';
                    if ($this->input->post($temp) != '') {
                        $obj->$temp = $this->input->post($temp);
                    } else {
                        $obj->$temp = $this->input->post('en_class_name');
                    }
                }

                $obj->academy_id = $this->input->post('academy_id');
                $obj->school_id = $this->input->post('school_id');
                $obj->teacher_id = implode(',', $this->input->post('teacher_id'));
                $obj->level_id = $this->input->post('level_id');
                $obj->lesson_day = implode(',', $this->input->post('lesson_day'));
                $obj->lesson_from = strtotime($this->input->post('lesson_from'));
                $obj->lesson_to = strtotime($this->input->post('lesson_to'));

                if ($this->input->post('same_addresss') != '1') {
                    $obj->same_address = 0;
                    $obj->address = $this->input->post('address');
                    $obj->postal_code = $this->input->post('postal_code');
                    $obj->city_id = $this->input->post('city_id');
                    $obj->state_id = $this->input->post('state_id');
                    $obj->country_id = $this->input->post('country_id');
                    $obj->phone_1 = $this->input->post('phone_1');
                    $obj->phone_2 = @$this->input->post('phone_2');
                    $obj->email = $this->input->post('email');
                } else {
                    $school = new School();
                    $school->where('id', $this->input->post('school_id'))->get();
                    $obj->same_address = 1;
                    $obj->address = $school->address;
                    $obj->postal_code = $school->postal_code;
                    $obj->city_id = $school->city_id;
                    $obj->state_id = $school->state_id;
                    $obj->country_id = $school->country_id;
                    $obj->phone_1 = $school->phone_1;
                    $obj->phone_2 = $school->phone_2;
                    $obj->email = $school->email;
                }

                $obj->user_id = $this->session_data->id;
                $obj->save();

                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'clan', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('clan'));

                $obj = new Clan();
                $data['clan'] = $obj->where('id', $id)->get();

                $users = New User();
                $data['users'] = $users->getUsersByRole(5);

                $academy = New Academy();
                if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                    $data['academies'] = $academy->get();
                } else {
                    $data['academies'] = $academy->where('rector_id', $this->session_data->id)->get();
                }

                $school = new School();
                $data['schools'] = $school->where('academy_id', $obj->academy_id)->get();

                $countries = New Country();
                $data['countries'] = $countries->get();

                $states = New State();
                $data['states'] = $states->where('country_id', $obj->country_id)->get();

                $cities = New City();
                $data['cities'] = $cities->where('state_id', $obj->state_id)->get();

                $level = New Level();
                $data['levels'] = $level->get();

                $this->layout->view('clans/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'clan', 'refresh');
        }
    }

    function deleteClan($id) {
        if (!empty($id)) {
            $clan = new Clan();
            $clan->where('id', $id)->get();
            /* foreach ($clan->School as $user) {
              $user->User_details->delete_all();
              }
              $clan->School->delete_all(); */
            $clan->delete();

            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'clan', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'clan', 'refresh');
        }
    }

    function clanTeacherList($id = 0, $type = 'all') {
        $this->layout->setField('page_title', $this->lang->line('list') . ' ' . $this->lang->line('teachers'));

        $academy = new Academy();
        $school = new School();
        $clan = new Clan();

        if ($id != 0 && $type == 'academy') {
            $data['all_academies'] = $academy->where('id', $id)->get();
            $data['all_schools'] = $academy->school->get();
            $data['all_clans'] = $academy->school->clan->get();

            $data['academy_id'] = $id;
        } else if ($id != 0 && $type == 'school') {
            $temp = $school->where('id', $id)->get();
            $data['all_schools'] = $school->where('academy_id', $temp->academy_id)->get();
            $data['all_academies'] = $school->academy->get();
            $data['all_clans'] = $school->clan->get();

            $data['academy_id'] = $temp->academy_id;
            $data['school_id'] = $id;
        } else if ($id != 0 && $type == 'clan') {
            $temp = $clan->where('id', $id)->get();
            $data['all_clans'] = $clan->where('school_id', $temp->school_id)->get();
            $data['all_schools'] = $clan->school->get();
            $data['all_academies'] = $clan->school->academy->get();

            $data['academy_id'] = $temp->academy_id;
            $data['school_id'] = $temp->school_id;
            $data['clan_id'] = $id;
        } else {
            if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                $data['all_academies'] = $academy->get();
                $data['all_schools'] = $school->get();
                $data['all_clans'] = $clan->get();
            } else if ($this->session_data->role == '3') {
                $data['all_academies'] = $academy->getAcademyOfRector($this->session_data->id);
                $data['all_schools'] = $school->getSchoolOfRector($this->session_data->id);
                $data['all_clans'] = $clan->getClanOfRector($this->session_data->id);
            } else if ($this->session_data->role == '4') {
                $data['all_academies'] = $academy->getAcademyOfDean($this->session_data->id);
                $data['all_schools'] = $school->getSchoolOfDean($this->session_data->id);
                $data['all_clans'] = $clan->getClanOfDean($this->session_data->id);
            } else if ($this->session_data->role == '5') {
                $data['all_academies'] = $academy->getAcademyOfTeacher($this->session_data->id);
                $data['all_schools'] = $school->getSchoolOfTeacher($this->session_data->id);
                $data['all_clans'] = $clan->getClanOfTeacher($this->session_data->id);
            }
        }

        $this->layout->view('clans/teacher_list', $data);
    }

    function clanStudentList($id = 0, $type = 'all') {
        $this->layout->setField('page_title', $this->lang->line('list') . ' ' . $this->lang->line('student'));

        $academy = new Academy();
        $school = new School();
        $clan = new Clan();

        if ($id != 0 && $type == 'academy') {
            $data['all_academies'] = $academy->where('id', $id)->get();
            $data['all_schools'] = $academy->school->get();
            $data['all_clans'] = $academy->school->clan->get();

            $data['academy_id'] = $id;
        } else if ($id != 0 && $type == 'school') {
            $temp = $school->where('id', $id)->get();
            $data['all_schools'] = $school->where('academy_id', $temp->academy_id)->get();
            $data['all_academies'] = $school->academy->get();
            $data['all_clans'] = $school->clan->get();

            $data['academy_id'] = $temp->academy_id;
            $data['school_id'] = $id;
        } else if ($id != 0 && $type == 'clan') {
            $temp = $clan->where('id', $id)->get();
            $data['all_clans'] = $clan->where('school_id', $temp->school_id)->get();
            $data['all_schools'] = $clan->school->get();
            $data['all_academies'] = $clan->school->academy->get();

            $data['academy_id'] = $temp->academy_id;
            $data['school_id'] = $temp->school_id;
            $data['clan_id'] = $id;
        } else {
            if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                $data['all_academies'] = $academy->get();
                $data['all_schools'] = $school->get();
                $data['all_clans'] = $clan->get();
            } else if ($this->session_data->role == '3') {
                $data['all_academies'] = $academy->getAcademyOfRector($this->session_data->id);
                $data['all_schools'] = $school->getSchoolOfRector($this->session_data->id);
                $data['all_clans'] = $clan->getClanOfRector($this->session_data->id);
            } else if ($this->session_data->role == '4') {
                $data['all_academies'] = $academy->getAcademyOfDean($this->session_data->id);
                $data['all_schools'] = $school->getSchoolOfDean($this->session_data->id);
                $data['all_clans'] = $clan->getClanOfDean($this->session_data->id);
            } else if ($this->session_data->role == '5') {
                $data['all_academies'] = $academy->getAcademyOfTeacher($this->session_data->id);
                $data['all_schools'] = $school->getSchoolOfTeacher($this->session_data->id);
                $data['all_clans'] = $clan->getClanOfTeacher($this->session_data->id);
            }
        }

        $this->layout->view('clans/student_list', $data);
    }

    function listTrialLessonRequest($clan_id) {
        $clan = new Clan();
        $data['clan_details'] = $clan->where('id', $clan_id)->get();
        $this->layout->view('clans/trial_lesson_request', $data);
    }

    function changeStatusTrialStudent($clan_id, $student_master_id, $type = null) {
        if ($type == 'notification') {
            Notification::updateNotification('apply_trial_lesson', $this->session_data->id, $student_master_id);
            Notification::updateNotification('trial_lesson_approved', $this->session_data->id, $student_master_id);
            Notification::updateNotification('trial_lesson_unapproved', $this->session_data->id, $student_master_id);
        }

        if (!empty($student_master_id)) {
            $userdetail = new Userdetail();
            $userdetail->where(array('student_master_id' => $student_master_id, 'clan_id' => $clan_id))->get();
            if ($userdetail->result_count() == 1) {
                if ($this->input->post() !== false) {

                    $userdetail->where(array('student_master_id' => $student_master_id, 'clan_id' => $clan_id))->update('status', $this->input->post('status'));
                    $userdetail->where(array('student_master_id' => $student_master_id, 'clan_id' => $clan_id))->update('approved_by', $this->session_data->id);

                    $notification_type = 'trial_lesson_unapproved';

                    if ($this->input->post('status') == 'A') {
                        $attadence = new Attendance();
                        $attadence->clan_date = $userdetail->first_lesson_date;
                        $attadence->student_id = $userdetail->student_master_id;
                        $attadence->user_id = $this->session_data->id;
                        $attadence->save();
                        $notification_type = 'trial_lesson_approved';
                    } else if ($this->input->post('status') == 'U') {
                        $attadence = new Attendance();
                        $attadence->where(array('student_id' => $student_master_id, 'clan_date' => $userdetail->first_lesson_date))->get();
                        $attadence->delete();
                    } else if ($this->input->post('status') == 'AS') {
                        $user = new User();
                        $user->where(array('id' => $student_master_id))->update('status', 'A');
                        $notification_type = 'accept_as_student';
                    }

                    $notification = new Notification();
                    $notification->type = 'N';
                    $notification->notify_type = $notification_type;
                    $notification->from_id = $this->session_data->id;
                    $notification->to_id = $userdetail->student_master_id;
                    $notification->object_id = $userdetail->student_master_id;
                    $notification->data = serialize($this->input->post());
                    $notification->save();


                    $ids = array();
                    $ids[] = User::getAdminIds();

                    $clan = new Clan();
                    $clan->where('id', $this->input->post('clan_id'))->get();
                    $ids[] = array_unique(explode(',', $clan->school->academy->rector_id . ',' . $clan->school->dean_id . ',' . $clan->teacher_id));

                    $final_ids = array_unique(MultiArrayToSinlgeArray($ids));
                    $user = new User();
                    $user->where_in('id', $final_ids);

                    foreach ($user->get() as $value) {
                        if ($value->id == $this->session_data->id) {
                            continue;
                        } else {
                            $notification = new Notification();
                            $notification->type = 'N';
                            $notification->notify_type = $notification_type;
                            $notification->from_id = $this->session_data->id;
                            $notification->to_id = $value->id;
                            $notification->object_id = 0;
                            $notification->data = serialize($this->input->post());
                            $notification->save();
                        }
                    }

                    $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                    redirect(base_url() . 'clan/trial_lesson_request/' . $clan_id, 'refresh');
                } else {
                    $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('trial_lesson'));
                    $data['userdetail'] = $userdetail;
                    $data['profile'] = $userdetail->User->get();
                    $data['clan'] = $userdetail->Clan->get();

                    $this->layout->view('clans/approve_trial_request', $data);
                }
            } else {
                $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
                redirect(base_url() . 'clan/trial_lesson_request/' . $clan_id, 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'clan/trial_lesson_request/' . $clan_id, 'refresh');
        }
    }

}
