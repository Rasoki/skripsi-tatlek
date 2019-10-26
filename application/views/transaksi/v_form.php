<div class="page-head-wrap">
    <h4 class="margin0">
        Form Transaksi
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">

            <li><a href="#">Form</a></li>
            <li class="active">Form Transaksi</li>
        </ol>
    </div>
</div>
<!--page header end-->
<div class="ui-content-body">
    <div class="panel">
        <div class="panel-body ">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    <form class="form-horizontal" role="form" action="<?php echo base_url() . 'Transaksi/input'; ?>" method="post">

                        <div class="form-group">
                            <label for="NoTransaksi" class="col-lg-3 col-sm-3 control-label">No. Transaksi</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="NoTransaksi" placeholder="No Transaksi" type="number">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="Tanggal" class="col-lg-3 col-sm-3 control-label">Tanggal</label>
                            <div class="col-lg-9">
                                <?php
                                $tanggal = date('Y-m-d');
                                ?>
                                <input class="form-control" name="Tanggal" placeholder="Tanggal" value="<?= $tanggal ?>" type="date" >
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                                <a href="<?php echo site_url() . 'Transaksi'; ?>" type="button" class="btn btn-warning">Cancel</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
