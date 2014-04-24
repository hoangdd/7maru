<?php
	// echo var_dump($courses);
?>
<div class="learning-course panel panel-danger">
	<div class="panel-heading">
    	<h3 class="panel-title">概要情報</h3>
  	</div>
	<table class = "table-hover table-striped table">
		<tr>
			<td>授業を買うためのお金</td>
			<td><?php echo $spentMoney.' VND' ;?></td>
		</tr>
		<tr>
			<td>買った授業の数</td>
			<td><?php echo count($courses).' コース' ;?></td>
		</tr>
		<tr>
			<td>レポートしたコース数</td>
			<td><?php echo count($reported_lessons).' コース' ;?></td>
		</tr>
		<tr>
			<td>ブロック数</td>
			<td><?php echo count($blockeds).' ケース' ;?></td>
		</tr>
		<tr>
			<td>レートした授業の数</td>
			<td><?php echo count($rates).' コース' ;?></td>
		</tr>
		<tr>
			<td>コメントした数</td>
			<td><?php echo count($comments).' コメント' ;?></td>
		</tr>
	</table>
</div>
<!-- Bill List================================================= -->
<div class="row">
            <?php echo "<p class='title'>". __("Bill List").":"."</p>"; ?>
              <div class="col-sm-8 multiselect" style="height: 300px;overflow-y: scroll;">
                <div class = "input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-search"></span>
                    </span>
                    <input type = "text" id = "search-bill" class = "form-control">
                   <!--  <div>
                        <button class = "btn btn-primary" id = "search-button">Search</button>
                    </div> -->
                </div>

                <table id="bill-list-table" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th class="danger"><label><input type="checkbox"><?php echo __('Check'); ?></label></th>
                      <th class="danger "><label><?php echo __('Created Date')?></label></th>
                      <th class="danger"><label><?php echo __('Lesson')?></label></th>
                      <th class="danger"><label><?php echo __('Teacher')?></label></th>
                      <th class="danger"><label><?php echo __('Money')?></label></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 0; foreach ($billList as $bill){ ?>
                      <tr>
                        <td class="check_box">
                          <span>
                            <label><input class="send-checkbox" type="checkbox" name= <?php echo '"'.$bill["LessonTransaction"]["transaction_id"].'"'; ?>>
                            </label>
                          </span>
                        </td>
                        <td><?php echo $bill['LessonTransaction']['created'];?></td>
                        <td><?php echo $this->Html->link($bill['Lesson']['name'],array('controller' => 'Lesson','action' => 'index',$bill['Lesson']['coma_id']));?></td>
                        <td><?php echo $this->Html->link($teacherList[$i],array('controller' => 'Teacher','action' => 'Profile',$bill['Lesson']['author']));?></td>
                        <td><?php echo $bill['LessonTransaction']['money'];?></td>
                      </tr>
                    <?php $i++;}?>
                  </tbody>
                </table>
              </div>
              <div class="form-group">
                        <button id='total-money-btn' class="btn btn-success"><?php echo __('Total') ?></button>
                        <div id='total-money-btn-result'></div>
              </div>
          </div>
<script type="text/javascript">

  $(document).ready(function(){

      var billList =$.parseJSON('<?php echo json_encode($billList);?>');

      $('#search-bill').on('input',function(e){
                hide_row_with($(this).val());
      });

       $("th input").click(function(){
            var status = $(this).prop('checked');      
            
            $(".check_box input").each(function(){
                if($(this).is(":visible")) $(this).prop('checked',status);
            });
      })

      $(".check_box input").click(function(){
            $("th input").prop('checked',false);
      })

      $('#total-money-btn').click(function(){
        
        var total=0;
        var id;
        $(".send-checkbox").each(function(){
            //danh sach tat ca the co' class = send-checkbox
            if($(this).prop('checked')==true){
                // them vao mang ids tat ca nhung user_id ma co' check
                id = $(this).prop('name');
                for (var x=0; x<billList.length; x++){
                  if(billList[x]['LessonTransaction']['transaction_id'] == id)
                    total = total + parseInt(billList[x]['LessonTransaction']['money']);
                }
                
            }
        });
        $('#total-money-btn-result').text(total + " VND");
      });

      function hide_row_with(key){
            $('#bill-list-table tr').each(function(index){
                if(index){
                    if(this.innerText.indexOf(key) == -1){
                        $(".send-checkbox").prop('checked',false);
                        $(this).hide();
                    } else {
                        $(this).show();
                    }    
                }
            });
        }
});
</script>
<!--=========================================================== -->
<div class="learning-course panel panel-danger">
	<div class="panel-heading">
    	<h3 class="panel-title">勉強時間が残る授業</h3>
  	</div>
	<div class='row panel-body' style = 'overflow-x: auto'>
			<!-- <div class="thumbnail"> -->
				
	<?php 
		foreach ($courses as $course) {
			// echo var_dump($course);
			if($course['learn_able'] === true){
	?>
			<div class='text-center left-col col-sm-3 col-md-3'>
			<?php
				// echo var_dump($course);
				$lesson = $course['lesson']; 
				$cover = LESSON_COVER_LINK.$lesson['Lesson']['cover'];
			     echo $this->Html->image($cover,array(
			      'class' => 'img-rounded img-thumbnail img-responsive',        
			      'style' => 'margin:auto'
			      )); 
			     // echo "<h3 style = 'font-weight:bold;color:red'>".$lesson['Lesson']['name'].'</h3>';
			 ?>
				 <div class="caption">
			        <h3><?php echo $this->Html->link($lesson['Lesson']['name'],array(
			        											'controller' => 'Lesson',
			        											'action' => 'index',
			        											$lesson['Lesson']['coma_id']
			        	)); ?>
			    	</h3>
				</div>
			</div>
		
	<?php	
			}	
		}
	?>
	</div>
</div>

<div class="learning-course panel panel-info">
	<div class="panel-heading">
    	<h3 class="panel-title">いま勉強できない授業(買った授業)</h3>
  	</div>
	<div class='row panel-body' style = 'overflow-x: auto'>
			<!-- <div class="thumbnail"> -->
				
	<?php 
		foreach ($courses as $course) {
			// echo var_dump($course);
			if($course['learn_able'] === false){
	?>
			<div class='text-center left-col col-sm-3 col-md-3'>
			<?php
				// echo var_dump($course);
				$lesson = $course['lesson']; 
				$cover = LESSON_COVER_LINK.$lesson['Lesson']['cover'];
			     echo $this->Html->image($cover,array(
			      'class' => 'img-rounded img-thumbnail img-responsive',        
			      'style' => 'margin:auto'
			      )); 
			     // echo "<h3 style = 'font-weight:bold;color:red'>".$lesson['Lesson']['name'].'</h3>';
			 ?>
				 <div class="caption">
			        <h3><?php echo $this->Html->link($lesson['Lesson']['name'],array(
			        											'controller' => 'Lesson',
			        											'action' => 'index',
			        											$lesson['Lesson']['coma_id']
			        	)); ?>
			    	</h3>
				</div>
			</div>
		
	<?php	
			}	
		}
	?>
	</div>
</div>

<div class="learning-course panel panel-info">
	<div class="panel-heading">
    	<h3 class="panel-title">レポートしたコース</h3>
  	</div>
	<div class='row panel-body' style = 'overflow-x: auto'>
			<!-- <div class="thumbnail"> -->
				
	<?php 
		foreach ($reported_lessons as $course) {
			// echo var_dump($course);
	?>
			<div class='text-center left-col col-sm-3 col-md-3'>
			<?php
				$lesson = $course['lesson']; 
				$cover = LESSON_COVER_LINK.$lesson['Lesson']['cover'];
			     echo $this->Html->image($cover,array(
			      'class' => 'img-rounded img-thumbnail img-responsive',        
			      'style' => 'margin:auto'
			      )); 
			 ?>
				 <div class="caption">
			        <h3><?php echo $this->Html->link($lesson['Lesson']['name'],array(
			        											'controller' => 'Lesson',
			        											'action' => 'index',
			        											$lesson['Lesson']['coma_id']
			        	)); ?>
			    	</h3>
				</div>
			</div>
		
	<?php	
		}
	?>
	</div>
</div>

<div class="learning-course panel panel-info">
	<div class="panel-heading">
    	<h3 class="panel-title">レートした授業の数</h3>
  	</div>
	<div class='row panel-body' style = 'overflow-x: auto'>
			<!-- <div class="thumbnail"> -->
				
	<?php 
		foreach ($rates as $course) {
			// echo var_dump($course);
	?>
			<div class='text-center left-col col-sm-3 col-md-3'>
			<?php
				$lesson = $course['lesson']; 
				$cover = LESSON_COVER_LINK.$lesson['Lesson']['cover'];
			     echo $this->Html->image($cover,array(
			      'class' => 'img-rounded img-thumbnail img-responsive',        
			      'style' => 'margin:auto'
			      )); 
			 ?>
				 <div class="caption">
			        <h3><?php echo $this->Html->link($lesson['Lesson']['name'],array(
			        											'controller' => 'Lesson',
			        											'action' => 'index',
			        											$lesson['Lesson']['coma_id']
			        	)); ?>
			    	</h3>
				</div>
			</div>
		
	<?php	
		}
	?>
	</div>
</div>

<div class="learning-course panel panel-info">
	<div class="panel-heading">
    	<h3 class="panel-title">ブロックされた</h3>
  	</div>
	<div class='row panel-body' style = 'overflow-x: auto'>
			<!-- <div class="thumbnail"> -->
				
	<?php 
		foreach ($blockeds as $blocked) {
			// echo var_dump($blocked['Teacher']);
	?>
			<div class='text-center left-col col-sm-2 col-md-2'>
			<div class="col-md-2 text-center">
		     <?php
		     		$author = $blocked['Teacher']['User'];     		                  
		        $author_profile = IMAGE_PROFILE_LINK.DS.$author['profile_picture'];     
				     echo $this->Html->image($author_profile, array(
				      'alt' => __('Profile'),
				      'class' => 'img-rounded mini_profile',                
				      'url' => array('controller' => 'teacher', 'action' => 'profile', $author['user_id'])
				      ));
				     echo '<p>';
				     echo $this->Html->link($author['firstname'].$author['lastname'],array(
				      'controller' => 'teacher',
				      'action' => 'profile', $author['user_id']
				      ));
				     echo '</p>';                
		     ?>
				 <div class="caption">
			        <h3><?php 
			        					// echo $this->Html->link($lesson['Lesson']['name'],array(
			        					// 						'controller' => 'Lesson',
			        					// 						'action' => 'index',
			        					// 						$lesson['Lesson']['coma_id']
			        									// )); 
			        	?>
			    	</h3>
				</div>
			</div>
		
	<?php	
		}
	?>
	</div>
</div>