<?php

class Product{
    
    static $relations = 
        ["Category" => ['type'=>'hasOne', 
                        'table'=>'category', 
                        'attribute'=>'category', 
                        'foreignKey'=>'category_id']
        ];
}
