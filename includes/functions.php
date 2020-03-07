<?php 

function wp_insert_data($args = []){
    global $wpdb;
    if(empty($args['domain_name'])){
        return new \WP_Error('no-name', __('You must provide a Domain Name', 'domain-manager'));
    }
    $defaults = [
        'domain_name' => '',
        'priority' => '',
        'category' => '',        
        'created_by' => get_current_user_id(),
        'description' => '',
        'created_at' => current_time('mysql'),
    ];
    $data = wp_parse_args($args, $defaults);

    $inserted = $wpdb->insert(        
        "{$wpdb->prefix}domain_manager",
        $data,
        [
            '%s',
            '%s',
            '%s',
            '%d',
            '%s',
            '%s',
        ]
        );
    if(! $inserted ){
        return new \WP_Error('failed-to-insert', __('Failed ot Insert Data', 'domain-manager'));
    }
    return $wpdb->insert_id;
}