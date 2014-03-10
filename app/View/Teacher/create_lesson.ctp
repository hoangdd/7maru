<form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">タイプ</label>
    <div class="col-sm-10">
      <select class="form-control">
		  <option>日本語</option>
		  <option>英語</option>
		  <option>数学</option>
		  <option>物理学</option>
		  <option>科学</option>
		</select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">他のタイプ</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputPassword3" placeholder="他のタイプ">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">授業の名前</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputPassword3" placeholder="授業の名前">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">授業の情報</label>
    <div class="col-sm-10">
      <textarea class="form-control" cols="5" rows="10" placeholder="Message" style="height: auto;" id="MessageBox">123456789   12345678912 35 6123</textarea>
    </div>
  </div>
  
  <div class = "form-group">
  <div class="col-sm-offset-2 col-sm-10">
  <label for="inputPassword3" class="">資料をアップロード</label>
  	<div class="input-group-btn">
  	<span class="glyphicon glyphicon-paperclip"></span>
                <a class="btn btn-default btn-file">
                	
                    <input type="file" class="file-input"/></a>
                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
            </div>
  	</div>
  </div>
  
  
  <div class = "form-group">
  
  <div class="col-sm-offset-2 col-sm-10">
  <label for="inputPassword3" class="">テストをアップロード</label>
  	<div class="input-group-btn">
  	<span class="glyphicon glyphicon-paperclip"></span>
                <a class="btn btn-default btn-file">
                	
                    <input type="file" class="file-input"/></a>
                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
            </div>
            
  	</div>
  	
  </div>
  
  <div class = "form-group">
  
	  <div class="col-sm-offset-2 col-sm-10">
	  <label for="inputPassword3" class="">授業のイメージ</label>
	  <?php echo $this->Html->image('cake.icon.png', array('class' => 'img-rounded')); ?>
	  	</div>
  	
  </div>
  
  <div class = "form-group">
  
	  <div class="col-sm-offset-2 col-sm-10">
	  <a href="https://facebook.com" class="btn btn-primary btn-lg active" role="button">テストのフォーマットをダウンロード</a>
	  
	  	</div>
  	
  </div>
  
  <div class="form-group">
	  
  
    <div class="col-sm-offset-2 col-sm-10">
    
        <label>
          <input type="checkbox"> Copyrightを認証する
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">作る</button>
      <button type="submit" class="btn btn-primary">リフレッシュ</button>
    </div>
  </div>
</form>




