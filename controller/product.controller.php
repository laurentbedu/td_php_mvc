<?php

class ProductController extends BaseController{

    function index(){

        $repository = new MainRepository("product");
        $repository->with("Category");
        $products = $repository->getAll();

        $this->entities = ['products' => $products];

        $this->render();
    }

    function read(){
        
        $repository = new MainRepository("product");
        $repository->with("Category");
        $product = $repository->getOne($this->id);

        if($product == null){
            header("Location: /error404");
            die;
        }

        // $repository = new MainRepository("category");
        // $category = $repository->getOne($product->category_id);

        $this->entities = ['product' => $product];//, 'category' => $category];

        $this->render();
    }

}