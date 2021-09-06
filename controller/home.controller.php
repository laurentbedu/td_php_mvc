<?php

class HomeController extends BaseController{

    function index(){

        $repository = new MainRepository("category");
        $categories = $repository->getAll();

        $this->entities = ['categories' => $categories];

        $this->render();
    }

}