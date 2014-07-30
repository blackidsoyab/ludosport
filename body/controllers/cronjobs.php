<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class cronjobs extends CI_Controller {

    var $session_data;
    var $mail_priority = array('U', 'H', 'N', 'L');

    function __construct() {
        parent::__construct();
        $this->session_data = $this->session->userdata('user_session');
        //$this->output->enable_profiler(TRUE);
    }

    function sendRegularMail() {
        $this->getMails(10);
    }

    function getMails($limit, $priority = 0, $count = 0) {
        echo '<br />----------<br />', $limit, '-', $priority, '-', $count, '<br />----------<br />';
        if (array_key_exists($priority, $this->mail_priority)) {
            $mail = new Mailbox();
            $mail->where(array('type' => $this->mail_priority[$priority], 'status' => 0));
            $mail->limit($limit);
            $mails = $mail->get();
            echo $mail->check_last_query();
            $total_records = $mail->where(array('type' => $this->mail_priority[$priority], 'status' => 0))->count();
            echo 'TR -', $total_records, ' --RC -', $mail->result_count(), '<br />';
            if ($mail->result_count() > 0) {
                $temp_count = 0;
                foreach ($mails as $value) {
                    $count++;
                    $temp_count++;
                    echo $value->id, '-', $value->type, '-', $limit, '-', $priority, '-', $count, '-', $temp_count, '<br />';
                    /* $option = array();
                      $option['tomailid'] = $value->to_email;
                      $option['subject'] = $value->subject;
                      $option['message'] = $value->message;
                      if (!is_null($value->attachment)) {
                      $option['attachement'] = base_url() . 'assets/email_attachments/' . $value->attachment;
                      }

                      if (send_mail($option)) {
                      $mail->where('id', $value->id)->update('status', 1);
                      $count++;
                      } */

                    if ($count >= $limit) {
                        break;
                    } else if ($total_records == $temp_count && ($limit - $temp_count) > 0) {
                        $this->getMails(($limit - $temp_count), ++$priority, $count);
                    } else {
                        continue;
                    }
                }
            } else {
                $this->getMails($limit, ++$priority, $count);
            }
        }
    }

}

