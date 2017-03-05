<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class comic_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


    function get($id) {

        $this->db->where("id",$id);

        $comic = $this->db->get("comics");

        if ($comic->num_rows() == 0) {
            echo "comic doesn't exist??";
            die;
        }

        $data = $comic->row_array();


        $this->db->select("comics_content.*, content.*");
        $this->db->where("comic_id",$id);
        $this->db->join("content", "comics_content.content_id = content.id");
        $this->db->order_by('order','ASC');
        $pages = $this->db->get("comics_content");

        if ($pages->num_rows() > 0) {

            $data['pages'] = $pages->result_array();

        } else {
            $data['pages'] = array();
        }

        return $data;

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
