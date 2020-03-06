<?php

namespace Domain\Manager\Admin; 

class Domainlists{

    function domainlists(){
        $action = isset ($_GET['action']) ? $_GET['action']: 'list';
        switch($action){
            case 'new': 
                $template = __DIR__ . '/views/domain-list-new.php';
            break;

            case 'edit': 
                $template = __DIR__ . '/views/domain-list-edit.php';
            break;

            case 'view': 
                $template = __DIR__ . '/views/domain-list-view.php';
            break;

            default:
                 $template = __DIR__ . '/views/domain-list.php';
            break;
        }
        if(file_exists($template)){
            include $template;
        }
    }
    public function form_handler(){
        if(! isset($_POST['submit_domain'])){
            return;
        }
        if(! wp_verify_nonce($_POST['_wpnonce'], 'new-domain')){
            wp_die('Are you Cheating ?');
        }
        if(! current_user_can('manage_options')){
            wp_die('Are you Cheating ?');
        }
        var_dump($_POST);
        exit;
    }
}