<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Sales_model extends MY_Model
{
	public $table = "sellings s";
	public $select_column = ['s.id', 's.cust_name', 's.mobile', 's.sell_price', 'i.imei', 's.create_date', 'p.model', 'b.b_name', 'p.sell_status'];
	public $order = ['s.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where(['p.is_deleted' => 0])
                 ->join("purchases p", 'p.id = s.id')
                 ->join("imeis i", 'i.id = p.imei_id')
				 ->join("brands b", 'b.id = p.brand');

		if ($this->input->get('start_date')) $this->db->where(['s.create_date >= ' => $this->input->get('start_date')]);
        if ($this->input->get('end_date')) $this->db->where(['s.create_date <= ' => $this->input->get('end_date')]);
		
        $this->datatable();
	}

	public function profit(int $id)
    {
        $this->db->select('s.id, s.cust_name buyer, s.mobile b_mobile, s.sell_price, s.create_date sell_date, p.cust_name seller,
        p.mobile s_mobile, p.price b_price, p.create_date b_date, imei, model, b_name')
				 ->from($this->table)
				 ->where(['s.id' => $id])
				 ->join("purchases p", 'p.id = s.id')
				 ->join("imeis i", 'i.id = p.imei_id')
				 ->join("brands b", 'b.id = p.brand');
				 
		return $this->db->get()->row_array();
    }
}