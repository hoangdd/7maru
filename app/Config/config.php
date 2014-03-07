<?php
/*
*	
*	Config file
*	@HoangDD
*/

/*========================SYSTEM CONFIG ====================*/
define('FILL_CHARACTER', '7maru');


/*========================Config user roles ====================*/
Configure::write('userRoles', array(

	));
/*========================End config user roles ====================*/

/*========================Config file ====================*/
define('DATA_DIR', DS.'opt'.DS.'lampp'.DS.'htdocs'.DS.'data');
define('IMG_DATA_DIR', DATA_DIR.DS.'img');
define('VIDEO_DATA_DIR', DATA_DIR.DS.'video');
define('AUDIO_DATA_DIR', DATA_DIR.DS.'audio');
define('SWF_DATA_DIR', DATA_DIR.DS.'swf');
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

		)

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
