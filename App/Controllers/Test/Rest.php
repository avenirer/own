<?php
namespace App\Controllers\Test;

class Rest
{
    function __construct()
    {
        //echo 'hello from contact';
    }

    public function index()
    {
        echo 'this is the rest page';
    }

    public function chest($params = array())
    {
        echo 'this is the rest page with "chest" subpage in Test directory<br />';
        print_r($params);
    }
}