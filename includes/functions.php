<?php 

function wp_insert_data($args = []){
    global $wpdb;
    $defaults = [
        'domain_name' => '',
        'priority' => '',
        'category' => '',        
        'created_by' => get_current_user_id(),
        'description' => '',
        'created_at' => currnet_time('mysql'),
    ];
    $data = wp_parse_args($args, $defaults);

    $inserted = $wpdb->insert("
        {$wpdb->prefix}domain_manager",
        $data,
        [
            '%s',
            '%s',
            '%s',
            '%d',
            '%s',
            '%s',
        ]
    )
    if(! $inserted ){
        return new \WP_Error('failed-to-insert');
    }
}