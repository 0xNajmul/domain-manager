<?php
/**
 * Plugin Name:      Domain Manager
 * Plugin URI:        https://najmul.xyz
 * Description:       A plugin for Mnaging Domains.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Najmul 
 * Author URI:        https://najmul.xyz
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       domain-manager
 * Domain Path:       /languages
 */

if(! defined('ABSPATH')){
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';
/**
 *  The Main Plugin Class
*/
final class Domain_Manager {

    const version = '1.0';   
    
    private function __construct(){
        $this->define_constants();

        register_activation_hook(__FILE__, [$this, 'activate']);
        add_action('plugins_loaded', [$this,'init_plugin']);
    }
    
    /* Initilize a Single Instance */
    public static function init(){
        static $instance = false;

        if(! $instance){
            $instance = new self();
        }
        
        return $instance;
    }
    public function define_constants(){
        define('DM_VERSION' , self::version);
        define('DM_FILE' , __FILE__);
        define('DM_PATH' , __DIR__);
        define('DM_URL' , plugins_url('',DM_FILE));
        define('DM_ASSETS' , DM_URL .'/assets');
    }
    public function init_plugin(){
        if(is_admin()){
            new Domain\Manager\Admin();            
        }
        else{
            new Domain\Manager\Frontend();
        }
        
    }

    public function activate(){
        $installer = new Domain\Manager\Installer();
        $installer->run();
    }


}

function domain_manager(){
    return Domain_Manager::init();
}
domain_manager();