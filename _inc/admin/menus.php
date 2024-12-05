<?php
add_action('admin_menu','sp_register_menu');

function sp_register_menu()
{
    add_menu_page(
        'تنظیمات پلاگین نمونه',
        'پلاگین نمونهمطالب مرتبط',
        'manage_options',
        'sample_plugin_setting',
        'sp_sample_plugin_admin_layout' //it was implemented in setting file
    );
}

include_once SP_PLUGIN_VIEW . 'admin/setting.php';
