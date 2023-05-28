<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url(); ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>E-Shope</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <!-- Query Menu -->
                <?php
                $role_id = $this->session->userdata('role_id');
                $queryMenu = "SELECT `user_menu_id`, `menu`
                                FROM `user_menu` JOIN `access_menu` 
                                ON `user_menu`.`user_menu_id` = `access_menu`.`menu_id`
                                WHERE `access_menu`.`role_id` = $role_id
                                ORDER BY `access_menu`.`menu_id` ASC
                                ";

                $menu = $this->db->query($queryMenu)->result_array();
                // var_dump($menu);
                // die();

                ?>
                <!-- LOOP MENU -->

                <?php foreach ($menu as $key) : ?>
                    <li class="nav-header">
                        <?= $key['menu']; ?>
                    </li>
                    <!-- SUBMENU -->
                    <?php
                    $menuId = $key['user_menu_id'];
                    // $querySubmenu = "SELECT *
                    //                     FROM `user_submenu` JOIN `user_menu` 
                    //                     ON `user_submenu`.`user_submenu_id` = `user_menu`.`user_menu_id`
                    //                     WHERE `user_submenu`.`user_submenu_id` = $menuId
                    //                     AND `user_submenu`.`is_active` =1
                    //                     ";
                    // $subMenu = $this->db->query($querySubmenu)->result_array();
                    $querySubmenu = "SELECT * FROM `user_submenu` 
                                    WHERE `user_menu_id` = $menuId 
                                    AND `is_active` =1
                    ";

                    $subMenu = $this->db->query($querySubmenu)->result_array();

                    // var_dump($querySubmenu);
                    // die();
                    ?>

                    <?php foreach ($subMenu as $key) : ?>
                        <li class="nav-item">
                            <a href="<?= base_url($key['url']); ?>" <?php if ($title == $key['title']) : ?> class="nav-link active" <?php else : ?> class="nav-link" <?php endif; ?>>
                                <i class="<?= $key['icon']; ?>"></i>
                                <p>
                                    <?= $key['title']; ?>
                                </p>
                            </a>
                        </li>

                    <?php endforeach; ?>

                <?php endforeach; ?>
                <hr>
                <a href="<?= site_url('Cobahalaman'); ?>" class="nav-link">
                    <i class="fas fa-fw fa-power-off" aria-hidden="true"></i>
                    <p>
                        Coba
                    </p>
                </a>
                <a href="<?= site_url('auth/logout'); ?>" class="nav-link">
                    <i class="fas fa-fw fa-power-off" aria-hidden="true"></i>
                    <p>
                        LOGOUT
                    </p>
                </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>