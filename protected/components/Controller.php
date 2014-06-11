<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

    
    
    protected function beforeAction($action) {
        
        
       
        //$this->d(Yii::app()->user->getState('role'));
        if (Yii::app()->controller->action->id !=='login')                       
            if (Yii::app()->user->isGuest || Yii::app()->user->getState('role') !== 'auth_user'){
                
                $this->redirect(Yii::app()->user->loginUrl);
            }
                

        return parent::beforeAction($action);
    }
   

}