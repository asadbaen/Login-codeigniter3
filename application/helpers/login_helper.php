<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('Auth');
    } else {

        $role_id = $ci->session->userdata('role_id');

        $menu = $ci->uri->segment(1);


        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();

        $usermenu_id = $queryMenu['user_menu_id'];

        $userAccess = $ci->db->get_where('access_menu', [
            'role_id' => $role_id,
            'menu_id' => $usermenu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('Auth/blocked');
        }
    }
}
// function is_logged_in()
// {
//     $ci = get_instance();
//     if (!$ci->session->userdata('email')) {
//         redirect('Auth');
//     } else {
//         $role_id = $ci->session->userdata('role_id');
//         $menu = $ci->uri->segment(1);
//         $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();

//         if ($queryMenu) {
//             $menu_id = $queryMenu['menu_id'];

//             $userAccess = $ci->db->get_where('access_menu', [
//                 'role_id' => $role_id,
//                 'menu_id' => $menu_id
//             ]);

//             if ($userAccess->num_rows() < 1) {
//                 redirect('Auth/blocked');
//             }
//         }
//     }
// }
