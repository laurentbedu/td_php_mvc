<?php

class ProductController extends BaseController{

    function index(){

        $repository = new MainRepository("product");
        $products = $repository->getAll();

        $this->entities = ['products' => $products];

        $this->render();
    }

}