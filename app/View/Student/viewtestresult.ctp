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
		  <p>点:<?php echo $hit."/".$total;?></p>
		  <p>終わった時間:<?php echo $time;?>分</p>
		  <p>テストのテーマ:IT日本語</p>
		  
		</div>
		<ul class="nav nav-pills">
			  
			  <li><a href="#">もう一度します</a></li>
			  <li><a href="#">資料を見る</a></li>
			  <li><a href="#">次のテスト</a></li>
			  
			</ul>

	</body>
</html>