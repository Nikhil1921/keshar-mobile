<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller  {

    public function __construct()
	{
		parent::__construct();
        $this->load->helper('api');
		// $this->banners = $this->config->item('banners');
	}

	protected $table = 'logins';
	
	public function send_otp()
    {
        post();
        verifyRequiredParams(["mobile"]);

        $post = [
    			'mobile'   	 => $this->input->post('mobile')
    		];

        if ($user = $this->main->get($this->table, 'id', $post)) {
            $this->load->helper('string');
            $update = [
                'otp'   	 => random_string('numeric', 6),
                'otp'   	 => 999999,
                'update_at'  => date('Y-m-d H:i:s', strtotime('+5 minutes')),
            ];
            if ($this->main->update(['id' => $user['id']], $update, $this->table) === true) {
                // send otp here
                $response['error'] = false;
                $response['message'] = "Login success.";
            }else{
                $response['error'] = true;
			    $response['message'] = "Some error occurs. Try again.";
            }
        }else{
            $response['error'] = true;
			$response['message'] = "Mobile not registered or account blocked.";
        }

		echoRespnse(200, $response);
    }

    public function check_otp()
    {
        post();
        verifyRequiredParams(["mobile", "otp"]);

        $post = [
    			'mobile'   	    => $this->input->post('mobile'),
    			'otp'   	    => $this->input->post('otp'),
    			'update_at >= ' => date('Y-m-d H:i:s')
    		];

        if ($user = $this->main->get($this->table, 'id', $post)) {
            
            $update = ['otp' => 0];

            if ($this->main->update(['id' => $user['id']], $update, $this->table) === true) {
                $response['row'] = $user;
                $response['error'] = false;
                $response['message'] = "Login success.";
            }else{
                $response['error'] = true;
			    $response['message'] = "Some error occurs. Try again.";
            }
        }else{
            $response['error'] = true;
			$response['message'] = "OTP expired or Invalid OTP.";
        }

        echoRespnse(200, $response);
    }
}