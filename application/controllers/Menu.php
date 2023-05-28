<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // if (!$this->session->userdata('email')) {
        //     redirect('Auth');
        // }
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = "Menu Managemen";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        // query menu
        // jika banyak menggunakan result_array
        // jika hanya sebaris menggunakan row_array
        // $data['menu'] = "SELECT * FROM `menu`";
        $data['menu'] = $this->db->get('user_menu')->result_array();

        // rule validation

        $this->form_validation->set_rules('menu', 'menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header');
            $this->load->view('layout/navbar', $data);
            $this->load->view('layout/sidebar');
            $this->load->view('menu/index', $data);
            $this->load->view('layout/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => htmlspecialchars($this->input->post('menu'))]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Added Succes!</div>');

            redirect('Menu');
        }
    }

    public function edit($id)
    {
        $data['title'] = "Menu Edit";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get_where('user_menu', ['user_menu_id' => $id])->row_array();
        $this->load->view('layout/header');
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('menu/edit');
        $this->load->view('layout/footer');
    }

    public function update()
    {
        $data['title'] = "Menu Managemen";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get_where('user_menu', ['user_menu_id' => $id])->row_array();

        $this->form_validation->set_rules('menu', 'menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">failed to add!</div>');
            redirect('Menu/edit');
        } else {
            $id = $this->input->post('user_menu_id', true);
            $menu = $this->input->post('menu', true);

            $this->db->update('user_menu', ['menu' => $menu], ['user_menu_id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Added Success!</div>');

            redirect('Menu');
        }
    }


    public function delete($id)
    {
        $this->db->delete('user_menu', ['user_menu_id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Delete Succes!</div>');

        redirect('Menu');
    }


    public function subMenu()
    {
        $data['title'] = "Submenu Management";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        // $data['submenu'] = $this->db->get('user_submenu')->result_array();
        $this->load->model('M_submenu', 'menu');

        $data['submenu'] = $this->menu->getSubmenu();

        // send to data menu

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('user_menu_id', 'menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header');
            $this->load->view('layout/navbar', $data);
            $this->load->view('layout/sidebar');
            $this->load->view('menu/submenu', $data);
            $this->load->view('layout/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'user_menu_id' => $this->input->post('user_menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];

            $this->db->insert('user_submenu', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Added Succes!</div>');

            redirect('Menu/submenu');
        }
    }

    public function editSubmenu()
    {
        $data['title'] = "Submenu Management";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        // $data['submenu'] = $this->db->get('user_submenu')->result_array();
        $this->load->model('M_submenu', 'menu');

        $data['submenu'] = $this->menu->getSubmenu();

        // send to data menu

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('user_menu_id', 'menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header');
            $this->load->view('layout/navbar', $data);
            $this->load->view('layout/sidebar');
            $this->load->view('menu/submenu', $data);
            $this->load->view('layout/footer');
        } else {

            $id = $this->input->post('user_submenu_id');
            $title = $this->input->post('title');
            $user_menu_id = $this->input->post('user_menu_id');
            $url = $this->input->post('url');
            $icon = $this->input->post('icon');
            $is_active = $this->input->post('is_active');

            $data = [
                'title' => $title,
                'user_menu_id' => $user_menu_id,
                'url' => $url,
                'icon' => $icon,
                'is_active' => $is_active
            ];

            $this->db->where('user_submenu_id', $id);
            $this->db->update('user_submenu', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update Successful!</div>');

            redirect('Menu/submenu');
        }
    }
}
