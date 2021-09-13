<?php

class UserController extends BaseController
{
    public function test1()
    {
        $repository = new MainRepository("app_user");
        $repository->with("Customer");
        $user = $repository->getOne(1);

        $this->entities = ['user' => $user];

        $this->render();
    }

    public function test2()
    {
        $repository = new MainRepository("customer");
        $repository->with("User");
        $customer = $repository->getOne(1);

        $this->entities = ['customer' => $customer];

        $this->render();
    }

    public function test3()
    {
        $repository = new MainRepository("app_user");
        $repository->with("Customer");
        $users = $repository->getAll();

        $this->entities = ['users' => $users];

        $this->render();
    }
    
    public function test4()
    {
        $repository = new MainRepository("customer");
        $repository->with("User");
        $customers = $repository->getAll();

        $this->entities = ['customers' => $customers];

        $this->render();
    }

    public function login(){
        
    }
}