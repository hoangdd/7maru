<script>
     $(document).ready(function() {
        $('#Gdocviewer').gdocsViewer({width: 600, height: 750});
//        $('#embedURL').gdocsViewer();
    });   
</script>

<?php
/**
*   view.ctp
*   view content of lesson
*   Author: HoangDD+ HoangNM
*   Lesson: title, image, stars
*/
    echo $this->Html->css('common');
    // $lesson = array(
    //     'title' =>  'Tokyo Hot',
    //     'image' =>  'tokyo_hot.jpg',
    //     'stars' => 2.5,
    //     'reader' => 4,
    //     'ranker' => 3,
    //     'created_date' => '2013/12/1',
    // );
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
    			echo $this->Html->image($lesson['image'],array('class' => 'img-rounded small_photo')); 
    			echo '<p></p>';
                //Show title
                echo '<h1 class="text-center">'.$lesson['title'].'</h1>';
                echo '<p></p>';
    			//_____________________
    			//ranking by stars                   
                $options = array();
                $options['stars'] =   $lesson['stars'];      
                $options['width'] = 30;
                $options['height'] = 30;
                echo $this->element('star_rank',array(
                'options' => $options,                
                ));
                //Show author
                echo '<p></p>';
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
                    'action'=>'exam',
                ),array('class' => 'btn btn-primary btn-lg active'));
                
        ?>
    </div>
    <div class='col-md-9'>
        <div class="panel panel-info">
            <!--panel header-->
            <div class="panel-heading">
                <h3 class="panel-title">Content of Lesson</h3>
            </div>
            <!--panel body-->
            <div class="panel-body">
                <!-- content of lesson -->
                <div>
<!--                    <textarea class="form-control" rows="40"></textarea>-->
                    <a href="/7maru/files/Schedule.xlsx" id="Gdocviewer"> Document view </a>
                </div>
            </div>
        </div>
    </div>
</div>