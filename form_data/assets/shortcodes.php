<?php add_action('init','form_data');
 function form_data(){
    add_shortcode('test','form_data_my_shortcode');
 }
 function form_data_my_shortcode($atts){
   //  return "Hello Wordpress";
   $atts=shortcode_atts(array('message'=>'Hello',),$atts,'test');
    return $atts['message'];
 }?>