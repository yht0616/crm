<?php

class PdfController extends ControllerInvoices
{
    // R E T U R N S  P D F  A S  F I L E
    public function actionGet()
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
    public function actionGen()
    {
        /* @var $invoice Invoices */

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
                $invoice->user_id = 2; /* TODO: get real user id when logged. Now used 2 by default */
                $invoice->date = time();
                $invoice->update();

                $result = $invoice->file_name;
            }
        }

        //exit and print filename
        exit($result);
    }

    // U S E D  F O R  G E N E R A T I O N
    private function GeneratePdf($invoice)
    {
        /* @var $invoice Invoices */

        $goods = Listgoods::model()->findAllByAttributes(array('ops_id' => $invoice->ops_id));
        $client = Clients::model()->findByPk($invoice->ops->user_id);

        //get html for pdf from partial
        $html = $this->renderPartial('_invoice_pdf_template',array('invoice' => $invoice, 'goods' => $goods, 'client' => $client),true);

        //create new pdf
        /* @var $pdf mPDF */
        $pdf = Yii::app()->ePdf->mpdf();
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
        $file_name = "pdf_invoice_".$invoice->id.".pdf";

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
}