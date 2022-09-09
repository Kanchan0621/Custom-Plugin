<?php 
/* Plugin Name: Form-Data
Plugin URI:http://localhost/course/
Description: a simple wordpress Plugin
Author: Kanchan
Author URI:http://localhost/course/
Version:1.0*/

// register_activation_hook(__FILE__,'form_data_activate');
// register_deactivation_hook(__FILE__,'form_data_dactivate');
// register_uninstall_hook(__FILE__,'form_data_uninstall');
// function form_data_activate(){
//     global $wpdb;
//     global $table_prefix;
//     $table=$table_prefix.'form_data'; 
//     $sql="
//     CREATE TABLE  `$table` (
//         `id` int(100) NOT NULL,
//         `name` varchar(100) NOT NULL
//       ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
      
//       ALTER TABLE  `$table`
//   ADD PRIMARY KEY (`id`);
//   ALTER TABLE  `$table`
//   MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;";
//      $wpdb->query( $sql);

// add_option('updateTitle','Your Title is hacked');
//     }

//     function form_data_dactivate(){
//       global $wpdb;
//       global $table_prefix;
//       $table=$table_prefix.'form_data'; 
//       $sql="DROP TABLE `course`.`$table";
//      $wpdb->query( $sql);
//   }
//   add_action('admin_menu','form_data_menu');
//   function form_data_menu(){
//     add_menu_page('Form Data','Form Data',8,__FILE__,'form_data_list');
//   }
//   function form_data_list(){
//     include ('form_data_list.php');
// delete_option('updateTitle');
//    }
//   function form_data_uninstall(){}

defined('ABSPATH') || die("You Can't Access the Directory");
define('PLUGIN_PATH',plugin_dir_path(__FILE__));
/* Including Files*/
include plugin_dir_path(__FILE__)."assets/shortcodes.php";
include plugin_dir_path(__FILE__)."assets/metaboxes.php";
include plugin_dir_path(__FILE__)."assets/custom_post_types.php";





/* Modification of Title*/
add_filter('the_title','form_data_the_title');
function form_data_the_title($title){
   // return "Your Title are Hacked";
    return "<strong>{$title}</strong>";
}



/* Inject and Enqueue css and js file into our html head and footer */
add_action('wp_enqueue_scripts','form_data_wp_enqueue_scripts');
function form_data_wp_enqueue_scripts(){
   wp_enqueue_style('form_data_plugin',plugin_dir_url(__FILE__)."/css/style.css");
   // wp_enqueue_scripts('form_data_script',plugin_dir_url(__FILE__)."assests/js/custom.js",array(),'1.0.0',true);
}


/* Navigation Menu */
add_action('admin_menu','form_data_plugin_menu');
add_action('admin_menu','form_data_process_form_setting');


function form_data_plugin_menu(){
   // add_menu_page($page_title,$menu_title,$capability,$menu_slug,$function='',$icon_url='',$position=null);
   add_menu_page('Form Data Options','Form Data Options','manage_options','form_data-options','form_data_options_func',$icon_url='',$position=null);
      //Theme Option in Dashboard Page
   // add_dashboard_page('Theme Options','Theme Options','manage_options','form_data-theme-settings','form_data_theme_settings_func');
   
   //Theme Option in Post Page
   // add_posts_page('Theme Options','Theme Options','manage_options','form_data-theme-settings','form_data_theme_settings_func');
   // add_submenu_page($parent_slug,$page_title,$menu_title,$capability,$menu_slug,$function='');
   add_submenu_page('form_data-options','Form Data Settings','Form Data Settings','manage_options','form_data-settings','form_data_settings_func');
   add_submenu_page('form_data-options','Form Data Layout','Form Data Layout','manage_options','form_data-layout','form_data_layout_func');
}

register_activation_hook(__FILE__,function(){
add_option('form_option_1','');
});
 register_deactivation_hook(__FILE__,function(){
  delete_option('form_option_1');
});

/* Form data options*/
function form_data_process_form_setting(){
register_setting('form_data_option_group','form_data_option_name');
 if(isset($_POST['action']) && current_user_can('manage_options')){
   update_option('form_option_1',sanitize_text_field($_POST['form_option_1']));
 }
}
function form_data_options_func(){ ?>
<div class="wrap"><h1>Form Data Options Menu</h1>
<?php settings_errors();?>
   <form action="options.php" method="post">
      <?php settings_fields('form_data_option_group');?>
    <label for="">Setting one: <input type="text" name="form_option_1" value="<?php echo esc_html(get_option('form_option_1'));?>"></label>
      
    <?php submit_button('Save Changes');?>
</form>
</div>
<?php 
   // echo"<h1>Form Data Options Menu</h1>";
   // return true;
}






function form_data_settings_func(){
   echo"<h1>Form Data Settings Menu</h1>";
   // return true;
}
function form_data_layout_func(){
   echo"<h1>Form Data Layout Menu</h1>";
}
// function form_data_theme_settings_func(){
//    echo"<h1>Theme Option</h1>";
// }
?>
