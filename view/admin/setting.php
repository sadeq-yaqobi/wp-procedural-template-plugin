<?php
function sp_sample_plugin_admin_layout()
{

    if (!current_user_can('manage_options')) {
        return;
    }
    if (isset($_GET['setting-update'])) {
        add_settings_error('setting', 'setting-message', 'تنظیمات ذخیره گردید.', 'success');
    }
    settings_errors('setting-message');

    ?>
    <div class="sp-wrap">
        <form action="options.php" method="post" >
            <h1><?php echo esc_html(get_admin_page_title()) ?></h1>
            <?php
            settings_fields('sample-plugin'); // Output security fields
            do_settings_sections('sample-plugin-html');// Output setting sections
            // Submit Button
            echo '<div class="submit-wrapper sp-submit-wrapper">';
            submit_button('ذخیره تغییرات', 'primary large');
            echo '</div>';
            ?>
        </form>
    </div>

    <?php
}

// Initialize plugin settings and fields
function sp_setting_init()
{

 register_setting('sample-plugin', '', 'sp_form_sanitize_input');

    // Add settings section
    add_settings_section('sp_settings_section', '', '', 'sample-plugin-html');
    // Add settings fields for information that need to customize plugin features
    add_settings_field('sp_settings_field', '', 'sp_render_form', 'sample-plugin-html', 'sp_settings_section');
}

add_action('admin_init', 'sp_setting_init');

function sp_render_form()
{
    $sp_setting = get_option('_sp_option_name');
    ?>
    <div class="sp-element-wrapper">
        <label for="title">عنوان بخش در قالب</label>
        <input id="title" type="text" name="_sp_option_name[_sp_title]" value="<?php  sp_get_input_value($sp_setting['_sp_title'],'') ?>">

        <label for="number">تعداد مطالب جهت نمایش</label>
        <input id="number" type="text" name=_sp_option_name["_sp_number]" value="<?php  sp_get_input_value($sp_setting['_sp_number'],'') ?>">

        <label for="term">نمایش مطلب بر اساس</label>
        <select name="_sp_option_name[_sp_term]" id="term">
            <option value="category" <?php echo selected(esc_attr($sp_setting['_sp_term']), 'category'); ?>>دسته‌بندی‌های مطلب
            </option>
            <option value="tag" <?php echo selected(esc_attr($sp_setting['_sp_term']), 'tag'); ?>>برچسب‌های مطلب</option>
        </select>

        <label for="order_by">ترتیب نمایش مطالب</label>
        <select name="_sp_option_name[_sp_order_by]" id="order_by">
            <option value="asc" <?php echo selected(esc_attr($sp_setting['_sp_order_by']), 'asc'); ?>>صعودی</option>
            <option value="desc" <?php echo selected(esc_attr($sp_setting['_sp_order_by']), 'desc'); ?>>نزولی</option>
            <option value="rand" <?php echo selected(esc_attr($sp_setting['_sp_order_by']), 'rand'); ?> >تصادفی</option>
        </select>

        <label for="display_type">حالت نمایش</label>
        <div class="sp-display-type" id="display_type">
            <label for="display_type_block">
                <input id="display_type_block" type="radio" name="_sp_option_name[_sp_display_type]"
                       value="block" <?php echo checked(esc_attr($sp_setting['_sp_display_type']), 'block'); ?>>
                <img width="32px" height="32px" src="<?php echo SP_PLUGIN_ASSETS_URL . 'img/gallery.png'; ?> "
                     alt="icon" title="نمایش به صورت اسلایدر">
            </label>
            <label for="display_type_list">
                <input id="display_type_list" type="radio" name="_sp_option_name[_sp_display_type]"
                       value="list" <?php echo checked(esc_attr($sp_setting['_sp_display_type']), 'list'); ?>>
                <img width="32px" height="32px" src="<?php echo SP_PLUGIN_ASSETS_URL . 'img/list.png'; ?>" alt="icon"
                     title="نمایش به صورت لیست">
            </label>
        </div>
        <div class="sp-number-slider-container">
            <div class="sp-number-item-slider-wrapper ">
                <label for="number-item-slider">تعداد مطالب در اسلایدر</label>
                <input id="number-item-slider" type="text" name="_sp_option_name[_sp_number_item_slider]"
                       value="<?php sp_get_input_value($sp_setting['_sp_number_item_slider'],'') ?>">
            </div>
        </div>
    </div>
    <?php
}
//get input value
function sp_get_input_value($value, $default_value = '')
{
    echo isset($value) ? esc_attr($value) : $default_value;
}

// sanitize inputs
function sp_form_sanitize_input($input)
{
    $input['_sp_title'] = sanitize_text_field($input['_sp_title']);
    $input['_sp_number'] = sanitize_text_field($input['_sp_number']);

    $input['_sp_term'] = sanitize_text_field($input['_sp_term']);
    $input['_sp_order_by'] = sanitize_text_field($input['_sp_order_by']);

    $input['_sp_display_type'] = sanitize_text_field($input['_sp_display_type']);
    $input['_sp_number_item_slider'] = sanitize_text_field($input['_sp_number_item_slider']);

    return $input;
}
