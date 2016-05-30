<?php
namespace Core;
use App;

class Own
{
    public function serve()
    {
        //echo 'hello';
        $path = $_GET['path'];
        $path = filter_var(trim($path, '/'), FILTER_SANITIZE_URL);
        $path_arr = explode('/',$path);

        if(strlen($path)== 0 || empty($path_arr)){
            $path_arr[0] = 'Homepage';
        }

        $class = 'App\\Controllers\\';
        $directories = $path_arr;
        foreach($directories as $key => $segment)
        {
            if(is_dir(ucfirst('App/Controllers/'.$segment)))
            {
                $class .= ucfirst(str_replace('-','_',$segment)).'\\';
                unset($path_arr[$key]);
            }
            else
            {
                break;
            }
        }
        $class .= ucfirst(str_replace('-', '_', array_shift($path_arr))); // once we get the "page" we remove it from the $path_arr

        if (class_exists($class)) {
            $page = new $class;
            if (sizeof($path_arr) >= 1 && method_exists($page, str_replace('-', '_', $path_arr[0]))) {
                $method = str_replace('-', '_', array_shift($path_arr));
                $page->{$method}($path_arr);
            } else {
                $page->index();
            }
            exit;
        } else {
            $page = new App\Controllers\Homepage;
            $page->index();
            exit;
        }
    }
}