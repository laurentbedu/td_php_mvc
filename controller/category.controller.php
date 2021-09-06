<?php

class CategoryController extends BaseController{

    function read(){

        $repository = new MainRepository("category");
        $category = $repository->getOne($this->id);
        if($category == null){
            header("Location: /error404");
            die;
        }

        $repository = new MainRepository("product");
        $products = $repository->getAll("category_id = $this->id");

        $this->entities = ['category' => $category, 'products' => $products];

        $this->render();
    }

}