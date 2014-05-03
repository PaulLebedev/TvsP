<div class="container">

    <div class="row">
        <div class="col-md-4">
            <div style="margin-top:30px; text-align:center	">
                <img src="/img/mechnik.jpg" alt="" class="img-thumbnail">
            </div>
        </div>
        <div class="col-md-4">
            <h1><?php echo $userData['user_name'] ?> <span class="label label-info"></span></h1>
            <div class="row">	
                <div class="col-md-2"><span class="label label-warning">Lvl: 0</span></div>
                <div class="col-md-2"><span class="label label-success">Exp: 0</span></div>
                <div class="col-md-2"><span class="label label-info">Cha: 0</span></div>
            </div>
            <div class="row">
                <div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Skill</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>IT</td>
                                <td><span class="badge">0</span></td>
                                <td><!--progress bar --></td>					
                            </tr>
                            <tr>
                                <td>Математика</td>
                                <td><span class="badge">0</span></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Социальные науки</td>
                                <td><span class="badge">0</span></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Экспериментальные науки</td>
                                <td><span class="badge">0</span></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Лингвистика</td>
                                <td><span class="badge">0</span></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Эрудиция</td>
                                <td><span class="badge">0</span></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-md-4" >
            <div style="margin-top:125px; padding:10px; background:#dfdfdf">
                <a href=""><span class="glyphicon glyphicon-pencil"></span> Редактировать</a>

                <dl class="dl-horizontal">
                    <dt>Имя</dt>
                    <dd><?php echo $userData['user_name'] ?></dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>E-mail</dt>
                    <dd><?php echo $userData['user_email'] ?></dd>
                </dl>
            </div>
        </div>
    </div>

    <hr>
    <div class="row">

    </div>

    <hr>

    <h2>Успехи</h2>
    <table class="table table-striped">
        <thead>
            <tr>

                <th>Дата</th>
                <th>Задача</th>
                <th>Сложность</th>

                <th>Очки</th>
            </tr>
        </thead>
        <tbody>
            <tr>

                <td>02.05.2014</td>
                <td>Главный вопрос<br><small><i> </i></small></td>
                <td>Hard</td>

                <td><span class="label label-success">50</span></td>
            </tr>
            <tr>

                <td>02.05.2014</td>
                <td>Пятерки<br><small><i> </i></small></td>
                <td>Easy</td>

                <td><span class="label label-success">10</span></td>
            </tr>

        <td>02.05.2014</td>
        <td>Сколько секунд до войны?<br><small><i> </i></small></td>
        <td>Easy</td>

        <td><span class="label label-warning">Проверяется</span></td>
        </tr>
        </tbody>
    </table>
    <!--<ul class="pagination">
        <li class="disabled"><a href="#">&laquo;</a></li>
        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
        <li><a href="#">2 <span class="sr-only">(current)</span></a></li>
        <li><a href="#">&raquo;</a></li>
    </ul>-->
</div>