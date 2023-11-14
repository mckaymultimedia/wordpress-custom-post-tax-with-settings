<?php
/*
Plugin Name: Custom Plugin
Description: This plugin creates a custom post type and taxonomy with settings.
Version: 1.0
*/

// Register custom post type and taxonomy
function custom_plugin_register_post_type_taxonomy() {
    // Register custom post type
    register_post_type('custom_post', array(
        'labels' => array(
            'name' => 'Custom Posts',
            'singular_name' => 'Custom Post',
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'custom-post'),
    ));

    // Register custom taxonomy
    register_taxonomy('custom_taxonomy', 'custom_post', array(
        'label' => 'Custom Taxonomy',
        'hierarchical' => true,
    ));
}
add_action('init', 'custom_plugin_register_post_type_taxonomy');

// Add settings page with 5 fields
function custom_plugin_settings_menu() {
    add_submenu_page(
        'options-general.php', // Parent menu
        'Custom Plugin Settings', // Page title
        'Custom Plugin Settings', // Menu title
        'manage_options', // Capability
        'custom-plugin-settings', // Menu slug
        'custom_plugin_settings_page' // Callback function
    );
}
add_action('admin_menu', 'custom_plugin_settings_menu');

function custom_plugin_settings_page() {
    if (isset($_POST['custom_field1'])) {
        // Save settings if form is submitted
        update_option('custom_field1', sanitize_text_field($_POST['custom_field1']));
        update_option('custom_field2', sanitize_text_field($_POST['custom_field2']));
        update_option('custom_field3', sanitize_text_field($_POST['custom_field3']));
        update_option('custom_field4', sanitize_text_field($_POST['custom_field4']));
        update_option('custom_field5', sanitize_text_field($_POST['custom_field5']));
    }
    ?>
    <div class="wrap">
        <h2>Custom Plugin Settings</h2>
        <form method="post">
            <label for="custom_field1">Field 1:</label>
            <input type="text" name="custom_field1" value="<?php echo esc_attr(get_option('custom_field1')); ?>"><br>

            <label for="custom_field2">Field 2:</label>
            <input type="text" name="custom_field2" value="<?php echo esc_attr(get_option('custom_field2')); ?>"><br>

            <label for="custom_field3">Field 3:</label>
            <input type="text" name="custom_field3" value="<?php echo esc_attr(get_option('custom_field3')); ?>"><br>

            <label for="custom_field4">Field 4:</label>
            <input type="text" name="custom_field4" value="<?php echo esc_attr(get_option('custom_field4')); ?>"><br>

            <label for="custom_field5">Field 5:</label>
            <input type="text" name="custom_field5" value="<?php echo esc_attr(get_option('custom_field5')); ?>"><br>

            <input type="submit" value="Save Settings" class="button-primary">
        </form>
    </div>
    <?php
}

?>