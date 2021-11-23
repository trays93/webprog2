<div class="row justify-content-center">
    <div class="col-4 mt-5">
        <select id="roomSelect" class="form-select" aria-label="Default select example" required></select>
        <select id="ipSelect" class="form-select" aria-label="Default select example" required></select>
        <select id="softwareSelect" class="form-select" aria-label="Default select example" required></select>
        <form action="/Pdf/create" method="POST">
            <input type="text" id="text" name="text" class="form-control" style="display: none;"> 
            <button type="submit" id="send" class="btn btn-primary">Pdf létrehozása</button>
        </form>
    </div>
</div>