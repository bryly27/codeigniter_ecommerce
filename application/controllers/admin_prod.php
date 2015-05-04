<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_prod extends CI_Controller
{
    public $current_page;

    public function __construct()
    {
        parent::__construct();
        $this->current_page = 1;
    }

    public function index()
    {
      if($this->session->userdata('access') == TRUE)
      {
        $products_id = $this->build_pagination_products($this->current_page);
        $this->load->model('admin_product');
        $info['products'] = $this->admin_product->get_all_products($products_id);
        $this->load->view('admin_products', $info);
      }
      else
      {
        redirect('/');
      }
    }

    public function search()
    {
      $this->load->model('admin_product');
      $name = $this->input->post('search');
      $info['products'] = $this->admin_product->search($name);
      $this->load->view('admin_products', $info);
    }

    public function delete($id)
    {
      $this->load->model('admin_product');
      $this->admin_product->delete($id);
      redirect('/admin_prod');
    }

    public function edit($id)
    {
      $this->load->model('admin_product');
      $info['products'] = $this->admin_product->get_product($id);
      $this->load->view('admin_edit', $info);
    }

    public function update()
    {
      $this->load->model('admin_product');
      $product = array(
          "name" => $this->input->post('name'),
          "description" => $this->input->post('description'),
          "photo" => $this->input->post('photo'),
          "price" => $this->input->post('price'),
          "category" => $this->input->post('category'),
          "type" => $this->input->post('type'),
          "gender" => $this->input->post('gender'),
          "color" => $this->input->post('color'),
          "brand" => $this->input->post('brand'),
          "model" => $this->input->post('model'),
          "inventory_count" => $this->input->post('inventory_count'),
        );
      $this->admin_product->update($product, $this->input->post('submit'));
      redirect('/admin_prod');

    }

    public function add()
    {
      if($this->input->post('edit')=='add')
      {
        $this->load->view('admin_add');
      }
      else
      {
      $this->load->model('admin_product');
        $product = array(
            "name" => $this->input->post('name'),
            "description" => $this->input->post('description'),
            "photo" => $this->input->post('photo'),
            "price" => $this->input->post('price'),
            "category" => $this->input->post('category'),
            "type" => $this->input->post('type'),
            "gender" => $this->input->post('gender'),
            "color" => $this->input->post('color'),
            "brand" => $this->input->post('brand'),
            "model" => $this->input->post('model'),
            "inventory_count" => $this->input->post('inventory_count'),
          );
        $this->admin_product->add_product($product);
        redirect('/admin_prod');
      }
    }

    public function show_paginated_products($current_page)
    {
        if($current_page > 0)
        {
            $this->current_page = $current_page;
            $this->index();
        }
    }

    public function build_pagination_products($current_page)
    {
        $pages = array();
        $pages['current_page'] = $current_page;
        // $prev_page = $current_page - 1;
        // $next_page = $current_page + 1;


        $this->load->model('admin_product');
        $order_count_all = $this->admin_product->get_count_all();

        $limit = 10;
        $count_pages = ceil($order_count_all / $limit);

        if($current_page == 0)
          $current_page = 1;

        for($i=1; $i<=$count_pages; $i++)
        {
            $offset = ($i-1) * $limit;
            $pages[$i] = $offset;
        }

        $products_id = $this->admin_product->get_products_per_page($pages[$current_page], $limit);

        $array_product_id = array();
        foreach($products_id as $row)
        {
          $array_product_id[] = $row->id;
        }

        $this->session->set_userdata('pages', $pages);

        return $array_product_id;

    }

    public function logOff()
    {
      $this->session->sess_destroy();
      redirect('/');
    }

}
