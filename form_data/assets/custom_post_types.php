<?php
add_action('init','form_data_news_post');
function form_data_news_post(){
    register_post_type('news',array(
        'label'=>"Global News",
        'labels'=>array(
            'name'           => _x( 'News', 'News type general name' ),
            'name_admin_bar' => _x( 'News', 'add new from admin bar' ),
            'add_new'        => _x( 'Add New News', 'add new news' ),
            'edit_item'      => __( 'Edit News' ),
            'view_item'      => __( 'View Attachment Page' ),
            'attributes'     => __( 'Attachment Attributes' ),
            'search-items'   =>__('Search News'),
            'all_items'      =>__('All News'),
            'archives '      =>__('News Archives'),
            'insert_into_item' =>('Insert Into News'),
            'featured_image'  =>_x('News Featured Image','news'),
            'set_featured_image'  =>_x('Set News Featured Image','news'),
            'remove_featured_image'  =>_x('Remove News Featured Image','news'),
            'use_featured_image'  =>_x('Use as News Featured Image','news'),
        // 'add_new'=>'Add News Global News',)
           
        ),
        'public'=>true,
        'description'=>' Test Custom post type news',
        'supports'=>['title','editor','comments','custom-fields','thumbnail']
    ));
    register_taxonomy('news-categories',['news'],array(
      'labels'=>array( 'name'      => _x( 'News Categories','taxonomy general name' ),
      'singular_name'              => _x( 'News Category','taxonomy singular name' ),
      'search_items'               => __( 'Search News Categories' ),
      'popular_items'              => null,
      'all_items'                  => __( 'All News Categories' ),
      'edit_item'                  => __( 'Edit News Category' ),
      'update_item'                => __( 'Update News Category' ),
      'parent_item'                =>__('Parent News Category'),
      'parent_item_colon'          =>__('Parent News Category'),
      'add_new_item'               => __( 'Add New News Category' ),
      'new_item_name'              => __( 'New News Category Name' ),
      'separate_items_with_commas' => null,
      'add_or_remove_items'        => null,
      'choose_from_most_used'      => null,
      'back_to_items'              => __( '&larr; Back to News Categories' ),),
           
      'hierarchical' =>true,
      'public'=>true,
    ));
}
add_filter("template_include",'form_data_news_template');
function form_data_news_template($template){
    global $post;
    if(is_single() AND $post->post_type=='news'){
        // print_r($template);
        // exit;
        $template=PLUGIN_PATH.'/form_data_news.php';
    }
    return $template;
}