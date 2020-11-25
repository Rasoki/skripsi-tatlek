<?php
//var_dump(base_url('includes'));
//die;
$select_eclat = [0.001,0.002,0.003,0.004,0.005,0.006,0.007,0.008,0.009,0.01];
$select_confidence = [0.5,0.6,0.7,0.8,0.9,1];
$select_confidence2 = [0.1,0.2,0.3,0.4];
?>
<div class="page-head-wrap">
    <h4 class="margin0">
        Tata Letak
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">
            <li><a href="#">Tata Letak</a></li>

            <li class="active">Hasil</li>
        </ol>
    </div>
</div>

<div class="ui-content-body">

    <div class="ui-container">

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">


                    <div class="panel-accordion panel-group" id="accordion_test">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading2">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_test" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                        ECLAT                                  </a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                    <div>
                                        <h1>ECLAT</h1>
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
                                                            Kategori
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
                                                                foreach ($value['id_kategori'] as $value2) {

                                                                    if ($no2 != 1) {
                                                                        echo ', ';
                                                                    }

                                                                    echo $eclat['kategori'][$value2]['name'];
                                                                    $no2++;
                                                                }
                                                                ?>
                                                            </td>   


                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div>
                                            <header class="panel-heading panel-border">
                                                Tabel List Kategori
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
                                                                Kategori
                                                            </th>
                                                            <th>
                                                                ID Transaksi
                                                            </th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $no = 1;
                                                        foreach ($eclat['kategori'] as $value) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $no++ ?></td>
                                                                <td><?php echo $value['name'] ?></td>
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
                                                            Kategori
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
                                                                <td><?php echo $eclat['kategori'][$key]['name'] . ' x ' . $eclat['kategori'][$key2]['name'] ?></td>
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
                                                            Kategori
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
                                                                <td><?php echo $eclat['kategori'][$key]['name'] . ' x ' . $eclat['kategori'][$key2]['name'] ?></td>
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
                                                            Kategori
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

                                                    $eclat_value = array();
                                                    $eclat_data = array();

                                                    foreach ($eclat['support'] as $key => $value) {
                                                        foreach ($value as $key2 => $value2) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $no++ ?></td>
                                                                <td><?php echo $eclat['kategori'][$key]['name'] . ' ->' . $eclat['kategori'][$key2]['name'] ?></td>
                                                                <td><?php echo $value2 ?>
                                                                </td>
                                                                <td><?php echo $eclat['confidence'][$key2][$key] ?>
                                                                </td>   
                                                                <td><?php echo $eclat['confidence'][$key2][$key] + $value2 ?>
                                                                </td> 


                                                            </tr>
                                                            <?php
                                                            array_push($eclat_data, array($key, $key2));
                                                            array_push($eclat_value, ($eclat['confidence'][$key2][$key] + $value2));
                                                        }
                                                    }

//                                                    print_r($eclat[support]);
                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading3">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_test" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                        FP-GROWTH  
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                    <!--<div>-->
                                    <h1>FPGROWTH</h1>
                                    <div>
                                        <header class="panel-heading panel-border">
                                            Tabel List Kategori dan Jumlah
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
                                                            Kategori
                                                        </th>
                                                        <th>
                                                            Jumlah
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $no = 1;
                                                    foreach ($growth['kategori_count'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $no++ ?></td>
                                                            <td><?php echo $growth['kategori'][$key]['name']; ?></td>
                                                            <td><?php
                                                                echo $value;
                                                                ?>
                                                            </td>

                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>

                                                </tbody>
                                                <?php //                                                print_r(array_sum($growth['kategori_count'])); ?>

                                                <?php
//                                                echo '<pre>';
//                                                $no = 1;
//                                                foreach ($growth['kategori_count'] as $key => $value) {
////                                                    if ($no == 1) {
//                                                    print_r($key . "=>" . $value);
//                                                    echo '<br>';
////                                                    }
////                                                    $no++;
////                                                    $count=count($value);
////                                                    print_r($count);
//                                                }
//                                                var_dump($growth['kategori_count'] );
                                                ?>
                                            </table>
                                        </div>
                                    </div>

                                    <div>
                                        <header class="panel-heading panel-border">
                                            Tabel Urut List Kategori dan Jumlah
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
                                                            Kategori
                                                        </th>
                                                        <th>
                                                            Jumlah
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $no = 1;
                                                    foreach ($growth['kategori_sort'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $no++ ?></td>
                                                            <td><?php echo $growth['kategori'][$key]['name']; ?></td>
                                                            <td><?php
                                                                echo $value;
                                                                ?>
                                                            </td>

                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <div class="panel-body">
                                        <div class="dd" id="nestable_list_3">
                                            <ol class="dd-list">
                                                <li class="dd-item dd3-item" data-id="13">
                                                    <!--<button data-action="collapse" type="button">Collapse</button>-->
                                                    <!--<button data-action="expand" type="button" style="display: none;">Expand</button>-->
                                                    <div class="dd-handle dd3-handle"></div>
                                                    <div class="dd3-content">NULL</div>
                                                    <ol class="dd-list">
                                                        <?php
                                                        foreach ($growth['pohon']['null'] as $id_kategori1 => $value1) {
                                                            ?>
                                                            <li class="dd-item dd3-item" data-id="16">
                                                                <div class="dd-handle dd3-handle"></div>
                                                                <div class="dd3-content"> <?= $growth['kategori'][$id_kategori1]['name'] ?></div>

                                                                <ol class="dd-list">
                                                                    <?php
                                                                    foreach ($value1 as $id_kategori2 => $value2) {
                                                                        if ($id_kategori2 != 'count') {
                                                                            ?>
                                                                            <li class="dd-item dd3-item" data-id="16">
                                                                                <div class="dd-handle dd3-handle"></div>
                                                                                <div class="dd3-content"> <?= $growth['kategori'][$id_kategori2]['name'] ?></div>

                                                                                <ol class="dd-list">
                                                                                    <?php
                                                                                    foreach ($value2 as $id_kategori3 => $value3) {
                                                                                        if ($id_kategori3 != 'count') {
                                                                                            ?>
                                                                                            <li class="dd-item dd3-item" data-id="16">
                                                                                                <div class="dd-handle dd3-handle"></div>
                                                                                                <div class="dd3-content"> <?= $growth['kategori'][$id_kategori3]['name'] ?></div>
                                                                                                <ol class="dd-list">
                                                                                                    <?php
                                                                                                    foreach ($value3 as $id_kategori4 => $value4) {
                                                                                                        if ($id_kategori4 != 'count') {
                                                                                                            ?>
                                                                                                            <li class="dd-item dd3-item" data-id="16">
                                                                                                                <div class="dd-handle dd3-handle"></div>
                                                                                                                <div class="dd3-content"> <?= $growth['kategori'][$id_kategori4]['name'] ?></div>

                                                                                                                <ol class="dd-list">
                                                                                                                    <?php
                                                                                                                    foreach ($value4 as $id_kategori5 => $value5) {
                                                                                                                        if ($id_kategori5 != 'count') {
                                                                                                                            ?>
                                                                                                                            <li class="dd-item dd3-item" data-id="16">
                                                                                                                                <div class="dd-handle dd3-handle"></div>
                                                                                                                                <div class="dd3-content"> <?= $growth['kategori'][$id_kategori5]['name'] ?></div>
                                                                                                                                <ol class="dd-list">
                                                                                                                                    <?php
                                                                                                                                    foreach ($value5 as $id_kategori6 => $value6) {
                                                                                                                                        if ($id_kategori6 != 'count') {
                                                                                                                                            ?>
                                                                                                                                            <li class="dd-item dd3-item" data-id="16">
                                                                                                                                                <div class="dd-handle dd3-handle"></div>
                                                                                                                                                <div class="dd3-content"> <?= $growth['kategori'][$id_kategori6]['name'] ?></div>
                                                                                                                                                <ol class="dd-list">
                                                                                                                                                    <?php
                                                                                                                                                    foreach ($value6 as $id_kategori7 => $value7) {
                                                                                                                                                        if ($id_kategori7 != 'count') {
                                                                                                                                                            ?>
                                                                                                                                                            <li class="dd-item dd3-item" data-id="16">
                                                                                                                                                                <div class="dd-handle dd3-handle"></div>
                                                                                                                                                                <div class="dd3-content"> <?= $growth['kategori'][$id_kategori7]['name'] ?></div>
                                                                                                                                                                <ol class="dd-list">
                                                                                                                                                                    <?php
                                                                                                                                                                    foreach ($value7 as $id_kategori8 => $value8) {
                                                                                                                                                                        if ($id_kategori8 != 'count') {
                                                                                                                                                                            ?>
                                                                                                                                                                            <li class="dd-item dd3-item" data-id="16">
                                                                                                                                                                                <div class="dd-handle dd3-handle"></div>
                                                                                                                                                                                <div class="dd3-content"> <?= $growth['kategori'][$id_kategori8]['name'] ?></div>
                                                                                                                                                                                <ol class="dd-list">
                                                                                                                                                                                    <?php
                                                                                                                                                                                    foreach ($value8 as $id_kategori9 => $value9) {
                                                                                                                                                                                        if ($id_kategori9 != 'count') {
                                                                                                                                                                                            ?>
                                                                                                                                                                                            <li class="dd-item dd3-item" data-id="16">
                                                                                                                                                                                                <div class="dd-handle dd3-handle"></div>
                                                                                                                                                                                                <div class="dd3-content"> <?= $growth['kategori'][$id_kategori9]['name'] ?></div>
                                                                                                                                                                                                <ol class="dd-list">
                                                                                                                                                                                                    <?php
                                                                                                                                                                                                    foreach ($value9 as $id_kategori10 => $value10) {
                                                                                                                                                                                                        if ($id_kategori10 != 'count') {
                                                                                                                                                                                                            ?>
                                                                                                                                                                                                            <li class="dd-item dd3-item" data-id="16">
                                                                                                                                                                                                                <div class="dd-handle dd3-handle"></div>
                                                                                                                                                                                                                <div class="dd3-content"> <?= $growth['kategori'][$id_kategori10]['name'] ?></div>
                                                                                                                                                                                                                <ol class="dd-list">
                                                                                                                                                                                                                    <?php
                                                                                                                                                                                                                    foreach ($value10 as $id_kategori11 => $value11) {
                                                                                                                                                                                                                        if ($id_kategori11 != 'count') {
                                                                                                                                                                                                                            ?>
                                                                                                                                                                                                                            <li class="dd-item dd3-item" data-id="16">
                                                                                                                                                                                                                                <div class="dd-handle dd3-handle"></div>
                                                                                                                                                                                                                                <div class="dd3-content"> <?= $growth['kategori'][$id_kategori11]['name'] ?></div>



                                                                                                                                                                                                                            </li>
                                                                                                                                                                                                                            <?php
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    ?>
                                                                                                                                                                                                                </ol>  



                                                                                                                                                                                                            </li>
                                                                                                                                                                                                            <?php
                                                                                                                                                                                                        }
                                                                                                                                                                                                    }
                                                                                                                                                                                                    ?>
                                                                                                                                                                                                </ol>  



                                                                                                                                                                                            </li>
                                                                                                                                                                                            <?php
                                                                                                                                                                                        }
                                                                                                                                                                                    }
                                                                                                                                                                                    ?>
                                                                                                                                                                                </ol>  



                                                                                                                                                                            </li>
                                                                                                                                                                            <?php
                                                                                                                                                                        }
                                                                                                                                                                    }
                                                                                                                                                                    ?>
                                                                                                                                                                </ol>  




                                                                                                                                                            </li>
                                                                                                                                                            <?php
                                                                                                                                                        }
                                                                                                                                                    }
                                                                                                                                                    ?>
                                                                                                                                                </ol>  



                                                                                                                                            </li>
                                                                                                                                            <?php
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                    ?>
                                                                                                                                </ol>  



                                                                                                                            </li>
                                                                                                                            <?php
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </ol>           
                                                                                                            </li>
                                                                                                            <?php
                                                                                                        }
                                                                                                    }
                                                                                                    ?>
                                                                                                </ol>           
                                                                                            </li>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </ol>
                                                                            </li>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </ol>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ol>
                                                </li>
                                            </ol>
                                        </div>
                                    </div>

                                    <hr>
                                    <?php
                                    asort($growth['kategori_count'])
                                    ?>
                                    <header class="panel-heading panel-border">
                                        Tabel CPB, CFPT, FPG
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
                                                        Kategori
                                                    </th>        
                                                    <th>
                                                        Conditional Pattern Base
                                                    </th>  



                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $no = 1;
                                                foreach ($growth['kategori_count'] as $key => $value) {
                                                    if ($no != count($growth['kategori_count'])) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $no ?></td>
                                                            <td><?php echo $eclat['kategori'][$key]['name'] . $key ?></td>
                                                            <td> 

                                                                <?php
                                                                foreach ($growth['pcb'][$key] as $key2 => $value2) {
                                                                    echo "<span class='label label-default label-mini'>";
                                                                    $count = count($value2);
                                                                    $html_key = '';
                                                                    $no_c = 1;
                                                                    $cabang = 0;

                                                                    $store = array();
                                                                    foreach ($value2 as $key3 => $value3) {
//                                                                            echo $eclat['kategori'][$value3]['name'];
                                                                        echo '' . $key3 . '';


                                                                        $count -=1;
                                                                        if ($count != 0) {
                                                                            echo ', ';
                                                                        }
                                                                        $html_key .=$value3 . '.';

                                                                        if ($no_c == 1) {
                                                                            $cabang = $value3;
                                                                        }

                                                                        $no_c++;

//                                                                            echo '{' . $key . '.' . $cabang . '.' . $value3 . '}';

                                                                        $index[1] = $key;
                                                                        $index[2] = $cabang;
                                                                        $index[3] = $value3;


                                                                        if (empty($growth['cfpt'][$key][$cabang][$value3])) {
                                                                            $growth['cfpt'][$key][$cabang][$value3] = 0;
                                                                        }
                                                                        array_push($store, $index);
                                                                    }
                                                                    $html_key .=$key . '.';
                                                                    foreach ($store as $row) {
                                                                        $growth['cfpt'][$row[1]][$row[2]][$row[3]] +=$growth['count_cpb'][$html_key];
                                                                    }


                                                                    echo ": " . $growth['count_cpb'][$html_key] . "</span> ";
//                                                                        echo "=== " . $html_key . "";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>

                                                            </td>
                                                            <td>

                                                            </td>


                                                        </tr>
                                                        <?php
                                                    }
                                                    $no++;
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
<!--                                    <pre>
                                    <?php
//                                            print_r($growth['cfpt']);
                                    ?>
                                    </pre>-->
                                    <div class="panel-body table-responsive">
                                        <table class="table colvis-data-table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        No
                                                    </th>
                                                    <th>
                                                        Kategori
                                                    </th>        

                                                    <th>
                                                        Conditional FP Tree
                                                    </th>  


                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $fpg = array();
                                                $no = 1;
                                                $max_val = 0;
                                                foreach ($growth['kategori_count'] as $key => $value) {


                                                    if ($no != count($growth['kategori_count'])) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $no ?></td>
                                                            <td><?php echo $eclat['kategori'][$key]['name'] . $key ?></td>
                                                            <td> 


                                                                <?php
                                                                if (!empty($growth['cfpt'][$key])) {
                                                                    foreach ($growth['cfpt'][$key] as $key2 => $value2) {
                                                                        echo '<code>[</code>';


                                                                        foreach ($value2 as $key3 => $value3) {
                                                                            echo " <span class='label label-info label-mini'>";

//                                                                                echo $eclat['kategori'][$key3]['name'];
                                                                            echo '' . $key3 . '';


                                                                            echo " : " . $value3 . " </span> &nbsp;";

                                                                            if ($value3 > 1) {

                                                                                if (empty($fpg[$key][$key3])) {
                                                                                    $fpg[$key][$key3] = 0;
                                                                                }

                                                                                $fpg[$key][$key3] +=$value3;
                                                                            }

                                                                            $max_val +=$value3;
                                                                        }
                                                                        echo '<code>]</code><br>';
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>

                                                            </td>
                                                            <td>

                                                            </td>


                                                        </tr>
                                                        <?php
                                                    }
                                                    $no++;
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="panel-body table-responsive">
                                        <table class="table colvis-data-table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        No
                                                    </th>
                                                    <th>
                                                        Kategori
                                                    </th>        

                                                    <th>
                                                        Frequent Pattern Generated
                                                    </th>  


                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $fpg_value = array();

                                                $fpg_data = array();
                                                $no = 1;
                                                foreach ($growth['kategori_count'] as $key => $value) { // loop 1
                                                    if ($no != count($growth['kategori_count'])) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $no ?></td>
                                                            <td><?php echo $eclat['kategori'][$key]['name'] . $key ?></td>
                                                            <td> 

                                                                <?php
                                                                if (!empty($fpg[$key])) {
                                                                    $fpg_merge = array();

                                                                    $html_merge = "<code>[</code> <span class='label label-success label-mini'>";
                                                                    $min_value = $max_val;

                                                                    foreach ($fpg[$key] as $key2 => $value2) { // loop 2
                                                                        if ($value2 < $min_value) {
                                                                            $min_value = $value2;
                                                                        }
                                                                        echo '<code>[</code>';


//                                                                            foreach ($value2 as $key3 => $value3) {
                                                                        echo " <span class='label label-success label-mini'>";

//                                                                                echo $eclat['kategori'][$key3]['name'];
                                                                        echo '' . $key2 . ',' . $key;


                                                                        echo " : " . $value2 . " </span> &nbsp;";

                                                                        $html_merge .= $key2 . ", ";

//                                                                            }
                                                                        echo '<code>]</code><br>';

                                                                        array_push($fpg_value, $value2);
                                                                        array_push($fpg_data, array($key, $key2));
                                                                        array_push($fpg_merge, $key2);
                                                                    }
                                                                    array_push($fpg_merge, $key);


                                                                    array_push($fpg_value, $min_value);
                                                                    array_push($fpg_data, $fpg_merge);

                                                                    $html_merge .= $key . " : " . $min_value . "</span> <code>]</code>";

                                                                    echo $html_merge;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
//                                                                var_dump($min_value);
//                                                                echo '<pre>';  var_dump($darlan); echo '</pre>';
                                                                ?>
                                                            </td>
                                                            <td>

                                                            </td>

                                                        </tr>
                                                        <?php
                                                    }
                                                    $no++;
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
                                                        Kategori
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
                                                foreach ($fpg_data as $key => $value) {
//                                                for ($i = 0; $i < count($fpg_data); $i++) {
                                                    if ($key == count($fpg_data) - 1) {
                                                        $data [] = end($fpg_data[$key]);
                                                    } else if (count($fpg_data[$key]) <= 2) {
                                                        $data [] = reset($fpg_data[$key]);
                                                    } else if (count($fpg_data[$key]) >= 2) {
                                                        $data [] = end($fpg_data[$key]);
                                                    }
                                                }
                                                ?>

                                                <?php
                                                foreach ($data as $key => $value) {
                                                    foreach ($growth['kategori_count'] as $key2 => $value2) {
                                                        if ($data[$key] == $key2) {
                                                            $data_growth[] = [$data[$key], $growth['kategori_count'][$key2]];
                                                        }
                                                    }
                                                }
                                                ?>

                                                <?php
//                                                $total = count($eclat['transaksi']);
                                                $total = array_sum($growth['kategori_count']);
                                                $no = 1;

                                                foreach ($fpg_value as $key => $value) {
                                                    $count = count($value);
                                                    $cek = 0;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?> </td>
                                                        <td>
                                                            <?php
                                                            foreach ($fpg_data[$key] as $key2 => $value2) {

                                                                if ($cek == 1) {
                                                                    if ($key == count($fpg_data) - 1) {
                                                                        $dkategori [] = [ end($fpg_data[$key]), $value];
                                                                    } else if (count($fpg_data[$key]) <= 2) {
                                                                        $dkategori [] = [reset($fpg_data[$key]), $value]; // pembagian
                                                                    } else if (count($fpg_data[$key]) >= 2) {
                                                                        $dkategori [] = [ end($fpg_data[$key]), $value];
                                                                    }
                                                                }

                                                                $cek++;

                                                                $count -=1;
                                                                if ($count != 0) {

                                                                    echo '->';
                                                                }

                                                                echo $eclat['kategori'][$value2]['name'] . '';
                                                            }
                                                            ?>
                                                        </td>

                                                        <td><?php echo $support = $value / $total; ?></td>  


                                                        <td>
                                                            <?php
//                                                            foreach ($dkategori as $key3 => $value3) {
//
//                                                                $cek3 = 1;
//                                                                foreach ($data_growth as $key4 => $value4) {
////                                                                    ($dkategori[$key3][0] == $data_growth[$key4][0]) && 
//                                                                  
//                                                                    if ($cek3 == 1) {
//
//                                                                        $confidence = $value / $data_growth[$key4][1];

                                                            echo $confidence = $value / $data_growth[$key][1];

//                                                                        $cek3++;
//                                                                    }
//                                                                }
//                                                            }
                                                            ?>
                                                        </td>

                                                        <td>
                                                            <?php echo $support + $confidence ?>
                                                        </td>                                                        
                                                        <?php
                                                    }
                                                    ?>
                                                </tr>

                                                <?php
//                                                    $no = 1;
//                                                    foreach ($fpg_value as $key => $value) {
//                                                        $cek = 0;
//                                                        foreach ($dkategori as $key2 => $value2) {
//                                                            $cek2 = 1;
//
//                                                            foreach ($data_growth as $key3 => $value3) {
//
//                                                                if ($cek == 1) {
//
//                                                                    if (($dkategori[$key2][0] == $data_growth[$key3][0]) && $cek2 == 1) {
////                                                                echo $no++;
////                                                                echo ". {$dkategori[$key2][1]} /  {$data_growth[$key3][1]} = ";
//                                                                        $confidence = $dkategori[$key2][1] / $data_growth[$key3][1];
////                                                                echo $confidence;
////                                                               
//                                                                        print_r($confidence);
//                                                                        echo "<br/>";
//                                                                        $cek++;
//                                                                    }
//                                                                }
//                                                                $cek++;
//                                                            }
//                                                        }
//                                                    }
//                                                    $no = 1;
//                                                    
//                                                    foreach ($dkategori as $key => $value) {
////                                                for ($i = 0; $i < count($dkategori); $i++) {
//                                                        $cek2 = 1;
//                                                        foreach ($data_growth as $key2 => $value2) {
////                                                    for ($j = 0; $j < count($data_growth); $j++) {
//                                                            
//                                                
//                                                                if (($dkategori[$key][0] == $data_growth[$key2][0]) && $cek2 == 1) {
//                                                                    echo $no++;
//                                                                    echo ". {$dkategori[$key][1]} /  {$data_growth[$key2][1]} = ";
//                                                                    $confidence[] = $dkategori[$key][1] / $data_growth[$key2][1];
//                                                                    echo $dkategori[$key][1] / $data_growth[$key2][1];
//                                                                    echo "<br/>";
//                                                                    
////                                                                    echo $dkategori[$key][1] / $data_growth[$key2][1];                                               
//                                                        }
//                                                        $cek2++;
////                                                        else if ($i == count($dkategori) - 1 && $j == count($data_growth) - 1) {
////                                                            echo $no++;
////                                                            echo ". {$dkategori[$i][1]} /  {$data_growth[$j][1]} = ";
////                                                            echo $dkategori[$i][1] / $data_growth[$j][1];
////                                                            echo "<br/>";
////                                                        }
//                                                    }
//                                                }
                                                ?>

                                                <?php
//                                                echo "<pre>";
//                                                var_dump($dkategori);
//                                                echo '<pre>';
//                                                print_r($fpg_data);
//                                                echo '<pre>';
//                                                $no = 0;
//                                                foreach ($growth['kategori_count'] as $key => $value) {
//                                                foreach ($fpg_data as $key2 => $value2) {
//
//
//
////                                                    print_r($fpg_data);
////                                                    print_r($fpg_data[$no][count($no)-1]);
//                                                    
//                                                    echo '<br>';
//                                                    $no++;
//                                                }
//                                                }
//                                                print_r($value);
                                                ?>
                                                <?php
//                                                var_dump($fpg_data);
//                                                foreach ($growth['kategori_count'] as $key => $value) {
//                                                }
//                                                echo '<pre>';
//                                                print_r($data);
//                                                var_dump(($growth['kategori_count'][8]));
//                                                echo "<br/>";
//                                                for ($i = 0; $i < count($data); $i++) {
//                                                    for ($j = 1; $j <= count($growth['kategori_count']); $j++) {
//                                                        if ($data[$i] == $j) {
//                                                            $data_growth[] = [$data[$i], $growth['kategori_count'][$j]];
//                                                        }
//                                                    }
//                                                }
//                                                var_dump($data_growth); //gabungan dari variabel $data dan $growth['kategori_count]
//                                                echo "dkategoti";
//                                                var_dump($dkategori);
//                                                echo "<br/>";
//                                                echo "data_growth";
//                                                var_dump($data_growth);
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php
//                    foreach ($eclat['support'] as $key => $value) {
////                  for ($i = 0; $i < count($fpg_data); $i++) {
//                        
//                    }
                    ?>

                    <?php
                    foreach ($eclat['support'] as $key => $value) {
                        foreach ($eclat['confidence'] as $key2 => $value2) {
                            if ($key == $key2) {
                                $item [] = [$eclat['support'][$key], $eclat['confidence'][$key2]];
                            }
                        }
                    }
//                    echo '<pre>';
//                    print_r($item[1]);
                    ?>


                    <header class="panel-heading panel-border">
                        Tabel Hasil Perbandingan

                    </header>
                    <?php
                    $value_backend = $value;
                    $value_backend2 = $value2;
                    ?>
                    <div class="ui-container">
                        <div class="panel-body table-responsive">
                            <table class="table colvis-data-table table-striped">

                                <thead>
                                <th>
                                    METODE
                                </th>
                                <th>
                                    SUPPORT
                                </th>
                                <th>
                                    CONFIDENCE
                                </th>
                                <th>
                                    ITEMSET
                                </th>
                                <th>
                                    DETAIL
                                </th>
                                </thead>
                                <tr>
                                    <td rowspan="2">
                                        ECLAT
                                    </td>
                                    <td>
                                        <select class="form-control" id="eclat1" name="eclat1">
                                            <?php
                                                foreach($select_eclat as $key=>$val)
                                                {
                                                    echo '<option value='.$val.'>'.$val.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" id="confidence1" name="confidence1">
                                            <?php
                                                foreach($select_confidence as $key=>$val)
                                                {
                                                    echo '<option value='.$val.'>'.$val.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td>

                                        <?php

                                        $no = 0;
                                        foreach ($item as $key => $value) {
                                            $cek = 0;

                                            foreach ($value as $key2 => $value2) {
                                                if ($cek == 0) {
                                                    foreach ($value2 as $key3 => $value3) {
                                                        if ($item[$key][0][$key3] >= 0.001 && $item[$key][1][$key3] >= 0.5) {
                                                            $no++;
                                                        }
                                                    }
                                                    $cek++;
                                                }
                                            }
                                        }

                                        $a_itemset [] = $no;
                                        
//                                        echo $item[$key][$no][$key3]['name'];
//                                   print_r($item);
//                                  echo $no;
                                        ?>
                                        <?php
//                                    $no=0;
//                                    foreach ($eclat['support'] as $key => $value) {
//                                        foreach ($eclat['confidence'] as $key2 => $value2){
//                                    if ($value >= 0.001 && $value2 >= 1.0) {
//                                        $no++;
//                                    }
//                                    }
//                                    }
//                                    echo $no
                                        ?>
                                        <span id="itemset1">0</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="form-control" id="eclat2" name="eclat2">
                                            <?php
                                                foreach($select_eclat as $key=>$val)
                                                {
                                                    echo '<option value='.$val.'>'.$val.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" id="confidence2" name="confidence2">
                                            <?php
                                                foreach($select_confidence2 as $key=>$val)
                                                {
                                                    echo '<option value='.$val.'>'.$val.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <?php
                                        $no = 0;
                                        
                                        $value_backend1 = $value;
                                        $value_backend12 = $value2;
                
                                        foreach ($item as $key => $value) {
                                            $cek = 0;

                                            foreach ($value as $key2 => $value2) {
                                                if ($cek == 0) {
                                                    foreach ($value2 as $key3 => $value3) {
                                                        if ($item[$key][0][$key3] >= 0.001 && $item[$key][1][$key3] >= 0.3) {
                                                            $no++;
                                                        }
                                                    }
                                                    $cek++;
                                                }
                                            }
                                        }
                                        $a_itemset [] = $no;
                             
//                                   print_r($item);
                                 
                                        ?>
                                        <span id="itemset2"><?=$no?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="2">
                                        FP-GROWTH
                                    </td>
                                    <td>
                                        0.001
                                    </td>
                                    <td>
                                        0.5
                                    </td>


                                    <td>
                                        <?php
                                        $total = array_sum($growth['kategori_count']);
                                        $no = 0;
                                        foreach ($fpg_value as $key => $value) {

                                            $support = $value / $total;
                                            $confidence = $value / $data_growth[$key][1];

                                            if ($support >= 0.001 && $confidence >= 0.5) {
//                                            if (count($fpg_value) != $no) {
                                                $no++;
//                                            }
                                            }
                                        }
                                        $a_itemset [] = $no;
                                        echo $no;
                                        ?>
                                    </td>


                                </tr>

                                <tr>
                                    <td>
                                         
                                    </td>
                                    <td>
                                        0.3
                                    </td>
                                    <td>
                                        <?php
                                        $total = array_sum($growth['kategori_count']);
                                        $no = 0;
                                        foreach ($fpg_value as $key => $value) {

                                            $support = $value / $total;
                                            $confidence = $value / $data_growth[$key][1];

                                            if ($support >= 0.001 && $confidence >= 0.3) {
//                                            if (count($fpg_value) != $no) {
                                                $no++;
                                            }
//                                        }
                                        }
                                        $a_itemset [] = $no;
                                        echo $no;
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?php
//                        var_dump($a_itemset);
//                        die;
                    ?>
                    <!--grafik-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <header class="panel-heading">
                                    Grafik Hasil Perbandingan
                                </header>
                                <div class="panel-body">
                                    <div id="basic-line" data-highcharts-chart="0">


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id='myDiv'><!-- Plotly chart will be drawn inside this DIV --></div>

                    <script type="text/javascript">
                        var trace1 = {// ECLAT
                            x: [0.5, 0.3],
                            y: [<?= $a_itemset[0] ?>,<?= $a_itemset[1] ?>],
                            type: 'scatter',
                            name: 'ECLAT'
                        };

                        var trace2 = {//FP-GROWTH
                            x: [0.5, 0.3],
                            y: [<?= $a_itemset[2] ?>,<?= $a_itemset[3] ?>],
                            type: 'scatter',
                            name: 'FP-GROWTH'
                        };

                        var data = [trace1, trace2];
                        var layout = {
                            title: 'Grafik Hasil Perbandingan'
                        };

                        Plotly.newPlot('myDiv', data, layout);

                    </script>
                    <!-- end grafik-->

                    

                    <?php
                    arsort($fpg_value);
//                        print_r($fpg_value);
//                        print_r($fpg_data);

                    arsort($eclat_value);
//                        print_r($eclat_value);
//                        print_r($eclat_data);
                    ?>


                    <!--                    <div>
                                            ECLAT
                                            <br>
                    <?php
                    $tampil = 0;
                    foreach ($eclat_value as $key => $value) {

                        if ($tampil == 0) {
//                                print_r($fpg_data[$key]);

                            foreach ($eclat_data[$key] as $key2 => $value2) {
                                echo $eclat['kategori'][$value2]['name'];
                                echo '<br>';
                            }
                            echo $value;
                        }

                        $tampil++;
                    }
                    echo '<br>';
                    echo '<br>';
                    echo 'itemset ';
                    echo count($eclat_data);
                    ?>
                                        </div>  -->
                    <br>
                    <!--                    <div>
                                            FP-GROWTH
                                            <br>
                    <?php
                    $tampil = 0;
                    foreach ($fpg_value as $key => $value) {

                        if ($tampil == 0) {
//                                print_r($fpg_data[$key]);

                            foreach ($fpg_data[$key] as $key2 => $value2) {
                                echo $eclat['kategori'][$value2]['name'];
                                echo '<br>';
                            }
                            echo $value;
                        }

                        $tampil++;
                    }
                    echo '<br>';
                    echo '<br>';
                    echo 'itemset ';
                    echo count($fpg_value);
                    ?>
                    
                                        </div>-->


                </section>
            </div>
(
         </div>
 
     </div>
 </div>

 <script src="<?= base_url('includes') ?>/bower_components/jquery/dist/jquery.min.js"></script>
 <script type="text/javascript">
 $(document).ready(function(){
     getValue();
     getValue2();
     $('#eclat1,#confidence1').on('change',function(){
         getValue();
     })
     $('#eclat2,#confidence2').on('change',function(){
         getValue();
     })
 })
 
 function getValue()
 {
     $.ajax({
         type: "POST",
         dataType: 'JSON',
         data: {support: $('#eclat1').val(),confidence:$('#confidence1').val(),item:<?php echo json_encode($item); ?>,value:<?php echo json_encode($value_backend); ?>,value2:<?php echo json_encode($value_backend2); ?>},
         url: "<?=base_url()?>/index.php/tatlek/itemset",
         success: function(data){
           $('#itemset1').html(data.nilai);
       }
   });    
}
function getValue2()
 {
     $.ajax({
         type: "POST",
         dataType: 'JSON',
         data: {support: $('#eclat2').val(),confidence:$('#confidence2').val(),item:<?php echo json_encode($item); ?>,value:<?php echo json_encode($value_backend1); ?>,value2:<?php echo json_encode($value_backend12); ?>},
         url: "<?=base_url()?>/index.php/tatlek/itemset",
         success: function(data){
           $('#itemset2').html(data.nilai);
       }
   });    
}
</script>



