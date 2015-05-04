<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'libraries/Stripe/lib/Stripe.php');
class Cart extends CI_Controller
{
	protected $data;
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model("Cart_model");
	}

	public function index()
	{
		// if(!$this->session->userdata('cart'))
		// {
		// 	$cart = array(
		// 						'total_items' => 0,
 	// 								);
		// 	$this->session->set_userdata('cart', $cart);
		// }
		$cart = $this->session->userdata('cart');
		$show_cart = array();
		$total_price = 0;

		foreach ($cart as $key => $value)
		{
			if($key != 'total_items')
			{
				$item = $this->Cart_model->get_item($key);
				$show_cart[] = array(
													'id' => $item['id'],
													'quantity' => $value,
													'name' => $item['name'],
													'price' => ($item['price']),
														);
				$total_price += ($item['price'] * $value);
			}

		}
		$show_cart['total_price'] = $total_price;
		$send['cart'] = $show_cart;
		// $send['pay_status'] = $this->data;
		// var_dump($this->data);
		// die();
		// $this->load->view('cart', $send);
		$this->load->view('cart', $send);

	}

	public function addToCart()
	{

		$product_id = $this->input->post('prod_id');
		$quantity = $this->input->post('quantity');

		$item = $this->Cart_model->get_item($product_id); //returns ALL info about the product

		$cart = $this->session->userdata('cart');

		if(array_key_exists($product_id, $cart))
		{
			$cart['total_items'] = $cart['total_items'] + $quantity;
			$cart[$product_id] = $cart[$product_id] + $quantity;
			$this->session->set_userdata('cart', $cart);
		}
		else
		{
			$cart['total_items'] = $cart['total_items'] + $quantity;
			$cart[$product_id] = $quantity;
			$this->session->set_userdata('cart', $cart);
		}
		redirect(base_url());
	}

	public function delete($id)
	{
		$cart = $this->session->userdata('cart');
		$total_items = $this->session->userdata('cart')['total_items'];
		$total_items = $total_items - $cart[$id];
		$cart['total_items'] = $total_items;
		unset($cart[$id]);
		$this->session->set_userdata('cart', $cart);
		redirect('/cart');
	}

	public function destroy()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function pay()
	{
		// Get shipping info from POST
		$user = array(
		   'first_name' => $this->input->post('firstname'),
		   'last_name' => $this->input->post('lastname'),
		   'address' => $this->input->post('address'),
		   'address_2' => $this->input->post('address2'),
		   'city' => $this->input->post('city'),
		   'state' => $this->input->post('state'),
		   'zip_code' => $this->input->post('zip')
		);

		//Get billing info from POST
		$buser = array(
		   'first_name' => $this->input->post('bfirstname'),
		   'last_name' => $this->input->post('blastname'),
		   'address' => $this->input->post('baddress'),
		   'address_2' => $this->input->post('baddress2'),
		   'city' => $this->input->post('bcity'),
		   'state' => $this->input->post('bstate'),
		   'zip_code' => $this->input->post('bzip')
		);
		//Add the shipping info to the db
		$add_row_id = $this->Cart_model->add_cust_address($user);
		//If ALL shipping and billing fields match then we only need to add one entry to the db and use the same ID for both the shipping and billing
		if(($user['first_name'] == $buser['first_name'])
			&& ($user['last_name'] == $buser['last_name'])
			&& ($user['address'] == $buser['address'])
			&& ($user['address_2'] == $buser['address_2'])
			&& ($user['city'] == $buser['city'])
			&& ($user['state'] == $buser['state'])
			&& ($user['zip_code'] == $buser['zip_code'])
			)
		{
			$add_billing_row_id = $add_row_id;
		}
		else
		//Else we need to add a separate entry to the db for billing info
		{
			$add_billing_row_id = $this->Cart_model->add_cust_address($buser);
		}

		//Get the customer's payment info from POST
		$customer = array(
		   'first_name' => $this->input->post('firstname'),
		   'last_name' => $this->input->post('lastname'),
		   'ship_to_address' => $add_row_id,
		   'bill_to_address' => $add_billing_row_id,
		   'card_number' => MD5($this->input->post('card')),
		   'security_code' => MD5($this->input->post('seccode')),
		   'exp_month' => $this->input->post('exp_month'),
		   'exp_year' => $this->input->post('exp_year')
		);
		//Add customer info to the db with the SHIP and BILL ID's from above and return the ID of the row inserted
		$add_customer = $this->Cart_model->add_customer($customer);
		//After inserting the row, query to get the ID of that row.
		$customer_id = $this->Cart_model->get_cust_id($add_customer);
		//Go back into the addresses table to update the cust_id field
		$update_shipping_cust_id = array(
		   'cust_id' => $customer_id['id'],
		   'id' => $add_row_id
		);
		$this->Cart_model->insert_customer_id($update_shipping_cust_id);
		$update_billing_cust_id = array(
		   'cust_id' => $customer_id['id'],
		   'id' => $add_billing_row_id
		);
		$this->Cart_model->insert_customer_id($update_billing_cust_id);
		//--------------------Refactor this section---------------------------------
		//Grabs all the cart data into an array to pass to the model to insert into ORDERS
		$cart = $this->session->userdata('cart');
		$show_cart = array();
		$total_price = 0;

		foreach ($cart as $key => $value)
		{
			if($key != 'total_items')
			{
				$item = $this->Cart_model->get_item($key);
				$show_cart[] = array(
													'id' => $item['id'],
													'quantity' => $value,
													'name' => $item['name'],
													'price' => ($item['price']),
														);
				$total_price += ($item['price'] * $value);
			}

		}
		$show_cart['total_price'] = $total_price;
		//-----------------End of refactor section-------------------------------
		//Create an array to pass to model to insert into ORDERS table
		$order_info = array(
		   'cust_id' => $customer_id['id'],
		   // 'cust_id' => "1",
		   'ship_to_address' => $add_row_id,
		   'bill_to_address' => $add_billing_row_id,
		   'order_status' => "New",
		   'shipping_price' => "9.99",
		   // 'ship_to_address' => "2",
		   // 'bill_to_address' => "3",
		   'order_total' => $show_cart['total_price']
		);
		$order_id = $this->Cart_model->add_order($order_info);
		//For each item in the cart, add to ORDERS_ITEM table that many times
		for($i = 0; $i < count($show_cart) - 1; $i++)
		{
			$order_info_items = array(
				'product_id' => $show_cart[$i]['id'],
				'quantity' => $show_cart[$i]['quantity'],
				'order_id' => $order_id
				// 'order_id' => "1005"
				);
			$this->Cart_model->add_order_item($order_info_items);
			$inventory = $this->Cart_model->get_inventory($show_cart[$i]['id']);
			$inventory_count = array(
					"inventory_count" => $inventory['inventory_count'] - $show_cart[$i]['quantity'],
					"quantity_sold" => $inventory['quantity_sold'] + $show_cart[$i]['quantity'],
				);
			$this->Cart_model->update_inventory($inventory_count, $show_cart[$i]['id']);
			$cart = array(
					'total_items' => 0,
 					);
			$this->session->set_userdata('cart', $cart);
		}
		//NEED TO UNSET THE WHOLE CART HERE, maybe add in flash session messages
		//redirect(base_url());
	}

	public function stripe()
	{
		$this->load->view('stripe');
	}

	public function post_pay()
	{
		if($this->session->userdata('paid')=="1") {
		    $this->pay(); //If Stripe API returned 1 then have the orders added to the DB

		 }
		elseif($this->session->userdata('paid')=="0") {
			redirect("/cart");
		 }
	}

	public function post()
	{
		// var_dump($this->input->post());
		// die();
		// Set your secret key: remember to change this to your live secret key in production
		// See your keys here https://dashboard.stripe.com/account
		Stripe::setApiKey("sk_test_OC5ocu6mbMsOB5NCSV6L8o83");
		$error = '';
		$success = '';
		$view_data['stripe_response'] = '';

		// Get the credit card details submitted by the form
		$token = $_POST['stripeToken'];

		// Create the charge on Stripe's servers - this will charge the user's card
		try {
		$charge = Stripe_Charge::create(array(
		  // "amount" => 1000, // amount in cents, again
		  "amount" => $this->input->post('total_to_charge')*100,
		  "currency" => "usd",
		  "card" => $token,
		  "description" => "payinguser@example.com")
		);
		 //    $view_data['stripe_response'] = '<div class="alert alert-success">
		 //                <strong>Success!</strong> Your payment was successful.
			// 			</div>';
			// $view_data['message'] = TRUE;
			// $this->session->set_userdata('paid', "1");
			$this->session->set_flashdata("success", "<div class='alert alert-success'>
				<strong>Success!</strong> Your payment was successful. </div>'");
			$this->pay();
			redirect(base_url());
		} catch(Stripe_CardError $e) {
		  // The card has been declined
			// $view_data['stripe_response'] = '<div class="alert alert-danger">
			// 		  <strong>Error!</strong> '.$e->getMessage().'
			// 		  </div>';
			// $view_data['message'] = FALSE;
			// $this->session->set_userdata('paid', "0");
			$this->session->set_flashdata("error", '<div class="alert alert-danger">
			 		  <strong>Error!</strong> '.$e->getMessage().'</div>');
			redirect("/cart");
		}
		// $post_data = $this->input->post();
		// var_dump($charge);
		// $this->output
		//      ->set_content_type('application/json')
		//      ->set_output($charge);
		// var_dump($view_data);
		// die();
		
		$this->load->view('stripe', $view_data);
	}

	public function test()
	{
		var_dump($this->input->post());
	}




}
