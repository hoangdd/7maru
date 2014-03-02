<html>
	<head>
			<style>
				h1
				{
					color:orange;
					text-align:center;
				}
				p
				{
					font-family:"Times New Roman";
					font-size:20px;
				}
			</style>
	</head>

	<body>
	
		<h1>結果</h1>
		<div class="jumbotron">
		  <p>点:10/10</p>
		  <p>終わった時間:10分</p>
		  <p>テストのテーマ:IT日本語</p>
		  
		</div>
		<ul class="nav nav-pills">
			  
			  <li><a href="#">もう一度します</a></li>
			  <li><a href="#">資料を見る</a></li>
			  <li><a href="#">次のテスト</a></li>
			  
			</ul>
	<h1>You can't select this text by accident!</h1>
	<button>
	<?php echo $this->Html->image('cake.icon.png', array('id' => 'draggingDisabled')); ?>
	</button>
	<script type = "text/javascript">
		window.onload = init;
 
		function init() {
		  disableDraggingFor(document.getElementById("draggingDisabled"));
		}
		 
		function disableDraggingFor(element) {
		  // this works for FireFox and WebKit in future according to http://help.dottoro.com/lhqsqbtn.php
		  element.draggable = false;
		  // this works for older web layout engines
		  element.onmousedown = function(event) {
		                event.preventDefault();
		                return false;
		              };
}
	</script>
	
	<object data="/home/khaclinh/Download/DS_kqxetDATN20132.pdf" type="application/pdf">
                <embed src=" /home/khaclinh/Download/DS_kqxetDATN20132.pdf" type="application/pdf">&nbsp; </embed>
                    alt :<a href="/home/khaclinh/Download/DS_kqxetDATN20132.pdf">
                </object>
	</body>
</html>