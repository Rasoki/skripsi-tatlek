<div class="page-head-wrap">
    <h4 class="margin0">
        Tata Letak
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">
            <li><a href="#">Tata Letak</a></li>

            <li class="active">Welcome</li>
        </ol>
    </div>
</div>

<div class="ui-content-body">

    <div class="ui-container">

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading panel-border">
                        Tabel Transaksi
                        <span class="tools pull-right">
                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                            <a class="close-box fa fa-times" href="javascript:;"></a>
                        </span>
                    </header>
                    <div class="panel-body table-responsive">
                        <table class="table colvis-data-table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>    
                                    <th>
                                        ID Transaksi
                                    </th>
                                    <th>
                                        Nama Barang
                                    </th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                foreach ($eclat['transaksi'] as $key => $value) {
                                    ?>

                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php
                                            echo $key;
                                            ?>
                                        </td>


                                        <td><?php
                                            $no2 = 1;
                                            foreach ($value['id_barang'] as $value2) {

                                                if ($no2 != 1) {
                                                    echo ', ';
                                                }

                                                echo $eclat['barang'][$value2]['name'];
                                                $no2++;
                                            }
                                            ?>
                                        </td>   


                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <header class="panel-heading panel-border">
                        Tabel List Barang
                        <span class="tools pull-right">
                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                            <a class="close-box fa fa-times" href="javascript:;"></a>
                        </span>
                    </header>
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
                                        ID Transaksi
                                    </th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                foreach ($eclat['barang'] as $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $value['name'] . ' | ' . $value['kode'] ?></td>
                                        <td><?php
                                            $no2 = 1;

                                            foreach ($value['id_transaksi'] as $value2) {
                                                if ($no2 != 1) {
                                                    echo ', ';
                                                }
                                                echo $value2;
                                                $no2++;
                                            }
                                            ?>
                                        </td>



                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                  <header class="panel-heading panel-border">
                       Tabel Penyilangan
                        <span class="tools pull-right">
                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                            <a class="close-box fa fa-times" href="javascript:;"></a>
                        </span>
                    </header>
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
                                        ID Transaksi
                                    </th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                foreach ($eclat['silang'] as $key => $value) {
                                    foreach ($value as $key2 => $value2) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $eclat['barang'][$key]['name'] . ' x ' . $eclat['barang'][$key2]['name'] ?></td>
                                            <td><?php
                                                $no2 = 1;

                                                foreach ($value2 as $value2) {
                                                    if ($no2 != 1) {
                                                        echo ', ';
                                                    }
                                                    echo $value2;
                                                    $no2++;
                                                }
                                                ?>
                                            </td>



                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                   <header class="panel-heading panel-border">
                       Tabel Seleksi
                        <span class="tools pull-right">
                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                            <a class="close-box fa fa-times" href="javascript:;"></a>
                        </span>
                    </header>
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
                                        ID Transaksi
                                    </th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                foreach ($eclat['seleksi'] as $key => $value) {

                                    foreach ($value as $key2 => $value2) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $eclat['barang'][$key]['name'] . ' x ' . $eclat['barang'][$key2]['name'] ?></td>
                                            <td><?php
                                                $no2 = 1;

                                                foreach ($value2 as $value2) {
                                                    if ($no2 != 1) {
                                                        echo ', ';
                                                    }
                                                    echo $value2;
                                                    $no2++;
                                                }
                                                ?>
                                            </td>



                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                  
                    <header class="panel-heading panel-border">
                       Tabel Hasil
                        <span class="tools pull-right">
                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                            <a class="close-box fa fa-times" href="javascript:;"></a>
                        </span>
                    </header>
                    <div class="panel-body table-responsive">
                        <table class="table colvis-data-table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>    
                                    <th>
                                        Nama  Barang
                                    </th>  

                                    <th>
                                        Support
                                    </th>
                                    <th>
                                        Confidence
                                    </th>
                                    <th>
                                        Total
                                    </th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                foreach ($eclat['support'] as $key => $value) {
                                    foreach ($value as $key2 => $value2) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $eclat['barang'][$key]['name'] . ' ->' . $eclat['barang'][$key2]['name'] ?></td>
                                            <td><?php echo $value2 ?>
                                            </td>
                                            <td><?php echo $eclat['confidence'][$key2][$key] ?>
                                            </td>   
                                            <td><?php echo $eclat['confidence'][$key2][$key] + $value2 ?>
                                            </td> 


                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                 
                </section>
            </div>

        </div>

    </div>
</div>
