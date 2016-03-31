<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 31/03/2016
 * Time: 09:54 AM
 */

function assets_url(){
    return base_url() . 'assets/';
}

function css_url(){
    return assets_url() . 'css/';
}

function js_url(){
    return assets_url() . 'js/';
}

function img_url(){
    return assets_url() . 'img/';
}

function bootstrap_url(){
    return assets_url() . 'bootstrap/';
}

function bootstrap_css_url(){
    return bootstrap_url() . 'css/';
}

function bootstrap_fonts_url(){
    return bootstrap_url() . 'fonts/';
}

function bootstrap_js_url(){
    return bootstrap_url() . 'js/';
}