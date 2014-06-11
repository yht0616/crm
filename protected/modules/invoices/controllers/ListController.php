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
        
        $request = Yii::app()->request;
        $pdf = null;

        if($request->isAjaxRequest){        
            $objOps = Ops::model()->with('users','client')->findByPk($id);
            $listGoods = Listgoods::model()->findAllByAttributes(array('ops_id'=>$id));        
            
            if(!empty($objOps->invoice_id)){
                $pdf = Invoices::model()->findByPk($$objOps->invoice_id)->filename;
            }
            
            $modal = $this->renderPartial('_modal',array('ops'=> $objOps,'goods'=>$listGoods,'pdf' => $pdf));
            echo $modal;
        }else{
            throw new CHttpException('404','Page not found');
        }
        
    }// ops

      

    
}