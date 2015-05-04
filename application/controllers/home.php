<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller
{
	public $current_page;

	public function __construct()
	{
	    parent::__construct();
	    $this->current_page = 1;
	}

	public function index()
	{
		//Start a cart session when a user lands on the main page
		if(!$this->session->userdata('cart'))
		{
			$cart = array(
					'total_items' => 0,
 					);
			$this->session->set_userdata('cart', $cart);
		}

		$items_id = $this->build_pagination($this->current_page);
		$this->load->model('products');
		$info['products'] = $this->products->get_products($items_id);
		$this->load->view('main');
	
	}

	public function show_products()
	{
		$items_id = $this->build_pagination($this->current_page);
		$this->load->model('products');
		$info['products'] = $this->products->get_products($items_id);
		$this->load->view('main_partial', $info);
	}


	public function order_asc()
	{

		$this->load->model('products');
		$info['products'] = $this->products->get_products_price_asc();
		$this->load->view('main_partial', $info);
	}

	public function order_desc()
	{
		$this->load->model('products');
		$info['products'] = $this->products->get_products_price_desc();
		$this->load->view('main_partial', $info);
	}

	public function search()
	{
		$this->load->model('products');
		$name = $this->input->post('search');
		$info['products'] = $this->products->search($name);
		$this->load->view('main_partial', $info);
	}

	public function product($type)
	{
		$this->load->model('products');
		$info['products'] = $this->products->type($type);
		$this->load->view('main_partial', $info);
	}

	public function cart()
	{
		$this->load->view('cart');
	}

	public function show_pagination($current_page)
	{
	    if($current_page > 0)
	    {
	        $this->current_page = $current_page;
	        $this->index();
	    }
	}

	public function build_pagination($current_page)
	{
	    $pages = array();
	    $pages['current_page'] = $current_page;
	    // $prev_page = $current_page - 1;
	    // $next_page = $current_page + 1;


	    $this->load->model('products');
	    $count_all = $this->products->get_count_all();

	    $limit = 15;
	    $count_pages = ceil($count_all / $limit);

	    if($current_page == 0)
	      $current_page = 1;

	    for($i=1; $i<=$count_pages; $i++)
	    {
	        $offset = ($i-1) * $limit;
	        $pages[$i] = $offset;
	    }

	    $items_id = $this->products->get_items_per_page($pages[$current_page], $limit);

	    $array_item_id = array();
	    foreach($items_id as $row)
	    {
	      $array_item_id[] = $row->id;
	    }

	    $this->session->set_userdata('pages', $pages);

	    return $array_item_id;

	}


}
