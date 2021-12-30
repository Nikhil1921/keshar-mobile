<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Models_model extends MY_Model
{
	public $table = "models m";
	public $select_column = ['m.id', 'm.m_name', 'b.b_name'];
	public $search_column = ['m.id', 'm.m_name', 'b.b_name'];
    public $order_column = [null, 'm.m_name', 'b.b_name', null];
	public $order = ['m.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where(['m.is_deleted' => 0, 'b.is_deleted' => 0])
				 ->join('brands b', 'b.id = m.brand_id');

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('m.id')
		         ->from($this->table)
				 ->where(['m.is_deleted' => 0, 'b.is_deleted' => 0])
				 ->join('brands b', 'b.id = m.brand_id');
		            	
		return $this->db->get()->num_rows();
	}
}