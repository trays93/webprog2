<div class="row justify-content-center">
    <div class="col-4 mt-5">
        <form action="/Login" method="POST">
            <?php if (isset($data['error'])) : ?>
            <div class="alert alert-danger" role="alert">
                <h2>Hiba történt!</h2>
                <?= $data['error'] ?>
            </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Jelszó</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Bejelentkezés</button>
        </form>
    </div>
</div>
