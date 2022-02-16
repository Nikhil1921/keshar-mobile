<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Login extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
        if ($this->session->auth) return redirect(admin());
	}

    protected $table = 'logins';

    protected $login = [
        [
            'field' => 'mobile',
            'label' => 'Mobile No.',
            'rules' => 'required|numeric|exact_length[10]',
            'errors' => [
                'required' => "%s is required",
                'numeric' => "%s is invalid",
                'exact_length' => "%s is invalid",
            ],
        ]
    ];

	public function index()
	{
        $this->form_validation->set_rules($this->login);

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = 'login';
            $data['name'] = 'login';
            
            return $this->template->load('auth/template', 'auth/login', $data);
        }
        else
        {
            $post = [
    			'mobile'   	 => $this->input->post('mobile')
    		];
            
    		$user = $this->main->get($this->table, 'id', $post);
    		
            if ($user) {
                $this->load->helper('string');
                $update = [
                    'otp'   	 => random_string('numeric', 6),
                    // 'otp'   	 => 999999,
                    'update_at'  => date('Y-m-d H:i:s', strtotime('+5 minutes')),
                ];
                if ($this->main->update(['id' => $user['id']], $update, $this->table) === true) {
                    $this->session->set_flashdata('login_id', $user['id']);
                    send_sms($post['mobile'], $update['otp']);
                    return redirect(admin('check-otp'));
                }else{
                    $this->session->set_flashdata('error', 'Some error occurs. Try again.');
    			    return redirect(admin('login'));
                }
    		}else{
    			$this->session->set_flashdata('error', 'Mobile not registered or account blocked.');
    			return redirect(admin('login'));
    		}
        }
	}

    public function check_otp()
    {
        if (! $this->session->login_id) return redirect(admin('forgot-password'));
        $this->session->set_flashdata('login_id', $this->session->login_id);
        
        $this->form_validation->set_rules('otp', 'OTP', 'required|numeric|exact_length[6]',
                        ['required' => "%s is required", 'numeric' => "%s is invalid", 'exact_length' => "%s is invalid",
            ]);

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = 'check OTP';
            $data['name'] = 'check_otp';
            
            return $this->template->load('auth/template', 'auth/check_otp', $data);
        }
        else
        {
            $post = [
    			'id'   	        => $this->session->login_id,
    			'otp'   	    => $this->input->post('otp'),
    			'update_at >= ' => date('Y-m-d H:i:s')
    		];

    		if ($user = $this->main->get($this->table, 'id, name', $post)) {
                
                $update = ['otp' => 0];

                if ($this->main->update(['id' => $user['id']], $update, $this->table) === true) {
                    $this->session->set_userdata('auth', $this->session->login_id);
                    $this->session->set_flashdata('success', 'Welcome '.$user['name']);
                    return redirect(admin());
                }else{
                    $this->session->set_flashdata('error', 'Some error occurs. Try again.');
    			    return redirect(admin('check-otp'));
                }
    		}else{
    			$this->session->set_flashdata('error', 'Invalid OTP.');
    			return redirect(admin('check-otp'));
    		}
        }
    }
}