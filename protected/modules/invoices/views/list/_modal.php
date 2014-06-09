    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Ops number: <?php echo $ops->ops_number?></h4>
    </div><!--/modal-header -->
    
    <div class="modal-body">
        <p>List of priduct:</p>
        <?php if(!empty($goods)):?>
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>code</th>
                <th>name</th>
                <th>quant</th>
                <th>price</th>
            </tr>
            <?php $count = 1; foreach($goods as $item):?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $item->code?></td>
                    <td><?php echo $item->name; ?></td>
                    <td><?php echo $item->quant;?></td>
                    <td><?php echo $item->price; ?></td>
                </tr>
            <?php $count++; endforeach;?>
        </table>        
        <?php endif;?>
    </div><!--/modal-body -->
    
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div><!--/modal-footer -->