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
        'status' => '',
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
            '%s',
        ]
        );
    if(! $inserted ){
        return new \WP_Error('failed-to-insert', __('Failed ot Insert Data', 'domain-manager'));
    }
    return $wpdb->insert_id;
}



function wp_get_data($args = []){
    global $wpdb;

    $defaults = [
        'number'  => 20,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'ASC'
    ];

    $args = wp_parse_args( $args, $defaults );

    $sql = $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}domain_manager
            ORDER BY {$args['orderby']} {$args['order']}
            LIMIT %d, %d",
            $args['offset'], $args['number']
    );

    $items = $wpdb->get_results( $sql );

    return $items;
}

function wp_table_count(){
    global $wpdb;
    return (int) $wpdb->get_var("SELECT count(id) FROM {$wpdb->prefix}domain_manager");
}