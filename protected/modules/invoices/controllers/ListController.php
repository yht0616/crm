<?php

class ListController extends ControllerInvoices
{
    public function actionListAll()
    {
//        $mdf_dir=dirname(__FILE__);
        $this->render('list_invoices');
    }
    public function actionIndex()
    {
         
        $ops = Ops::model()->with('user')->findAll();
        $this->d($ops);
       
    }
}