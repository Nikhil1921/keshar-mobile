<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Purchases_model extends MY_Model
{
	public $table = "purchases p";
	public $imei = 'imeis';
	public $selling = 'sellings';
	public $select_column = ['p.id', 'p.cust_name', 'p.mobile', 'p.price', 'i.imei', 'p.create_date', 'm.m_name', 'b.b_name', 'p.sell_status'];
	public $search_column = ['p.id', 'p.cust_name', 'p.mobile', 'p.price', 'i.imei', 'p.create_date', 'm.m_name', 'b.b_name'];
    public $order_column = [null, 'p.cust_name', 'p.mobile', 'p.price', 'i.imei', 'p.create_date', 'm.m_name', 'b.b_name', null];
	public $order = ['p.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where(['b.is_deleted' => 0, 'm.is_deleted' => 0, 'p.is_deleted' => 0])
                 ->join("$this->imei i", 'i.id = p.imei_id')
                 ->join("brands b", 'b.id = i.brand_id')
                 ->join("models m", 'm.id = i.model_id');
        
        $this->db->where(['p.sell_status' => $this->input->get('status')]);
        
        if ($this->input->get('start_date')) $this->db->where(['p.create_date >= ' => $this->input->get('start_date')]);
        if ($this->input->get('end_date')) $this->db->where(['p.create_date <= ' => $this->input->get('end_date')]);
        
        $this->datatable();
	}

	public function count()
	{
		$this->db->select('p.id')
		         ->from($this->table)
				 ->where(['b.is_deleted' => 0, 'm.is_deleted' => 0, 'p.is_deleted' => 0])
                 ->join("$this->imei i", 'i.id = p.imei_id')
                 ->join("brands b", 'b.id = i.brand_id')
                 ->join("models m", 'm.id = i.model_id');
		
        $this->db->where(['p.sell_status' => $this->input->get('status')]);

		return $this->db->get()->num_rows();
	}

	public function purchase($table, $p_id=null)
	{
        $this->db->trans_start();

        $imei = [
            'brand_id' => d_id($this->input->post('brand_id')),
            'model_id' => d_id($this->input->post('model_id')),
            'imei'     => $this->input->post('imei'),
        ];
        
        $imei_id = $this->check($this->imei, $imei, 'id');

        if (!$imei_id){
            $this->db->insert($this->imei, $imei);
            $imei_id = $this->db->insert_id();
        }

        $purchase = [
            'cust_name'      => $this->input->post('cust_name'),
            'mobile'         => $this->input->post('mobile'),
            'price'          => $this->input->post('price'),
            'create_date'    => $this->input->post('op_date'),
            'create_by'      => $this->session->auth,
            'sell_status'    => 0,
            'imei_id'        => $imei_id
        ];

        if ($p_id == null) {
            for ($i=0; $i < 5; $i++) $imgs[$i]['image'] = '';
            $purchase['documents'] = json_encode($imgs);
        }
        
        if ($p_id != null) {
            $this->db->where('id', $p_id)->update($table, $purchase);
        }else{
            $this->db->insert($table, $purchase);
            $p_id = $this->db->insert_id();
        }

        $this->db->trans_complete();
        
		if ($this->db->trans_status() == true)
            return e_id($p_id);
        else
            return false;
	}

    public function sell($table, $p_id)
	{
        $this->db->trans_start();
        
        $sell = [
            'id'             => $p_id,
            'cust_name'      => $this->input->post('cust_name'),
            'mobile'         => $this->input->post('mobile'),
            'sell_price'     => $this->input->post('price'),
            'create_date'    => $this->input->post('op_date'),
            'create_by'      => $this->session->auth
        ];
        
        if ($this->check($this->selling, ['id' => $p_id], 'id'))
            $this->db->where('id', $p_id)->update($this->selling, $sell);
        else
            $this->db->insert($this->selling, $sell);
        
        $this->db->where('id', $p_id)->update($table, ['sell_status' => 1]);

        $this->db->trans_complete();
        
		if ($this->db->trans_status() == true)
            return e_id($p_id);
        else
            return false;
	}
}