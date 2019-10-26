<div class="page-head-wrap">
    <h4 class="margin0">
        Edit Rak
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">
            <li><a href="#">Data Table</a></li>
            <li><a href="#">Edit</a></li>
            <li class="active">Edit Rak</li>
        </ol>
    </div>
</div>
<!--page header end-->

<div class="ui-content-body">




    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php foreach ($rak as $u) { ?>
                        <form class="form-horizontal" role="form" action="<?php echo base_url() . 'Rak/update'; ?>" method="post">
                            <div class="form-group">
                                <label class="col-lg-3 col-sm-3 control-label">No. Rak</label>
                                <div class="col-lg-9">
                                    <input type="hidden" name="id_rak" value="<?php echo $u->id_rak ?>">
                                    <input class="form-control" name="NoRak" value="<?php echo $u->no_rak ?>">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 col-sm-3 control-label">Lokasi</label>
                                <div class="col-lg-9">
                                    <input class="form-control" name="Lokasi" value="<?php echo $u->lokasi ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-lg-3 col-sm-3 control-label">Nama Barang</label>
                                <div class="col-lg-9">
                                    <select class="form-control" name="id_barang">
                                        <?php
                                        foreach ($barang as $u) {
                                            ?>
                                            <option  value="<?= $u->id_barang; ?>"> <?= $u->nama_barang; ?></option>
                                            <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-9">
                                    <a href="<?php echo site_url() . 'Rak'; ?>" type="button" class="btn btn-warning">Cancel</a>
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