<html><head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
 <script type="text/javascript">
$(function() {

$(".btn btn-default").click(function() {

var element = $(this);
   
    var test = $("#comment_content").val();
	
    var dataString = 'content='+ test;
	
	
	
	if(test=='')
	{
	alert("Please Enter Some Text");
	
	}
	else
	{
	$("#flash").show();
	$("#flash").fadeIn(400).html('<img src="http://tiggin.com/ajax-loader.gif" align="absmiddle">&nbsp;<span class="loading">Loading Comment...</span>');
	
		
		$.ajax({
		type: "POST",
  url: "comment_cell",
   data: dataString,
  cache: false,
  success: function(html){
  
  
  
    $("#display").after(html);

 document.getElementById('comment_content').value='';
 $("#flash").hide();
	
  }
  
  
});
	}
		

    return false;
	});



});
</script>
</head>
<body>
<table class = "comment_table_cell">
<tr>
<td>

<div id="flash" align="left"  >hhhh</div>
<div id="display" align="left">
	<table class = "comment_table_cell">
		<tr class="comment"><td class="comment_box">
			<div class="media">
			   <a class="pull-left" href="#">
			  <?php echo $this->Html->image('cake.icon.png', array('class' => 'media-object')); ?>
			      
			   </a>
			   <div class="media-body">
			      <h4 class="media-heading">ホンさん</h4>
			      あなたの「卒業」はなんと言いますか？
			   </div>
			</div>
			</td>
		</tr>
	</table>

<table class = "comment_table_cell">
	<tr class="comment"><td class="comment_box">
		<div class="media">
		   <a class="pull-left" href="#">
		      <?php echo $this->Html->image('cake.icon.png', array('class' => 'media-object')); ?>
		   </a>
		   <div class="media-body">
		      <h4 class="media-heading">勤大先生</h4>
		      卒業です。
		      
		   </div>
		   
		</div>
		</td>
	</tr>
</table>
</div>


<div align="left">
	<form  method="post" name="form" action="">
		<table class = "comment_table_cell">
			<tr class = "comment">
			
			        <td class="comment_box">
				        <div class="media">
						   <a class="pull-left" href="#">
						   <?php echo $this->Html->image('cake.icon.png', array('class' => 'media-object')); ?>
						   </a>
						   <div class="media-body">
						     <textarea cols="30" rows="2" name="content" id="comment_content" maxlength="145" placeholder="この下でコメントを書いてください"></textarea><br />
						      
						   </div>
				        </div>
			        
			        </td>
			
			</tr>
		
				<tr class = "comment">
					<td class="comment_box">
						<div class="media">
						<button class="btn btn-default" type="submit">記録</button>
						<input class="btn btn-default" type="button" value="消す">
						<input class="btn btn-default" type="submit" value="変更">
						</div>
					</td>
				</tr>
		
		</table>
	</form>

</div>


</td>
</tr>
</table>
<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
      Dropdown
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li><a href="#">Dropdown link</a></li>
      <li><a href="#">Dropdown link</a></li>
    </ul>
  </div>
</body>
</html>
