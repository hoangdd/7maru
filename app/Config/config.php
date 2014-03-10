<?php
/*
*	
*	Config file
*	@HoangDD
*/

/*========================SYSTEM CONFIG ====================*/
define('FILL_CHARACTER', '7maru');
define('IMAGE_PROFILE_DIR', WWW_ROOT.'img'.DS.'data'.DS.'avata');
define('LESSON_COVER_DIR', WWW_ROOT.'img'.DS.'data'.DS.'cover');

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
		'lesson' => '*',
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
		'lesson' => array('comment', 'index', 'view'),
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
		'teacher' => array('profile', 'register'),
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
		'mineType' => array(
			'swf' => array('flash' => 'application/x-shockwave-flash'),
			),
		'path' => SWF_DATA_DIR,
		),

	'img' => array(
		'extension'=> array(
			'png', 'jpg', 'jpeg', 'gif'
			),
		'mineType' => array(
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
		'mineType' => array(
			'wav' => array('audio' => 'audio/wav'),
			'mp3' => array('audio' => 'audio/mpeg3'),
			),
		'path' => AUDIO_DATA_DIR,
		),
	'video' => array(
		'extension'=> array(
			'avi', 'flv', 'mp4'
			),
		'mineType' => array(
			'avi' => array('video' => 'video/avi'),
			),
		'path' => VIDEO_DATA_DIR,
		)

	))	;

Configure::write('comand', array(
	'pdf2swf' => array(
		'pdf2swf %s -o %s'
		),

	'doc2pdf' => array(
		),

	'ppt2pdf' => array(
		),

	));

/*========================End config file ====================*/
