<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Main_modal extends MY_Model
{
    public function sell_price()
    {
        $total = $this->db->select("SUM(sell_price) total")
                          ->from('sellings')
                          ->get()
                          ->row_array();
        
        return $total ? $total['total'] : 0;
    }

    public function purchase_price()
    {
        $total = $this->db->select("SUM(price) total")
                          ->from('purchases')
                          ->where(['is_deleted' => 0])
                          ->get()
                          ->row_array();
        
        return $total ? $total['total'] : 0;
    }
}