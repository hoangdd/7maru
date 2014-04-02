<div id="searchBoxContainer" class="container">
    <form role="form" method="get" action="/7maru/search" id="searchForm" class="form-horizontal">
        <div class="row mainSearchBox">
            <div class="col-xs-9">
                <input class="form-control input-lg" placeholder="Enter Query" type="text" name="string" >
            </div>
            <button type="submit" value="Search" class="btn btn-lg btn-primary">
            <span class="glyphicon glyphicon-search"></span>  <?php echo __('Search') ?>
            </button>
        </div>
        <p></p>
        <div class="row">
            <div class="col-lg-3">
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="checkbox" value="" name="" checked>
                    </span>
                    <label class="form-control bg-success" >授業</label>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="checkbox" value="" name="" checked>
                    </span>
                    <label class="form-control bg-success">先生</label>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="checkbox" value="" name="" checked>
                    </span>
                    <label class="form-control bg-success">学生</label>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="input-group bg-success  ">
                    <span class="input-group-addon">
                        <input type="checkbox" value="" name="" checked>
                    </span>
                    <label class="form-control bg-success">コメント</label>
                </div>
            </div>
        </div>
        <p></p>
        
        <div class="row">
            <div class="col-lg-3">
                <select class="form-control">
                  <option>カテゴリ</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
            </div>
            <div class="col-lg-3">
                <select class="form-control">
                  <option>言語</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
            </div>
            <div class="col-lg-3">
                <select class="form-control">
                  <option>時間</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
            </div>
            <div class="col-lg-3">
                <select class="form-control">
                  <option>評価点</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
            </div>
        </div>
    </form>
</div>
<!--/* Result Box */-->
<!--// Sensei-->
<div class="lesson-list list-group" style="margin-top: 20px">
        <div class="media list-group-item">
            <div class="pull-left col-xs-3">
                <div class="img" title = "Lesson Name" data-toggle="tooltip" data-placement="left">
                    <a href="">
                        <img src="/7maru/img/profile.jpg" height="140" width="140" alt="Lesson Image" class="img-thumbnail">
                    </a>
                </div>
                <div class="star center-block" style="padding: 5px">
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                </div>
            </div>
            <div class="media-body">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo __('Lesson Name - Teacher Name') ?></h3>
                    </div>
                    <div class="panel-body">
                        <?php echo __('Description') ?>
                    </div>
                </div>
                <button type="button" class="btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-shopping-cart"></span> <?php echo __('Buy') ?>
                </button>
                <button type="button" class="btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-shopping-cart"></span> <?php echo __('Action') ?>
                </button>
                <button type="button" class="btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-shopping-cart"></span> <?php echo __('Action') ?>
                </button>
            </div>
        </div>
        
        <div class="media list-group-item">
            <div class="pull-left col-xs-3">
                <div class="img" title = "Lesson Name" data-toggle="tooltip" data-placement="left">
                    <a href="">
                        <img src="/img/profile.jpg" height="140" width="140" alt="Lesson Image" class="img-thumbnail">
                    </a>
                </div>
                <div class="star center-block" style="padding: 5px">
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                </div>
            </div>
            <div class="media-body">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo __('Lesson Name - Teacher Name') ?></h3>
                    </div>
                    <div class="panel-body">
                        <?php echo __('Description') ?>
                    </div>
                </div>
                <button type="button" class="btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-shopping-cart"></span> <?php echo __('Buy') ?>
                </button>
            </div>
        </div>
        <div class="media list-group-item">
            <div class="pull-left col-xs-3">
                <div class="img" title = "Lesson Name" data-toggle="tooltip" data-placement="left">
                    <a href="">
                        <img src="/img/profile.jpg" height="140" width="140" alt="Lesson Image" class="img-thumbnail">
                    </a>
                </div>
                <div class="star center-block" style="padding: 5px">
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                </div>
            </div>
            <div class="media-body">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo __('Lesson Name - Teacher Name') ?></h3>
                    </div>
                    <div class="panel-body">
                        <?php echo __('Description') ?>
                    </div>
                </div>
                <button type="button" class="btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-shopping-cart"></span> <?php echo __('Buy') ?>
                </button>
            </div>
        </div>
        
    </div>
<iframe src="http://docs.google.com/viewer?url=%20http%3A%2F%2Fresearch.google.com%2Farchive%2Fbigtable-osdi06.pd&embedded=true" width="600" height="780" style="border: none;"></iframe>