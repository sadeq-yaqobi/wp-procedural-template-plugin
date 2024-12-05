<?php
function sp_initialize_options_setting()
{
    $options = [
        '_sp_title' => 'مطالب مرتبط',
        '_sp_number' => '4',
        '_sp_term' => 'category',
        '_sp_order_by' => 'rand',
        '_sp_display_type' => 'list',
        '_sp_number_item_slider'=>'3'
    ];

//    foreach ($options as $option => $default_value) update_option($option, $default_value);
}

function sp_delete_options_setting()
{
    $options = ['_sp_title', '_sp_number', '_sp_term', '_sp_order_by', '_sp_display_type','_sp_number_item_slider'];

//    foreach ($options as $option) delete_option($option);
}
