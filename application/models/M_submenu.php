<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_submenu extends CI_Model
{

    public function getSubmenu()
    {
        $query = "SELECT `user_submenu`.*, `user_menu`.`menu` FROM `user_submenu` JOIN `user_menu` ON `user_submenu`.`user_menu_id` = `user_menu`.`user_menu_id`";

        return $this->db->query($query)->result_array();
    }
}
