<?php

namespace Domain\Manager\Admin; 

class Domainlists{

    public $errors = [];

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

            case 'check': 
                $template = __DIR__ . '/views/domain-list-check.php';
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
        //Protection from CSRF
        if(! wp_verify_nonce($_POST['_wpnonce'], 'new-domain')){
            wp_die('Are you Cheating ?');
        }
        //  Check Only admin is Submitting the Form
        if(! current_user_can('manage_options')){
            wp_die('Are you Cheating ?');
        }
        //Check Empty Value 
        $domain_name = isset($_POST['domain_name']) ? sanitize_text_field($_POST['domain_name']) : '';
        $priority = isset($_POST['priority']) ? sanitize_text_field($_POST['priority']) : '';
        $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
        $description = isset($_POST['description']) ? sanitize_text_field($_POST['description']) : '';
        $status = isset($_POST['status']) ? sanitize_text_field($_POST['status']) : '';

        if(empty($domain_name)){
            $this->errors['domain_name'] = __('Please Provide a Domain Name' , 'domain-manager');
        }
        if(empty($priority)){
            $this->errors['priority'] = __('Please Provide a Domain Name', 'domain-manager');
        } 
        if(!empty($this->errors)){
            return;
        }

        $insert_id = wp_insert_data(
           [
            'domain_name' => $domain_name, 
            'priority' => $priority,
            'category' => $category,
            'description' => $description,
            'status' => $status,
           ]
        );
       
        if(is_wp_error($insert_id)){
            wp_die($insert_id->get_error_message());
        }
        
        $redirected_to = admin_url('admin.php?page=domain-manager&inserted=true');
        wp_redirect($redirected_to);
        exit;

    }
}