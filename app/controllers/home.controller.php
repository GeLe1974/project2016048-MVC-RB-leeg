<?php

/**
 * Created by PhpStorm.
 * User: Geert
 * Date: 20/06/16
 * Time: 14:54
 */





class Home extends Controller
{


    protected $user;
    public function __construct()
    {
        $this->user = $this->model('User');
    }

    /**
     * @param string $name
     */
    public function index($name = '')
        {
            /*echo "name = $name";*/
            $user = $this->user;
            $user->name = $name;

            //echo "username : $user->name" ;
            //$this->view('home/index', ['name' => $user->name]);
            $this->twig('home/home.twig',[
                'title' => $name,
               
            ]);

        }

        public function test(){
        echo'home/tets/test/tset';
        }

    public function create($username='',$email='')
    {
        $this->user->create([
            'name' => $username,
            'email' => $email
        ]);
    }


}