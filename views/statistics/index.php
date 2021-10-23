<?php
$szamstatisztika = $data['szamstatisztika'];
?>

<div class="row">
    <div class="col-12">
    <h1>Számstatisztika</h1>
    <p class="lead">Add meg kedvenc számaidat</p>

    <form method="POST">
        <div class="row">
            <?php for ($i = 0; $i < 6; $i++): ?>
            <div class="col">
                <input type="number"
                    class="form-control"
                    name="szamok[]"
                    min="1"
                    max="45" <?= !empty($_POST['szamok']) ? 'value="' . $_POST['szamok'][$i] . '"': '' ?>
                    required>
            </div>
            <?php endfor; ?>
        </div>
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">Kérem a statisztikát</button>
        </div>
    </form>


    <?php if (!empty($szamstatisztika)) : ?>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Szám</th>
                    <th>Hányszor húzták</th>
                    <th>Utoljára húzták</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($szamstatisztika as $key => $value): ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $value['hanyszor'] ?></td>
                    <td><?= $value['utoljaraHuztak'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    </div>
</div>
