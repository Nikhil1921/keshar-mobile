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
            $sub_array[] = $row->model;
            $sub_array[] = $row->b_name;
            $sub_array[] = $row->profit;
            
            $action = '<div class="btn-group" role="group"><button class="btn btn-success dropdown-toggle"
                    id="btnGroupVerticalDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="fa fa-cogs"></span></button>
                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start">';
            $action .= anchor($this->redirect."/invoice/".e_id($row->id), '<i class="fa fa-print"></i> Invoice</a>', 'class="dropdown-item"');
            $action .= anchor($this->redirect."/profit-view/".e_id($row->id), '<i class="fa fa-eye"></i> Profit view</a>', 'class="dropdown-item"');
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
}