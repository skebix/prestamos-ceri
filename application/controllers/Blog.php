<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 03/03/2016
 * Time: 11:14 AM
 */

class Blog extends CI_Controller {

    public function __construct(){
        parent::__construct();
        // Your own constructor code
    }

    public function index(){
        $data['todo_list'] = array('Clean House', 'Call Mom', 'Run Errands');

        $data['title'] = "My Real Title";
        $data['heading'] = "My Real Heading";

        $this->load->view('blog/blogview', $data);
    }

    public function comments(){
        echo 'Look at this!';
    }

    public function params($sandals, $id){
        echo $sandals;
        echo $id;
    }
}