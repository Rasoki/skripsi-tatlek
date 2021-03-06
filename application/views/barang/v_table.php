<!--page header start-->
<div class="page-head-wrap">
    <h4 class="margin0">
        Data Barang
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">
            <li><a href="#">Data Latih</a></li>

            <li class="active">Data Barang</li>
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
                                        Kode Barang
                                    </th>
                                    <th>
                                        Nama Barang
                                    </th>
<!--                                    <th>
                                        Jumlah Barang
                                    </th>-->
                                    <th>
                                        Jenis Barang
                                    </th>
<!--                                    <th>
                                        Harga Barang
                                    </th>-->
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
                                foreach ($barang as $u) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $u->kode_barang ?></td>
                                        <td><?php echo $u->nama_barang ?></td>
<!--                                        <td><?php echo $u->jum_barang ?></td>-->
                                        <td><?php echo $u->nama_kategori ?></td>
<!--                                        <td><?php echo ' Rp.' . number_format($u->harga_barang,0,',','.')?></td>-->


                                        <td>
                                             <?php
                        if($this->session->userdata('jabatan')=='admin'){
                     ?>
                                            <a  class="btn btn-info" href="<?php echo site_url('Barang/edit/' . $u->id_barang); ?>">
                                                <i class="icon-note"></i>
                                            </a>
                                            <a  class="btn btn-danger" href="<?php echo site_url('Barang/hapus/' . $u->id_barang); ?>">
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
