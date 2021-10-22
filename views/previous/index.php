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
                            <td><?= number_format($talalat->talalat, 0, "", "&#8239;"); ?></td>
                            <td><?= number_format($talalat->darab, 0, "", "&#8239;"); ?></td>
                            <td><?= number_format($talalat->ertek, 0, "", "&#8239;")." Ft"; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
        <div class="box secondary no-shadow footer clear">
                        <div class="title clear"><h3>Keresés a korábbi sorsolások között játékhét alapján</h3></div>
                        <div class="clear" id="downloads">
                            <div class="d-flex justify-content-center align-items-center">
                                <form action="/beadando/previous" method="post" class="ng-pristine ng-valid">
                                    <div class="selector" id="uniform-year" style="width: 102px;">
                                        <span style="width: 98px; user-select: none;"></span>
                                        <select class="custom-select ng-isolate-scope" name="year" id="year">
                                            <?php foreach($huzas->evek as $ev) :
                                                if($ev != 0) {?>
                                                    <option <?= $huzas->ev == $ev ? "selected" : "" ?> value="<?= $ev ?>"><?= $ev ?></option>
                                                <?php }
                                            endforeach ?>
                                        </select>
                                    </div>
                                    <div class="selector" id="uniform-week" style="width: 102px;">
                                        <select class="custom-select ng-isolate-scope" name="week" id="week">
                                            <?php for($i=1;$i <= 53;$i++) : ?>
                                                <option <?= $huzas->het == $i ? "selected" : "" ?> value="<?= $i ?>"><?= $i.". hét" ?></option>
                                            <?php endfor ?>
                                            </select>
                                    </div>
                                    <input class="button button-more" type="submit" name="source" value="Keresés">
                                </form>
                            </div>
                        </div>
                    </div>
        <div class="card-footer">
            <?php if($huzas->megelozoHuzasId !== 0): ?>
            <a href="?huzas_id=<?= $huzas->megelozoHuzasId ?>" class="btn btn-danger">Előző</a>
            <?php endif; ?>
            <?php if($huzas->kovetkezoHuzasId !== 0): ?>
            <a href="?huzas_id=<?= $huzas->kovetkezoHuzasId ?>" class="btn btn-danger" style="position: absolute; right: 20px;">Következő</a>
            <?php endif; ?>
        </div>
    </div>
</div>

