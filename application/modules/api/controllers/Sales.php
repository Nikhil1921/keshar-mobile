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

    public function invoice($id)
    {
        $id = explode('.', $id);
        $id = reset($id);
        $sell = $this->main->get("sellings", 'cust_name, mobile, sell_price, create_date', ['id' => $id]);
        if ($sell) {
            $purchase = $this->main->get('purchases', 'brand, model, id, price, sell_status, imei_id', ['id' => $id]);    
            $imei = $this->main->get("imeis", 'imei', ['id' => $purchase['imei_id']]);
            $purchase['brand'] = $this->main->check("brands", ['id' => $purchase['brand']], 'b_name');
            $data['data'] = array_merge($purchase, $imei);
            
            if ($sell) $data['data'] = array_merge($data['data'], $sell);
            
            require 'vendor/autoload.php';
            $mpdf = new \Mpdf\Mpdf();
            $curl_handle = curl_init();
            curl_setopt($curl_handle,CURLOPT_URL, base_url('assets/dist/css/print.css'));
            curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
            curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
            $stylesheet = curl_exec($curl_handle);
            curl_close($curl_handle);
            $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
            $mpdf->WriteHTML($this->load->view('sales/invoice_pdf', $data, true), \Mpdf\HTMLParserMode::HTML_BODY);
            $mpdf->Output();
            /* $mpdf->Output("uploads/invoice/$id.pdf", "F"); */
            /* return $this->template->load('template', 'sales/invoice', $data); */
        }
    }
}