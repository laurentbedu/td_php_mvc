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

        $this->entities = ['product' => $product];

        $this->render();
    }

    function create(){
        $errors = [];
        $posted = [];
        
        if(isset($_SESSION['post'])){
            
            $posted = $_SESSION['post'];
            unset($_SESSION['post']);
            $files = $_SESSION['files'];
            unset($_SESSION['files']);

            if(isset($posted['cancel'])){
                //TODO Delete temp image file if exists
                header("Location: /product");
                die;
            }

            if(isset($files['image_path']) && $files['image_path']['error'] == 0){
                $file = $files['image_path'];
                $posted['image_path'] = str_replace("/temp","",$file['tmp_name']);
                $bp = 0;
            }
            if(isset($posted['image_path'])){
                $temp_image_path = explode('/',$posted['image_path']);
                $indexToInsert = count($temp_image_path) - 1;
                array_splice( $temp_image_path, $indexToInsert, 0, "temp" );
                $temp_image_path = implode('/',$temp_image_path);
            }
            
            $repo = new MainRepository("product");
            $errors = $repo->validate($posted);
            if(count($errors) == 0){
                $result = $repo->insertOne($posted);
                if($result != false){
                    if (isset($posted['image_path'])) {
                        $test = rename($temp_image_path, $posted['image_path']);
                    }
                    header("Location: /product/read/$result->id");
                    die;
                }
            }
            
        }

        $repository = new MainRepository("category");
        $categories = $repository->getAll();

        $this->entities = [ 'categories' => $categories, 
                            'errors' => $errors, 
                            'posted' => $posted ];

        $this->render();
    }

}