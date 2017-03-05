<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class content_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }



    function get_latest($count=50) {

        $this->db->limit($count);

        $result = $this->db->get("content");

        $result = $result->result_array();

        return $result;


    }



    function get($id) {

        $this->db->where('id',$id);
        $result = $this->db->get('content');

        if ($result->num_rows() > 0) {

            return $result->row_array();

        } else {

            $this->session->set_flashdata("invalid");

            return false;

        }

    }



    function add_comment($id,$text) {

        $comment = array(
          "content_id"  => $id,
            "user_id"   => $this->session->userdata('user_id'),
            "text"  => $text
        );

        $this->db->insert("comments",$comment);

    }

    function get_comments($id) {

        $this->db->select('comments.*, members.username');
        $this->db->from('comments');
        $this->db->where('content_id',$id);
        $this->db->join('members',"members.id = comments.user_id");

        $comments = $this->db->get();

        if ($comments->num_rows() > 0) {
            return $comments->result_array();
        }

        return false;

    }
	
	
	
}
