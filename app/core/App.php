<?php

namespace App;

use App\Controllers\HomeController;
use App\Core\Controller;

class App
{
    protected Controller $controller;
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();
        // Default controller
        $controllerName = '\\App\\Controllers\\' . ucfirst($url[0] ?? 'home') . 'Controller';

        // Include controller file if it exists
        $controllerFile = '../app/controllers/' . ucfirst($url[0] ?? 'home') . 'Controller.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $this->controller = new $controllerName;
            unset($url[0]);
        } else {
            // Fallback to the default controller if the file doesn't exist
            require_once '../app/controllers/HomeController.php';
            $this->controller = new HomeController;
        }

        // Check if the method exists in the controller
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Set the parameters
        $this->params = $url ? array_values($url) : [];

        $this->controller->onCall();
        // Call the controller method with parameters
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl()
    {
        // Parse the URL from the 'url' query parameter
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
