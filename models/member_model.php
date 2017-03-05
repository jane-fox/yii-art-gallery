<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class member_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


    function auth($email, $password) {

        $this->db->where("email",$email);
        $member = $this->db->get("members")->row_array();



        if ($member['email'] == $email) {
            if ($member['password'] == $password) {

                $this->session->set_userdata(array(
                    "user_id" => $member['id'],
                    "username"  =>  $member['username']
                ));

                return true;
            }
        }

        $this->session->set_flashdata('error', "Email / Password combo invalid");
        return false;

    }

	
	
	
	
}
