<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Models_model extends MY_Model
{
	public $table = "models m";
	public $select_column = ['m.id', 'm.m_name', 'm.brand_id'];
	public $order = ['m.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where(['m.is_deleted' => 0]);

		$this->datatable();
	}

	public function add_update(int $id, string $table)
	{  
		$post = [
            'm_name' => $this->input->post('m_name'),
            'brand_id' => $this->input->post('brand_id')
        ];
		
		$this->db->trans_start();

		if ($id != 0)
			$this->db->where('id', $id)->update($table, $post);
		else
			$this->db->insert($table, $post);

		return $this->db->trans_complete();
	}
}