<?php /* @var $content string */ ?>

<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui-1.9.2.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.9.2.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/common.js"></script>

    <link rel="icon" type="image/png" href="" />
    <link rel="apple-touch-icon-precomposed" type="image/png" href="" />

    <meta name="keywords" content="crm">
    <meta name="description" content="crm">
    <title>crm - invoice module</title>
</head>


<body>

    <?php  $this->widget('application.widgets.TopMeniuWidget'); ?>

<div class="invouce-table-holder">
    <?php echo $content; ?>
</div><!--/invoice-table-holder -->


</body>

</html>