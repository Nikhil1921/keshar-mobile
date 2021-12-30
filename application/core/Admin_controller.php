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

	protected function uploadImage($upload)
    {
        $this->load->library('upload');
        $config = [
                'upload_path'      => $this->path,
                'allowed_types'    => 'jpg|jpeg|png|pdf',
                'file_name'        => time(),
                'file_ext_tolower' => TRUE
            ];
        
        $this->upload->initialize($config);
        if ($this->upload->do_upload($upload)){
            $img = $this->upload->data("file_name");
            $name = $this->upload->data("raw_name");
            
            if (in_array($this->upload->data('file_ext'), ['.jpg', '.jpeg']))
                $image = imagecreatefromjpeg($this->path.$img);
            if ($this->upload->data('file_ext') == '.png')
                $image = imagecreatefrompng($this->path.$img);

            if (isset($image)){
                convert_webp($this->path, $image, $name);
                unlink($this->path.$img);
                $img = "$name.webp";
            }
            
            return ['error' => false, 'message' => $img];
        }else
            return ['error' => true, 'message' => $this->upload->display_errors()];
    }

    public function get_model_list()
    {
        check_ajax();
        $return = array_map(function($ins){
            return ['val' => e_id($ins['id']), 'm_name' => $ins['m_name']];
        }, $this->main->getall("models", 'id, m_name', ['is_deleted' => 0, 'brand_id' => d_id($this->input->get('brand_id'))]));
        
        die(json_encode($return));
    }
}