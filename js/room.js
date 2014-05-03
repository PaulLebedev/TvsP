gCountdown = false;

$(document).ready(function () {
    $("#agree").change(function () {
        if ($("#agree").attr('checked')) {
            $.get("/agree", {'uid':$('#agree').data("id")},
                function (data) {
                    console.log(data);
                    // подсветить своего юзера
                });
        }


    });

    setInterval(function () {
        if (cap)
            $.get("/update-solution?rid=" + gRoom + "&text=" + $('#sol').val(), function (data) {
            });
        else
            $.get("/get-room?rid=" + gRoom, function (data) {
                console.log(data);
                data = JSON.parse(data);
                $("#tSol").html(data["solution"]);

            });


        $.get("/get-users?rid=" + gRoom, function (data) {

            data = JSON.parse(data);

            /*if(currentUsers.length != data.length)
             {*/
            $("#users").empty();
            $(".userBadge").remove();

            for (var i in data) {
                var capLabel = "";
                if (cap && data[i]['user_id'] == viewer_id)
                    capLabel = '<span class="label label-warning">Cap</span>';

                $("#users").append('<div class="userBadge media u-block /* u-block-active */">' +
                    '<a class="pull-left" href="#"> <img class="media-object"' +
                    ' src="http://forum.cosmo.ru/uploads/av-343732.jpg" width="64" height = "64" alt = "" ></a>' +
                    '<div class="media-body"><span class="media-heading"><strong>' + data[i]['user_name'] +
                    '</strong>' + capLabel + '</span><br><small>Exp: 0 | Cha: 0' +
                    '<br> <!--<span class="label label-info">IT</span> -->' +
                    '<span class="label label-success">READY!</span></small></div></div>');

                for (i = 0; i < participantsNumber - data.length; i++)
                    $("#users").append('<div class="media u-block u-block-waiting"><p>Ожидаем участника...</p></div>');
                //}
            }

            if (data.length == participantsNumber) {
                $.get("/launch?rid=" + gRoom, function (data) {
                    if (!gCountdown) {
                        $("#fullDescription").show();
                        countdown('countdown');
                        gCountdown = true;

                    }
                });

            }
        });

    }, 2000);
});