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
        /* @var $operation Ops */

        //result
        $result = "";
        //get invoice id from request
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
                $invoice->user_id = Yii::app()->user->id;
                $invoice->date = time();
                $invoice->update();

                $result = $invoice->file_name;
            }

            //try to find operation
            $operation = Ops::model()->findByPk($invoice->ops_id);

            //if operation found
            if($operation != null)
            {
                //set id of this invoice to operation
                $operation->invoice_id = $invoice->id;

                //update operation in base
                $operation->update();
            }
        }

        //exit and print filename
        exit($result);
    }

    // G E N E R A T E S  P D F  A N D  R E D I R E C T S  T O  L I S T
    public function actionGen2()
    {
        /* @var $invoice Invoices */
        /* @var $operation Ops */

        //get invoice id from request
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
                $invoice->user_id = Yii::app()->user->id;
                $invoice->date = time();
                $invoice->update();
            }

            //try to find operation
            $operation = Ops::model()->findByPk($invoice->ops_id);

            //if operation found
            if($operation != null)
            {
                //set id of this invoice to operation
                $operation->invoice_id = $invoice->id;

                //update operation in base
                $operation->update();
            }
        }

        //redirect to list
        $this->redirect($this->createUrl('list/index'));
    }

    // U S E D  F O R  G E N E R A T I O N
    private function GeneratePdf($invoice)
    {
        /* @var $invoice Invoices */

        $goods = Listgoods::model()->findAllByAttributes(array('ops_id' => $invoice->ops_id));
        $client = Clients::model()->findByPk($invoice->ops->client_id);

        //get html for pdf from partial
        $html = $this->renderPartial('_invoice_pdf_template',array('invoice' => $invoice, 'goods' => $goods, 'client' => $client),true);

        //create new pdf

        /* @var $pdf mPDF */
        $pdf = Yii::app()->ePdf->mpdf();

        //add styles to pdf
        $stylesheet = file_get_contents('css/invoice_pdf.css');
        $pdf->WriteHTML($stylesheet, 1);

        //convert html to pdf
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