<?php

class ListController extends ControllerInvoices
{
    // L I S T S  A L L  I N V O I C E S
    public function actionListAll()
    {
        $this->render('list_invoices');
    }

    // R E T U R N S  P D F  A S  F I L E
    public function actionGetPdf()
    {
        //get id from request
        $id = Yii::app()->request->getParam('id');

        //find invoice from base
        $invoice = Invoices::model()->findByPk($id);

        //if invoice found
        if($invoice != null)
        {
            //get filenme
            $filename = $invoice->file_name;

            //if filename is not empty
            if($filename != '' && $filename != null)
            {
                //if file found in dir
                if(file_exists('pdf/'.$filename))
                {
                    //send header for downloading
                    $file = 'pdf/'.$filename;
                    header('Content-type: application/pdf');
                    header('Content-Disposition: attachment; filename="'.$file.'"');
                    readfile($file);
                }
                //send to error page
                else
                {
                    /* TODO: create page for error */
                    exit('File not found');
                }
            }
        }
    }

    // A J A X  R E Q U E S T - G E N E R A T E S  P D F  A N D  P R I N T S  F I L E N A M E
    public function actionGenPdf()
    {
        //result
        $result = "";
        //get id from request
        $id = Yii::app()->request->getParam('id');

        //find invoice from base
        $invoice = Invoices::model()->findByPk($id);

        //if invoice found
        if($invoice != null)
        {
            //generate pdf
            $pdf_filename = $this->GeneratePdf($invoice);

            //if pdf name not empty
            if($pdf_filename != '')
            {
                $invoice->file_name = $pdf_filename;
                $invoice->update();

                $result = $invoice->file_name;
            }
        }
        exit($result);

        $this->renderText($result);
    }

    // U S E D  F O R  G E N E R A T I O N
    private function GeneratePdf($invoice)
    {
        $goods = Listgoods::model()->findAllByAttributes(array('ops_id' => $invoice->ops_id));

        //include mDpf libs
        $mPdf_dir=dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'mpdf/mpdf.php';
        require_once($mPdf_dir);

        //get html for pdf from partial
        $html = $this->renderPartial('_invoice_pdf_template',array('invoice' => $invoice, 'goods' => $goods),true);

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
    }

    // I N D E X
    public function actionIndex()  {
         
        $invoices = Invoices::model()->with('users','ops')->findAll();
       
        $this->render('index',array('invoices' => $invoices));
    }
    
    
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