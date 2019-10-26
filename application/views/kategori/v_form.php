<div class="page-head-wrap">
    <h4 class="margin0">
        Form Kategori
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">
            <li><a href="#">Form</a></li>
            <li class="active">Form Kategori</li>
        </ol>
    </div>
</div>
<!--page header end-->
<div class="ui-content-body">
    <div class="panel">
        <div class="panel-body ">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form class="form-horizontal" role="form" action="<?php echo site_url() . 'Kategori/input'; ?>" method="post">
                        <div class="form-group">
                            <label  class="col-lg-3 col-sm-3 control-label">Nama Kategori</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="NamaKategori"  placeholder="Nama Kategori" type="text">

                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                                <a href="<?php echo site_url() . 'Kategori'; ?>" type="button" class="btn btn-warning">Cancel</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                            

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
