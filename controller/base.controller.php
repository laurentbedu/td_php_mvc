<?php

class BaseController
{
    public function __construct($params)
    {
        $this->action = $params[0] ?? 'index';
        $this->id = $params[1] ?? null;

        if (!method_exists(get_called_class(), $this->action)) {
            header("Location: /error404");
            die;
        }

        $this->entities = [];
   
        /*structure du chemin des templates par defaut
            template/nameOfTheController/nameOfTheAction.view.php
        */
        $templatesFolder = lcfirst(str_replace("Controller", "", get_called_class()));
        $this->template = "template/$templatesFolder/$this->action.view.php";

        $this->{$this->action}();
    }

    public function render(){

        foreach($this->entities as $k => $v){
            ${$k} = $v;
        }
        
        ob_start();
        include_once $this->template;
        $this->content = ob_get_clean();
    }
}

?>