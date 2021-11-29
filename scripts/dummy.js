let baseUrl = 'https://dummyapi.io/data/v1/user';
let appId = '61a510ed2ce5cb82f59fd850';

function User(id, title, firstName, lastName, email) {
    this.id = id;
    this.firstName = firstName;
    this.lastName = lastName;
    this.title = title;
    this.email = email;

    this.toString = function() {
        return `${this.title}. ${this.firstName} ${this.lastName}`;
    }
}

function App(listView, detailsView, insertView, table) {
    this.listView = listView;
    this.table = table;

    this.users = [];
    this.selectedUser = null;

    this.getUsers = function() {
        $.ajax({
            url: baseUrl,
            type: 'GET',
            dataType: 'json',
            headers: {
                'app-id': appId
            }
        }).done(function(result) {
            listView.show();
            detailsView.hide();
            insertView.hide();
            table.empty();

            users = result.data;

            users.forEach(u => {
                let row = $('<tr></tr>');
                let buttons = $(`<td></td>`);
                let detailsButton = $(`<button class="btn btn-warning btn-sm bg-warning mr-2" data-user-id="${u.id}">Megnyit</button>`);
                detailsButton.on('click', app.getUser);

                let deleteButton = $(`<button class="btn btn-danger btn-sm bg-danger" data-user-id="${u.id}">Töröl</button>`);
                deleteButton.on('click', app.deleteUser);

                $(`<td>${u.id}</td><td>${u.title}</td><td>${u.firstName}</td><td>${u.lastName}</td>`).appendTo(row);
                detailsButton.appendTo(buttons);
                deleteButton.appendTo(buttons);
                buttons.appendTo(row);
                row.appendTo(table);
            });
            
        });
    }

    this.getUser = function() {
        const userId = $(this).attr('data-user-id');
        const url = `${baseUrl}/${userId}`;

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            headers: {
                'app-id': appId
            }
        }).done(function(result) {
            listView.hide();
            detailsView.show();
            insertView.hide();

            app.selectedUser = new User(result.id, result.title, result.firstName, result.lastName, result.email);

            $('#user').text(`${app.selectedUser.toString()} adatai`);
            $('#userId').val(app.selectedUser.id);
            $('#firstName').val(app.selectedUser.firstName);
            $('#lastName').val(app.selectedUser.lastName);
            $('#email').val(app.selectedUser.email);
        });
    }

    this.updateUser = function() {
        let id = $('#userId').val();
        let firstName = $('#firstName').val();
        let lastName = $('#lastName').val();
        let email = $('#email').val();

        const url = `${baseUrl}/${id}`;

        if (id !== '' && firstName !== '' && lastName != '' && email !== '') {
            $.ajax({
                url: url,
                type: 'PUT',
                dataType: 'json',
                headers: {
                    'app-id': appId
                },
                data: {
                    "firstName": firstName,
                    "lastName": lastName,
                    "email": email
                }
            }).done(function(result) {
                app.selectedUser = new User(result.id, result.title, result.firstName, result.lastName, result.email);

                $('#user').text(`${app.selectedUser.toString()} adatai`);
                $('#userId').val(app.selectedUser.id);
                $('#firstName').val(app.selectedUser.firstName);
                $('#lastName').val(app.selectedUser.lastName);
                $('#email').val(app.selectedUser.email);
            });
        } else {
            alert('Minden mező kitöltése kötelező!');
            return;
        }
    }

    this.insertUser = function() {
        let firstName = $('#newFirstName').val();
        let lastName = $('#newLastName').val();
        let email = $('#newEmail').val();

        const url = `${baseUrl}/create`;

        if (firstName !== '' && lastName != '' && email !== '') {
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                headers: {
                    'app-id': appId
                },
                data: {
                    "firstName": firstName,
                    "lastName": lastName,
                    "email": email
                }
            }).done(function(result) {
                listView.hide();
                detailsView.show();
                insertView.hide();

                app.selectedUser = new User(result.id, result.title, result.firstName, result.lastName, result.email);

                $('#user').text(`${app.selectedUser.toString()} adatai`);
                $('#userId').val(app.selectedUser.id);
                $('#firstName').val(app.selectedUser.firstName);
                $('#lastName').val(app.selectedUser.lastName);
                $('#email').val(app.selectedUser.email);
            });
        } else {
            alert('Minden mező kitöltése kötelező!');
            return;
        }
    }

    this.deleteUser = function() {
        let userResponse = confirm('Biztosan törölni akarod ezt a felhasználót?');
        if (!userResponse) return;

        const userId = $(this).attr('data-user-id');
        const url = `${baseUrl}/${userId}`;

        $.ajax({
            url: url,
            type: 'DELETE',
            dataType: 'json',
            headers: {
                'app-id': appId
            }
        }).done(function(result) {
            app.getUsers();
        });
    }

    this.showNewUser = function() {
        listView.hide();
        detailsView.hide();
        insertView.show();
    }
}

let app = null;

$(document).ready(function() {
    app = new App(
        $("#usersList"),
        $('#userDetails'),
        $('#insertUser'),
        $("#usersTable")
    );

    app.getUsers();

    $('.backToList').on('click', app.getUsers);
    $('#getUsers').on('click', app.getUsers);
    $('#updateUser').on('click', app.updateUser);
    $('#newUser').on('click', app.showNewUser);
    $('#addUser').on('click', app.insertUser);
});
