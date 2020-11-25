<!--page header start-->
<div class="page-head-wrap">
    <h4 class="margin0">
        Data Transaksi
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">
            <li><a href="#">Data Latih</a></li>

            <li class="active">Data Transaksi</li>
        </ol>
    </div>
</div>
<!--page header end-->

<div class="ui-content-body">

    <div class="ui-container">

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                     <a href="<?php echo site_url('Transaksi/form'); ?>"> 
                        <i class="icon-plus"></i> 
                    </a>

                    <div class="panel-body table-responsive">
                        <table class="table colvis-data-table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>    
                                    <th>
                                        No. Transaksi
                                    </th>
                                    <th>
                                        Tanggal
                                    </th>
                                   
<!--                                    <th>
                                        Total Harga
                                    </th>-->
                                    <th>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                <?php
                                $no = 1;
                                foreach ($transaksi as $u) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $u->no_transaksi ?></td>
                                        <td><?php echo $u->tanggal ?></td>
                                       
<!--                                        <td><?php echo ' Rp.' . number_format($u->harga,0,',','.')?></td>-->
                                        <td>
                                           
                                             <a  class="btn btn-primary" href="<?php echo site_url('Transaksi/form_detail/' . $u->id_transaksi); ?>">
                                                <i class="icon-arrow-right-circle"></i>
                                            </a>
                                             <a  class="btn btn-info" href="<?php echo site_url('Transaksi/edit/' . $u->id_transaksi); ?>">
                                                <i class="icon-note"></i>
                                            </a>
                                            <a  class="btn btn-danger" href="<?php echo site_url('Transaksi/hapus/' . $u->id_transaksi); ?>">
                                                <i class="icon-close"></i>
                                            </a>
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
