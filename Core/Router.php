<?php
namespace Core;
use App;
class Router
{
    public $path_arr;
    public $routes = array();
    public $controller = 'App\\Controllers';
    public $default_controller;
    public $method = '';
    
    function __construct()
    {
        //include CONFIG_PATH.'/Routes.php';
        $routes = array();
        include (CONFIG_PATH.'/Routes.php');
        $this->routes = $routes;
        $this->default_controller = ucfirst($this->routes['default_controller']);
        $this->method = $this->routes['default_method'];
        $this->path_arr = $this->_parse_path();
    }

    public function serve()
    {
        $directories = $this->path_arr;
        foreach($directories as $key => $segment)
        {
            if(is_dir(APP_PATH.ucfirst('/Controllers/'.$segment)))
            {
                $this->controller .= '\\'.ucfirst(str_replace('-','_',$segment));
                unset($this->path_arr[$key]);
            }
            else
            {
                break;
            }
        }
        $potential_controller = ucfirst(str_replace('-', '_', array_shift($this->path_arr)));


        if (class_exists($this->controller.'\\'.$potential_controller)) {
            $this->controller .= '\\'.$potential_controller; // once we get the "page" we remove it from the $path_arr
            $page = new $this->controller;
            if (sizeof($this->path_arr) >= 1 && method_exists($page, str_replace('-', '_', $this->path_arr[0]))) {
                $this->method = str_replace('-', '_', array_shift($this->path_arr));
            }
            $page->{$this->method}($this->path_arr);
            exit;

        } else {
            $this->controller .= '\\'.ucfirst($this->routes['404']);
            http_response_code(404);
            $page = new $this->controller;
            $page->{$this->method}($this->path_arr);
            exit;
        }
    }

    private function _parse_path()
    {
        $path = filter_var(trim($_GET['path'],'/'), FILTER_SANITIZE_URL);
        $path = str_replace(array('//', '../'), '/', $path);

        $path_arr = explode('/',$path);

        if(strlen($path)== 0 || empty($path_arr)){
            $path_arr[0] = $this->default_controller;
        }

        return $path_arr;
    }
        
}