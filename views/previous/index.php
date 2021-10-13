<?php
$huzas = $data['huzas'];
?>

<div class="row">
    <div class="col-12">
    <h1>Előző sorsolások</h1>

    <div class="card">
        <div class="card-header text-center">
            <h2 class="card-title">
                <?= $huzas->ev ?>. <?= $huzas->het ?>. hét
            </h2>
        </div>
        <div class="card-body">
            <div class="text-center mb-3">
            <?php foreach($huzas->szamok as $szam): ?>
                <span class="number bg-danger text-white"><?= $szam ?></span>
            <?php endforeach; ?>
            </div>

            <table class="table table-striped text-center">
                <thead>
                    <tr class="bg-danger text-white">
                        <th>Találat</th>
                        <th>Darabszám</th>
                        <th>Nettó nyeremény</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($huzas->talalatok as $talalat): ?>
                        <tr>
                            <td><?= $talalat->talalat ?></td>
                            <td><?= $talalat->darab ?></td>
                            <td><?= $talalat->ertek ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <?php if($huzas->megelozoHuzasId !== 0): ?>
            <a href="?huzas_id=<?= $huzas->megelozoHuzasId ?>" class="btn btn-danger">Előző</a>
            <?php endif; ?>
            <?php if($huzas->kovetkezoHuzasId !== 0): ?>
            <a href="?huzas_id=<?= $huzas->kovetkezoHuzasId ?>" class="btn btn-danger">Következő</a>
            <?php endif; ?>
        </div>
    </div>
</div>