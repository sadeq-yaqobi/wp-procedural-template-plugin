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
    // Register settings with sanitization
    $args = ['type' => 'string', 'sanitize_callback' => 'sanitize_text_field', 'default' => null];

    $option_names = ['_sp_title', '_sp_number', '_sp_term', '_sp_order_by', '_sp_display_type', '_sp_number_item_slider'];
//    foreach ($option_names as $option_name) register_setting('sample-plugin', $option_name, $args);

    // Add settings section
    add_settings_section('sp_settings_section', '', '', 'sample-plugin-html');
    // Add settings fields for information that need to customize plugin features
    add_settings_field('sp_settings_field', '', 'sp_render_html', 'sample-plugin-html', 'sp_settings_section');
}

add_action('admin_init', 'sp_setting_init');

function sp_render_html()
{
    $title = get_option('_sp_title');
    $number = get_option('_sp_number');
    $term = get_option('_sp_term');
    $order_by = get_option('_sp_order_by');
    $display_type = get_option('_sp_display_type');
    $number_item_slider = get_option('_sp_number_item_slider');
    ?>
    <div class="sp-element-wrapper">
        <label for="title">عنوان بخش در قالب</label>
        <input id="title" type="text" name="_sp_title" value="<?php echo isset($title) ? esc_attr($title) : ''; ?>">

        <label for="number">تعداد مطالب جهت نمایش</label>
        <input id="number" type="text" name="_sp_number" value="<?php echo isset($number) ? esc_attr($number) : ''; ?>">

        <label for="term">نمایش مطلب بر اساس</label>
        <select name="_sp_term" id="term">
            <option value="category" <?php echo selected(esc_attr($term), 'category'); ?>>دسته‌بندی‌های مطلب
            </option>
            <option value="tag" <?php echo selected(esc_attr($term), 'tag'); ?>>برچسب‌های مطلب</option>
        </select>

        <label for="order_by">ترتیب نمایش مطالب</label>
        <select name="_sp_order_by" id="order_by">
            <option value="asc" <?php echo selected(esc_attr($order_by), 'asc'); ?>>صعودی</option>
            <option value="desc" <?php echo selected(esc_attr($order_by), 'desc'); ?>>نزولی</option>
            <option value="rand" <?php echo selected(esc_attr($order_by), 'rand'); ?> >تصادفی</option>
        </select>

        <label for="display_type">حالت نمایش</label>
        <div class="sp-display-type" id="display_type">
            <label for="display_type_block">
                <input id="display_type_block" type="radio" name="_sp_display_type"
                       value="block" <?php echo checked(esc_attr($display_type), 'block'); ?>>
                <img width="32px" height="32px" src="<?php echo SP_PLUGIN_ASSETS_URL . 'img/gallery.png'; ?> "
                     alt="icon" title="نمایش به صورت اسلایدر">
            </label>
            <label for="display_type_list">
                <input id="display_type_list" type="radio" name="_sp_display_type"
                       value="list" <?php echo checked(esc_attr($display_type), 'list'); ?>>
                <img width="32px" height="32px" src="<?php echo SP_PLUGIN_ASSETS_URL . 'img/list.png'; ?>" alt="icon"
                     title="نمایش به صورت لیست">
            </label>
        </div>
        <div class="sp-number-slider-container">
            <div class="sp-number-item-slider-wrapper ">
                <label for="number-item-slider">تعداد مطالب در اسلایدر</label>
                <input id="number-item-slider" type="text" name="_sp_number_item_slider"
                       value="<?php echo isset($number_item_slider) ? esc_attr($number_item_slider) : ''; ?>">
            </div>
        </div>
    </div>
    <?php
}