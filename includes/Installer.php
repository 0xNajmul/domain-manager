<?php

namespace Domain\Manager;

class Installer{

    public function run(){
        $this-> add_version();
        $this-> create_tables();

    }
    public function add_version(){
        $installed = get_option('dm_install');
        if(! $installed){
            update_option('dm_install' , time());
        }        
        update_option('dm_version' ,DM_VERSION );
    }
    public function create_tables(){
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        
        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}domain_manager` (
        `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
        `domain_name` varchar(255) NOT NULL,
        `priority` varchar(255) NOT NULL,
        `category` varchar(255) NULL,
        `created_by` varchar(255) NOT NULL,               
        `description` varchar(500) NULL,
        `status` varchar(255) NULL,
        `created_at` datetime NOT NULL,        
        PRIMARY KEY (`id`)
        ) $charset_collate";      

    
        if(! function_exists('dbDelta')){
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }
        dbDelta($schema);
    }
}