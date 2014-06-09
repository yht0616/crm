<?php

class ControllerInvoices extends CController
{
    public $layout= '/layouts/main_layout';

    public function __construct($id,$module=null){

        parent::__construct($id,$module);
    }

    protected function beforeAction($action) {

        return parent::beforeAction($action);
    }
}