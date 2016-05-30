<?php

if ( ! function_exists('dd'))
{
    /**
     * dd (dump and die)
     *
     * Outputs the variable and die()
     *
     * @param	mixed
     * @return	string
     */
    function dd($var)
    {
        if(is_array($var) || is_object($var))
        {
            echo '<pre>';
            print_r($var);
            echo '</pre>';
        }
        else
        {
            var_dump($var);
        }
        die();
    }
}