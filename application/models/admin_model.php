<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    function __construct()
    {
        parent:: __construct();
    }

    public function get_admin_by_email($email)
    {
        $query = $this->db->get_where('admins', array('email' => $email));
        if($query->num_rows() > 0)
            return $query->row();
        return false;
    }
}
