<!-- main part -->
<div class="container">
    <!-- filters -->
    <div class="col-md-2">
        <h3>Категории</h3>
        <?php if (!isset($entered)) $entered = null; ?>
        <?php foreach ($categories as $category) : ?>
            <?php $activeClass = $category['name'] == $entered ? 'active' : 'notactive' ?>
            <p><a href="/list/<?php echo $category['name']; ?>"><button class="btn btn-info netch <?php echo $activeClass; ?>" type="button"><?php echo $category['name']; ?></button></a></p>
        <?php endforeach; ?>

        <!--<button class="btn btn-info netch notactive" type="button">IT Tasks</button>
        <button class="btn btn-default btn-math netch notactive" type="button">Mathematics</button>
        <button class="btn btn-danger netch notactive" type="button">Social sciences</button>
        <button class="btn btn-primary netch notactive" type="button">Experimental</button>
        <button class="btn btn-success netch notactive" type="button">Linguistics</button>
        <button class="btn btn-warning netch notactive" type="button">Erudition</button>-->        
    </div>
    <!-- end of filter -->


    <div class="col-md-10">
        <div class="btn-toolbar" role="toolbar">
            <div class="col-md-5 btn-group">
                <div class="input-group">
                    <span class="input-group-addon">ID:</span>
                    <input type="text" class="form-control" placeholder="Enter task's ID">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Поиск</button>
                    </span>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2 btn-group"><button onclick=" location.reload();" class="btn btn-info" type="button">Обновить&nbsp;&nbsp;<span class="glyphicon glyphicon-refresh"></span></button></div>
            <div class="col-md-2 btn-group"><button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Новая задача&nbsp;&nbsp;<span class="glyphicon glyphicon-plus"></span></button></div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Configure room</h4>
                    </div>
                    <div class="modal-body">
                        <h4>Choose category:</h4>                        
                        <form action="/room-create" method="post">
                            <select class="form-control" name="problem_id">
                                <?php foreach ($tasks as $task): ?>
                                    <option value="<?php echo $task['id'] ?>"><?php echo $task['title'] ?></option>
                                <?php endforeach;  ?>
                            </select>
                        <!--<select class="form-control">
                            <option>Mathematics</option>
                            <option>Social sciences</option>
                            <option>Experimental</option>
                            <option>Linguistics</option>
                            <option>Erudition</option>
                        </select><br>-->
                            <!--<h4>Choose task:</h4>
                            <select class="form-control">
                                <option>Kill Bill</option>
                                <option>Shoot em up</option>
                                <option>Die hard</option>
                            </select>
                            <br>
                            <h4>Choose slot:</h4>
                            <select class="form-control">
                                <option>Information technologies</option>
                                <option>Mathematics</option>
                                <option>Social sciences</option>
                                <option>Experimental</option>
                                <option>Linguistics</option>
                                <option>Erudition</option>
                            </select>-->
                            </div>
                            <div class="modal-footer">
                                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                                <!--<button type="button" class="btn btn-success">Enter room!</button>-->
                                <input type="submit" value="Enter room!">
                            </div>
                        </form>
                    </div>
                </div>
            </div>            
            <br>
            <!-- table of tasks -->
            <div class="">
                <table class="table table-hover table-condensed">
                    <?php if (isset($rooms)): ?>
                        <?php if (!$rooms): ?>
                            <p>Ничего не найдено</p>
                        <?php else: ?>
                            <tr>
                                <th style="width: 30px">ID</th>
                                <th>Task name</th>
                                <!--<th style="width: 120px">Specialization</th>-->
                                <th style="width: 140px">Participants</th>
                                <th style="width: 100px">Task rating</th>
                                <th style="width: 90px">Task cost</th>
                                <th style="width: 70px">Mode</th>
                            </tr>
                            <?php foreach ($rooms as $room) : ?>                        
                                <tr>
                                    <td style="vertical-align: top"><a href="/room?rid=<?php echo $room['id']; ?>"><?php echo $room['id']; ?></a></td>
                                    <td>
                                        <h4 style="margin-top:5px"><a href="/room?rid=<?php echo $room['id']; ?>"><?php echo $room['title']; ?></a></h4>
                                        <p class="small"><small><?php echo $room['preview']; ?></small></p>
                                        <!--<span class="label label-default">Uma Turman</span>
                                        <span class="label label-default">Quentin</span>
                                        <span class="label label-default">Comedy</span>
                                        <span class="label label-default">Family</span>-->
                                    </td>
                                    <td style="vertical-align: middle">
                                        <div class="row">
                                            <button class="btn btn-info netch notactive" type="button"><?php echo $room['participants']; ?></button>
                                        </div>
                                        <div class="row">
                                            <button class="btn btn-info netch " type="button">It</button>
                                            <button class="btn btn-default btn-math netch " type="button">Ma</button>
                                            <button class="btn btn-danger netch notactive" type="button">Ss</button>
                                        </div>
                                        <div class="row">
                                            <button class="btn btn-primary netch " type="button">Ex</button>
                                            <button class="btn btn-success netch " type="button">Li</button>
                                            <button class="btn btn-warning netch notactive" type="button">Er</button>
                                        </div> 
                                    </td>
                                    <td style="vertical-align: middle" class="text-center"><?php echo $room['rating']; ?></td>
                                    <td style="vertical-align: middle" class="text-center"><?php echo $room['cost']; ?></td>
                                    <td style="vertical-align: middle" class="text-center"><?php echo $room['mode']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
<!--<tr>
<th>ID</th>
<th>Task name</th>
<th style="width: 120px">Specialization</th>
<th>Task rating</th>
<th>Task cost</th>
<th>Mode</th>
</tr>
<tr>
<td style="vertical-align: middle">{a234}</td>
<td>
<h4>Kill bill</h4>
<p class="small"><small>Kill Bill is an American action/thriller film written and directed by Quentin Tarantino. Kill Bill was originally scheduled for a single theatrical release, but with a running time of over four hours...</small></p>
<span class="label label-default">Uma Turman</span>
<span class="label label-default">Quentin</span>
<span class="label label-default">Comedy</span>
<span class="label label-default">Family</span>
</td>
<td style="vertical-align: middle">
<div class="row">
<button class="btn btn-info netch notactive" type="button">It</button>
<button class="btn btn-default btn-math netch notactive" type="button">Ma</button>
<button class="btn btn-danger netch notactive" type="button">Ss</button>
</div>
<div class="row">
<button class="btn btn-primary netch notactive" type="button">Ex</button>
<button class="btn btn-success netch notactive" type="button">Li</button>
<button class="btn btn-warning netch notactive" type="button">Er</button>
</div> 
</td>
<td style="vertical-align: middle" class="text-center">4.65</td>
<td style="vertical-align: middle" class="text-center">5</td>
<td style="vertical-align: middle" class="text-center">Easy</td>
</tr>
<tr>
<td style="vertical-align: middle">{b734}</td>
<td>
<h4>Shoot 'Em Up</h4>
<p class="small"><small>Shoot 'Em Up is a 2007 action/black comedy film,[1] starring Clive Owen, Paul Giamatti, and Monica Bellucci. The film was written and directed by Michael Davis and produced by...</small></p>
<span class="label label-default">Guns</span>
<span class="label label-default">Bullets</span>
<span class="label label-default">Fun</span>
<span class="label label-default">Family</span>
</td>
<td style="vertical-align: middle">
<div class="row">
<button class="btn btn-info netch notactive" type="button">It</button>
<button class="btn btn-default btn-math netch notactive" type="button">Ma</button>
<button class="btn btn-danger netch notactive" type="button">Ss</button>
</div>
<div class="row">
<button class="btn btn-primary netch notactive" type="button">Ex</button>
<button class="btn btn-success netch notactive" type="button">Li</button>
<button class="btn btn-warning netch notactive" type="button">Er</button>
</div> 
</td>
<td style="vertical-align: middle" class="text-center">8.65</td>
<td style="vertical-align: middle" class="text-center">10</td>
<td style="vertical-align: middle" class="text-center">Medium</td>
</tr>
<tr>
<td style="vertical-align: middle">{z79}</td>
<td>
<h4>Die hard</h4>
<p class="small"><small>Die Hard is a 1988 American action film directed by John McTiernan and written by Steven E. de Souza and Jeb Stuart, based on the 1979 novel Nothing Lasts Forever by...</small></p>
<span class="label label-default">Death</span>
<span class="label label-default">Horror</span>
<span class="label label-default">Bruce</span>
<span class="label label-default">Zed's dead, baby</span>
</td>
<td style="vertical-align: middle">
<div class="row">
<button class="btn btn-info netch notactive" type="button">It</button>
<button class="btn btn-default btn-math netch notactive" type="button">Ma</button>
<button class="btn btn-danger netch notactive" type="button">Ss</button>
</div>
<div class="row">
<button class="btn btn-primary netch notactive" type="button">Ex</button>
<button class="btn btn-success netch notactive" type="button">Li</button>
<button class="btn btn-warning netch notactive" type="button">Er</button>
</div> 
</td>
<td style="vertical-align: middle" class="text-center">6.65</td>
<td style="vertical-align: middle" class="text-center">10</td>
<td style="vertical-align: middle" class="text-center">Hard</td>
</tr>-->                    
                </table>
            </div>
          <!--  <ul class="pagination">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul> -->
        </div>
        <!-- end table of tasks -->
    </div>
    <!-- end of main part -->