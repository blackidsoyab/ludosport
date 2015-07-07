<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * allows the common form validation to be called from the controller itself
 */
class MY_Form_validation extends CI_Form_validation
{
    
    protected $CI;
    
    function __construct() {
        parent::__construct();
        $this->CI = & get_instance();
    }
    
    /**
     * validates the name. only a-to-z, A-to-Z and blank space are allowed
     * @param type $field_value is the field's value which we are validating
     * @return boolean is the true false value telling whether the field's valus is valid or not
     */
    function name_validator($field_value) {
        
        // here * is used so blank is a valid data
        if (!preg_match('/^[a-zA-Z ]*$/', $field_value)) {
            
            //set the field vaues given by user
            $this->CI->form_validation->set_value($field_value);
            $this->CI->form_validation->set_message('name_validator', '%s is not a valid');
            return false;
        } else {
            return true;
        }
    }
    
    /**
     * validates the name. only a-to-z, A-to-Z , blank space , dt and dash are allowed
     * @param type $field_value is the field's value which we are validating
     * @return boolean is the true false value telling whether the field's valus is valid or not
     */
    function name_with_dotdash_validator($field_value) {
        
        // here * is used so blank is a valid data
        if (!preg_match('/^[a-zA-Z .-]*$/', $field_value)) {
            
            //set the field vaues given by user
            $this->CI->form_validation->set_value($field_value);
            $this->CI->form_validation->set_message('name_with_dotdash_validator', '%s is not a valid Name');
            return false;
        } else {
            return true;
        }
    }
    
    /**
     *
     * @param type $field_value is the field's value which we are validating
     * @return boolean is the true false value telling whether the field's valus is valid or not
     */
    function date_validator($field_value) {
        
        if ($field_value != '') {
            
            // if the pattern matches then we will check if the date mathces or not
            // matches with 0-1-2011 or 01-1-2011 or 1-22-5201 or 11-11-1111
            if (preg_match('/^[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}$/', $field_value)) {
                
                // of the pattern matches then get the values of day,month and year
                // from input that are separated by '-' delim
                $date_value_array = explode("-", $field_value);
                
                // get the values and cast them to integers
                $day = (int)$date_value_array[0];
                $month = (int)$date_value_array[1];
                $year = (int)$date_value_array[2];
                
                // check if the date is valid or not
                // if not valid set the error message
                if (!checkdate($month, $day, $year)) {
                    
                    //set the field vaues given by user
                    $this->CI->form_validation->set_value($field_value);
                    
                    // set the error message and return false
                    $this->CI->form_validation->set_message('date_validator', '%s is not a valid date(eg. 25-12-2001)');
                    return false;
                }
                
                // return true if the date is a valid date
                return true;
            } else {
                
                // if the date entered does not match with the regular expression then return a false with the error code
                $this->CI->form_validation->set_message('date_validator', '%s is not a valid date(eg. 25-12-2001)');
                return false;
            }
        }
    }
    
    /**
     * validation for a phone number
     * @param type $field_value is the field's value which we are validating
     * @return boolean is the true false value telling whether the field's valus is valid or not
     */
    function phone_number_validator($field_value) {
        
        // we check the number by reqired validation. so if it is blank no need to check
        // for any other validation. simply return true as it would be validated by required
        if ($field_value != '') {
            
            // check ofr number by regx
            // 30digits without + sign and 29 digits if + is there
            if (!preg_match('/^[0-9]{1,30}|[+]{0,1}[0-9]{1,29}$/', $field_value)) {
                
                //set the field vaues given by user
                $this->CI->form_validation->set_value($field_value);
                $this->CI->form_validation->set_message('phone_number_validator', '%s is not a valid Number');
                return false;
            } else {
                return true;
            }
        }
        return true;
    }
    
    /**
     * checks if the first date is older than the second date
     * @param type $field_value is the second date
     * @param type $date_from is the first date
     * @return boolean
     */
    function date_greater($field_value, $date_from) {
        
        // get the difference between two dates
        $days = strtotime($date_from) - strtotime($field_value);
        
        // if the difference is greater than 0  then it is an error so we need
        // to set the error
        if ($days > 0) {
            
            //  set the error and return true
            $this->CI->form_validation->set_message('date_greater', 'Select the date greater than ' . $date_from);
            return false;
        } else {
            
            // second date is newer than first date so return true indicating
            // that the validation passed
            return true;
        }
    }
    
    /**
     * checks if the first date is older than the second date
     * @param type $field_value is the second date
     * @param type $date_from is the first date
     * @return boolean
     */
    function date_less_than($field_value, $date_from) {
        
        // get the difference between two dates
        $days = strtotime($field_value) - strtotime($date_from);
        
        // if the difference is greater than 0  then it is an error so we need
        // to set the error
        if ($days > 0) {
            
            //  set the error and return true
            $this->CI->form_validation->set_message('date_less_than', 'Select the date Less than ' . $date_from);
            return false;
        } else {
            
            // second date is newer than first date so return true indicating
            // that the validation passed
            return true;
        }
    }
    
    /**
     * checks if you already have a subscription between that date
     * @param type $field_value
     * @param type $param is dd-mm-yyyy,clientid,client_subscription_id. here client_subscription_id is optional
     * leave the client subscription id blank, ie do not pass it if creating a new subscription
     * @return boolean
     */
    function client_subscription_coliding($field_value, $param) {
        $date_to = $field_value;
        
        // get the date from and client id and client_subscription_id from $param
        $values_passed = explode(",", $param);
        $date_from = $values_passed[0];
        $client_id = $values_passed[1];
        
        // if the client_subscription_id was passed then set the value in variable
        if (isset($values_passed[2])) {
            $subscription_id = $values_passed[2];
        }
        
        // load the model and get the table name where we need to query
        $this->CI->load->model('client_subscription_model');
        $table_name = $this->CI->client_subscription_model->table_name;
        
        $array = array('client_id' => $client_id, 'from_date <=' => date_to_db_date($date_to), "end_date >=" => date_to_db_date($date_from));
        
        // if client_subscription_id was set then we need to ignore the records
        // whos id same as currunt record. (do not match with currunt record,
        // it is allowed to colide with currunt record)
        if (isset($subscription_id)) {
            $array['client_subscription_id <>'] = $subscription_id;
        }
        
        // do query
        $query = $this->CI->db->get_where($table_name, $array);
        $result = $query->result();
        
        // if no result was found then there was no coliding. allow it
        if (count($result) == 0) {
            return true;
        } else {
            
            // atleast one record was found which colide. do not allow it.
            // show the dates of first record in the error message
            $this->CI->form_validation->set_message('client_subscription_coliding', 'You already have subscription btween  ' . $result[0]->from_date . " and " . $result[0]->end_date);
            return false;
        }
    }
    
    function not_same_as($field_value, $other_field_value) {
        if ($field_value == $other_field_value) {
            $this->CI->form_validation->set_message('not_same_as', 'Value of %s can not be same as other field(' . $other_field_value . ")");
            return false;
        } else {
            return true;
        }
    }
    
    function file_required($field_value, $param) {
        
        if (isset($_FILES[$param])) {
            return true;
        } else {
            $this->CI->form_validation->set_message('file_required', 'Please select a file for %s ');
            return false;
        }
    }
    
    function file_error_message_show($field_value, $param) {
        $this->CI->form_validation->set_message('file_allowed_types', $field_value . " " . $param . ' %s ');
        return false;
    }
    
    /**
     *
     * @param type $field_value name of the file being uploaded
     * @param type $param is the name of the form field
     * @return boolean true if file was there
     */
    function file_allowed_types($field_value, $param) {
        $extension = $this->_getExtension($field_value);
        $types_allowed = explode(",", $param);
        if (in_array($extension, $types_allowed)) {
            return true;
        } else {
            $this->CI->form_validation->set_message('file_allowed_types', 'Files with extension ' . $param . ' are allowed in %s ');
            return false;
        }
    }
    
    private 
    function _getExtension($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return strtolower($ext);
    }
    
    /**
     * this function will check that is the value enter in textbox of form details is already taken or not.
     * If the name is alredy enter in database it will give an error.
     * @param type $field_value
     * @return boolean
     */
    function isDataExit_validator($field_value, $param) {
        $values = explode(",", $param);
        $filed_name = $values[0];
        $model = $values[1];
        
        //get the data from database.
        $res = $this->CI->$model->getWhere(array($filed_name => $field_value));
        
        //if data is changed then check for uniquesness
        if (isset($res[0]->$filed_name) && strtolower($res[0]->$filed_name) === strtolower($field_value)) {
            $this->CI->form_validation->set_value($field_value);
            $this->CI->form_validation->set_message('isDataExit_validator', '%s is Already Exits.');
            return false;
        } else {
            return true;
        }
    }
    
    /**
     * This function check the data in datbase at the time of edit data.
     * if it is same as n database then it will do nothing
     * but if it is changed the it will check of the unique name.
     * @param type $field_value : current filed value
     * @param type $param
     * @return boolean
     */
    function edit_isDataExit_validator($field_value, $param) {
        $value = explode(",", $param);
        $primary_key = $value[0];
        $primary_key_field = $value[1];
        $field = $value[2];
        $model = $value[3];
        
        //get the data from database.
        $res = $this->CI->$model->getWhere(array($primary_key_field => $primary_key));
        
        //if same as in databaase do nothing
        if (strtolower($res[0]->$field) === strtolower($field_value)) {
            return true;
        } else {
            
            //if data is changed then check for uniquesness
            //get data from database
            $res_1 = $this->CI->$model->getWhere(array($field => $field_value));
            
            //if data is changed then check for uniquesness
            if (isset($res_1[0]->$field) && strtolower($res_1[0]->$field) === strtolower($field_value)) {
                $this->CI->form_validation->set_value($field_value);
                $this->CI->form_validation->set_message('edit_isDataExit_validator', '%s is Already Taken.');
                return false;
            } else {
                return true;
            }
        }
    }
}
?>
