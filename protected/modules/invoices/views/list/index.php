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
                            <th>invoice</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1; foreach($invoices as $item):?>
                        <tr>
                            <td><?php echo $count?></td>
                            <td><a href="#"><?php echo $item->ops->ops_number; ?></a></td>
                            <td>07.26.2014</td>
                            <td><?php echo $item->user->fname;?></td>
                            <td><a href="#" class="btn btn-default">Make invoive</a></td>
                        </tr>
                        <?php $count++; endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div><!-- /col-md-12-->
        </div><!-- /row -->
    </div><!-- /container -->
</div><!--/invoice-table-holder -->