<?php
namespace App\Controllers;

class Contact
{
    function __construct()
    {
        //echo 'hello from contact';
    }

    public function index()
    {
        echo 'this is the contact page';
    }

    public function by_email($params = array())
    {
        echo 'this is the contact page with "by email" subpage<br />';
        print_r($params);
    }
}