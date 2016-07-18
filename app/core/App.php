<?php

/**
 * Created by PhpStorm.
 * User: Geert
 * Date: 20/06/16
 * Time: 14:48
 */
class App
{
    protected $controller = 'home';

    protected $method = 'index';

    protected $params = [];

    public function __construct()
    {


       //-----controller kiezen------

        // 1 : splits url op
        $url = $this->parseUrl();

        //2 : check of controller waarde heeft en bestaat anders 'homecontroller'
        if (isset($url)&&  file_exists('../app/controllers/'. $url[0] . '.controller.php')){

            $this->controller = $url[0];
            unset($url[0]);

        }else{

            $this->controller = 'home';
        }

        require_once '../app/controllers/' . $this->controller . '.controller.php';
        $this->controller = new $this->controller;



        //----Method kiezen------


        if(isset($url[1]))
        {
            if(method_exists($this->controller,$url[1]))
            {

                $this->method = $url[1];
                unset($url[1]);

            } else {
                $this->method ='index';
            }
            $this->params = array_values($url);

            call_user_func_array([$this->controller,$this->method], $this->params);

        }else{

            call_user_func_array([$this->controller,'index'], []);
        }
    }

    public function parseUrl()
    {
        if(isset($_GET['url']))
        {
            //echo $_GET['url'];
            return $url = explode('/',filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));


        }
    }
}