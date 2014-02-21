<h2>Hello from search view</h2>
<h1><?php echo $string; ?></h1>
<?php
    echo $this->Form->create(null,
                             array(
                                 'type'=>'get',
                                 'url' => array(
                                    'controller' => 'search',
                                    'action'=>'index'
                                ),
                                 'class' => 'form-inline'
                             ));
    echo $this->Form->input('Search',array('placeholder' => 'Enter Query',
                                  'label' => false,       
                                  'class' => 'form-control'
                            ));
    echo $this->Form->submit('Search',array('class'=>'btn btn-success',
                                            'div' => false));
//    echo $this->Form->end(array('class'=>'btn btn-success',
//                                'value'=>'Search'
//                               ));
?>