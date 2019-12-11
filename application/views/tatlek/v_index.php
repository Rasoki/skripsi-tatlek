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
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                    <hr>

                    <h1>FPGROWTH</h1>
                    <div>
                        <header class="panel-heading panel-border">
                            Tabel List Barang dan Jumlah
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
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <header class="panel-heading panel-border">
                            Tabel List Barang dan Jumlah
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

                                                    foreach ($value2 as $key3 => $value3) {
                                                        echo $eclat['kategori'][$value3]['name'];
                                                        $count -=1;
                                                        if ($count != 0) {
                                                            echo ', ';
                                                        }
                                                        $html_key .=$value3 . '.';
                                                    }
//                                                    echo json_encode($value2);

                                                    echo ": " . $growth['count_cpb'][$html_key] . "</span> ";
                                                }
//                                                echo $growth['count_cpb'][$html_key];
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
                                        Conditional FP Tree
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
                                                foreach ($growth['cfpt'][$key] as $key2 => $value2) {
                                                    echo '<';

                                                    foreach ($value2 as $key3 => $value3) {
                                                        echo "<span class='label label-default label-mini'>";

                                                        echo $eclat['kategori'][$key3]['name'];


                                                        echo "</span> ";
                                                    }
                                                    echo '>';
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
                                $no = 1;
                                foreach ($growth['kategori_count'] as $key => $value) {

                                    if ($no != count($growth['kategori_count'])) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td><?php echo $eclat['kategori'][$key]['name'] . $key ?></td>
                                            <td> 

                                                <?php
                                                foreach ($growth['cfpt'][$key] as $key2 => $value2) {

                                                    echo "<span class='label label-default label-mini'>";

                                                    echo $eclat['kategori'][$key]['name'] . ', ' . $eclat['kategori'][$key2]['name'];


                                                    echo "</span> ";
                                                }
                                                echo "<span class='label label-default label-mini'>";
                                                echo $eclat['kategori'][$key2]['name'];
                                                foreach ($growth['cfpt'][$key] as $key2 => $value2) {


                                                    echo  ', ' .$eclat['kategori'][$key2]['name'];
                                                }
                                                echo "</span> ";
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

                </section>
            </div>

        </div>

    </div>
</div>





