<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_product extends CI_Model {

    public function get_all_products($products_id)
    {
        $this->db->select ('*');
        $this->db->from('products');

        if(!empty($products_id))
            $this->db->where_in('id', $products_id);

        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }

    function get_product($id)
    {
        return $this->db->query("SELECT * FROM products WHERE id = '$id'")->row_array();
    }

    function search($name)
    {
        return $this->db->query("SELECT * FROM products WHERE name LIKE '$name%' OR id LIKE '$name%' ")->result_array();
    }

    function delete($id)
    {
        return $this->db->query("DELETE FROM products WHERE id = ?", $id)->row_array;
    }

    function add_product($product)
    {
        $query = "INSERT INTO products (name, description, photo, price, category, type, gender, color, brand, model, inventory_count, created_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $values = array($product['name'], $product['description'], $product['photo'], $product['price'], $product['category'], $product['type'], $product['gender'], $product['color'], $product['brand'], $product['model'], $product['inventory_count'], date("Y-m-d, H:i:s"));
        return $this->db->query($query, $values);
    }

    function update($product, $id)
    {
        $query = "UPDATE products SET name=?, description=?, photo=?, price=?, category=?, type=?, gender=?, color=?, brand=?, model=?, inventory_count=?, updated_at=? WHERE id = $id";
        $values = array($product['name'], $product['description'], $product['photo'], $product['price'], $product['category'], $product['type'], $product['gender'], $product['color'], $product['brand'], $product['model'], $product['inventory_count'], date("Y-m-d, H:i:s"));
        return $this->db->query($query, $values);
    }

    function get_customer_info($order)
    {
        return $this->db->query("SELECT addresses.*, customers.*, orders.* FROM addresses LEFT JOIN customers ON addresses.cust_id = customers.id LEFT JOIN orders ON customers.id = orders.cust_id WHERE orders.id = '$order'")->row_array();
    }

    function get_order_info($order)
    {
        return $this->db->query("SELECT order_items.*, orders.*, products.* FROM products LEFT JOIN order_items ON products.id = order_items.product_id LEFT JOIN orders ON order_items.order_id = orders.id WHERE orders.id = '$order'")->result_array();
    }

    public function get_count_all()
    {
        return $this->db->count_all('products');
    }

    public function get_products_per_page($offset, $limit)
    {
        $this->db->select ( 'products.id' );
        $this->db->from ( 'products' );
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->result();
        return false;
    }

    public function get_billing($id)
    {
        return $this->db->query("SELECT addresses.* FROM addresses LEFT JOIN customers ON addresses.cust_id = customers.id LEFT JOIN orders ON customers.id = orders.cust_id AND orders.bill_to_address = addresses.id WHERE orders.bill_to_address = ?", $id)->row_array();
    }

}
