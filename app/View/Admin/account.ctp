<?php 
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
	data = <?php echo $data ?>;			
    function update(data){    	
			var strToAppend = "<tr><th>Purchased date</th><th>Username</th><th>Name</th><th>Credit card number</th> </tr>";
			if (data != null){
	 		for (var i = 0; i< data.length; i++){
		 			strToAppend += "<tr>";
		 			strToAppend+= "<td>"+data[i]['ComaTransaction']['created']+"</td>";
		 			strToAppend+= "<td>" + data[i]['User']['username']+"</td>";
		 			strToAppend+= "<td>"+data[i]['User']['lastname']+data[i]['User']['firstname']+"</td>";
		 			strToAppend+= "<td>"+data[i]['User']['Student']['credit_account']+"</td>"; 			
		 			strToAppend+= "</tr>";
		 		}
	 		}
	 		$("#account_data").html(strToAppend);	 			 			
	}
	update(data);
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