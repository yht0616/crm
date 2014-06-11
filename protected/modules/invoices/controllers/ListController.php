<?php

class ListController extends ControllerInvoices
{
    public function actionListAll()
    {
        $this->render('list_invoices');
    }

    public function actionGetPdf()
    {
        $id = Yii::app()->request->getParam('id');
        debugvar($id);
    }

    public function actionGenPdf()
    {
        //get id from request
        $id = Yii::app()->request->getParam('id');

        //find invoice from base
        $invoice = Invoices::model()->findByPk($id);

        //if invoice found
        if($invoice != null)
        {
            //generate pdf
            $pdf_filename = $this->GeneratePdf($invoice);

            
        }
    }

    private function GeneratePdf($invoice)
    {
        //include mDpf libs
        $mPdf_dir=dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'mpdf/mpdf.php';
        require_once($mPdf_dir);

        //get html for pdf from partial
        $html = $this->renderPartial('_invoice_pdf_template',array('invoice' => $invoice),true);

        //create new pdf
        $pdf = new mPDF('utf-8', 'A4', '8', 'Arial', 10, 10, 10, 10, 10, 10);
        $pdf->charset_in = 'UTF-8';

        //add styles to pdf
        $stylesheet = file_get_contents('css/invoice_pdf.css');
        $pdf->WriteHTML($stylesheet, 1);

        //convert html to pdf
        $pdf->list_indent_first_level = 0;
        $pdf->WriteHTML($html,2);

        //if dir not exist
        if(!file_exists('pdf'))
        {
            //create
            mkdir('pdf');
        }

        //filename
        $file_name = md5($invoice->id).".pdf";

        //if dir created
        if(file_exists('pdf'))
        {
            //save file
            $pdf->Output('pdf/'.$file_name, 'F');

            //return filename
            return $file_name;
        }

        //if dir not found
        else
        {
            //return nothing
            return "";
        }



        /*
        //return file to download
        if(file_exists('pdf/'.$file_name))
        {
            $file = 'pdf/'.$file_name;
            header('Content-type: application/pdf');
            header('Content-Disposition: attachment; filename="'.$file.'"');
            readfile($file);
        }
        else
        {
            exit('File not found');
        }
        */
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

        if($request->isAjaxRequest){        
            $objOps = Ops::model()->with('users')->findByPk($id);
            $listGoods = Listgoods::model()->findAllByAttributes(array('ops_id'=>$id));        
        
            $modal = $this->renderPartial('_modal',array('ops'=> $objOps,'goods'=>$listGoods));
            echo $modal;
        }else{
            throw new CHttpException('404','Page not found');
        }
        
    }// ops

      

    
}