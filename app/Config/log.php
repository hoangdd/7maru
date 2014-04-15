<?php 
$logs = array(
	1 => array('type' => 'FATAL', 'file'=> true, 'database'=>false, 'message'=>'システム汎用エラー'),
	2 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'クライアントがリクエストを送信します'),
	3 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'ユーザーが無効なデータを送信します'),
	4 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'ユーザーは許可なしページを要求します'),
	5 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'ユーザーは大きすぎるデータを提出'),
	6 => array('type' => 'WARN', 'file'=> true, 'database'=>true, 'message'=>'ユーザーは、短い時間で多くの要求を行う'),
	7 => array('type' => 'FATAL', 'file'=> true, 'database'=>false, 'message'=>'内部エラー'),
	8 => array('type' => 'ERROR', 'file'=> true, 'database'=>false, 'message'=>'外部エラー'),
	9 => array('type' => 'FATAL', 'file'=> true, 'database'=>false, 'message'=>'不明なエラー'),

	100 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'クライアントが学生の登録ページを要求します'),
	101 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'学生は登録しまた'),
	102 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'学生のユーザー名は使用しています'),
	103 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'無効登録データ'),
	104 => array('type' => 'FATAL', 'file'=> true, 'database'=>false, 'message'=>'大きいすぎ登録データ'),
	105 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'学生が授業ページを要求します'),
	106 => array('type' => 'ERROR', 'file'=> true, 'database'=>false, 'message'=>'授業ページが空です'),
	107 => array('type' => 'ERROR', 'file'=> true, 'database'=>true, 'message'=>'学生は許可なし授業ページを要求ます'),
	108 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'学生がテストページを要求します'),
	109 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'学生は答えを送信します'),
	110 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'システムは答えをチェック終わりました。'),
	111 => array('type' => 'ERROR', 'file'=> true, 'database'=>false, 'message'=>'システムは答えをチェックできません。'),
	112 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'学生は講義を評価。'),
	113 => array('type' => 'ERROR', 'file'=> true, 'database'=>false, 'message'=>'学生は、無効印の授業を評価'),
	114 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'学生はこの講義を評価する権限がありません。'),
	115 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'クライアントが授業管理ページを要求します'),
	116 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'ユーザーは、授業管理ページを表示する権限がありません。'),
	117 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'学生はプロファイルを変更しました'),
	118 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'無効な新しいデータが提出'),
	119 => array('type' => 'FATAL', 'file'=> true, 'database'=>false, 'message'=>'新しいデータが大きすぎ'),
	120 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'クライアント（学生）はプロファイルページを要求します'),
	121 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'ユーザーは、プロファイルページを表示する権限がありません。'),
	122 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'クライアント（学生）はテスト結果のページを要求します'),
	123 => array('type' => 'WARN', 'file'=> true, 'database'=>true, 'message'=>'何のテストなしでテスト結果を要求します'),
	124 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'ユーザーは許可なく試験結果を要求します'),

	200 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'クライアントが先生の登録ページを要求します'),
	201 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'先生は登録しまた'),
	202 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'先生のユーザー名は使用しています'),
	203 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'無効登録データ'),
	204 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'大きいすぎ登録データ'),
	205 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'先生が授業ページを要求します'),
	206 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'先生は許可なし授業ページを要求します'),
	207 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'ユーザー（先生）は自分のアカウントを消します'),
	208 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'クライアント（先生）はプロファイルのページを要求します'),
	209 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'先生は無効な新しいデータが提出しました'),
	210 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'先生は大きすぎ新しいデータが提出しました'),
	211 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'ユーザー（先生）はプロファイルを変更しました'),
	212 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'クライアント（先生）はプロファイルのページを要求します'),
	213 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'クライアント（先生）はホームのページ許可なしを要求します'),
	214 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'先生は授業作成ページを要求します'),
	215 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'テストファイルフォーマットは不正です'),
	216 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'無効なデータが提出しました'),
	217 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'大きいすぎデータが提出しました'),
	218 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'先生は授業を作成しまた'),
	219 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'先生は授業整理ページを要求します'),
	220 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'授業を作成しました'),
	221 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'先生は授業管理ページを要求します'),
	222 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'先生は授業消すすることを要求します'),
	223 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'先生は空授業消すすることを要求します'),
	224 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'先生は許可なし授業消すすることを要求します'),
	225 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'先生は授業を削除しました'),
	226 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'先生は統計ページを要求します'),
	227 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'先生は許可なし統計ページを要求します'),

	300 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'ユーザーはログインしました'),
	301 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'ユーザーは無効なログインデータを提出します'),
	302 => array('type' => 'WARN', 'file'=> true, 'database'=>true, 'message'=>'ユーザーは５回以上ログイン失敗しました'),
	303 => array('type' => 'WARN', 'file'=> true, 'database'=>true, 'message'=>'無効なIPアドレスでログインを要求します'),
	304 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'パスワードが変更られました'),
	305 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'ユーザーはコメントを書いた'),
	306 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'無効なコメント'),
	307 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'ユーザーはコメントを変更しました'),
	308 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'ユーザーはコメントを消した'),
	309 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'ユーザーは空コメントを消します'),
	310 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'ユーザーは空コメントを変更します'),
	311 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'ユーザーは許可なし空コメントを消します'),
	312 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'ユーザーは許可なし空コメントを変更します'),
	313 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'新しいコメント内容は無効です'),
	314 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'ユーザーはキーワードを検索します'),
	315 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'空結果'),
	316 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'ユーザーはアドバンス検索します'),
	317 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'アドバンス検索データ'),

	400 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'管理者はホームページを要求します'),
	401 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'管理者はログインしました'),
	402 => array('type' => 'WARN', 'file'=> true, 'database'=>true, 'message'=>'管理者は無効なログインデータを提出しました'),
	403 => array('type' => 'WARN', 'file'=> true, 'database'=>true, 'message'=>'管理者は無効なIPアドレスを提出しました'),
	404 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'管理者は統計ページを要求します'),
	405 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'管理者はユーザー管理ページを要求します'),
	406 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'管理者はユーザーのパスワードをレッセトしました'),
	407 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'管理者はユーザー情報を変更しました'),
	408 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'管理者はユーザーを消し'),
	409 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'管理者はユーザーを塞ぐ'),
	410 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'管理者は課金ページを要求しま'),
	411 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'管理者はIPアドレス管理ページを要求しま'),
	412 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'管理者はIPアドレスを追加ました'),
	413 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'管理者はIPアドレスを変更ました'),
	414 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'管理者はIPアドレスを消した'),
	415 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'管理者はお知らせページを要求しま'),
	416 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'管理者は、パブリックメッセージを作成し送信する'),
	417 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'管理者は、秘密なメッセージを作成と送信します'),
	418 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'管理者は資料管理ページを要求しま'),
	419 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'管理者は資料を消した'),
	420 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'管理者は資料を塞ぐ'),
	421 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'管理者はパスワード変更することを要求します'),
	422 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'管理者はパスワードを変更しました'),
	423 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'管理者は無効なデータを提出します'),
	424 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'管理者は新しいユーザー確認のページを要求します'),
	425 => array('type' => 'INFO', 'file'=> true, 'database'=>true, 'message'=>'管理者は新しいユーザーを確認しました'),
	
	500 => array('type' => 'FATAL', 'file'=> true, 'database'=>false, 'message'=>'データベースサバーに接続できません'),
	501 => array('type' => 'ERROR', 'file'=> true, 'database'=>false, 'message'=>'データベースからのデータの読み取りができません。'),
	502 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'違法データベース•サーバ要求'),
	503 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'データベースから、データ読み取りました'),
	504 => array('type' => 'WARN', 'file'=> true, 'database'=>false, 'message'=>'データベース•サーバー•帰るデータは空です'),
	505 => array('type' => 'FATAL', 'file'=> true, 'database'=>false, 'message'=>'データを保存できません'),
	506 => array('type' => 'INFO', 'file'=> true, 'database'=>false, 'message'=>'データを保存しました'),

	600 => array('type' => 'ERROR', 'file'=> true, 'database'=>false, 'message'=>'他のログ'),
	);

Configure::write('logs', $logs);