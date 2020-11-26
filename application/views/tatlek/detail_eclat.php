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
                                $no = 1;

                                $eclat_value = array();
                                $eclat_data = array();

                                foreach ($eclat['support'] as $key => $value) {
                                    foreach ($value as $key2 => $value2) {
                                        if($eclat['support'] >= $support && $eclat['confidence'][$key2][$key] >= $confidence){
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
                            array_push($eclat_data, array($key, $key2));
                            array_push($eclat_value, ($eclat['confidence'][$key2][$key] + $value2));
                        }
                    }

//                                                    print_r($eclat[support]);
                    ?>

                </tbody>
            </table>
        </div>
    </section>
</div>
</div>
</div>
</div>