<?php
	$list = array(
		array(
			'description' => 'Social prophecy? Black comedy? Study of freewill? A Clockwork Orange is all of these. It is also a dazzling experiment in language, as Burghiss creates a new language - \'meow\', the cat slang of a not-too-distant future.',		
			'authorId' => '34wsdf',
			'author' => array(
				'username' => 'victorhugo',
				'firstname' =>'Victor',
				'lastname' => 'Hugo',
				'address' => 'Paris, France',
				'phone_number' => '01649586899',
				'mail' => 'hugovic@gmail.com',
				'office' => 'Hội nhà văn Việt Nam', 
				'description' => 'Victor Hugo là một nhà văn, nhà thơ, nhà viết kịch thuộc chủ nghĩa lãng mạn nổi tiếng của Pháp. Ông cũng đồng thời là một nhà chính trị, một trí thức dấn thân tiêu biểu của thế kỷ XIX. Wikipedia'
			),
			'title' => '9 lines',
			'image' => 'http://localhost/7maru/img/lessoncover/1.png',
			'tags' => array('math','18+'),
			'stars' => 3,
			'reader' => 4,
			'ranker' => 3,
			'buy_status' => 1,
			'created_date' => '2013/12/1',
			'materials' => array(),
			'tests' => array(
			)
		),
		array(
			'description' => 'Social prophecy? Black comedy? Study of freewill? A Clockwork Orange is all of these. It is also a dazzling experiment in language, as Burghiss creates a new language - \'meow\', the cat slang of a not-too-distant future.',		
			'authorId' => '34wsdf',
			'author' => array(
				'username' => 'victorhugo',
				'firstname' =>'Victor',
				'lastname' => 'Hugo',
				'address' => 'Paris, France',
				'phone_number' => '01649586899',
				'mail' => 'hugovic@gmail.com',
				'office' => 'Hội nhà văn Việt Nam', 
				'description' => 'Victor Hugo là một nhà văn, nhà thơ, nhà viết kịch thuộc chủ nghĩa lãng mạn nổi tiếng của Pháp. Ông cũng đồng thời là một nhà chính trị, một trí thức dấn thân tiêu biểu của thế kỷ XIX. Wikipedia'
			),
			'title' => '9 lines',
			'image' => 'http://localhost/7maru/img/lessoncover/6.png',
			'tags' => array('math','18+'),
			'stars' => 3,
			'reader' => 4,
			'ranker' => 3,
			'buy_status' => 1,
			'created_date' => '2013/12/1',
			'materials' => array(),
			'tests' => array(
			)
		),
		array(
			'description' => 'Social prophecy? Black comedy? Study of freewill? A Clockwork Orange is all of these. It is also a dazzling experiment in language, as Burghiss creates a new language - \'meow\', the cat slang of a not-too-distant future.',		
			'authorId' => '34wsdf',
			'author' => array(
				'username' => 'victorhugo',
				'firstname' =>'Victor',
				'lastname' => 'Hugo',
				'address' => 'Paris, France',
				'phone_number' => '01649586899',
				'mail' => 'hugovic@gmail.com',
				'office' => 'Hội nhà văn Việt Nam', 
				'description' => 'Victor Hugo là một nhà văn, nhà thơ, nhà viết kịch thuộc chủ nghĩa lãng mạn nổi tiếng của Pháp. Ông cũng đồng thời là một nhà chính trị, một trí thức dấn thân tiêu biểu của thế kỷ XIX. Wikipedia'
			),
			'title' => '9 lines',
			'image' => 'http://localhost/7maru/img/lessoncover/9.png',
			'tags' => array('math','18+'),
			'stars' => 3,
			'reader' => 4,
			'ranker' => 3,
			'buy_status' => 1,
			'created_date' => '2013/12/1',
			'materials' => array(),
			'tests' => array(
			)
		)
	);
?>
<?php
	echo $this->Html->css('component');
	echo $this->Html->css('lesson');
?>
<ul id="bk-list" class="bk-list clearfix">
	<?php
		foreach ($list as $lesson) {
	?>
			<li class='lesson-book'>
				<div class="bk-book book bk-bookdefault">
					<div class="bk-front" style="background-image: url(<?php echo $lesson['image'];?>);	">
					</div>
				</div>
				<div class="bk-info">
					<button>Buy</button>
					<button>View page</button>
					<h3>
						<span>
							<?php echo $lesson['author']['firstname'].' '.$lesson['author']['lastname']?>
						</span>
						<span>
							<?php echo $lesson['title']; ?>
						</span>
					</h3>
					<p>
						<?php echo $lesson['description'];?>
					</p>
				</div>
			</li>
	<?php
		}
	?>
</ul>
