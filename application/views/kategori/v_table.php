<!--page header start-->
<div class="page-head-wrap">
    <h4 class="margin0">
        Data Kategori
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">

            <li><a href="#">Data Latih</a></li>
            <li class="active">Data Kategori</li>
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
                                        Nama Kategori
                                    </th>
                                    <?php
                                    if($this->session->userdata('jabatan')=='admin'){
                                    ?>
                                    <th>
                                        Aksi
                                    </th>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                foreach ($kategori as $u) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $u->nama_kategori ?></td>

                                        <td>
                                            <?php
                                            if($this->session->userdata('jabatan')=='admin'){
                                            ?>
                                            <a  class="btn btn-info" href="<?php echo site_url('Kategori/edit/' . $u->id_kategori); ?>">
                                                <i class="icon-note"></i>
                                            </a>
                                            <a  class="btn btn-danger" href="<?php echo site_url('Kategori/hapus/' . $u->id_kategori); ?>">
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
