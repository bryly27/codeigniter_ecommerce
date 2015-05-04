<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class details extends CI_Model {

    function get_details($id)
    {
        return $this->db->query("SELECT * FROM products WHERE id = $id")->result_array();
    }

    function get_similar($type)
    {
        return $this->db->query("SELECT * FROM products WHERE type = '$type'")->result_array();
    }


    // function get_product($email)
    // {
    //     return $this->db->query("SELECT * FROM  WHERE email = ?", array($email))->row_array();
    // }

    // function get_user($email)
    // {
    //     return $this->db->query("SELECT id, first_name, last_name, email, password FROM users WHERE email = ?", $email)->row_array();
    // }

    // function add_user($user)
    // {
    //     $query = "INSERT INTO users (first_name, last_name, email, password, created_at) VALUES (?,?,?,?,?)";
    //     $values = array($user['first_name'], $user['last_name'], $user['email'], $user['password'], date("Y-m-d, H:i:s"));
    //     return $this->db->query($query, $values);
    // }

    // function get_messages()
    // {
    //     return $this->db->query("SELECT messages.*, users.first_name, users.last_name FROM messages LEFT JOIN users ON users.id = messages.user_id ORDER BY id DESC")->result_array();
    // }

    // function add_message($message)
    // {
    //     $query = "INSERT INTO messages (user_id, message, created_at) VALUES (?,?,?)";
    //     $values = array($message['user_id'], $message['message'], date("Y-m-d, H:i:s"));
    //     return $this->db->query($query, $values);
    // }

    // function get_comments()
    // {
    //     return $this->db->query("SELECT comments.*, users.first_name, users.last_name FROM comments LEFT JOIN users ON users.id = comments.user_id")->result_array();
    // }

    // function add_comment($comment)
    // {
    //     $query = "INSERT INTO comments (messages_id, user_id, comment, created_at) VALUES (?,?,?,?)";
    //     $values = array($comment['messages_id'], $comment['user_id'], $comment['comment'], date("Y-m-d, H:i:s"));
    //     return $this->db->query($query, $values);
    // }

}
