<?php
/*
*	
*	Config file
*	@HoangDD
*/

/*========================SYSTEM CONFIG ====================*/
define('FILL_CHARACTER', '7maru');
define('IMAGE_PROFILE_DIR', WWW_ROOT.'img'.DS.'data'.DS.'avatar');
define('LESSON_COVER_DIR', WWW_ROOT.'img'.DS.'data'.DS.'cover');
define('LESSON_COVER_LINK', "data/cover/");
define('IMAGE_PROFILE_LINK',"data/avatar/");
define('MONEY_PER_LESSON',20000);
define('TEACHER_PROFIT_PERCENTAGE',0.6);
define ('TYPE_CREDIT_CARD' , 18);
define ('TYPE_BANK_ACCOUNT', 54);
/*========================Config user roles ====================*/

/*
admin => account, blockuser, changepassword, createadmin, index, ipmanage, login ,notification, statistic, usermanage
file => img, swf, video, audio
home => index
lesson => comment, create, edit, index, view
login => index, changepassword
reference => edit, index, new, view
search => index
student => buylesson, dotest, editprofile, index, profile, register, statistic, test, viewresult
teacher => creatlesson, editprofile, index, lesson, lessonmanage, profile, register, statistic
user => comment, index
*/
Configure::write('userRoles', array(
	// admin
	'R1' => array(
		'admin' => '*',
		'home' => '*',
		'file' => '*',
		'lesson' => array('index', 'comment','view'),
		'search' => '*',
		'student' => array('index', 'profile', 'statistic'),
		'teacher' => array('index', 'profile', 'statistic'),
		'user' => array('index')
	),
	// teacher
	'R2' => array(
		'file' => '*',
		'home' => '*',
		'lesson' => array('index','view', 'comment', 'create', 'edit', 'destroy', 'recentlesson'),
		'login' => '*',
		'reference' => '*',
		'search' => '*',
		'user' => '*',
		'teacher' => '*',
		'student' => array('index', 'profile')
		),

	// student
	'R3' => array(
		'file' => '*',
		'home' => '*',
		'lesson' => array('index','view' , 'comment', 'rate', 'viewcontent', 'hotlesson', 'newlesson', 'bestseller', 'recentlesson', 'buy'),
		'login' => '*',
		'reference' => array('index', 'view'), 
		'search' => '*',
		'student' => '*',
		'teacher' => array('index', 'profile'),
		'user' => '*'
		),

	//guest
	'R4' => array(
		'home' => '*',
		'login' => array('index'),
		'admin' => array('login'),
		'search' => '*',
		'student' => array('profile', 'register'),
		'teacher' => array('profile', 'register', 'checkusername'),
		'lesson' => array('hotlesson', 'newlesson', 'bestseller', 'recentlesson')
	),
));
/*========================End config user roles ====================*/

/*========================Config file ====================*/
define('DATA_DIR', APP.'data');
define('IMG_DATA_DIR', DATA_DIR.DS.'img');
define('VIDEO_DATA_DIR', DATA_DIR.DS.'video');
define('AUDIO_DATA_DIR', DATA_DIR.DS.'audio');
define('SWF_DATA_DIR', DATA_DIR.DS.'swf');
define('TSV_DATA_DIR', DATA_DIR.DS.'tsv');
define('HTML_DATA_DIR', DATA_DIR.DS.'html');
//define('HTML_DATA_DIR','js/test');
define('DATA_SRC_DIR', DATA_DIR.DS.'src');


Configure::write('srcFile', array(
	'image' => array(
		'extension' => array(
			'png', 'jpg', 'jpeg', 'gif'
			)
		),
	'pdf' => array(
		'extension'=> array(
			'pdf'
			),

		),

	'microsoftOffiece' => array(
		'extension'=> array(
			'doc','docx', 'ppt', 'pptx'
			),

		),

	'audio' => array(
		'extension'=> array(
			'wav', 'mp3'
			),

		),
	'video' => array(
		'extension'=> array(
			'avi', 'flv', 'mp4'
			),

		),
	'tsv' => array(
		'extension'=> array(
			'tsv'
			)
		),
	));

Configure::write('dataFile', array(
	'swf' => array(
		'extension' => array('swf'),
		'mimeType' => array(
			'swf' => array('flash' => 'application/x-shockwave-flash'),
			),
		'path' => SWF_DATA_DIR,
		),

	'img' => array(
		'extension'=> array(
			'png', 'jpg', 'jpeg', 'gif'
			),
		'mimeType' => array(
			'png' => array('image' => 'image/png'),
			'jpg' => array('image' => 'image/jpeg'),
			'jpeg' => array('image' => 'image/jpeg'),
			'gif' => array('image' => 'image/gif'),
			),
		'path' => IMG_DATA_DIR,
		),

	'audio' => array(
		'extension'=> array(
			'wav', 'mp3'
			),
		'mimeType' => array(
			'wav' => array('audio' => 'audio/wav'),
			'mp3' => array('audio' => 'audio/mpeg3'),
			),
		'path' => AUDIO_DATA_DIR,
		),
	'video' => array(
		'extension'=> array(
			'avi', 'flv', 'mp4'
			),
		'mimeType' => array(
			'avi' => array('video' => 'video/avi'),
			),
		'path' => VIDEO_DATA_DIR,
		), 
	'html' => array(
		'extension'=> array(
			'htm', 'html', 'js'
			),
		'mimeType' => array(
			'js' => array('js' => 'application/x-javascript'),
			),
		'path' => VIDEO_DATA_DIR,
		), 

	))	;

Configure::write('command', array(
	'pdf2swf' => array(
		'pdf2swf %s -o %s'
		),

	'doc2pdf' => array(
		),

	'ppt2pdf' => array(
		),

	));

/*========================End config file ====================*/
