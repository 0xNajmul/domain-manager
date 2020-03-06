<?php

namespace Domain\Manager;

class Admin{
    function __construct(){
        $this->dispatch_actions();
        new Admin\Menu();
    }

    public function dispatch_actions(){
        $domainlists = new Admin\Domainlists;
        add_action('admin_init' , [$domainlists,'form_handler']);
    }
}