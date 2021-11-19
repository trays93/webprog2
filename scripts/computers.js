function Gep(id, hely, tipus, ipcim) {
    this.id = id;
    this.hely = hely;
    this.tipus = tipus;
    this.ipcim = ipcim;
    this.telepitesek = [];

    this.addTelepites = function(telepites) {
        this.telepitesek.push(telepites);
    }
}

function Szoftver(id, nev, kategoria) {
    this.id = id;
    this.nev = nev;
    this.kategoria = kategoria;
}

function Telepites(id, szoftver, verzio, datum) {
    this.id = id;
    this.szoftver = szoftver;
    this.verzio = verzio;
    this.datum = datum;
}

function App(listView, detailsView, insertView, table, installations) {
    this.listView = listView;
    this.detailsView = detailsView;
    this.insertView = insertView;
    this.table = table;
    this.installations = installations;
    this.computers = [];
    this.softwares = [];

    this.loadData = function() {
        this.table.empty();

        this.computers.forEach(c => {
            let row = $('<tr></tr>');
            let detailsButton = $(`<button class="btn btn-warning btn-sm bg-warning mr-2" data-computer-id="${c.id}">Megnyit</button>`);
            detailsButton.on('click', this.computerDetails);

            
            let deleteButton = $(`<button class="btn btn-danger btn-sm bg-danger" data-computer-id="${c.id}">Töröl</button>`);
            deleteButton.on('click', this.deleteComputer);

            $(`<td>${c.id}</td><td>${c.hely}</td><td>${c.tipus}</td><td>${c.ipcim}</td>`).appendTo(row);
            detailsButton.appendTo(row);
            deleteButton.appendTo(row);

            row.appendTo(this.table);
        });
    }

    this.computerDetails = function() {
        installations.empty();

        let computerId = $(this).attr('data-computer-id');

        $.ajax({
            url: `${baseUrl}/getComputer/${computerId}`,
            type: 'GET',
            dataType: 'json'
        }).done(function (result) {
            console.clear();
            console.info(result);
            console.table(result.telepitesek);
            $('#computerId').val(result.id);
            $('#computerLocation').val(result.hely);
            $('#computerType').val(result.tipus);
            $('#computerIP').val(result.ipcim);

            result.telepitesek.forEach(t => {
                let row = $('<tr></tr>');
                $(`<td>${t.id}</td><td>${t.szoftver.nev}</td><td>${t.szoftver.kategoria}</td><td>${t.verzio}</td><td>${t.datum}</td>`).appendTo(row);
                row.appendTo(installations);
            });

            window.scrollTo({ top: 0, behavior: 'smooth' });
            listView.hide();
            detailsView.show();
            insertView.hide();
        });
    }

    this.insertComputer = function(computer) {
        $.ajax({
            url: `${baseUrl}/insertComputer`,
            type: 'POST',
            dataType: 'json',
            data: JSON.stringify(computer)
        }).done(function (result) {
            console.clear();
            console.info(result);
            console.table(result.telepitesek);
            $('#computerId').val(result.id);
            $('#computerLocation').val(result.hely);
            $('#computerType').val(result.tipus);
            $('#computerIP').val(result.ipcim);

            result.telepitesek.forEach(t => {
                let row = $('<tr></tr>');
                $(`<td>${t.id}</td><td>${t.szoftver.nev}</td><td>${t.szoftver.kategoria}</td><td>${t.verzio}</td><td>${t.datum}</td>`).appendTo(row);
                row.appendTo(installations);
            });
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
            listView.hide();
            detailsView.show();
            insertView.hide();
        });
    }

    this.updateComputer = function(computer) {
        let computerId = computer.id;

        $.ajax({
            url: `${baseUrl}/updateComputer/${computerId}`,
            type: 'PUT',
            dataType: 'json',
            data: JSON.stringify(computer)
        }).done(function (result) {
            console.clear();
            console.info(result);
            console.table(result.telepitesek);
            $('#computerId').val(result.id);
            $('#computerLocation').val(result.hely);
            $('#computerType').val(result.tipus);
            $('#computerIP').val(result.ipcim);

            result.telepitesek.forEach(t => {
                let row = $('<tr></tr>');
                $(`<td>${t.id}</td><td>${t.szoftver.nev}</td><td>${t.szoftver.kategoria}</td><td>${t.verzio}</td><td>${t.datum}</td>`).appendTo(row);
                row.appendTo(installations);
            });
        });
    }

    this.deleteComputer = function() {
        let userResponse = confirm('Biztosan törölni akarod ezt a számítógépet?');
        if (!userResponse) return;

        let computerId = $(this).attr('data-computer-id');

        $.ajax({
            url: `${baseUrl}/deleteComputer/${computerId}`,
            type: 'DELETE',
            dataType: 'json'
        }).done(function (result) {
            getComputers();
        });
    }   
}

let baseUrl = `http://${window.location.hostname}/ComputersRest`;
let app = null;

function getComputers() {
    $.ajax({
        url: `${baseUrl}/getComputers`,
        type: 'GET',
        dataType: 'json'
    }).done(function (result) {
        app.computers = result;
        app.loadData();
        console.clear();
        console.table(app.computers);

        app.detailsView.hide();
        app.listView.show();
        app.insertView.hide();
    });
}

function showNewComputerView() {
    app.detailsView.hide();
    app.listView.hide();
    app.insertView.show();
}

function updateComputer() {
    let id = $('#computerId').val();
    let location = $('#computerLocation').val();
    let type = $('#computerType').val();
    let ip = $('#computerIP').val();

    if (id !== '' && location !== '' && type !== '' && ip !== '') {
        let computer = new Gep(id, location, type, ip);
        app.updateComputer(computer);
    } else {
        alert('Minden mező kitöltése kötelező!');
        return;
    }
}

function insertComputer() {
    let location = $('#newComputerLocation').val();
    let type = $('#newComputerType').val();
    let ip = $('#newComputerIP').val();

    if (location !== '' && type !== '' && ip !== '') {
        let computer = new Gep(0, location, type, ip);
        app.insertComputer(computer);
    } else {
        alert('Minden mező kitöltése kötelező!');
        return;
    }
}

$(document).ready(function() {
    app = new App($('#list'), $('#details'), $('#insert'), $('#computersTable'), $('#installations'));
    $('#getComputers').on('click', getComputers);
    $('.backToList').on('click', getComputers);
    $('#newComputer').on('click', showNewComputerView);
    $('#updateComputer').on('click', updateComputer);
    $('#insertComputer').on('click', insertComputer);
    getComputers();
});
