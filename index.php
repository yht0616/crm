<?php

//debugs var
function debugvar($var, $title = '')
{
    //ip addresses which can see debugged info
    $arrIps = array(
        '127.0.0.1'
    );

    //if current ip exist in array
    if(in_array($_SERVER["REMOTE_ADDR"],$arrIps))
    {
        //debug
        ob_start();
        if( $title )
            echo "$title\n";
        print_r($var);
        $out = ob_get_clean();
        echo "<pre>";
        echo htmlentities($out);
        echo "</pre>";
    }
}

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
