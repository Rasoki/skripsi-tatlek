<div class="page-head-wrap">
    <h4 class="margin0">
        Edit Detail
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">
            <li><a href="#">Data Table</a></li>
            <li><a href="#">Detail</a></li>
            <li><a href="#">Edit</a></li>
            <li class="active">Edit Detail</li>
        </ol>
    </div>
</div>
<!--page header end-->

<div class="ui-content-body">




    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    <form class="form-horizontal" role="form" action="<?php echo base_url() . 'Transaksi/update_detail'; ?>" method="post">



                        <div class="form-group">
                            <label  class="col-lg-3 col-sm-3 control-label">Nama Barang</label>
                            <div class="col-lg-9">  
                                <input type="hidden" name="id_detail_transaksi" value="<?php echo $detail_transaksi->id_detail_transaksi ?>">
                                <input type="hidden" name="id_transaksi" value="<?php echo $detail_transaksi->id_transaksi ?>">

                                <select class="form-control" name="id_barang">
                                    <?php
                                    foreach ($barang as $t) {
                                        if ($t->id_barang == $detail_transaksi->id_barang) {
                                            ?>
                                            <option  value="<?= $t->id_barang; ?>" selected><?= $t->nama_barang  ?></option>
                                            <?php
                                        } else {
                                            ?>
                                            <option  value="<?= $t->id_barang; ?>"><?= $t->nama_barang ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
<!--. ' Rp.' . number_format($t->harga_barang, 0, ',', '.')-->



<!--                        <div class="form-group">
                            <label for="JumlahBarang" class="col-lg-3 col-sm-3 control-label">Jumlah Barang</label>
                            <div class="col-lg-9">  
                                <input class="form-control" name="jumlah" value="<?php echo $detail_transaksi->jumlah ?>">
                            </div>
                        </div>-->

                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                                <a href="<?php echo site_url() . 'transaksi/form_detail/' . $detail_transaksi->id_transaksi; ?>" type="button" class="btn btn-warning">Cancel</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>