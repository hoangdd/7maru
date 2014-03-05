<h1>Create new Lesson</h1>

<div class="form-wrapper">
    <form class="form-horizontal" method="post" action="#">
        <div class="form-group row">
            <label class="control-label col-sm-4" for="lesson_type">Category</label>
            <div class="col-sm-3" style="height: 300px;overflow-y: scroll;">
<!--
                <select class="form-control" id="lesson_type" name="category">
                  <?php  
//                    foreach ($categories as $category){
////                        debug($category);die;
//                        echo "<option>".$category["Category"]["name"]."</option>";   
//                    }            
                    ?>
                </select>
-->
                <?php foreach ($categories as $category){ ?>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="checkbox" value= <?php echo '"'.$category["Category"]["category_id"].'"'; ?> name= "category[]">
                        </span>
                        <label class="form-control bg-success" ><?php echo $category["Category"]["name"] ?></label>
                    </div>
                <?php } ?>
                    
                
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-sm-4" for="lesson_type">Different Category</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="inputEmail3" placeholder="Category" name="other_category">
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-sm-4" for="lesson_type">Lesson Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Enter Lesson Name" name="name">
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-sm-4" for="lesson_type">Description</label>
            <div class="col-sm-8">
                <textarea class="form-control" rows="3" name="desc"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-sm-4" for="lesson_type">Document</label>
            <div class="col-sm-8">
                <input type="file" name="document">
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-sm-4" for="lesson_type">Test File</label>
            <div class="col-sm-8">
                <input type="file" name="test">
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-sm-4" for="lesson_type">Lesson Image</label>
            <div class="col-sm-8">
                <input type="file" name="image">
                <img src="/7maru/img/profile.jpg" height="140" width="140" alt="Lesson Image" class="img-thumbnail">
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-sm-4" for="lesson_type">Test File Format</label>
            <div class="col-sm-8">
                <a class="btn btn-link"  href="#"><span class="glyphicon glyphicon-download-alt"></span>   Download Here</a>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-sm-4" for="lesson_type">Copyright</label>
            <div class="col-lg-3">
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="checkbox" value="true" name="copyright">
                    </span>
                    <label class="form-control bg-success" >Confirm</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-sm-4" for="lesson_type"></label>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-lg-6">
                        <input type="submit" class="btn btn-success btn-lg btn-block" value="Create">
<!--                            <span class="glyphicon glyphicon-floppy-disk"></span> -->
                    </div>
                    <div class="col-lg-6">
                        <button type="button" class="btn btn-danger btn-lg btn-block">
                            <span class="glyphicon glyphicon-refresh"></span> 
                            Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
    </form>
</div>