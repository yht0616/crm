<?php

class ListController extends ControllerInvoices
{
    public function actionListAll()
    {
        $this->render('list_invoices');
    }

    

    public function actionIndex()  {
         
        $invoices = Invoices::model()->with('users','ops')->findAll();
       
        $this->render('index',array('invoices' => $invoices));
    }// index;
    
    
    /**
     * Ajax request for products
     */
    public function actionOps($id){

        /* @var $invoice Invoices */
        /* @var $objOps Ops */

        $request = Yii::app()->request;
        $pdf = null;

        //if this is ajax
        if($request->isAjaxRequest){

            //get all operations with users and clients related
            $objOps = Ops::model()->with('users','client')->findByPk($id);
            $listGoods = Listgoods::model()->findAllByAttributes(array('ops_id'=>$id));        

            //find invoice by invoice_id in ops
            $invoice = Invoices::model()->findByAttributes(array('ops_id' => $objOps->id));

            /*
            //if invoice id not empty
            if($objOps->invoice_id != '' && $objOps->invoice_id != null){
                //get invoice
                $invoice = Invoices::model()->findByPk($objOps->invoice_id);
            }
            */

            $this->renderPartial('_modal',array('ops'=> $objOps,'goods'=>$listGoods,'invoice' => $invoice));
        }
        else
        {
            throw new CHttpException('404','Page not found');
        }

    }// ops

      

    
}