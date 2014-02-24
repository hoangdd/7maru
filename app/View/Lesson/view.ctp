<?php
/**
*   view.ctp
*   view content of lesson
*   Author: HoangDD+ HoangNM
*   Lesson: title, image, stars
*/
    echo $this->Html->css('common');
    $lesson = array(
        'title' =>  'Tokyo Hot',
        'image' =>  'tokyo hot.jpg',
        'stars' =>  4,
        'reader'=>  4,
        'ranker'=>  3,
        'created_date' => '2013/12/1',
    );
    $teacher = array(
            'image' => 'profile.jpg',
            'name' => 'agaraki yui',            
            'id' => 'abcxyz'
        );
    $starsImage = 'star.png';
	$starsBlurImage = 'blurStar.png';
	$__MAX_RANK = 5;
?>

<!-- lesson information -->
<div class="row">
    <div class='col-md-3 text-center'>
        <!-- Left col: Image and ranhking and vote stars-->
        <?php
                //Show title
                echo '<h1 class="text-center">'.$lesson['title'].'</h1>';
    			echo $this->Html->image($lesson['image'],array('class' => 'img-rounded small_photo')); 
    			echo '<p></p>';
    			//_____________________
    			//ranking by stars
    			for ($i=1; $i<=$lesson['stars']; $i++){
    				echo $this->Html->image($starsImage);
    			}
    			for ($i; $i <= $__MAX_RANK; $i++){
    				echo $this->Html->image($starsBlurImage);    				
    			}
                //Show author
                echo '<p>';
                echo $this->Html->image("profile.jpg", array(
                    'alt' => 'profile',
                    'class' => 'img-rounded mini_profile',                
                    'url' => array('controller' => 'teacher', 'action' => 'profile', $teacher['id'])
                    ));
                echo '<p>';
                echo 'Author : ';
                echo $this->Html->link($teacher['name'],array(
                    'controller' => 'teacher',
                    'action' => 'profile', $teacher['id']
                    ));
                echo '</p>';  
    			//______________________
    			//created date
    			echo '<p></p>';
    			echo '<p class="text_center"> Created Date: <strong>'.$lesson['created_date'].'</strong> </p>';
    			echo '<p>'.$lesson['stars'].' ranker / '.$lesson['reader'].' reader'.'</p>';
                echo $this->Html->link('Lets try with test!', array(
                    'controller'=>'student',
                    'action'=>'test',
                ),array('class' => 'btn btn-primary btn-lg active'));
                
        ?>
    </div>
    <div class='col-md-9'>
        <!-- content of lesson -->
        <div>
            <textarea class="form-control" rows="40">Content of Lesson</textarea>
        </div>
    </div>
</div>