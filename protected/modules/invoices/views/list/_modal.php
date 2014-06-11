    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Ops number: <?php echo $ops->ops_number?></h4>
    </div><!--/modal-header -->
    
    <div class="modal-body">
        <table>
            <tr>
            	<td>
                	Client: <?php echo $ops->client->name?> <?php echo $ops->client->lname;?><br/>
                    Adress: Vilnius,<br/>
                    J.Kanto 18-3
                                                         
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
            <tr>
            	<td>1</td>
                <td>Muilas</td>
                <td>34567</td>
                <td>2</td>
                <td>34.00</td>
                <td>68.00</td>
            </tr>
            <tr>
            	<td colspan="5" class="text-right">Total: </td>
                <td>345.00 LT</td>
            </tr>
        </table>
    
    
    </div><!--/modal-body --
    
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div><!--/modal-footer -->