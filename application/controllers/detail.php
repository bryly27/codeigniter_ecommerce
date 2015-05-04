<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Detail extends CI_Controller
{
	public function index($id)
	{
		$this->load->model('details');
		$info['details'] = $this->details->get_details($id);
		$info['similars'] = $this->details->get_similar($info['details']['0']['type']);
		$this->load->view('show', $info);
	}




}
