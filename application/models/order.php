<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Model
{
    function __construct()
    {
        parent:: __construct();
    }

    public function create_order($order_data)
    {
        $this->db->insert('orders', $order_data);
    }

    public function update_order_status($id, $status)
    {
        $data = array(
                       'order_status' => $status
                    );
        $this->db->update('orders', $data, array('id' => $id));
    }

    public function delete_order($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('orders');
    }

    public function get_count_all()
    {
        return $this->db->count_all('orders');
    }

    public function get_order_by_id($id)
    {
        $query = $this->db->get_where('orders', array('id' => $id));
        if($query->num_rows() > 0)
            return $query->result();
        return false;
    }

    public function get_orders_per_page($offset, $limit)
    {
        $this->db->select ( 'orders.id' );
        $this->db->from ( 'orders' );
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->result();
        return false;
    }

    public function get_all_orders($filter, $orders )
    {
        $where = '';

        foreach($filter as $key => $val)
        {
            if($key == 'status' and $val <> 'show_all' and strlen($val) > 0)
                $where = "a.order_status = '$val'";
            else if($key == 'search' and strlen($val) > 0)
            {
                $where = "a.id like  '%$val%' OR b.first_name like '%$val%' OR a.order_status like  '%$val%'";
            }
        }

        $this->db->select ( 'a.id, a.order_status, a.order_total,  a.created_at, b.first_name, b.last_name, c.address, , c.address2, , c.city, , c.state, , c.zip_code');
        $this->db->from( 'orders as a');
        $this->db->join( 'customers as b', 'a.cust_id = b.id' );
        $this->db->join( 'addresses as c ', 'c.id = a.bill_to_address and c.cust_id = a.cust_id and c.cust_id = b.id');

        // if(strlen($status) > 0 and $where <> 'show_all')
        //     $this->db->where('a.order_status', $status);

        if(!empty($orders))
            $this->db->where_in('a.id', $orders);

        if(strlen($where) > 0)
        $this->db->where($where);
    
        $this->db->order_by( 'a.id', 'desc');
        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->result();
        return false;
    }

    public function update($status, $id)
    {

        $query = "UPDATE orders SET order_status='$status', updated_at=? WHERE id = $id";
        $values = array(date("Y-m-d, H:i:s"));
        return $this->db->query($query, $values);

    }



}












