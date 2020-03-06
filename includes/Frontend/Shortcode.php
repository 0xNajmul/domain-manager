<?php

namespace Domain\Manager\Frontend;

/**
 * Shortcode Handler class
 */
class Shortcode{
    function __construct(){
        add_shortcode('domain-manager',[$this,'render_shortcode']);
    }
    /**
     * Shortcode Handler function
     *
     * @param array $atts
     * @param string $content
     * @return string
     */
    function render_shortcode($atts , $content = ''){
        return 'Hello From Shortcode !';
    }
}