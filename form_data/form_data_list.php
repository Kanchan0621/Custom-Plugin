<?php
global $wpdb;
global $table_prefix;
$table=$table_prefix.'form_data'; 
$sql="SELECT * FROM $table";
$result=$wpdb->get_results($sql);
print_r($result);
?>
