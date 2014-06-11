<?php /* @var $invoice Invoices */  ?>
<?php /* @var $item Listgoods */ ?>
<?php /* @var $goods array */ ?>

<?php $vat = 0.21; ?>

<!DOCTYPE html>

<html>
<head>
    <title></title>
</head>
<body>
<table cellpadding="0" cellspacing="0" class="header-tbl">
    <tr>
        <td style="text-align: right; font-size: 16px;" colspan="3">PVM SASAKITA FAKTURA<br><br></td>
    </tr>
    <tr>
        <td style="font-size: 15px;">Pardavejas:</td>
        <td><strong>UAB Vandens filtravimo sistemos</strong><br>Imones kodas:2568746545; PVM kodas: LT583500515<br><br><span class="sm-1">Silutes pl.4 Klaipeda.<br> Dnb Nord bankas LT2440125641898</span></td>
        <td style="text-align: right;"><strong>Serija VFSV Nr. 1123</strong><br><br>Data 2014.05.19</td>
    </tr>
</table>
<br><br>
<hr class="hr">
<br><br>
<table cellpadding="0" cellspacing="0" class="customer-tbl">
    <tr>
        <td style="font-size: 15px;">Pirkejas:</td>
        <td><strong>Jozas Baskys<br>a.k. 34845648964</strong><br>Alytaus raj. Butrimonys Margirio g. 15</td>
        <td>Telefonas, atsakingas<br>862725514</td>
    </tr>
</table>
<br><br>
<table cellpadding="0" cellspacing="0" class="invoice-data-tbl">
    <tr class="head-tbl">
        <td style="height: 20px;">Pavadinimas</td>
        <td style="height: 20px;">Mato Vnt.</td>
        <td style="height: 20px;">Kiekis</td>
        <td style="height: 20px;">Kaina Lt.</td>
        <td style="height: 20px;">Suma Lt.</td>
    </tr>

    <?php $total_qnt = 0; ?>
    <?php $total_price = 0; ?>

    <?php foreach($goods as $item): ?>
    <tr>
        <td><?php echo $item->name; ?></td>
        <td>vnt.</td>
        <td><?php echo $item->quant; ?></td>
        <td><?php echo number_format($item->price,2,'.',''); ?></td>
        <td><?php echo number_format($item->price*$item->quant,2,'.',''); ?></td>
        <?php $total_qnt += $item->quant; ?>
        <?php $total_price += $item->price; ?>
    </tr>
    <?php endforeach?>

    <tr>
        <td>Apmoketi pavedimui iki 2014-06-15</td>
        <td></td>
        <td></td>
        <td>0.0000</td>
        <td>0.00</td>
    </tr>

    <tr>
        <td style="border: none;">Is viso:</td>
        <td style="border: none;"></td>
        <td style="border: none;"><?php echo $total_qnt; ?></td>
        <td style="border: none;"><span class="no-wrap">Suma be PVM</span><br><span class="no-wrap">PVM suma (21%)</span></td>
        <td><?php echo number_format($total_price,2,'.',''); ?><br><?php echo number_format($total_price*$vat,2,'.',''); ?></td>
    </tr>

    <tr>
        <td style="border: none;"></td>
        <td style="border: none;"></td>
        <td style="border: none;"></td>
        <td style="border: none;">Suma su PVM</td>
        <td><?php echo number_format($total_price*(1+$vat),2,'.',''); ?></td>
    </tr>

</table>
<p><strong>Suma zodziais: Sesi tukstanciai septinesdesimt-keturi litai 20 centu</strong></p>
<p class="sized-p">Neapmokejus per nurodyta termina uz kiek-viena-diena priskaiciuoja 0.2% delspenigu. </p>
<p>Saskaita israse: Laura Stukaite</p>
<p>Saskaita gavo:</p>
</body>
</html>
