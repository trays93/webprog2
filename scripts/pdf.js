let baseUrl = `http://${window.location.hostname}/Pdf`;
let result = [];

function rooms() {
    $(".adat").html("");
    $("#send").css({"visibility" : "hidden"});
    $.post(
        `${baseUrl}/getRooms`,
        {},
        function(data) {
            $("<option>").val("0").text("Válasszon termet...").appendTo("#roomSelect");
            var lista = data.lista;
            for(i=0; i<lista.length; i++)
                $("#roomSelect").append('<option>'+lista[i].data+'</option>');
        },
        "json"                                                    
    );
};

function ips() {
    $(".adat").html("");
    $("#ipSelect").html("");
    $("#softwareSelect").html("");
    $("#send").css({"visibility" : "hidden"});
    var room = $("#roomSelect").val();
    if (room != "Válasszon termet..") {
        $.post(
            `${baseUrl}/getIps`,
            {"hely" : room},
            function(data) {
                $("#ipSelect").html('<option value="0">Válasszon IP-címet...</option>');
                var lista = data.lista;
                for(i=0; i<lista.length; i++)
                    $("#ipSelect").append('<option value="'+lista[i].id+'">'+lista[i].data+'</option>');
            },
            "json"                                                    
        );
    }
}

function softwares() {
    $("#softwareSelect").html("");
    $("#send").css({"visibility" : "hidden"});
    $(".adat").html("");
    var gid = $("#ipSelect").val();
    if (gid != 0) {
        
        $.post(
            `${baseUrl}/getSoftwares`,
            {"gid" : gid},
            function(data) {
                $("#softwareSelect").html('<option value="0">Válasszon szoftvert...</option>');
                var lista = data.lista;
                for(i=0; i<lista.length; i++)
                    $("#softwareSelect").append('<option value="'+lista[i].id+'">'+lista[i].data+'</option>');
            },
            "json"                                                    
        );
    }
    
}

function all() {
    $(".adat").html("");
    $("#send").css({"visibility" : "hidden"});
    var softwareid = $("#softwareSelect").val();
    var ipid = $("#ipSelect").val();
    var softwareid = $("#softwareSelect").val();
    if (softwareid != 0 && ipid != 0) {
        $.post(
            `${baseUrl}/getAll`,
            {"sid" : softwareid, "gid" : ipid},
            function(data) {
                result = data;
                $("#send").css({"visibility" : "visible"});
                $("#text").val(data.data);
            },
            "json"                                                    
        );
    }
}

$(document).ready(function() {
   rooms();
   
   $("#roomSelect").change(ips);
   $("#ipSelect").change(softwares);
   $("#softwareSelect").change(all);
   
   }
);