<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Sales_model extends MY_Model
{
	public $table = "sellings s";
	public $select_column = ['s.id', 's.cust_name', 's.mobile', 's.sell_price', 'i.imei', 's.create_date', 'm.m_name', 'b.b_name', 'p.sell_status'];
	public $search_column = ['s.id', 's.cust_name', 's.mobile', 's.sell_price', 'i.imei', 's.create_date', 'm.m_name', 'b.b_name'];
    public $order_column = [null, 's.cust_name', 's.mobile', 's.sell_price', 'i.imei', 's.create_date', 'm.m_name', 'b.b_name', null];
	public $order = ['s.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where(['b.is_deleted' => 0, 'm.is_deleted' => 0, 'p.is_deleted' => 0])
                 ->join("purchases p", 'p.id = s.id')
                 ->join("imeis i", 'i.id = p.imei_id')
                 ->join("brands b", 'b.id = i.brand_id')
                 ->join("models m", 'm.id = i.model_id');

		if ($this->input->get('start_date')) $this->db->where(['s.create_date >= ' => $this->input->get('start_date')]);
        if ($this->input->get('end_date')) $this->db->where(['s.create_date <= ' => $this->input->get('end_date')]);
		
        $this->datatable();
	}

	public function count()
	{
		$this->db->select('s.id')
		         ->from($this->table)
				 ->where(['b.is_deleted' => 0, 'm.is_deleted' => 0, 'p.is_deleted' => 0])
                 ->join("purchases p", 'p.id = s.id')
                 ->join("imeis i", 'i.id = p.imei_id')
                 ->join("brands b", 'b.id = i.brand_id')
                 ->join("models m", 'm.id = i.model_id');
		            	
		return $this->db->get()->num_rows();
	}
}