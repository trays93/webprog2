        <div class="row" id="list">
            <div class="col-12">
                <h4>Számítógépek listája</h4>
                <button id="getComputers" class="btn btn-primary">Lista frissítése</button>
                <button id="newComputer" class="btn btn-success">Új számítógép</button>
            </div>

            <div class="col-12">
                <table class="table table-striped mt-2">
                    <thead>
                        <tr>
                            <th>Azonosító</th>
                            <th>Hely</th>
                            <th>Típus</th>
                            <th>IP cím</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="computersTable"></tbody>
                </table>
            </div>
        </div>

        <div class="row" id="details" style="display: none;">
            <div class="col-12">
                <h4>Számítógép adatai</h4>
                <hr />
                <button class="btn btn-primary backToList">Vissza a listához</button>
                <button id="updateComputer" class="btn btn-success">Gép módosítása</button>

                <form>
                    <div class="row mb-3">
                        <label for="computerId" class="col-sm-2 col-form-label">Azonosító</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="computerId">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="computerLocation" class="col-sm-2 col-form-label">Hely</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="computerLocation">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="computerType" class="col-sm-2 col-form-label">Típus</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="computerType">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="computerIP" class="col-sm-2 col-form-label">IP cím</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="computerIP">
                        </div>
                    </div>
                </form>

                <table class="table table-striped mt-2">
                    <figcaption>Telepítések</figcaption>
                    <thead>
                        <tr>
                            <th>Azonosító</th>
                            <th>Szoftver</th>
                            <th>Kategória</th>
                            <th>Verzió</th>
                            <th>Telepítés dátuma</th>
                        </tr>
                    </thead>
                    <tbody id="installations"></tbody>
                    <tfoot>
                        <tr>
                            <th>Azonosító</th>
                            <th>Szoftver</th>
                            <th>Kategória</th>
                            <th>Verzió</th>
                            <th>Telepítés dátuma</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="row" id="insert" style="display: none;">
            <div class="col-12">
                <h4>Számítógép adatai</h4>
                <hr />
                <button class="btn btn-primary backToList">Vissza a listához</button>
                <button id="insertComputer" class="btn btn-success">Számítógép hozzáadása</button>

                <form class="mt-3">

                    <div class="row mb-3">
                        <label for="newComputerLocation" class="col-sm-2 col-form-label">Hely</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="newComputerLocation">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="newComputerType" class="col-sm-2 col-form-label">Típus</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="newComputerType">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="newComputerIP" class="col-sm-2 col-form-label">IP cím</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="newComputerIP">
                        </div>
                    </div>
                </form>
            </div>
        </div>