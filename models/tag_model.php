<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class tag_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


    function add_tags($content, $tags) {

        if ( gettype($tags) == "string" ) {
            $tags = array($tags);
        }

        foreach ($tags as $tag) {

            $tag_id = $this->_get_by_name($tag);

            if ($tag_id > 0) {

                $this->db->where("tag_id", $tag_id);
                $this->db->where("content_id", $content);

                if ($this->db->get("content_tags")->num_rows() > 0) {

                    //Tag already exists, do nothing

                } else {

                    $this->db->insert("content_tags",array("tag_id"=>$tag_id,"content_id" => $content));

                }

            }

        }

    }


    //Get a tag by its name, return its ID
    function _get_by_name($name) {

        $this->db->where("tag",$name);

        $tag = $this->db->get("tags");

        if ($tag->num_rows() > 0) {

            $tag = $tag->row_array();

            return $tag['id'];

        }

        //No tag by that name exists, create it.
        $new_tag = $this->_create_tag($name);

        if ($new_tag > 0 ) {

            return $new_tag;

        }

        return false;

    }


    //Create tag; return ID of new (or existing) tag
    function _create_tag($name,$type="topical",$redirect=0) {

        $this->db->where("tag",$name);
        $tag = $this->db->get("tags");

        if( $tag->num_rows() > 0) {

            $tag = $tag->row_array();
            return $tag['id'];

        } else {

            $new_tag = array(
                "tag"   => $name,
                "type"  => $type,
                "redirect_to"   => $redirect
            );

            $this->db->insert("tags",$new_tag);

            return $this->db->insert_id();

        }

        return false;

    }


    function for_content($id) {

        $this->db->where("content_tags.content_id",$id);
        $this->db->join("tags","tags.id = content_tags.tag_id");
        $result = $this->db->get("content_tags");

        if ($result->num_rows() > 0) {

            $tags = $result->result_array();

            return $tags;

        }

        return false;

    }


}
