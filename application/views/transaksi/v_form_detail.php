<!--page header start-->
<div class="page-head-wrap">
    <h4 class="margin0">
        Data Transaksi
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">
            <li><a href="#">Data Table</a></li>

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

                    <div class="panel-body table-responsive">
                        <table class="table colvis-data-table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>    



                                    <th>
                                        Nama Barang
                                    </th>

                                    <th>
                                        Harga 
                                    </th>
                                    <th>
                                        Jumlah
                                    </th>
                                    <th>
                                        Total Harga
                                    </th>
                                    <th>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                foreach ($detail_transaksi as $u) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $u->nama_barang ?></td>
                                        <td><?php echo ' Rp.' . number_format($u->harga_barang, 0, ',', '.') ?></td>

                                        <td><?php echo $u->jumlah ?></td>

                                        <td>
                                            <?php
                                            $total = $u->jumlah * $u->harga_barang;
                                            echo' Rp.' . number_format($total, 0, ',', '.')
                                            ?>
                                        </td>
                                        <td>
                                            <a  class="btn btn-info" href="<?php echo site_url('Transaksi/edit_detail/' . $u->id_detail_transaksi); ?>">
                                                <i class="icon-note"></i>
                                            </a>
                                            <a  class="btn btn-danger" href="<?php echo site_url('Transaksi/hapus_detail/' . $u->id_detail_transaksi . '/' . $u->id_transaksi); ?>">
                                                <i class="icon-close"></i>
                                            </a>


                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                        <!--page header end-->
                        <div class="ui-content-body">
                            <div class="panel">
                                <div class="panel-body ">
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2">

                                            <form class="form-horizontal" role="form" action="<?php echo base_url() . 'Transaksi/input_detail'; ?>" method="post">


                                                <input class="form-control" name="id_transaksi" type="hidden" value="<?= $id_transaksi ?>">

                                                <div class="form-group">
                                                    <label  class="col-lg-3 col-sm-3 control-label">Nama Barang</label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control" name="id_barang">
                                                            <?php
                                                            foreach ($barang as $t) {
                                                                ?>
                                                                <option  value="<?= $t->id_barang; ?>"><?= $t->nama_barang; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br><br>


                                                <div class="form-group">
                                                    <label  class="col-lg-3 col-sm-3 control-label">Jumlah Barang</label>
                                                    <div class="col-lg-9">
                                                        <input class="form-control" name="jumlah" placeholder="Jumlah Barang" type="number">
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <div class="col-lg-offset-3 col-lg-9">
                                                        <a href="<?php echo site_url() . 'Transaksi'; ?>" type="button" class="btn btn-warning">Cancel</a>
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>        
                    </div>
                </section>
            </div>

        </div>

    </div>
</div>
