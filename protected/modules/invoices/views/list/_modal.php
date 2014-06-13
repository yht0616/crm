<?php /* @var $invoice Invoices */ ?>
<?php /* @var $ops Ops */ ?>
<?php /* @var $item Listgoods */ ?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Modal title</h4>
</div><!--/modal-header -->

<div class="modal-body">
    <table>
        <tr>
            <td>
                Client: <?php echo $ops->client->name?> <?php echo $ops->client->lname?><br/>
                Adress: <?php echo $ops->client->city ?>,<br/>
                <?php echo $ops->client->street?>

            </td>
            <td></td>
        </tr>
    </table>
    <hr>
    <p>Product list</p>
    <table class="table table-bordered" >
        <tr>
            <th>#</th>
            <th>Prod. pavad</th>
            <th>Prd. kodas</th>
            <th>kiekis</th>
            <th>kaina, LT</th>
            <th>total</th>

        </tr>
        <?php if(!empty($goods)):?>
            <?php $total = 0;  $count = 1; foreach($goods as $item):?>
                <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo $item->name?></td>
                    <td><?php echo $item->code;?></td>
                    <td><?php echo $item->quant?></td>
                    <td><?php echo  number_format($item->price/100, 2,'.',''); ?></td>
                    <td><?php $t = $item->price * $item->quant; echo number_format($t/100,2,'.',''); ?></td>
                </tr>
                <?php $total += $t; $count++; endforeach;?>
            <tr>
                <td colspan="5" class="text-right">Total: </td>
                <td><?php echo number_format($total/100,2,'.','');?> LT</td>
            </tr>
        <?php endif;?>
    </table>


</div><!--/modal-body -->

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <?php if($invoice != null && $invoice->file_name != null && $invoice->file_name != ""):?>
        <a href="<?php echo $this->createUrl('pdf/get',array('id' => $invoice->id)); ?>"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-share"></span> Download</button></a>
    <?php else:?>
        <a href="<?php echo $this->createUrl('pdf/gen2',array('id' => $invoice->id)); ?>"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-share"></span> Make invoice</button></a>
    <?php endif;?>
</div><!--/modal-footer -->
