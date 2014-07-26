<?php

if (!function_exists('send_mail')) {

    function send_mail($options) {

        $ci = get_instance();
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'soyab@blackidsolutions.com',
            'smtp_pass' => 'soyabsoyab',
            'mailtype' => 'html',
        );
        $ci->load->library('email', $config);
        $ci->email->set_newline("\r\n");
        $ci->email->from('soyab@blackidsolutions.com', 'MyLudosport');
        $ci->email->to($options['tomailid']);
        $ci->email->subject($options['subject']);
        $ci->email->message($options['message']);

        if (isset($options['cc']))
            $ci->email->bcc($options['cc']);

        if (isset($options['attachement']))
            $ci->email->attach($options['attachement']);

        if (!$ci->email->send()) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
?>
