<div class="page-head-wrap">
    <h4 class="margin0">
        Form Akun
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">
            <li><a href="#">Form</a></li>
            <li class="active">Form Akun</li>
        </ol>
    </div>
</div>
<!--page header end-->
<div class="ui-content-body">
    <div class="panel">
        <div class="panel-body ">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form class="form-horizontal" role="form" action="<?php echo base_url() . 'Akun/input'; ?>" method="post">
                        <div class="form-group">
                            <label for="Username" class="col-lg-3 col-sm-3 control-label">Username</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="Username"  placeholder="Username" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Password" class="col-lg-3 col-sm-3 control-label">Password</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="Password"  placeholder="Password" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Jabatan" class="col-lg-3 col-sm-3 control-label">Jabatan</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="Jabatan"  placeholder="Jabatan" type="text">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                                <a href="<?php echo site_url() . 'Akun'; ?>" type="button" class="btn btn-warning">Cancel</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
