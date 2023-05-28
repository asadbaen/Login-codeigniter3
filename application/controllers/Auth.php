<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function goToDefaultPage()
    {
        if ($this->session->userdata('role_id') == 1) {
            redirect('admin');
        } else if ($this->session->userdata('role_id') == 2) {
            redirect('user');
        } else {
            // jika ada role_id yg lain maka tambahkan disini
        }
    }

    public function index()
    {
        $this->goToDefaultPage();
        // validation
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');

        // if check validation
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Login';
            $this->load->view('auth/login', $data);
        } else {
            // validations success
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        // var_dump($user);

        // die;
        // check
        // user is ready exist
        if ($user) {
            // user is active
            if ($user['is_active'] == 1) {
                // check password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    // this not password
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
 Wrong password!</div>');

                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
 Email not activated!</div>');

                redirect('Auth');
            }
        } else {
            // user is not ready
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 Email is not register!</div>');

            redirect('Auth');
        }
    }

    public function register()
    {
        $this->goToDefaultPage();
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'This email has already exist!'
        ]);
        $this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[4]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Membership Registration';
            $this->load->view('auth/register', $data);
        } else {
            // $data, set data if success validations
            $data = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'images' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_BCRYPT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time(),
            ];

            // insert data to db
            $this->db->insert('users', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 congratulations successful registration, please login!</div>');

            redirect('Auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 you have logged out!</div>');

        redirect('Auth');
    }

    public function blocked()
    {
        $this->load->view('blocked');
    }
}
