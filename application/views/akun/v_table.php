<!--page header start-->
<div class="page-head-wrap">
    <h4 class="margin0">
        Data Akun
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">

            <li><a href="#">Data Table</a></li>
            <li class="active">Data Akun</li>
        </ol>
    </div>
</div>
<!--page header end-->

<div class="ui-content-body">

    <div class="ui-container">

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                     <?php
                        if($this->session->userdata('jabatan')=='admin'){
                     ?>
                    <a href="<?php echo site_url('Kategori/form'); ?>"> 
                        <i class="icon-plus"></i> 
                    </a>
                     <?php }?>
                    <div class="panel-body table-responsive">
                        <table class="table colvis-data-table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>    
                                    <th>
                                        Username
                                    </th>
                                    <th>
                                        Password
                                    </th>
                                    <th>
                                        Jabatan
                                    </th>
                                    <?php
                        if($this->session->userdata('jabatan')=='admin'){
                     ?>
                                    <th>
                                        Aksi
                                    </th>
                                       <?php }?>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                foreach ($akun as $u) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $u->username ?></td>
                                        <td><?php echo $u->password ?></td>
                                        <td><?php echo $u->jabatan ?></td>

                                        <td>
                                            <?php
                        if($this->session->userdata('jabatan')=='admin'){
                     ?>
                                            <a  class="btn btn-info" href="<?php echo site_url('Akun/edit/' . $u->id_akun); ?>">
                                                <i class="icon-note"></i>
                                            </a>
                                            <a  class="btn btn-danger" href="<?php echo site_url('Akun/hapus/' . $u->id_akun); ?>">
                                                <i class="icon-close"></i>
                                            </a>
                                            <?php }?>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

        </div>

    </div>
</div>
