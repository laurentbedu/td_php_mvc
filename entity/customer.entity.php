<?php

class Customer extends Model{

    static $relations = 
    ["User" => ['type'=>'isOne', 
                    'table'=>'app_user', 
                    'attribute'=>'user', 
                    'foreignKey'=>'customer_id']
    ];
    
}