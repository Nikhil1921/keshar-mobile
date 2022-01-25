<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Purchases extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->path = $this->config->item('documents');
        $this->load->helper('api');
        $this->load->model('purchases_model', 'api');
    }

	private $table = 'purchases';
	private $title = 'purchases';
	
	public function index()
	{
        get();
        verifyRequiredParams(["start", "length", "status"]);

        $data = $this->api->make_datatables();

        $response['row'] = $data;
        $response['error'] = false;
        $response['message'] = "$this->title List success";

        echoRespnse(200, $response);
	}
    

	public function add_update()
	{
        post();
        $api = authenticate('logins');
        verifyRequiredParams(['brand_id', 'model', 'imei', 'cust_name', 'mobile', 'price', 'op_date', 'id']);

        $id = $this->input->post('id');

        $this->load->model('purchases_model');
        
        if ($insert = $this->purchases_model->purchase($this->table, $id, $api)) {
            $response['row'] = $insert;
            $response['error'] = false;
            $response['message'] = "$this->title ".($id ? 'update' : 'add')." success";
        }else{
            $response['error'] = true;
            $response['message'] = "$this->title ".($id ? 'update' : 'add')." not success";
        }

        echoRespnse(200, $response);
	}

    public function sell()
	{
        post();
        $api = authenticate('logins');
        verifyRequiredParams(['cust_name', 'mobile', 'price', 'op_date', 'id']);

        $id = $this->input->post('id');

        $this->load->model('purchases_model');

        if ($this->purchases_model->sell($this->table, $id, $api)) {
            $response['error'] = false;
            $response['message'] = "Sell success";
        }else{
            $response['error'] = true;
            $response['message'] = "Sell not success";
        }

        echoRespnse(200, $response);
	}

	public function upload($id)
	{
        $docs = $this->main->get($this->table, 'documents', ['id' => $id]);
        
        $docs = $docs ? json_decode($docs['documents']) : '';

        if ($this->input->server('REQUEST_METHOD') == "GET" && $docs) {
            $response['row']['path'] = base_url($this->path);
            $response['row']['docs'] = $docs;
            $response['error'] = true;
            $response['message'] = "Document list success.";
        }elseif ($this->input->server('REQUEST_METHOD') == "POST" && $docs) {
            verifyRequiredParams(['key']);
            $image = $this->uploadImage('document');
            
            if ($image['error'] == TRUE)
			    echoRespnse(200, $image);
            else{
                $unlink = $docs[$this->input->post('key')]->image;
                $docs[$this->input->post('key')]->image = $image["message"];
                $post = ['documents' => json_encode($docs)];

                $uid = $this->main->update(['id' => $id],$post, $this->table);
                if ($uid && $unlink && file_exists($this->path.$unlink)) unlink($this->path.$unlink);
                if ($uid) {
                    $response['error'] = false;
                    $response['message'] = "Document uploaded.";
                }else{
                    $response['error'] = true;
                    $response['message'] = "Document not uploaded.";
                }
            }
        }else{
            $response['error'] = true;
            $response['message'] = "Purchase not found";
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

    public function profit(int $id)
    {
        get();
        $this->load->model('sales_model');
        
        if ($row = $this->sales_model->profit($id)) {
            $response['row'] = $row;
            $response['error'] = false;
            $response['message'] = "$this->title delete success";
        }else{
            $response['error'] = true;
            $response['message'] = "$this->title delete not success";
        }

        echoRespnse(200, $response);
    }
}