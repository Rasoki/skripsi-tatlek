<!--page header start-->
<div class="page-head-wrap">
    <h4 class="margin0">
        Data Rak
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">

            <li><a href="#">Data Table</a></li>
            <li class="active">Data Rak</li>
        </ol>
    </div>
</div>
<!--page header end-->

<div class="ui-content-body">

    <div class="ui-container">

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">

                    <div class="panel-body table-responsive">
                        <table class="table colvis-data-table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>    
                                    <th>
                                        No. Rak
                                    </th>
                                    <th>
                                        Lokasi
                                    </th>
                                     <th>
                                       Nama Barang
                                    </th>
                                    <th>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                foreach ($rak as $u) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $u->no_rak ?></td>
                                        <td><?php echo $u->lokasi ?></td>
                                        <td><?php echo $u->nama_barang ?></td>

                                        <td>
                                            <a  class="btn btn-info" href="<?php echo site_url('Rak/edit/' . $u->id_rak); ?>">
                                                <i class="icon-note"></i>
                                            </a>
                                            <a  class="btn btn-danger" href="<?php echo site_url('Rak/hapus/' . $u->id_rak); ?>">
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
