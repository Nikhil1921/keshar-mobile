<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Admin_controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->auth) 
			return redirect(admin('login'));

        $this->user = (object) $this->main->get("logins", 'name, mobile, email', ['id' => $this->session->auth]);
		$this->redirect = admin($this->redirect);
	}
    
    public function invoice(int $id)
    {
        $purchase = $this->main->get('purchases', 'id, price, sell_status, imei_id', ['id' => d_id($id)]);
        if ($purchase) {
            $data['name'] = $this->name;
            $data['title'] = "Delivery Challan";
            $data['url'] = $this->redirect;
            $imei = $this->main->get("imeis", 'brand, model, imei', ['id' => $purchase['imei_id']]);
            $sell = $this->main->get("sellings", 'cust_name, mobile, sell_price, create_date', ['id' => d_id($id)]);
            if ($imei)
                $imei['brand'] = $this->main->check("brands", ['id' => $imei['brand']], 'b_name');
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
            /* $mpdf->Output("uploads/$id.pdf", "F"); */
            /* return $this->template->load('template', 'sales/invoice', $data); */
        }else{
            return $this->error_404();
        }
    }

    public function get_model_list()
    {
        check_ajax();
        $return = array_map(function($ins){
            return ['val' => e_id($ins['id']), 'm_name' => $ins['m_name']];
        }, $this->main->getall("models", 'id, m_name', ['is_deleted' => 0, 'brand_id' => d_id($this->input->get('brand_id'))]));
        
        die(json_encode($return));
    }

    public function profit(int $id)
    {
        $this->load->model('sales_model');
        $data['data'] = $this->sales_model->profit(d_id($id));
        
        if ($data['data']) {
            $data['name'] = $this->name;
            $data['title'] = "Profit";
            $data['url'] = $this->redirect;
        
            return $this->template->load('template', 'sales/profit', $data);
        }else{
            return $this->error_404();
        }
    }
}