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
//        $this->forward('list/listall');
        $this->redirect($this->createUrl('list/listall'));
    }
}