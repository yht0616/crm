<?php
class TopMeniuWidget extends CWidget {
    
    public function run(){
        
        $objUser = Yii::app()->user;
        $fname = $objUser->getState('fname');
        $lname = $objUser->getState('lname');
        $stock = $objUser->getState('stock'); 
        $service = $objUser->getState('service');
        $client = $objUser->getState('client');
         
        
        $this->render('top_menu',array('fname' => $fname,'lname' => $lname,'stock' => $stock, 'service' => $service, 'client' => $client));   
        
    }    
}
?>