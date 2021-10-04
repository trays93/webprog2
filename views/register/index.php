<div class="row justify-content-center">
    <div class="col-4 mt-5">
        <form action="/beadando/register" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" value="<?= isset($data['data']['email']) ? $data['data']['email'] : '' ?>"
                    class="form-control <?= isset($data['errors']) ? (isset($data['errors']['email']) ? 'is-invalid' : 'is-valid') : '' ?>">
                <?php if (isset($data['errors']['email'])) : ?>
                <div class="invalid-feedback">
                    <?= $data['errors']['email'] ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">Vezetéknév</label>
                <input type="text"  id="firstname" name="firstname" value="<?= isset($data['data']['firstname']) ? $data['data']['firstname'] : '' ?>"
                    class="form-control <?= isset($data['errors']) ? (isset($data['errors']['firstname']) ? 'is-invalid' : 'is-valid') : '' ?>">
                <?php if (isset($data['errors']['firstname'])) : ?>
                <div class="invalid-feedback">
                    <?= $data['errors']['firstname'] ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Keresztnév</label>
                <input type="text" id="lastname" name="lastname" value="<?= isset($data['data']['lastname']) ? $data['data']['lastname'] : '' ?>"
                    class="form-control  <?= isset($data['errors']) ? (isset($data['errors']['lastname']) ? 'is-invalid' : 'is-valid') : '' ?>">
                <?php if (isset($data['errors']['lastname'])) : ?>
                <div class="invalid-feedback">
                    <?= $data['errors']['lastname'] ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Jelszó</label>
                <input type="password" id="password" name="password"
                    class="form-control <?= isset($data['errors']) ? (isset($data['errors']['password']) ? 'is-invalid' : 'is-valid') : '' ?>">
            </div>
            <div class="mb-3">
                <label for="password-confirm" class="form-label">Jelszót megerősít</label>
                <input type="password" id="password-confirm" name="password-confirm"
                class="form-control <?= isset($data['errors']) ? (isset($data['errors']['password']) ? 'is-invalid' : 'is-valid') : '' ?>">
                <?php if (isset($data['errors']['password'])) : ?>
                <div class="invalid-feedback">
                    <?= $data['errors']['password'] ?>
                </div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Regisztrálás</button>
        </form>
    </div>
</div>

<pre><?= var_dump($data) ?></pre>
