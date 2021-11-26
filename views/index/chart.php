<?php 
    if(count($data) > 0) {
        $labels = [];
        $datas = [];
        $colors = [];
        foreach($data as $i) {
            $labels[] = $i['nev'];
            $datas[] = $i['count'];
            $color = "";
            $color = "rgba(".rand(0,255).", ".rand(0,255).", ".rand(0,255).", 0.6)";
            $colors[] = $color;
        }
?>

<script type="text/javascript">
   var labels = <?php echo json_encode($labels); ?>;
   var datas = <?php echo json_encode($datas); ?>;
   var colors = <?php echo json_encode($colors); ?>;
</script>

<div class="container">
    <div class="col-12"><canvas id="myChart"></canvas></div>
    
    <div class="col-12">
        <div id="Title" class="col-12 d-flex justify-content-center"><h3>A legnépszerűbb szoftverek</h3></div>
        <div class="col-12" id="tableHigh">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Szoftver neve</th>
                    <th scope="col">Telepítések száma</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i = 0; $i < round(count($data)/10); $i++) { ?>
                    <tr>
                        <th scope="row"><?= $i +1 ?></th>
                        <td><?= $data[$i]['nev'] ?></td>
                        <td><?= $data[$i]['count'] ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-12">
        <div id="Title" class="col-12 d-flex justify-content-center"><h3>A legnépszerűtlenebb szoftverek</h3></div>
        <div class="col-12" id="tableHigh">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Szoftver neve</th>
                    <th scope="col">Telepítések száma</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $j = 1;
                    for($i = count($data) - 1; $i > count($data) - round(count($data)/10); $i--) { ?>
                    <tr>
                        <th scope="row"><?= $j ?></th>
                        <td><?= $data[$i]['nev'] ?></td>
                        <td><?= $data[$i]['count'] ?></td>
                    </tr>
                    <?php $j++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php } ?>