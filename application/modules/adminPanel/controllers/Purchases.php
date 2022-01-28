<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Purchases extends Admin_controller  {

    public function __construct(){
        parent::__construct();
        $this->path = $this->config->item('documents');
    }

	private $table = 'purchases';
	protected $redirect = 'purchases';
	protected $title = 'Purchase';
	protected $name = 'purchases';
	
	public function index()
	{
		$data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['url'] = $this->redirect;
        $data['dateFilter'] = true;
        $data['operation'] = "List";
        $data['dataTables'] = "$this->redirect/get";
		
		return $this->template->load('template', "$this->redirect/home", $data);
	}

	public function get()
    {
        check_ajax();
        $this->load->model('purchases_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $this->input->get('start') + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->cust_name;
            $sub_array[] = $row->mobile;
            $sub_array[] = $row->price;
            $sub_array[] = $row->imei;
            $sub_array[] = date('d-m-Y', strtotime($row->create_date));
            $sub_array[] = $row->model;
            $sub_array[] = $row->b_name;
            
            $action = '<div class="btn-group" role="group"><button class="btn btn-success dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="fa fa-cogs"></span></button><div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start">';
            
            $action .= anchor($this->redirect."/documents/".e_id($row->id), '<i class="fa fa-file"></i> Documents</a>',
            'class="dropdown-item"');

            if (!$row->sell_status)
                $action .= anchor($this->redirect."/update/".e_id($row->id), '<i class="fa fa-edit"></i> Edit</a>', 'class="dropdown-item"');
                
            $action .= anchor($this->redirect."/sell/".e_id($row->id), '<i class="fa fa-rupee-sign"></i>&nbsp&nbsp Sell</a>', 'class="dropdown-item"');

            if (!$row->sell_status)
                $action .= form_open($this->redirect.'/delete', 'id="'.e_id($row->id).'"', ['id' => e_id($row->id)]).
                        '<a class="dropdown-item" onclick="remove('.e_id($row->id).'); return false;" href=""><i class="fa fa-trash"></i> Delete</a>'.
                        form_close();
            else {
                $action .= anchor($this->redirect."/invoice/".e_id($row->id), '<i class="fa fa-print"></i>
                Invoice</a>', 'class="dropdown-item"');
                $action .= anchor($this->redirect."/profit-view/".e_id($row->id), '<i class="fa fa-eye"></i> Profit view</a>', 'class="dropdown-item"');
            }
            
            $action .= '</div></div>';
            $sub_array[] = $action;

            $data[] = $sub_array;
            $sr++;
        }

        $output = [
            "draw"              => intval($this->input->get("draw")),  
            "recordsTotal"      => $this->data->count(),
            "recordsFiltered"   => $this->data->get_filtered_data(),
            "data"              => $data
        ];
        
        die(json_encode($output));
    }

	public function add()
	{
        $this->form_validation->set_rules($this->validate);

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = $this->title;
            $data['name'] = $this->name;
            $data['operation'] = "Add";
            $data['url'] = $this->redirect;
            $data['brands'] = $this->main->getall('brands', 'id, b_name', ['is_deleted' => 0]);
            
            return $this->template->load('template', "$this->redirect/form", $data);
        }else{
            $this->load->model('purchases_model');
            $id = $this->purchases_model->purchase($this->table);
            
            if ($id) $this->redirect = "$this->redirect/upload/$id";
            flashMsg($id, "$this->title added.", "$this->title not added. Try again.", $this->redirect);
        }
	}

	public function update($id)
	{
        $this->form_validation->set_rules($this->validate);

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = $this->title;
            $data['name'] = $this->name;
            $data['operation'] = "Update";
            $data['url'] = $this->redirect;
            $data['brands'] = $this->main->getall('brands', 'id, b_name', ['is_deleted' => 0]);
            $purchase = $this->main->get($this->table, 'cust_name, mobile, price, create_date, brand, model, create_by, sell_status, imei_id', ['id' => d_id($id)]);

            if ($purchase) {
                $imei = $this->main->get("imeis", 'imei', ['id' => $purchase['imei_id']]);
                $data['data'] = array_merge($purchase, $imei);
                return $this->template->load('template', "$this->redirect/form", $data);
            }else{
                return $this->error_404();
            }
        }else{
            $this->load->model('purchases_model');
            $id = $this->purchases_model->purchase($this->table, d_id($id));
            
            if ($id) $this->redirect = "$this->redirect/upload/$id";

            flashMsg($id, "$this->title updated.", "$this->title not updated. Try again.", $this->redirect);
        }
	}

    public function sell($id)
	{
        $this->form_validation->set_rules($this->sell);

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = $this->title;
            $data['name'] = $this->name;
            $data['operation'] = "Sell";
            $data['url'] = $this->redirect;
            $purchase = $this->main->get($this->table, 'brand, model, price, sell_status, imei_id', ['id' => d_id($id)]);
            if ($purchase) {
                $imei = $this->main->get("imeis", 'imei', ['id' => $purchase['imei_id']]);
                $sell = $this->main->get("sellings", 'cust_name, mobile, sell_price, create_date', ['id' => d_id($id)]);
                if ($purchase)
                    $purchase['brand'] = $this->main->check("brands", ['id' => $purchase['brand']], 'b_name');
                

                $data['data'] = array_merge($purchase, $imei);
                if ($sell) {
                    $data['data'] = array_merge($data['data'], $sell);
                }
                return $this->template->load('template', "$this->redirect/sell", $data);
            }else{
                return $this->error_404();
            }
        }else{
            $this->load->model('purchases_model');
            
            $id = $this->purchases_model->sell($this->table, d_id($id));
            
            flashMsg($id, "$this->title sold.", "$this->title not sold. Try again.", $this->redirect);
        }
	}

	public function upload($id)
	{
        $docs = $this->main->get($this->table, 'documents', ['id' => d_id($id)]);

        if ($this->input->server('REQUEST_METHOD') == "GET" && $docs) {
            $data['title'] = $this->title;
            $data['name'] = $this->name;
            $data['operation'] = "Upload";
            $data['url'] = $this->redirect;
            $data['path'] = $this->path;
            $data['data'] = $docs;
            return $this->template->load('template', "$this->redirect/upload", $data);
        }elseif ($this->input->server('REQUEST_METHOD') == "POST" && $docs) {
            $docs = json_decode($docs['documents']);
            
            $image = $this->uploadImage('document');
            if ($image['error'] == TRUE)
			    flashMsg(0, "", $image["message"], "$this->redirect/upload/$id");
            else{
                $unlink = $docs[$this->input->post('key')]->image;
                $docs[$this->input->post('key')]->image = $image["message"];
                $post = ['documents' => json_encode($docs)];

                $uid = $this->main->update(['id' => d_id($id)],$post, $this->table);
                if ($uid && $unlink && file_exists($this->path.$unlink)) unlink($this->path.$unlink);
                flashMsg($uid, "$this->title added.", "$this->title not added. Try again.", "$this->redirect/upload/$id");
            }
        }else{
            return $this->error_404();
        }
	}

	public function documents($id)
	{
        $docs = $this->main->get($this->table, 'documents', ['id' => d_id($id)]);

        if ($docs) {
            $data['title'] = $this->title;
            $data['name'] = $this->name;
            $data['operation'] = "Documents";
            $data['url'] = $this->redirect;
            $data['path'] = $this->path;
            $data['data'] = $docs;
            return $this->template->load('template', "$this->redirect/documents", $data);
        }else{
            return $this->error_404();
        }
	}

	public function delete()
    {
        $this->form_validation->set_rules('id', 'id', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE)
            flashMsg(0, "", "Some required fields are missing.", $this->redirect);
        else{
            $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_deleted' => 1], $this->table);
            flashMsg($id, "$this->title deleted.", "$this->title not deleted.", $this->redirect);
        }
    }

    protected $validate = [
        [
            'field' => 'brand_id',
            'label' => 'Brand Name',
            'rules' => 'required|max_length[100]',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 100 chars allowed.",
            ],
        ],
        [
            'field' => 'model_id',
            'label' => 'Model Name',
            'rules' => 'required|max_length[100]',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 100 chars allowed.",
            ],
        ],
        [
            'field' => 'imei',
            'label' => 'IMEI No',
            'rules' => 'required|max_length[50]',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 50 chars allowed.",
            ],
        ],
        [
            'field' => 'cust_name',
            'label' => 'Customer Name',
            'rules' => 'required|max_length[50]',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 50 chars allowed.",
            ],
        ],
        [
            'field' => 'mobile',
            'label' => 'Customer mobile',
            'rules' => 'required|numeric|exact_length[10]',
            'errors' => [
                'required' => "%s is required",
                'exact_length' => "%s is invalid",
                'numeric' => "%s is invalid",
            ],
        ],
        [
            'field' => 'price',
            'label' => 'Purchase price',
            'rules' => 'required|numeric|max_length[10]',
            'errors' => [
                'required' => "%s is required",
                'numeric' => "%s is invalid",
                'max_length' => "Max 10 chars allowed.",
            ],
        ],
        [
            'field' => 'op_date',
            'label' => 'Purchase date',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is required"
            ],
        ],
    ];

    protected $sell = [
        [
            'field' => 'cust_name',
            'label' => 'Customer Name',
            'rules' => 'required|max_length[50]',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 50 chars allowed.",
            ],
        ],
        [
            'field' => 'mobile',
            'label' => 'Customer mobile',
            'rules' => 'required|numeric|exact_length[10]',
            'errors' => [
                'required' => "%s is required",
                'exact_length' => "%s is invalid",
                'numeric' => "%s is invalid",
            ],
        ],
        [
            'field' => 'price',
            'label' => 'Sell price',
            'rules' => 'required|numeric|max_length[10]',
            'errors' => [
                'required' => "%s is required",
                'numeric' => "%s is invalid",
                'max_length' => "Max 10 chars allowed.",
            ],
        ],
        [
            'field' => 'op_date',
            'label' => 'Sell date',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is required"
            ],
        ],
    ];
}