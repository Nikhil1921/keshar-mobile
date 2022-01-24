<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->path = $this->config->item('documents');
        $this->load->helper('api');
        $this->load->model('Sales_model', 'api');
    }

	private $table = 'sales';
	protected $title = 'Sales';
	
	public function index()
	{
        get();
        verifyRequiredParams(["start", "length"]);

        $data = $this->api->make_datatables();

        $response['row'] = $data;
        $response['error'] = false;
        $response['message'] = "$this->title List success";

        echoRespnse(200, $response);
	}
}