<div class="page-head-wrap">
    <h4 class="margin0">
        Detail Eclat
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">
            <li><a href="#">Detail Eclat</a></li>

            <li class="active">Hasil</li>
        </ol>
    </div>
</div>

<div class="ui-content-body">

    <div class="ui-container">

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
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
                                    if(($value / $total) >= $support1 && ($value / $data_growth[$key][1]) >= $confidence1 ){
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
</section>
</div>
</div>
</div>
</div>