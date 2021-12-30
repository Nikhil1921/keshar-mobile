<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends Admin_controller  {

    public function __construct(){
        parent::__construct();
        $this->path = $this->config->item('documents');
    }

	private $table = 'sales';
	protected $redirect = 'sales';
	protected $title = 'Sale';
	protected $name = 'sales';
	
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
        $this->load->model('Sales_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $this->input->get('start') + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->cust_name;
            $sub_array[] = $row->mobile;
            $sub_array[] = $row->sell_price;
            $sub_array[] = $row->imei;
            $sub_array[] = date('d-m-Y', strtotime($row->create_date));
            $sub_array[] = $row->m_name;
            $sub_array[] = $row->b_name;

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
}