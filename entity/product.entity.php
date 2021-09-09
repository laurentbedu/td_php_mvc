<?php

class Product extends Model{

    static $relations = 
        ["Category" => ['type'=>'hasOne', 
                        'table'=>'category', 
                        'attribute'=>'category', 
                        'foreignKey'=>'category_id']
        ];
}
