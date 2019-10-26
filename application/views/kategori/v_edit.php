<div class="page-head-wrap">
    <h4 class="margin0">
        Edit Kategori
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">
            <li><a href="#">Data Table</a></li>
            <li><a href="#">Edit</a></li>
            <li class="active">Edit Kategori</li>
        </ol>
    </div>
</div>
<!--page header end-->

<div class="ui-content-body">




    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php foreach ($kategori as $u) { ?>
                        <form class="form-horizontal" role="form" action="<?php echo base_url() . 'Kategori/update'; ?>" method="post">
                            <div class="form-group">
                                <label for="NamaKategori" class="col-lg-3 col-sm-3 control-label">Nama Kategori</label>
                                <div class="col-lg-9">
                                    <input type="hidden" name="id_kategori" value="<?php echo $u->id_kategori ?>">
                                    <input class="form-control" name="NamaKategori" value="<?php echo $u->nama_kategori ?>">

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-9">
                                    <a href="<?php echo site_url() . 'Kategori'; ?>" type="button" class="btn btn-warning">Cancel</a>
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