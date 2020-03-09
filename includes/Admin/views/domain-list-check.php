<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e('Domain Checking' , 'domain-manager') ?></h1>
    <a class="page-title-action" href="<?php echo admin_url('admin.php?page=domain-manager') ?>"><?php _e('Go Back' , 'domain-manager') ?></a>
</div>

<?php

    $table = new Domain\Manager\Admin\Domain_List();
    $table->prepare_items();

    // echo $table->items[3]->domain_name;
    // $n=0;
    // $table_count = wp_table_count();
    // for ($x = 0; $x <= $table_count-1; $x++) { 
    //     foreach( $table->items[$x] as $key){
    //         echo $key;
    //     }
    //     $x++;
    // }

    $n=0;
    $p=1;
    $status1 = 'Taken';
    $status2 = 'Free';
    $table_count = wp_table_count();
    for ($x = 0; $x <= $table_count-1; $x++) { 
        
        $domain = $table->items[$n]->domain_name;          
        echo $domain;     
        echo "<br>";
        if ( gethostbyname($domain) != $domain ) {
            wp_insert_data2(
                [         
                 'status' => $status1,
                ],$p
             );   
             echo $p , '->' , $status1; 
             echo "<br>"; 
        }
        else {
            wp_insert_data2(
                [         
                 'status' => $status2,
                ],$p
             );  
             echo $p ,'->', $status2;   
             echo "<br>";
        };
        $n++;
        $p++;
    }

    
    function wp_insert_data2($args = [] , $id){
        global $wpdb;     
        $defaults = [         
            'status' => '',          
        ];
        $data = wp_parse_args($args, $defaults);
    
        $inserted = $wpdb->update(        
            "{$wpdb->prefix}domain_manager",
            $data,
            [ 'id' => $id ],
            [               
                '%s',
            ]
            );
        if(! $inserted ){
            return new \WP_Error('failed-to-insert', __('Failed ot Insert Data', 'domain-manager'));
        }
        return $wpdb->insert_id;
    }


?>
