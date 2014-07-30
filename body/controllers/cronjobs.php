<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class cronjobs extends CI_Controller {

    var $session_data;
    var $mail_priority = array('U', 'H', 'N', 'L');

    function __construct() {
        parent::__construct();
        $this->session_data = $this->session->userdata('user_session');
        $this->output->enable_profiler(TRUE);
    }

    function sendRegularMail() {
        $this->getMails(10);
    }

    function getMails($limit, $priority = 0, $count = 0) {
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
                    $option['subject'] = $this->mail_priority[$priority] . '-' . $value->subject;
                    $option['message'] = $value->message;
                    if (!is_null($value->attachment)) {
                        $option['attachement'] = base_url() . 'assets/email_attachments/' . $value->attachment;
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
    }

}

