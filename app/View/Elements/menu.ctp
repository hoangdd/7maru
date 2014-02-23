
<?php
  $user = array(
    'type' => 'student',
   );
  $page = array(
    'controller' => $this->name,
    'action' => $this->action
    );
  $menu = array(
    'student' => array(
        'Home' => $this->Html->url(array(
          'controller' => 'Student',
          'action' => 'index'
          )),
        'Profile' => $this->Html->url(array(
          'controller' => 'Student',
          'action' => 'Profile'
          )),
        'Buy Lesson' => $this->Html->url(array(
          'controller' => 'Student',
          'action' => 'BuyLesson'
          ))
      ),
    'teacher' => array(
      'Home' => '#',
      'Profile' => '#',
      'Lesson Manage' => '#',
      'Create Lesson' => '#'

      )
    );
?>


<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
      <a class="navbar-brand" href="#">7Maru</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php
        $current_url = $this->Html->url(array(
          'controller' => $page['controller'],
          'action' => $page['action']
          ));
          foreach ($menu[$user['type']] as $key => $value) {
            # code...
            if($current_url == $value){
              echo "<li class='active'><a href=".$value.">".__($key)."</a></li>";
            }else{
              echo "<li><a href=".$value.">".__($key)."</a></li>";
            }
          }
        ?>
      </ul>
      <?php
          echo $this->Form->create(null, array(
          'controller' => 'search',
          'action' => 'index',
          'class' => 'navbar-form navbar-right',
          ));

          echo $this->Form->input(
              'keyword',
              array(
                'label' => '',
                'class' => 'form-control',
                'placeholder' => __('Enter a keyword'),
                'div' => array(
                  'style' => 'display:inline-block;margin-right:10px;'
                  ),
              )
          );

          echo $this->Form->button('Search', array(
            'class' => 'btn btn-default',
            'type' => 'Search',
           ));
        echo $this->Form->end();
      ?>
    </div>
  </div>
</nav>