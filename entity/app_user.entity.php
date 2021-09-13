<?php

class App_user extends Model{

    static $relations = 
    ["Customer" => ['type'=>'hasOne', 
                    'table'=>'customer', 
                    'attribute'=>'customer', 
                    'foreignKey'=>'customer_id']
    ];

}