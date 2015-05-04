<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class products extends CI_Model {

    function get_products($products_id)
    {
        // return $this->db->query("SELECT * FROM products")->result_array();

        $this->db->select ('*');
        $this->db->from('products');

        if(!empty($products_id))
            $this->db->where_in('id', $products_id);

        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }


    function get_products_price_asc()
    {
        return $this->db->query("SELECT * FROM products ORDER BY price ASC")->result_array();
    }

     function get_products_price_desc()
    {
        return $this->db->query("SELECT * FROM products ORDER BY price DESC")->result_array();
    }

    function search($name)
    {
        return $this->db->query("SELECT * FROM products WHERE name LIKE '$name%'")->result_array();
    }

    function type($type)
    {
        return $this->db->query("SELECT * FROM products WHERE type = '$type' ORDER BY name ASC")->result_array();
    }

    public function get_count_all()
    {
        return $this->db->count_all('products');
    }

    public function get_items_per_page($offset, $limit)
    {
        $this->db->select ( 'products.id' );
        $this->db->from ( 'products' );
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->result();
        return false;
    }

}
