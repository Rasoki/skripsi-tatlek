<div class="page-head-wrap">
    <h4 class="margin0">
        Form Barang
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">

            <li><a href="#">Form</a></li>
            <li class="active">Form Barang</li>
        </ol>
    </div>
</div>
<!--page header end-->
<div class="ui-content-body">
    <div class="panel">
        <div class="panel-body ">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form class="form-horizontal" role="form" action="<?php echo base_url() . 'Barang/input'; ?>" method="post">
                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Kode Barang</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="KodeBarang" placeholder="Kode Barang" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-lg-3 col-sm-3 control-label">Nama Barang</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="NamaBarang" placeholder="Nama Barang" type="text">
                            </div>                                      
                        </div>

<!--                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Jumlah Barang</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="JumlahBarang" placeholder="Jumlah Barang" type="text">
                            </div>
                        </div>-->

                        <div class="form-group">
                            <label  class="col-lg-3 col-sm-3 control-label">Jenis Barang</label>
                            <div class="col-lg-9">
                                <select class="form-control" name="id_kategori">
                                    <?php
                                    foreach ($kategori as $u) {
                                        ?>
                                        <option  value="<?= $u->id_kategori; ?>"> <?= $u->nama_kategori; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br><br>

<!--                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Harga Barang</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="HargaBarang" placeholder="Harga Barang" type="text">
                            </div>
                        </div>-->
                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                                <a href="<?php echo site_url() . 'Barang'; ?>" type="button" class="btn btn-warning">Cancel</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
