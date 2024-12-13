<?php
function sp_initialize_options_setting()
{
    $sp_options = [
        '_sp_title' => 'مطالب مرتبط',
        '_sp_number' => '4',
        '_sp_term' => 'category',
        '_sp_order_by' => 'rand',
        '_sp_display_type' => 'list',
        '_sp_number_item_slider'=>'3'
    ];

add_option('_sp_option_name',$sp_options);
}

function sp_delete_options_setting()
{
    delete_option('_sp_option_name');
}
