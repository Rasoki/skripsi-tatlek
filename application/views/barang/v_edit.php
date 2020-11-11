<div class="page-head-wrap">
    <h4 class="margin0">
        Edit Barang
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">
            <li><a href="#">Data Table</a></li>
            <li><a href="#">Edit</a></li>
            <li class="active">Edit Barang</li>
        </ol>
    </div>
</div>
<!--page header end-->

<div class="ui-content-body">




    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php foreach ($barang as $u) { ?>
                        <form class="form-horizontal" role="form" action="<?php echo base_url() . 'Barang/update'; ?>" method="post">

                            <div class="form-group">
                                <label for="KodeBarang" class="col-lg-3 col-sm-3 control-label">Kode Barang</label>
                                <div class="col-lg-9">
                                    <input type="hidden" name="id_barang" value="<?php echo $u->id_barang ?>">
                                    <input class="form-control" name="KodeBarang" value="<?php echo $u->kode_barang ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="NamaBarang" class="col-lg-3 col-sm-3 control-label">Nama Barang</label>
                                <div class="col-lg-9">  
                                    <input class="form-control" name="NamaBarang" value="<?php echo $u->nama_barang ?>">
                                </div>
                            </div>

<!--                            <div class="form-group">
                                <label for="JumlahBarang" class="col-lg-3 col-sm-3 control-label">Jumlah Barang</label>
                                <div class="col-lg-9">  
                                    <input class="form-control" name="JumlahBarang" value="<?php echo $u->jum_barang ?>">
                                </div>
                            </div>-->

                            <div class="form-group">
                                <label  class="col-lg-3 col-sm-3 control-label">Jenis Barang</label>
                                <div class="col-lg-9">
                                    <select class="form-control" name="id_kategori">
                                        <?php
                                        foreach ($kategori as $t) {
                                            ?>
                                            <option  value="<?= $t->id_kategori; ?>"><?= $t->nama_kategori; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <br><br>

<!--                            <div class="form-group">
                                <label for="HargaBarang" class="col-lg-3 col-sm-3 control-label">Harga Barang</label>
                                <div class="col-lg-9">  
                                    <input class="form-control" name="HargaBarang" value="<?php echo $u->harga_barang ?>">
                                </div>
                            </div>-->

                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-9">
                                     <a href="<?php echo site_url() . 'Barang'; ?>" type="button" class="btn btn-warning">Cancel</a>
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