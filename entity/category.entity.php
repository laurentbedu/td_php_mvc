<?php

class Category{

    static $relations = 
        ["Products" => ['type'=>'hasMany', 
                        'table'=>'product', 
                        'attribute'=>'products', 
                        'foreignKey'=>'category_id']
        ];
}
