<!DOCTYPE html>
<html>

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2016/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2016/labs/labResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
        <?php
        print "hi";

         ?>

		<h1>My Music Page</h1>

		<!-- Ex 1: Number of Songs (Variables) -->
		<p>
			I love music.
			I have
			<?php
				$song_count = 5678;
				print $song_count;
			?>
			 total songs,
			which is over
			<?php
				print (int)($song_count/10);
			?>
			hours of music!
		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		<!-- Ex 3: Query Variable -->
		<div class="section">
			<h2>Yahoo! Top Music News</h2>
			<ol>
			<?php

		  $newspages = $_GET["newspages"];

			if (!isset($_GET["newspages"])) {
  		$newspages = 5;
			}
			 for ($i= 1 ; $i<=$newspages; $i++){ ?>
				<li><a href="http://music.yahoo.com/news/archive/?page=<?= $i ?>">Page <?= $i ?></a></li>
				<?php } ?>
			</ol>
		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->
		<!-- Ex 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>

			<ol>
				<?php
				$texts = file("favorite.txt");
				for($i=0;$i<count($texts);$i++){?>
						<li><a href="http://en.wikipedia.org/wiki/<?=$texts[$i]?>"><?=$texts[$i]?></a></li>
				<?php } ?>

			</ol>
		</div>
		<!-- Ex 6: Music (Multiple Files) -->
		<!-- Ex 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>
		<ul id="musiclist">
		<?php
			function cmp($a, $b){

    		return (filesize($b)-filesize($a));
				}

				$songs = glob("lab6/musicPHP/songs/*.mp3");

					usort($songs, cmp);

					foreach ($songs as $song) { ?>
						<li class="mp3item">
						<a href="<?=$song?>"><?=basename($song)?> (<?=(int)(filesize($song)/1024)?> KB)</a>
					 </li>
					<?php }
				?>
	</ul>


				<!-- Exercise 8: Playlists (Files) -->
							<?php
									$m3us = glob("lab6/musicPHP/songs/*.m3u");
									arsort($m3us);
									foreach ($m3us as $file) { ?>
									<li class="playlistitem"><?=basename($file)?>:

										<?php $mp3 = file($file);
										shuffle($mp3);?>
										<ul>
									<?php	for ($i = 0; $i < count($mp3); $i++){

														$pos = strpos($mp3[$i], "#");
														if($pos===FALSE){
															?>
  														<li> <?=$mp3[$i]?></li>
							 		<?php 		}
												} ?>
									</ul>
								</li>
						<?php } ?>

						</div>



		<div>
			<a href="http://validator.w3.org/check/referer">
				<img src="http://selab.hanyang.ac.kr/courses/cse326/2013/labs/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img src="http://selab.hanyang.ac.kr/courses/cse326/2013/labs/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
