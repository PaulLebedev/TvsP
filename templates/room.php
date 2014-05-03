<script src="//code.jquery.com/jquery-latest.min.js"></script>
<script src="js/room.js"></script>
<link href="../css/room.css" rel="stylesheet">
<script language="JavaScript">
    gRoom = <?= $room['rid'] ?>;
    currentUsers = <?= json_encode($users) ?>;
    participantsNumber = <?= $room['participants'] ?>;
    cap = <? if ($cap) echo 1; else echo 0; ?>;
    viewer_id = <?= $viewer_id ?>;
</script>
<script>
    var interval;
    var minutes = 10;
    var seconds = 0;

    function countdown(element) {
        interval = setInterval(function () {
            var el = document.getElementById(element);
            if (seconds == 0) {
                if (minutes == 0) {
                    el.innerHTML = "Time is over!";
                    clearInterval(interval);
                    return;
                } else {
                    minutes--;
                    seconds = 59;
                }
            }
            if (minutes > 0) {
                var minute_text = minutes + " мин ";
            } else {
                var minute_text = '';
            }
            var second_text = seconds + " сек ";
            el.innerHTML = '<span class="label label-info">' + minute_text + ' ' + second_text + "</span>";
            seconds--;
        }, 1000);
    }
</script>
<div class="container">
    <h1><?= $room["title"] ?></h1>

    <div class="row">
        <div class="col-md-5">
            <h2>Краткое описание</h2>
            <blockquote>
                <p><?= $room["preview"] ?></p>
            </blockquote>


            <div id="fullDescription" <? if ($room['status'] != 'RUNNING') { ?>hidden="hidden" <? } ?>>
                <h2>Полное описание</h2>
                <blockquote>
                    <p><?= $room["description"] ?></p>
                </blockquote>


            <h2>Осталось:
                <div id='countdown' style="display:inline"></div>
            </h2>

            <!--<button type="button" id="loading-example-btn" data-loading-text="I'm ready!" class="btn btn-success">
                I'm ready!
            </button>-->


            <hr>
            <? if ($cap) { ?>
            <div><textarea id="sol" type="text" class="form-control" placeholder="Captain enter your answer"
                           rows="10"></textarea></div>
                <br>
            <center>
                <button type="button" class="btn btn-success"  data-target="#results" data-toggle="modal">Submit</button>
            </center>
            <? } else { ?>
            <b>Решение:</b><br/>
            <div id="tSol"></div>
            <? } ?>
            <br>
            </div>
            <button type="button" class="btn btn-danger"
                    onclick='window.location="/leave-room?rid=<?= $room['rid'] ?>"'>Покинуть команду
            </button>
        </div>
        <div class="col-md-7">

            <h2>Участники</h2>

            <div id="users">

                <?
                if ($users)
                    foreach ($users as $user) {
                        ?>
                        <div class="userBadge media u-block /* u-block-active */">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="img/golova.jpg" width="64"
                                     height="64"
                                     alt="">
                            </a>

                            <div class="media-body">
                    <span class="media-heading"><strong><?= $user['user_name'] ?></strong>
                        <? if ($cap and $user['user_id'] == $viewer_id) echo '<span class="label label-warning">Cap</span>'; ?></span><br>
                                <small>Exp: 0 | Cha: 0 <br> <!--<span class="label label-info">IT</span> -->
                                    <span class="label label-success">READY!</span></small>
                            </div>
                        </div>
                        <?
                    }
                for ($i = 0; $i < ($room['participants'] - count($users)); $i++)
                    echo '<div class="media u-block u-block-waiting">
            <p>Ожидаем участника...</p>
            </div>'
                ?>
            </div>


            <!--<div class="media u-block u-block-waiting">
                <p>Waiting IT...</p>
            </div>
            <div class="media u-block u-block-waiting">
                <p>Waiting Math...</p>
            </div>
            <div class="media u-block u-block-waiting">
                <p>Waiting Erudit...</p>
            </div>-->

            <div style="clear:both"></div>

            <!-- Chat -->
            <iframe src="http://91.210.106.63:8888/chat?username=<?= $user_name ?>&room=Team-<?= $room['rid'] ?>"
                    width="640" height="500" frameBorder="0"></iframe>

        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="results" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Результаты</h4>
                </div>
                <div class="modal-body">
                    <blockquote>Ваш ответ принят и является <font style="color:#4CAE4C; font-weight:bold">верным</font>!</blockquote>
                    Отметьте участников, которые на ваш взгляд внесли максимальный вклад в решение задачи
                    <div style="clear:both;">
                        <div class="media u-block-modal">
                            <img class="media-object pull-left" src="img/golova.jpg" width="64" height="64"  alt="">
                            <div class="media-body">
                                <span class="media-heading"><strong>zavg</strong></span><br>
                                <small>Exp: 0 | Cha: 0 <br> <span class="label label-info">Ling</span></small>
                            </div>
                        </div>
                    </div>

                    <div class="media u-block-modal u-block-active">
                        <img class="media-object pull-left" src="img/golova.jpg" width="64" height="64"  alt="">
                        <div class="media-body">
                            <span class="media-heading"><strong>OT4E</strong></span><br>
                            <small>Exp: 0 | Cha: 0 <br> <span class="label label-info">IT</span></small>
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location='/profile/<?= $viewer_id?> '">ОК</button>

                </div>
            </div>
        </div>
    </div>

</div>
