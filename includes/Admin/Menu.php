<?php

namespace Domain\Manager\Admin;

/* The Menu Handler Class */

class Menu{

    function __construct(){
        add_action('admin_menu',[$this , 'admin_menu']);
    }
    public function admin_menu(){
        $parent_slug = 'domain-manager';
        $capabilities = 'manage_options';
        add_menu_page(__('Domain Manager', 'domain-manager'),__('Domain Manager', 'domain-manager'),'manage_options', $parent_slug,[$this , 'domain_lists'],'dashicons-admin-site','4',);
        add_submenu_page($parent_slug, __('Domain Lists', 'domain-manager'), __('Domain Lists', 'domain-manager'), $capabilities, $parent_slug, [$this , 'domain_lists']);
        add_submenu_page($parent_slug,__('Settings', 'domain-manager'),__('Settings', 'domain-manager'),$capabilities,'domain-lists',[$this , 'domain_manager_settings']);
    }
    public function domain_lists(){
        $domainlists = new Domainlists();
        $domainlists->domainlists();
    }
    public function domain_manager_settings(){
        echo "This is Menu";
    }
}