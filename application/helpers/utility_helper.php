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