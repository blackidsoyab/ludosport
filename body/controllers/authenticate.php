<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class authenticate extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->layout->setLayout('template/layout_login');
        $this->layout->setField('page_title', 'User Login');

        setLanguage();
    }

    public function index() {
        $session = $this->session->userdata('user_session');
        if (!empty($session)) {
            $this->session->set_flashdata('info', 'You are already logged in :)');
            redirect(base_url() . 'dashboard', 'refresh');
        } else {
            $this->layout->view('authenticate/login');
        }
    }

    function validateUser() {
        $user = new User();
        $user->where('username', $this->input->post('username'));
        $user->where('password', md5($this->input->post('password')));
        $user->get();

        if ($user->result_count() === 1) {
            if ($user->status == 'D') {
                $this->session->set_flashdata('info', 'You are not an active member. <br /> Contact Admin.');
                redirect(base_url() . 'login', 'refresh');
            } else {
                $roles = explode(',', $user->role_id);
                $user_data = new stdClass();
                $user_data->id = $user->id;
                $user_data->name = $user->firstname . ' ' . $user->lastname;
                $user_data->avtar = $user->avtar;
                $user_data->language = 'en';
                $user_data->all_roles = $roles;
                $user_data->role = $roles[0];
                $user_data->status = $user->status;
                $newdata = array('user_session' => $user_data);
                $this->session->set_userdata($newdata);
                $this->setLastNotification($user->id);
                redirect(base_url() . 'dashboard', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid Username or Password');
            redirect(base_url() . 'login', 'refresh');
        }
    }

    function setLastNotification($user_id) {
        $notification = new Notification();
        $notification->where(array('to_id' => $user_id, 'status' => 0));
        $notification->order_by('id', 'desc');
        $notification->limit(1);
        $notification->get();
        if (!empty($notification->id)) {
            $this->session->set_userdata('last_notification_id', $notification->id);
        } else {
            $this->session->set_userdata('last_notification_id', '0');
        }
    }

    function logout() {
        $this->session->unset_userdata('user_session');
        $this->session->sess_destroy();

        redirect(base_url() . 'login', 'refresh');
    }

    function permission() {
        $this->layout->setLayout('template/layout_permission');
        $this->layout->setField('page_title', 'Permission Denied');
        $this->layout->view('authenticate/permission');
    }

    function register() {
        $this->layout->setField('page_title', 'Registration');
        $city = new City();
        $data['cities'] = $city->get();
        $this->layout->view('authenticate/register', $data);
    }

    function saveUser() {
        $new_user = new User();
        $new_user->role_id = 6;
        $new_user->firstname = $this->input->post('firstname');
        $new_user->lastname = $this->input->post('lastname');
        $new_user->username = $this->input->post('username');
        $new_user->city_id = $this->input->post('city_id');
        $city = new City();
        $city->where('id', $this->input->post('city_id'))->get();
        $new_user->state_id = $city->state->id;
        $new_user->country_id = $city->state->country->id;
        $new_user->date_of_birth = strtotime(date('Y-m-d', strtotime($this->input->post('date_of_birth'))));
        $new_user->email = $this->input->post('email');
        $new_user->password = md5($this->input->post('password'));
        if ($new_user->save()) {
            //Mail Template for registration thanks
            $email = new Email();
            $email->where('type', 'user_registration')->get();
            $message = $email->message;
            $message = str_replace('#firstname', $new_user->firstname, $message);
            $message = str_replace('#lastname', $new_user->lastname, $message);

            //Save mail in our mail box
            $mailbox = new Mailbox();
            $mailbox->type = 'L';
            $mailbox->to_email = $new_user->email;
            $mailbox->subject = $email->subject;
            $mailbox->message = $message;
            $mailbox->attachment = $email->attachment;
            $mailbox->save();

            //Get all the Admins, Rectors, Deans, Teachers
            $ids = array();
            $ids[] = User::getAdminIds();
            $ids[] = Academy::getAssignRectorIds();
            $ids[] = School::getAssignDeanIds();
            $ids[] = Clan::getAssignTeacherIds();

            //Make single array form all ids
            $final_ids = array_unique(MultiArrayToSinlgeArray($ids));

            //Fecth all the User details
            $user = new User();
            $user->where_in('id', $final_ids);

            // Mail Template for new user register notification to all above ids
            $email = new Email();
            $email->where('type', 'user_registration_notification')->get();
            $message = $email->message;
            $message = str_replace('#firstname', $new_user->firstname, $message);
            $message = str_replace('#lastname', $new_user->lastname, $message);
            $message = str_replace('#date', get_current_date_time()->get_date_time_for_db(), $message);

            foreach ($user->get() as $value) {
                //Add notification
                $notification = new Notification();
                $notification->type = 'I';
                $notification->notify_type = 'user_register';
                $notification->from_id = 0;
                $notification->to_id = $value->id;
                $notification->object_id = $new_user->id;
                $notification->save();

                //Add details in our mail box
                $mailbox = new Mailbox();
                $mailbox->type = 'L';
                $mailbox->to_email = $value->email;
                $mailbox->subject = $email->subject;
                $mailbox->message = $message;
                $mailbox->attachment = $email->attachment;
                $mailbox->save();
            }

            $this->session->set_flashdata('success', 'Login with Username or Password');
            redirect(base_url() . 'login', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Invalid Username or Password');
            redirect(base_url() . 'register', 'refresh');
        }
    }

    function userForgotPassword() {
        $this->layout->setField('page_title', $this->lang->line('forgot_password'));
        $this->layout->view('authenticate/forgot_password');
    }

    function userSendResetPasswordLink() {
        $user = new User();
        $user->where('email', $this->input->post('user_email'))->get();

        $email = new Email();
        $email->where('type', 'forgot_password')->get();
        if ($user->result_count() == 1 && $email->result_count() == 1) {
            $random_string = random_string('alnum', 32);
            $user->password = $random_string;
            $user->save();
            $message = $email->message;
            $message = str_replace('#firstname', $user->firstname, $message);
            $message = str_replace('#lastname', $user->lastname, $message);
            $link = '<a href="' . base_url() . 'reset_password/' . $random_string . '">Click Here to reset password</a>';
            $message = str_replace('#reset_link', $link, $message);

            $option['tomailid'] = $user->email;
            $option['subject'] = $email->subject;
            $option['message'] = $message;

            if (send_mail($option)) {
                $this->session->set_flashdata('success', 'Check your Mail Address.');
            } else {
                $this->session->set_flashdata('error', 'Unable to send mail. please try again');
            }
        } else {
            $this->session->set_flashdata('error', 'Email Address does not exit');
        }
        redirect(base_url() . 'forgot_password', 'refresh');
    }

    function userResetPassword($random_string) {
        if ($this->input->post() !== false) {
            $user = new User();
            $user->where('password', $random_string)->get();
            if ($user->result_count() == 1) {
                $user->password = md5($this->input->post('new_password'));
                $user->save();
                $this->session->set_flashdata('success', 'Login with new password');
                redirect(base_url() . 'login', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'unable to reset password');
                redirect(base_url() . 'reset_password/' . $random_string, 'refresh');
            }
        } else {
            $this->layout->setField('page_title', $this->lang->line('reset_password'));
            $data['random_string'] = $random_string;
            $this->layout->view('authenticate/reset_password', $data);
        }
    }

    function permissionDenied() {
        $this->layout->view('authenticate/permission');
    }


    function error_404(){
        $this->layout->view('authenticate/error_404');
    }

}
