<?php
$valutak = $data['valutak'];
$start = $data['start'];
$end = $data['end'];
$arfolyam = $data['arfolyam'];
?>

<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-center">
                <h2 class="card-title">Árfolyamok</h2>
            </div>
            <div class="card-body">
                <form method="POST" class="row">
                    <div class="col-4 mb-3">
                        <label for="datum">Dátum:</label>
                        <input type="date"
                            class="form-control"
                            name="datum"
                            id="datum"
                            min="<?= $start ?>"
                            max="<?= $end ?>"
                            required <?= isset($_POST['datum']) ? 'value="' . $_POST['datum'] .'"' : '' ?>>
                    </div>
                    <div class="col-4 mb-3">
                        <label for="valuta1">Pénznem:</label>
                        <select class="form-select" name="valuta1" id="valuta1" required>
                            <option value="" selected disabled>Kérlek válassz</option>
                            <?php foreach($valutak as $valuta) : ?>
                            <option value="<?= $valuta ?>" <?= (isset($_POST['valuta1']) && $_POST['valuta1'] === $valuta) ? 'selected' : '' ?>><?= $valuta ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-4 mb-3">
                        <label for="valuta2">Pénznem:</label>
                        <select class="form-select" name="valuta2" id="valuta2" required>
                            <option value="" selected disabled>Kérlek válassz</option>
                            <?php foreach($valutak as $valuta) : ?>
                            <option value="<?= $valuta ?>" <?= (isset($_POST['valuta2']) && $_POST['valuta2'] === $valuta) ? 'selected' : '' ?>><?= $valuta ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Küld</button>
                    </div>
                </form>
                
                <?php if (!empty($arfolyam)) : ?>
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Árfolyamok:</h5>
                        <ul>
                            <?php foreach($arfolyam['napiArfolyam'] as $k => $v) : ?>
                            <li>Pénznem: <?= $k ?>, árfolyam: <?= $v ?> Ft</li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <canvas id="myChart"></canvas>
                    </div>
                </div>

                <script>
                    const labels = [
                        <?php foreach($arfolyam['dates'] as $date) : ?>
                        '<?= $date ?>',
                        <?php endforeach; ?>
                    ];
                    const data = {
                        labels: labels,
                        datasets: [
                            {
                                label: '<?= $_POST['valuta1'] ?>',
                                backgroundColor: 'rgb(255, 99, 132)',
                                borderColor: 'rgb(255, 99, 132)',
                                data: [
                                    <?php foreach($arfolyam[$_POST['valuta1']] as $rate) : ?>
                                    <?= str_replace(',', '.', $rate) ?>,
                                    <?php endforeach; ?>
                                ],
                            },
                            {
                                label: '<?= $_POST['valuta2'] ?>',
                                backgroundColor: 'rgb(66, 135, 245)',
                                borderColor: 'rgb(66, 135, 245)',
                                data: [
                                    <?php foreach($arfolyam[$_POST['valuta2']] as $rate) : ?>
                                    <?= str_replace(',', '.', $rate) ?>,
                                    <?php endforeach; ?>
                                ],
                            },
                        ]
                    };

                    const config = {
                        type: 'line',
                        data: data,
                        options: {}
                    };

                    var myChart = new Chart(
                        document.getElementById('myChart'),
                        config
                    );
                </script>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
