<div class="page-head-wrap">
    <h4 class="margin0">
        Edit Transaksi
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">
            <li><a href="#">Data Table</a></li>
            <li><a href="#">Edit</a></li>
            <li class="active">Edit Transaksi</li>
        </ol>
    </div>
</div>
<!--page header end-->

<div class="ui-content-body">




    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php foreach ($transaksi as $u) { ?>
                        <form class="form-horizontal" role="form" action="<?php echo base_url() . 'Transaksi/update'; ?>" method="post">

                            <div class="form-group">
                                <label  class="col-lg-3 col-sm-3 control-label">No. Transaksi</label>
                                <div class="col-lg-9">
                                    <input type="hidden" name="id_transaksi" value="<?php echo $u->id_transaksi ?>">
                                    <input class="form-control" name="no_transaksi" value="<?php echo $u->no_transaksi ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-lg-3 col-sm-3 control-label">Tanggal</label>
                                <div class="col-lg-9">  
                                    <input class="form-control" name="tanggal" value="<?php echo $u->tanggal ?>" type="date">
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-9">
                                    <a href="<?php echo site_url() . 'Transaksi'; ?>" type="button" class="btn btn-warning">Cancel</a>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>

                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>