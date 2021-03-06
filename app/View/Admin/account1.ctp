?php 
	/**
	*	account.ctp
	*	@author: Hoang Dac
	*	account page of admin
	*/
	//==========================
	//sample data	
	//==========================
	//particular lib
	echo $this->Html->script(array('chartapi','bootstrap-datepicker'));
	echo $this->Html->css('datepicker');
?>
<div class="row">	
	<p class='title'>Money management</p>
</div>
<div class="row">
	<div class="col-md-2 date"><strong> Choose month: </strong></div>
	<div class="col-md-3 date">	
		<input class="form-control" id="dp1" readonly=""/>
	</div>
	<div class="col-md-3 date">	
		<input type='button' id="displayButton" class='btn btn-success' value = 'Display'></input>
	</div>
	<div class="col-md-3 text-right date">	
		 <input type='button' id="exportButton" class='btn btn-success' value = 'Export'></input>
	</div>
</div>
<p></p>
<div>
<table id='account_data' class="table table-bordered table-hover"> 	
 </table>
</div>
<script>
$(document).ready(function(){
	today = new Date();	
    var month = today.getMonth()+1; //January is 0!
    var year = today.getFullYear();    
    var data;		
    var _TYPE_CREDIT_CARD = 18;
    var _TYPE_BANK_ACCOUNT = 54;
    var _STUDENT_PAY_MONEY = 20000;
    var _TEACHER_PROFIT = _STUDENT_PAY_MONEY*60/100;
	data =	 <?php echo $data ?>;				
    function update(data){    	
    	student = data['student'];
	teacher = data['teacher'];	
			var strToAppend = "<tr><th>Username</th><th>Name</th><th>Type</th><th> Money </th><th>Credit card number</th> </tr>";			
			if (data != null){
	 		for (var i in student){
		 			strToAppend += "<tr>";		 			
		 			strToAppend+= "<td>" + student[i]['info']['username']+"</td>";
		 			strToAppend+= "<td>"+student[i]['info']['lastname']+student[i]['info']['firstname']+"</td>";
		 			strToAppend+= "<td>"+_TYPE_CREDIT_CARD+"</td>";
		 			strToAppend+= "<td>"+student[i]['count']*_STUDENT_PAY_MONEY+"</td>";
		 			strToAppend+= "<td>"+student[i]['info']['Student']['credit_account']+"</td>"; 					 			
		 			strToAppend+= "</tr>";
		 		}
	 		
	 		for (var i in teacher){
		 			strToAppend += "<tr>";		 			
		 			strToAppend+= "<td>" + teacher[i]['info']['username']+"</td>";
		 			strToAppend+= "<td>"+teacher[i]['info']['lastname']+teacher[i]['info']['firstname']+"</td>";
		 			strToAppend+= "<td>"+_TYPE_BANK_ACCOUNT+"</td>";
		 			strToAppend+= "<td>"+teacher[i]['count']*_TEACHER_PROFIT+"</td>";
		 			strToAppend+= "<td>"+teacher[i]['info']['Teacher']['bank_account']+"</td>"; 			
		 			strToAppend+= "</tr>";
		 		}
	 		}	 		
	 		$("#account_data").html(strToAppend);	 			 			
	}
	update(data);
	$("#dp1").change(function(){
		alert("ok");
		// $.ajax({
	 // 				type: 'post',
	 // 				data: {data:data},	 						 		
	 // 				url: <?php echo "'".$this->Html->url(array('controller' => 'admin','action' => 'exportAccountFile'))."'" ?>,		 				
	 // 			}).done(function(dt){	 		 					
		// 			alert("Export successfully");		 				
	 // 			}).error(function(){
	 // 				alert("Error was happended while exporting file");
	 // 			});    	

	});
	$("#exportButton").click(function(){	 			
	 			$.ajax({
	 				type: 'post',
	 				data: {data:data},	 						 		
	 				url: <?php echo "'".$this->Html->url(array('controller' => 'admin','action' => 'exportAccountFile'))."'" ?>,		 				
	 			}).done(function(dt){	 		 					
					alert("Export successfully");		 				
	 			}).error(function(){
	 				alert("Error was happended while exporting file");
	 			})    	
	 		}); 		 				
    $("#dp1").datepicker({
    	format:"mm/yyyy",
    	viewMode: 'months',
    	minViewMode: 'months',    	    	
    }); 
    $("#dp1").datepicker('set','today');

    $("#displayButton").click(function(){
    	var param  = $("#dp1").val();
		$.ajax({	 				
	 				data: param,
	 				url: <?php echo "'".$this->Html->url(array('controller' => 'admin','action' => 'getDataForAccount'))."/"."'" ?> + param,
	 				dataType:'json'
	 			}).done(function(dt){
	 				data = dt;
	 				update(dt);	 		 										
	 			}).error(function(){	 				
	 			})
    })
})
</script>