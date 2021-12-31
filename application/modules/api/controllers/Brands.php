<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends MY_Controller  {

    public function __construct()
	{
		parent::__construct();
        $this->load->helper('api');
        $this->load->model('Brands_model', 'api');
	}

	protected $table = 'brands';
	protected $title = 'Brand';
	
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
	
	public function add_update()
    {
        post();
        verifyRequiredParams(["b_name", "id"]);
        
        $id = $this->input->post('id');

        if ($this->api->add_update($id, $this->table)) {
            $response['error'] = false;
            $response['message'] = "$this->title ".($id ? 'update' : 'add')." success";
        }else{
            $response['error'] = true;
            $response['message'] = "$this->title ".($id ? 'update' : 'add')." not success";
        }

		echoRespnse(200, $response);
    }
	
	public function delete(int $id)
    {
        delete();

        if ($this->api->update(['id' => $id], ['is_deleted' => 1], $this->table)) {
            $response['error'] = false;
            $response['message'] = "$this->title delete success";
        }else{
            $response['error'] = true;
            $response['message'] = "$this->title delete not success";
        }

		echoRespnse(200, $response);
    }
}