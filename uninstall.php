<?php
// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}

// Drop a custom db table
global $wpdb;
$table_programacion   = $wpdb->prefix . 'Wgt_programacion';
$wpdb->query( "DROP TABLE IF EXISTS {$table_programacion}" );

$wpdb->delete($wpdb->posts, array('post_title' => 'widget programacion','post_type'=>'page'));
