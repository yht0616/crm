<?php /* @var $invoices array */ ?>
<?php /* @var $item Invoices */ ?>

<div class="invouce-table-holder">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>invoice demo</h3>
                <div class="filter-holder">

                    <form class="form-inline" role="form">
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail2">Date from</label>
                            <input type="text" class="form-control date-picker" id="exampleInputEmail2" placeholder="From">
                        </div><!--/form-group -->

                        <div class="form-group">
                            <label class="sr-only" for="exampleInputPassword2">Date to</label>
                            <input type="text" class="form-control date-picker" id="exampleInputPassword2" placeholder="To">
                        </div><!--/form-group -->

                        <button type="submit" class="btn btn-default">Find</button>
                    </form>
                </div><!--/filter-holder -->
                <div class="table-holder">
                    <table class="table table-responsive table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ops-number</th>
                            <th>date</th>
                            <th>who did</th>
                            <th>inv-date</th>
                            <th>invoice</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1; foreach($invoices as $item):?>
                            <tr>
                                <td><?php echo $count?></td>
                                <td><a class="ops_link" href="<?php echo '/invoices/list/ops/'.$item->ops->id; ?>" ><?php echo $item->ops->ops_number; ?></a></td>
                                <td><?php echo date('y.m.d',$item->ops->date); ?></td>
                                <td><?php echo $item->users->fname;?>&nbsp;<?php echo $item->users->lname; ?></td>
                                <td>07.26.2014</td>
                                <td>
                                    <?php if($item->file_name == '' || $item->file_name == null): ?>
                                        <a href="<?php echo $this->createUrl('list/genpdf',array('id' => $item->id)); ?>" class="btn btn-default ajax-lnk">Make invoive</a>
                                    <?php else: ?>
                                        <a href="<?php echo $this->createUrl('list/getpdf',array('id' => $item->id)); ?>"><?php echo $item->file_name; ?></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php $count++; endforeach;?>
                        </tbody>
                    </table>
                </div>

                <!-- /modal start -->

                <div class="modal fade"  id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            

                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <!--/ modal end -->


            </div><!-- /col-md-12-->
        </div><!-- /row -->
    </div><!-- /container -->
</div><!--/invoice-table-holder -->