<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class admin_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }



    function get_latest($count=10) {

        $this->db->limit($count);
        $content = $this->db->get("content");
        return $content;


    }


    function comics_list() {

        $this->db->select('comics.*,content.file');
        $this->db->from('comics');

        $this->db->join("comics_content"," comics.id = comics_content.comic_id");
        $this->db->where("comics_content.order",1);

        $this->db->join("content", "comics_content.content_id = content.id");


        return $this->db->get()->result_array();


    }



    function add_content($file, $title, $artist) {

        $insert = array(
            "file"  => $file,
            "title" => $title,
            "artist_id" => $artist
        );

        $this->db->insert('content',$insert);

        $new = $this->db->insert_id();

        return $new;


    }

    //Is current user an admin?
    function has_access() {

        $user = $this->session->userdata('user_id');

        if ($user > 0) {

            $this->db->where('id',$user);
            $result = $this->db->get('members');

            if ($result->num_rows() > 0) {

                $result = $result->row_array();

                if ($result["account"] == "admin") {

                    return true;

                } else {

                        $this->session->set_flashdata("error", "Permission Denied.");
                        return false;

                }
            }
        }

        //Not logged in
        $this->session->set_flashdata("error","You're not logged in.");
        return false;

    }


    //Takes a given user ID and returns the artist, or false if none exist
	function artist_by_user($user_id) {
        $this->db->where('user_id',$user_id);
        $data = $this->db->get('artists');

        if ($data->num_rows() == 1) {
            return $data->row_array();
        } else if ($data->num_rows() > 1) {
            $this->session->set_flashdata('error',"Please ask the web admin to check for duplicate artists with user_id $user_id");
            return false;
        } else {
            $this->session->set_flashdata('error',"No artist for for user #$user_id");
            return false;
        }
    }
	
	
}
