<?php
add_action('admin_init',function(){
    add_meta_box('_mycustommetabox','My Custom MetaBox','form_data_custom_metabox',['post','page']);      //Function for add metabox
});
function form_data_custom_metabox($post){
$_mymetabox =get_post_meta($post->ID,'_mymetabox',true) ? get_post_meta($post->ID,'_mymetabox',true):'';
$_myselectbox =get_post_meta($post->ID,'_myselectbox',true) ? get_post_meta($post->ID,'_myselectbox',true):'';
  ?>
    <input type="text" id=""  class="" value="<?php echo $_mymetabox?>">
    <!--Dropdown in Meta Box -->
    <br>
    <select name="_selectbox" id="">
        <option value="1" <?php $_myselectbox ==1?'selected':''?>>One</option>
        <option value="2"<?php $_myselectbox ==2?'selected':''?>>Two</option>
        <option value="3"<?php $_myselectbox ==3?'selected':''?>>Three</option>
</select>
    <?php

}
add_action('save_post',"form_data_save_post");
function form_data_save_post(){
    if(array_key_exists('_mymetabox',$_POST)&& array_key_exists('_selectbox',$_POST)){
        update_post_meta('$post_id','_mymetabox',$_POST['_mymetabox']);
    }
}

/*post Background Color Change using Custom Meta*/
add_action('the_post','form_data_custom_the_post');
 function form_data_custom_the_post($post){
     $_mymetabox =get_post_meta($post->ID,'_mymetabox',true) ? get_post_meta($post->ID,'_mymetabox',true):'';?>

<style>
    article#post-<?php echo $post->ID; ?>{
        background-color: <?php echo $_mymetabox; 
        ?>;
        color:#fff;
    }
    </style>
    <?php
 }
 ?>