<?php
add_action('admin_menu','sp_register_menu');
//add_action('admin_menu','sp_register_options');

//if you want to show setting page in a specific menu in wordPress dashboard
function sp_register_menu()
{
    add_menu_page(
        'تنظیمات پلاگین نمونه',
        'پلاگین نمونه رویه‌ای',
        'manage_options',
        'sample_plugin_setting',
        'sp_sample_plugin_admin_layout' //it was implemented in view/admin/setting.php
    );
}
// if you want to set plugin setting page under general setting menu, not by a specific menu
//function sp_register_options()
//{
//    add_options_page(
//        'تنظیمات پلاگین لایک',
//        'لایک پست',
//        'manage_options',
//        'like_bookmark_setting',
//        'lbs_like_bookmark_post_admin_layout' //it was implemented in view/admin/setting.php
//    );
//}

include_once SP_PLUGIN_VIEW . 'admin/setting.php';
