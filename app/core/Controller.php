<?php

/**
 * Created by PhpStorm.
 * User: Geert
 * Date: 20/06/16
 * Time: 14:50
 */

require __DIR__.'/../../vendor/autoload.php';
use rock\sanitize\Sanitize;
use rock\validate\Validate;


class Controller
{
    protected $model='home';

    protected $loader ='';
    protected $twig ='';

    protected function loadTwig()
    {
        $this->loader = new Twig_Loader_Filesystem(__DIR__.'/../views');
        $this->twig = new Twig_Environment($this->loader,[
        //'cache' => __DIR__.'/cache/views',
            'cache' => false,
    ]);
        return $this->twig;
    }


    /**
     * @param $model :
     *
     * @return mixed
     */
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        $namespace = 'model\\Model_'.$model;
        return new $namespace();

    }

    public function view($view, $data)
    {
        require_once '../app/views/'. $view . '.php';

    }

    public function twig($template,$data)
    {
        $this->loadTwig();
        echo $this->twig->render($template,$data);

    }
    public function loadFromArray($array) {
        $class = new ReflectionClass(get_class($this));
        $props = $class->getProperties();
        foreach($props as $p) {
            if (isset($array[$p->getName()]))
            $p->setValue($this, $array[$p->getName]);
        }
    }


}