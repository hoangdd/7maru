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
define ('TYPE_CREDIT_CARD' , 18);
define ('TYPE_BANK_ACCOUNT', 54);
define ('DEFAULT_COVER_IMAGE', 'default_cover.jpg');
define ('DEFAULT_PROFILE_IMAGE', 'default_avatar.jpg');
define('MAX_COVER_SIZE' ,2);
define('UNIT_SIZE',1024*1024);
define('MAX_TEST_FILE_SIZE',5);
define('MAX_DOCUMENT_FILE_SIZE',60*1024);

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
		'data' => '*',
		'home' => '*',
		'data' => '*',
		'file' => '*',
		'lesson' => '*',
		'search' => '*',
		'student' => array('index', 'profile', 'editprofile'),
		'teacher' => array('index', 'profile', 'editprofile'),
		'user' => '*',
		'cakeerror' => '*'
	),
	// teacher
	'R2' => array(
		'file' => '*',
		'home' => '*',
		'lesson' => array('index','view', 'comment', 'create', 'edit', 'destroy', 'recentlesson','viewcontent','testhistory','exam','dotest','result','viewtestresult'),
		'login' => '*',
		'reference' => '*',
		'search' => '*',
		'user' => '*',
		'teacher' => '*',
		'data' => '*',
		'student' => array('profile'),
		'cakeerror' => '*'
		),

	// student
	'R3' => array(
		'file' => '*',
		'home' => '*',
		'lesson' => array('index','view' , 'comment', 'rate', 'viewcontent', 'hotlesson', 'newlesson', 'bestseller', 'recentlesson', 'buy','viewcontent','testhistory','exam','dotest','result','viewtestresult'),
		'login' => '*',
		'reference' => array('index', 'view'), 
		'search' => '*',
		'student' => '*',
		'teacher' => array('profile'),
		'user' => '*',
		'data' => '*',
		'cakeerror'	=> '*'
		),

	//guest
	'R4' => array(
		'home' => '*',
		'login' => array('index','confirmverifycode','logout'),
		'admin' => array('login'),
		'search' => '*',
		'student' => array('profile', 'register'),
		'teacher' => array('profile', 'register', 'checkusername'),
		'lesson' => array('hotlesson', 'newlesson', 'bestseller', 'recentlesson','index'),
		'cakeerror' => '*'
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

define('BACKUP_COMMAND','/var/www/7maru/backups/');
define('BACKUP_STORE','/var/www/backup_store/');


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
			'wav', 'mp3', 'ogg'
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
			'mp3' => array('audio' => 'audio/mpeg'),
			'ogg' => array('audio' => 'audio/ogg')
			),
		'path' => AUDIO_DATA_DIR,
		),
	'video' => array(
		'extension'=> array(
			'avi', 'flv', 'mp4'
			),
		'mimeType' => array(
			'avi' => array('video' => 'video/avi'),
			'mp4' => array('video' => 'video/mp4'),
			'flv' => array('video' => 'video/flv')
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
		'path' => HTML_DATA_DIR,
		), 

	))	;

Configure::write('command', array(
	'pdf2swf' => array(
		'pdf2swf %s -o %s'
		),

	'doc2pdf' => array(
		'lowriter --convert-to pdf %s'
		// 'unoconv %s'
		),

	'ppt2pdf' => array(
		' loimpress --convert-to pdf:writer_pdf_Export %s'
		),

	));

/*========================End config file ====================*/
