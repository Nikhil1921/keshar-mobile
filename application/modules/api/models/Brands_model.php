<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Brands_model extends MY_Model
{
	public $table = "brands b";
	public $select_column = ['b.id', 'b.b_name'];
	public $order = ['b.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where(['b.is_deleted' => 0]);

		$this->datatable();
	}

	public function add_update(int $id, string $table)
	{  
		$post = [
            'b_name' => $this->input->post('b_name')
        ];
		
		$this->db->trans_start();

		if ($id != 0)
			$this->db->where('id', $id)->update($table, $post);
		else
			$this->db->insert($table, $post);

		return $this->db->trans_complete();
	}
}