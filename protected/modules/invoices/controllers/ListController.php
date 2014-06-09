<?php

class ListController extends ControllerInvoices
{
    public function actionListAll()
    {
        $this->render('list_invoices');
    }

    public function actionPdf()
    {
        //include mDpf libs
        $mPdf_dir=dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'mpdf/mpdf.php';
        require_once($mPdf_dir);

        //get html for pdf from partial
        $html = $this->renderPartial('_invoice_pdf_template',array(),true);

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
        $file_name = 'generated.pdf';

        //if dir created
        if(file_exists('pdf'))
        {
            //save file
            $pdf->Output('pdf/'.$file_name, 'F');
        }

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

    }

    public function actionIndex()
    {
<<<<<<< HEAD
         
        $ops = Ops::model()->with('user')->findAll();
        $this->d($ops);
       
=======
        $this->actionListAll();

//        $this->forward('list/listall');
//        $this->redirect($this->createUrl('list/listall'));
>>>>>>> d5c113459d8933ca03de77be6dc8eee754d8a6ca
    }
}