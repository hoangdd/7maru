<style type="text/css">
form.search {
	background-color:#FFB090;
	border-radius:10px;
	display:block;
	margin:20px 0
            
}

form.search #thesearchbox {
	border:0;
	border-radius:5px;
	font-size:18px;
	margin:0;
	padding:0;
	padding:4px;
	background: #fff url('/img/zoom.png') no-repeat 780px;
	width:800px
}

form.search #thesearchbutton {
	background-color:#FFF;
	border:0;
	border-radius:5px;
	color:#6B3F2E;
	cursor:pointer;
	font-size:15px;
	font-weight:700;
	height:30px;
	margin:0;
	padding:0;
	width:160px
}

form.search>fieldset {
    border:none;
	display:block;
/*	height:30px;*/
	padding:10px;
/*    width: 1000px;*/
}

form.search>fieldset>div {
	background-color:#FFF;
	border-radius:5px;
	display:block;
	float:left;
	height:30px;
	padding:0;
	text-align:center
}

form.search>>div:first-child{
	margin-right:10px
}

</style>
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
                                 'class' => 'search'
                             ));
    ?>
    <fieldset>
    <?php
        echo $this->Form->input('Search',array('placeholder' => 'Enter Query',
                                  'label' => false,       
                                  'id' => 'thesearchbox'
                            ));
    ?>
    
    <?php
        echo $this->Form->submit('Search',array('class'=>'thesearchbutton',
                                            'div' => true,
                                            'id' =>'thesearchbutton'));
//    echo $this->Form->end(array('class'=>'btn btn-success',
//                                'value'=>'Search'
//                               ));
    ?>
    </fieldset>
    <?php echo $this->form->end() ?>