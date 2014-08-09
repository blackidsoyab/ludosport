<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class messages extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('message'));
        $this->session_data = $this->session->userdata('user_session');

        if ($this->session_data->status == 'P') {
            $this->session->set_flashdata('error', 'You dont have permission to see it :-/ Please contact Admin');
            redirect(base_url() . 'denied', 'refresh');
        }
    }

    private function _sidebarData() {
        $message = new Message();

        $data['count_inbox'] = $message->where(array('to_id' => $this->session_data->id, 'status' => 'U'))->get()->result_count();
        unset($message);
        $message = new Message();
        $data['count_sent'] = $message->where('from_id', $this->session_data->id)->where_in('status', array('U', 'R'))->get()->result_count();
        unset($message);
        $message = new Message();
        $data['count_draft'] = $message->where(array('from_id' => $this->session_data->id, 'status' => 'D'))->get()->result_count();
        unset($message);
        $message = new Message();
        $data['count_trash'] = $message->coutTrashCount();
        unset($message);
        return $data;
    }

    public function viewMessage() {
        $data = $this->_sidebarData();
        $data['view_title'] = 'Message Inbox';
        $data['message_box'] = 'inbox';
        $data['message_page_layout'] = $this->load->view('messages/list', $data, true);
        $this->layout->view('messages/sidebar', $data);
    }

    public function composeMessage($type = 'single') {
        if ($this->input->post() !== false) {
            foreach ($this->input->post('to_id') as $to) {
                $message = new Message();
                $message->type = $this->input->post('message_type');
                $message->reply_of = $this->input->post('reply_of');
                $message->from_id = $this->session_data->id;
                if ($this->input->post('message_type') == 'single') {
                    $message->to_id = $to;
                } else {
                    $message->to_id = implode(',', $this->_getIdsForGroup($to));
                }
                $message->subject = $this->input->post('subject');
                $message->message = $this->input->post('message');
                if ($this->input->post('action') == 'send') {
                    $status = 'U';
                } else if ($this->input->post('action') == 'draft') {
                    $status = 'D';
                }
                $message->status = $status;
                $message->save();
            }

            $this->session->set_flashdata('success', $this->lang->line('message_sent_success'));
            redirect(base_url() . 'message', 'refresh');
        } else {
            $data = $this->_sidebarData();
            $data['view_title'] = 'Compose Message';
            $data['type'] = $type;
            $data['message_all_types'] = $this->_getMessageType();

            if ($type == 'single') {
                $data['users'] = $this->_getUsersForMessage();
            } else if ($type == 'group') {
                $data['groups'] = $this->_getGroupsForMessage();
            }

            $data['message_page_layout'] = $this->load->view('messages/compose', $data, true);
            $this->layout->view('messages/sidebar', $data);
        }
    }

    private function _getMessageType() {
        if ($this->session_data->id == 1 || $this->session_data->id == 2) {
            return array('single', 'group');
        }
    }

    private function _getUsersForMessage() {
        if ($this->session_data->id == 1 || $this->session_data->id == 2) {
            $users = new User();
            $users->where(array('status' => 'A', 'id >' => '1'))->get();
            return $users;
        }
    }

    private function _getGroupsForMessage() {
        if ($this->session_data->id == 1 || $this->session_data->id == 2) {
            $roles = new Role();
            $array = array();
            $array['data'] = $roles->where(array('id >' => '1'))->get();
            $array['filed'] = $this->session_data->language . '_role_name';
            return $array;
        }
    }

    private function _getIdsForGroup($id) {
        if ($this->session_data->id == 1 || $this->session_data->id == 2) {
            $user = new User();
            return $user->getUsersByIdsRole($id);
        }
    }

    public function draftMessage() {
        $data = $this->_sidebarData();
        $data['view_title'] = 'Draft';
        $data['message_box'] = 'draft';
        $data['message_page_layout'] = $this->load->view('messages/list', $data, true);
        $this->layout->view('messages/sidebar', $data);
    }

    public function sentMessage() {
        $data = $this->_sidebarData();
        $data['view_title'] = 'Sent Items';
        $data['message_box'] = 'sent';
        $data['message_page_layout'] = $this->load->view('messages/list', $data, true);
        $this->layout->view('messages/sidebar', $data);
    }

    public function trashMessage() {
        $data = $this->_sidebarData();
        $data['view_title'] = 'Trash';
        $data['message_box'] = 'trash';
        $data['message_page_layout'] = $this->load->view('messages/list', $data, true);
        $this->layout->view('messages/sidebar', $data);
    }

    public function readMessage($id) {
        $message = new Message();
        $result = $message->getMessageForReading($id);
        if ($result !== FALSE) {
            $message->where('id', $id)->update('status', 'R');
            $data = $this->_sidebarData();
            $data['id'] = $id;
            $data['view_title'] = 'Read Message';
            $data['messages_data'] = $result;
            $data['message_page_layout'] = $this->load->view('messages/read', $data, true);
            $this->layout->view('messages/sidebar', $data);
        } else {
            $this->session->set_flashdata('error', $this->lang->line('message_read_error'));
            redirect(base_url() . 'message', 'refresh');
        }
    }

    public function replyMessage($id) {
        $data = $this->_sidebarData();
        $message = new Message();
        $result_1 = $message->getMessageForReading($id);
        $result_2 = $message->getMessageForReplying($id);

        if ($result_1 !== FALSE && $result_2 !== FALSE) {
            if ($this->input->post() !== false) {
                $message = new Message();
                $message->type = 'single';
                $message->reply_of = $result_2->id;
                $message->from_id = $this->session_data->id;
                $message->to_id = $result_2->from_id;
                $message->subject = 'Reply of : ' . $result_2->subject;
                $message->message = $this->input->post('message');
                if ($this->input->post('action') == 'send') {
                    $status = 'U';
                } else if ($this->input->post('action') == 'draft') {
                    $status = 'D';
                }
                $message->status = $status;
                $message->save();

                $this->session->set_flashdata('success', $this->lang->line('message_sent_success'));
                redirect(base_url() . 'message', 'refresh');
            } else {
                $data['view_title'] = 'Reply Message';
                $data['reply_id'] = $id;
                $data['messages_data'] = $result_1;
                $data['to_reply_data'] = $result_2;
                $data['message_page_layout'] = $this->load->view('messages/reply', $data, true);
                $this->layout->view('messages/sidebar', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('message_reply_error'));
            redirect(base_url() . 'message', 'refresh');
        }
    }

}
