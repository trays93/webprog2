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
                        <input type="date" class="form-control" name="datum" id="datum" min="<?= $start ?>" max="<?= $end ?>" required>
                    </div>
                    <div class="col-4 mb-3">
                        <label for="valuta1">Valuta:</label>
                        <select class="form-select" name="valuta1" id="valuta1" required>
                            <option value="" selected disabled>Kérlek válassz</option>
                            <?php foreach($valutak as $valuta) : ?>
                            <option value="<?= $valuta ?>"><?= $valuta ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-4 mb-3">
                        <label for="valuta2">Valuta:</label>
                        <select class="form-select" name="valuta2" id="valuta2" required>
                            <option value="" selected disabled>Kérlek válassz</option>
                            <?php foreach($valutak as $valuta) : ?>
                            <option value="<?= $valuta ?>"><?= $valuta ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Küld</button>
                    </div>
                </form>
                
                <?php if (!empty($arfolyam)) : ?>
                <div class="row">
                    <div class="col-12">
                        <ul>
                            <?php foreach($arfolyam as $k => $v) : ?>
                            <li><?= $k ?>: <?= $v ?></li>
                            <?php endforeach; ?>
                        </ul>
                        
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
