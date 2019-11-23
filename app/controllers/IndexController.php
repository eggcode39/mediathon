<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 23/11/2019
 * Time: 3:24
 */
class IndexController{
    private $crypt;
    private $nav;
    private $log;
    private $clean;
    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->log = new Log();
        $this->clean = new Clean();
    }

    public function index(){
        echo 'Pronto habrá algo aquí, pero ahorita no joven :/';
    }
}