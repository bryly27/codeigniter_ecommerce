<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model {
    function get_item($id)
    {
        return $this->db->query("SELECT * FROM products WHERE id = ?", array($id))->row_array();
    }
    function get_all_items()
    {
        return $this->db->query("SELECT * FROM products ORDER BY name ASC")->result_array();
    }
    function add_student($student)
    {
        $query = "INSERT INTO students (first_name, last_name, email, password, created_at) VALUES (?,?,?,?,?)";
        $values = array($student['first_name'], $student['last_name'], $student['email'], $student['password'], date("Y-m-d, H:i:s"));
        return $this->db->query($query, $values);
    }
    function destroy($number)
    {
        return $this->db->query("DELETE FROM courses where id = $number");
    }
    function add_cust_address($user)
    {
        $query = "INSERT INTO addresses (first_name, last_name, address, address2, city, state, zip_code, created_at) VALUES (?,?,?,?,?,?,?,?)";
        $values = array($user['first_name'], $user['last_name'], $user['address'], $user['address_2'], $user['city'], $user['state'],$user['zip_code'], date("Y-m-d, H:i:s"));
        // return $this->db->query($query, $values);
        $this->db->query($query, $values);
        return mysql_insert_id();
    }

    function add_customer($user)
    {
        $query = "INSERT INTO customers (first_name, last_name, ship_to_address, bill_to_address, created_at) VALUES (?,?,?,?,?)";
        $values = array($user['first_name'], $user['last_name'], $user['ship_to_address'], $user['bill_to_address'], date("Y-m-d, H:i:s"));
        $this->db->query($query, $values);
        return mysql_insert_id();
    }

    function get_cust_id($id)
    {
        return $this->db->query("SELECT id FROM customers WHERE ID = ?", array($id))->row_array();
    }

    function insert_customer_id($info)
    {
        $query = "UPDATE addresses
                  SET
                  cust_id = ?
                  WHERE id = ?
                  ";
        $values = array($info['cust_id'], $info['id']);
        $this->db->query($query, $values);
    }

    function add_order($info)
    {
        $query = "INSERT INTO orders (cust_id, order_status, bill_to_address, ship_to_address, shipping_price, order_total, created_at) VALUES (?,?,?,?,?,?,?)";
        $values = array($info['cust_id'], $info['order_status'], $info['bill_to_address'], $info['ship_to_address'], $info['shipping_price'], $info['order_total'], date("Y-m-d, H:i:s"));
        $this->db->query($query, $values);
        return mysql_insert_id();
    }

    function add_order_item($info)
    {
        $query = "INSERT INTO order_items (order_id, product_id, quantity) VALUES (?,?,?)";
        $values = array($info['order_id'], $info['product_id'], $info['quantity']);
        $this->db->query($query, $values);
        // return mysql_insert_id();
    }

    function get_inventory($id)
    {
        return $this->db->query("SELECT products.inventory_count, products.quantity_sold FROM products WHERE id = ?", $id)->row_array();
    }

    function update_inventory($inventory, $id)
    {
        $query = "UPDATE products SET inventory_count=?, quantity_sold=? WHERE id = $id";
        $values = array($inventory['inventory_count'], $inventory['quantity_sold']);
        return $this->db->query($query, $values);
    }
}

