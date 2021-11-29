        <div class="row" id="usersList">
            <div class="col-12">
                <h4>Dummy API felhasználók listája</h4>
                <button id="getUsers" class="btn btn-primary">Lista frissítése</button>
                <button id="newUser" class="btn btn-success">Új felhasználó</button>
            </div>

            <div class="col-12">
                <table class="table table-striped mt-2">
                    <thead>
                        <tr>
                            <th>Azonosító</th>
                            <th>Titulus</th>
                            <th>Vezetéknév</th>
                            <th>Keresztnév</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="usersTable"></tbody>
                </table>
            </div>
        </div>

        <div class="row" id="userDetails" style="display: none;">
            <div class="col-12">
                <h4 id="user">Felhasználó adatai</h4>
                <hr>
                <button class="btn btn-primary backToList">Vissza a listához</button>
                <button id="updateUser" class="btn btn-success">Felhasználó módosítása</button>

                <form>
                    <div class="row-mb-3">
                        <label for="userId" class="col-sm-2 col-form-label">Azonosító</label>
                        <div class="col-sm-10">
                            <input type="text" name="userId" id="userId" class="form-control-plaintext" readonly>
                        </div>
                    </div>

                    <div class="row-mb-3">
                        <label for="firstName" class="col-sm-2 col-form-label">Vezetéknév</label>
                        <div class="col-sm-10">
                            <input type="text" name="firstName" id="firstName" class="form-control">
                        </div>
                    </div>

                    <div class="row-mb-3">
                        <label for="lastName" class="col-sm-2 col-form-label">Utónév</label>
                        <div class="col-sm-10">
                            <input type="text" name="lastName" id="lastName" class="form-control">
                        </div>
                    </div>

                    <div class="row-mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row" id="insertUser" style="display: none;">
            <div class="col-12">
                <h4 id="user">Új felhasználó</h4>
                <hr>
                <button class="btn btn-primary backToList">Vissza a listához</button>
                <button id="addUser" class="btn btn-success">Új felhasználó mentése</button>

                <form>
                    <div class="row-mb-3">
                        <label for="newFirstName" class="col-sm-2 col-form-label">Vezetéknév</label>
                        <div class="col-sm-10">
                            <input type="text" name="newFirstName" id="newFirstName" class="form-control">
                        </div>
                    </div>

                    <div class="row-mb-3">
                        <label for="newLastName" class="col-sm-2 col-form-label">Utónév</label>
                        <div class="col-sm-10">
                            <input type="text" name="newLastName" id="newLastName" class="form-control">
                        </div>
                    </div>

                    <div class="row-mb-3">
                        <label for="newEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="newEmail" id="newEmail" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
        </div>