<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta charset="UTF-8">
		<meta content="Kulcsszó1, Kulcsszó2, Kulcsszó3" name="keywords"><meta content="Description szövege jön ide..." name="description">
		
		<title>Traveltrix - Be far. Feel home.</title>
		
		<link rel="stylesheet" href="lib/css/style.css" />
		<link rel="stylesheet" href="lib/css/video-js.css" />
		<link rel="stylesheet" href="lib/css/ui-lightness/style.css" />
		
		<script src="lib/js/modernizr-2.min.js"></script>
	</head>
	<body id="home">
	
	<header>
		<nav>
			<ul>
				<li class="active" id="home"><a href="/">Home<span>The starting point</span></a></li>
				<li id="blog"><a href="blog">Blog<span>Latest news</span></a></li>
				<li id="faq"><a href="faq">FAQ<span>Get your answers here</span></a></li>
				<li id="about"><a href="about">About<span>Who we are</span></a></li>
			</ul>
			<div id="search">
				<form action="#" id="search-form">
					<a href="#" id="advanced-button">Advanced</a>
					<div id="search-options">
						<p><label for="health">Health</label><input type="checkbox" name="health" id="health" /></p>
						<p><label for="extreme">Extreme</label><input type="checkbox" name="exterem" id="extreme" /></p>
						<p><label for="sights">Sights</label><input type="checkbox" name="sights" id="sights" /></p>
					</div>
					<input type="search" name="keyword" id="keyword" placeholder="Search..." />
					<a href="#" id="search-button"></a>
				</form>
			</div>
		</nav>
	</header>
	<div id="main">
		<section id="slider">
			<div id="top-layer">
				<img src="img/sliderLogo.png" alt="Traveltrix logo" />
				<h2>Create your dream trip and be your own boss. Get Started!</h2>
			</div>
			<a class="nextSlide nav" href="#"></a>
			<div id="slides">
				<div class="slide">
					<img src="img/flow.png" alt="" />
				</div>
				<div class="slide">
						<div class="video-js-box">
						    <!-- Using the Video for Everybody Embed Code http://camendesign.com/code/video_for_everybody -->
						    <video id="example_video_1" class="video-js" width="960" height="330" controls="controls" preload="auto" poster="http://video-js.zencoder.com/oceans-clip.png">
						      <source src="http://video-js.zencoder.com/oceans-clip.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
						      <source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm; codecs="vp8, vorbis"' />
						      <source src="http://video-js.zencoder.com/oceans-clip.ogv" type='video/ogg; codecs="theora, vorbis"' />
						      <!-- Flash Fallback. Use any flash video player here. Make sure to keep the vjs-flash-fallback class. -->
						      <object id="flash_fallback_1" class="vjs-flash-fallback" width="960" height="330" type="application/x-shockwave-flash"
						        data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf">
						        <param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" />
						        <param name="allowfullscreen" value="true" />
						        <param name="flashvars" value='config={"playlist":["http://video-js.zencoder.com/oceans-clip.png", {"url": "http://video-js.zencoder.com/oceans-clip.mp4","autoPlay":false,"autoBuffering":true}]}' />
						        <!-- Image Fallback. Typically the same as the poster image. -->
						        <img src="http://video-js.zencoder.com/oceans-clip.png" width="960" height="330" alt="Poster Image"
						          title="No video playback capabilities." />
						      </object>
						    </video>
						    <!-- Download links provided for devices that can't play video in the browser. -->
						    <p class="vjs-no-video"><strong>Download Video:</strong>
						      <a href="http://video-js.zencoder.com/oceans-clip.mp4">MP4</a>,
						      <a href="http://video-js.zencoder.com/oceans-clip.webm">WebM</a>,
						      <a href="http://video-js.zencoder.com/oceans-clip.ogv">Ogg</a><br>
						      <!-- Support VideoJS by keeping this link. -->
						      <a href="http://videojs.com">HTML5 Video Player</a> by VideoJS
						    </p>
						  </div>
				</div>
			</div>
		</section>
		
		<div id="form-wrap">
			<form action="#" id="basic-form">
				<h3>Plan your tour! It only takes 10 minutes.</h3>
				<fieldset class="half" id="destination">
					<h4>Destination</h4>
					<label for="country">Country</label>
					<select name="country" id="country">
						<option value="1">Hungary</option>
						<option value="2">Austria</option>
						<option value="3">Romania</option>
					</select>
					<label for="city">City/Region</label>
					<select name="city" id="city">
						<option value="1">Region 1</option>
						<option value="2">Region 2</option>
						<option value="3">Region 3</option>
						<option value="4">Region 4</option>
						<option value="5">Region 5</option>
					</select>
				</fieldset>
				<fieldset class="half" id="dates">
					<h4>Dates</h4>
					<label for="from">From</label>
					<input type="text" name="from" id="from" class="datepicker" />
					<label for="to">To</label>
					<input type="text" name="to" id="to" class="datepicker" />
				</fieldset>
				<div class="clear"></div>
				<fieldset>
					<h4>Number of travelers</h4>
					<div class="left">
						<label for="children">Children</label>
						<input type="number" name="childre" id="children" />
					</div>
					<div class="right">
						<label for="youngs">Young adults</label>
						<input type="number" name="youngs" id="youngs" />
					</div>
					<div class="left">
						<label for="adults">Adults</label>
						<input type="number" name="adults" id="adults" />
					</div>
					<div class="right">
						<label for="seniors">Seniors</label>
						<input type="number" name="seniors" id="seniors" />
					</div>
				</fieldset>
				<div class="clear"></div>
				<fieldset>
					<input type="submit" value="Plan my dream tour" />					
				</fieldset>
			</form>
		</div>
		
		<section id="features">
			<div class="feature">
				<h2>125% garancia</h2>
				<h3>Nem viccelünk</h3>
				<p>Válogatott túráink minőségéért teljes mértékben felelősséget vállalunk, számunkra a legfontosabb a túristák elégedettsége. Amennyiben a választott túra minőségileg kifogásolható volt, Fodor Ákos <strong>125%-át visszafizetu az árnak.</strong></p>
			</div>
			<div class="feature">
				<h2>Válogatott túravezetők</h2>
				<h3>Nálunk a legjobbat kapja</h3>
				<p>Minden túraezetőt igénylő túránkhoz a célország legjobb túravaezetőit szolgáltatjuk. A Traveltrix túravezetői egy válogatott társaság, csakis a legjobbak kerülhetnek be, személyes elbírálás és próbatúrák után.</p>
			</div>
			<div class="feature">
				<h2>Teljes kontroll</h2>
				<h3>Élmények, ahogy önnek megfelel</h3>
				<p>A Traveltrix intuitív felületén keresztül lehetőséget kap, hogy teljesen egyénre szabja külföldi útját. Válassza ki a szimpatikus túrákat, válogasson az első osztályú túravezetőink közül, végül megkapja Ákos szuper itinerjét.</p>
			</div>
		</section>
		
		<section id="why">
			<div id="points">
				<h2>5 ok, amiért a magánturizmus élménygazdagabb</h2>
				<ol>
					<li class="active egy" data-text="egy">Teljesen egyénre szabott túrák, egyedi élmények</li>
					<li data-text="ketto" class="ketto">Nincsenek kötöttségek, nem kell a csoporttal rajban mozogni</li>
					<li data-text="harom" class="harom">Az ország rejtett szépségeit is felfedezheti</li>
					<li data-text="negy" class="negy">Pénztárcabarát</li>
					<li data-text="ot" class="ot">Helyi kultúra és életérzés</li>
				</ol>
			</div>
			<div id="text">
				<ul>
					<li id="egy">
						<h2>Teljesen egyénre szabott túrák, egyedi élmények</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet mauris eu turpis euismod rutrum dapibus vitae neque. Suspendisse potenti. Mauris eu erat et sapien posuere bibendum at fermentum purus. Fusce molestie ultrices tortor sed tincidunt. Nam at sapien enim, quis vestibulum tortor. <img src="http://placekitten.com/g/200/130" alt="" /> Pellentesque et leo nulla, nec vulputate nulla. Sed blandit quam eu dolor viverra ac suscipit est sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras ac libero eu massa sollicitudin mattis porta sollicitudin turpis. Vivamus elementum nisl non neque gravida ultricies. Cras dapibus tempor neque a scelerisque. Sed vulputate, risus eget.</p>
						<h3>Hogyan segít ebben a Traveltrix?</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet mauris eu turpis euismod rutrum dapibus vitae neque. Suspendisse potenti. Mauris eu erat et sapien posuere bibendum at fermentum purus. Fusce molestie ultrices tortor sed tincidunt. Nam at sapien enim, quis vestibulum tortor. Pellentesque et leo nulla, nec vulputate nulla. Sed blandit quam eu dolor viverra ac suscipit est sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras ac libero eu massa sollicitudin mattis porta sollicitudin turpis. Vivamus elementum nisl non neque gravida ultricies. Cras dapibus tempor neque a scelerisque. Sed vulputate, risus eget.</p>
					</li>
					<li id="ketto">
						<h2>Nincsenek kötöttségek, nem kell a csoporttal rajban mozogni</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet mauris eu turpis euismod rutrum dapibus vitae neque. Suspendisse potenti. Mauris eu erat et sapien posuere bibendum at fermentum purus. Fusce molestie ultrices tortor sed tincidunt. Nam at sapien enim, quis vestibulum tortor. Pellentesque et leo nulla, nec vulputate nulla. Sed blandit quam eu dolor viverra ac suscipit est sollicitudin. <img src="http://placekitten.com/g/200/130" alt="" /> Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras ac libero eu massa sollicitudin mattis porta sollicitudin turpis. Vivamus elementum nisl non neque gravida ultricies. Cras dapibus tempor neque a scelerisque. Sed vulputate, risus eget.</p>
						<h3>Hogyan segít ebben a Traveltrix?</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet mauris eu turpis euismod rutrum dapibus vitae neque. Suspendisse potenti. Mauris eu erat et sapien posuere bibendum at fermentum purus. Fusce molestie ultrices tortor sed tincidunt. Nam at sapien enim, quis vestibulum tortor. Pellentesque et leo nulla, nec vulputate nulla. Sed blandit quam eu dolor viverra ac suscipit est sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras ac libero eu massa sollicitudin mattis porta sollicitudin turpis. Vivamus elementum nisl non neque gravida ultricies. Cras dapibus tempor neque a scelerisque. Sed vulputate, risus eget.</p>
					</li>
					<li id="harom">
						<h2>Az ország rejtett szépségeit is felfedezheti</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet mauris eu turpis euismod rutrum dapibus vitae neque. Suspendisse potenti. Mauris eu erat et sapien posuere bibendum at fermentum purus. Fusce molestie ultrices tortor sed tincidunt. Nam at sapien enim, quis vestibulum tortor. Pellentesque et leo nulla, nec vulputate nulla. Sed blandit quam eu dolor viverra ac suscipit est sollicitudin. <img src="http://placekitten.com/g/200/130" alt="" /> Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras ac libero eu massa sollicitudin mattis porta sollicitudin turpis. Vivamus elementum nisl non neque gravida ultricies. Cras dapibus tempor neque a scelerisque. Sed vulputate, risus eget.</p>
						<h3>Hogyan segít ebben a Traveltrix?</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet mauris eu turpis euismod rutrum dapibus vitae neque. Suspendisse potenti. Mauris eu erat et sapien posuere bibendum at fermentum purus. Fusce molestie ultrices tortor sed tincidunt. Nam at sapien enim, quis vestibulum tortor. Pellentesque et leo nulla, nec vulputate nulla. Sed blandit quam eu dolor viverra ac suscipit est sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras ac libero eu massa sollicitudin mattis porta sollicitudin turpis. Vivamus elementum nisl non neque gravida ultricies. Cras dapibus tempor neque a scelerisque. Sed vulputate, risus eget.</p>
					</li>
					<li id="negy">
						<h2>Pénztárcabarát</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet mauris eu turpis euismod rutrum dapibus vitae neque. Suspendisse potenti. Mauris eu erat et sapien posuere bibendum at fermentum purus. Fusce molestie ultrices tortor sed tincidunt. Nam at sapien enim, quis vestibulum tortor. Pellentesque et leo nulla, nec vulputate nulla. Sed blandit quam eu dolor viverra ac suscipit est sollicitudin. <img src="http://placekitten.com/g/200/130" alt="" /> Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras ac libero eu massa sollicitudin mattis porta sollicitudin turpis. Vivamus elementum nisl non neque gravida ultricies. Cras dapibus tempor neque a scelerisque. Sed vulputate, risus eget.</p>
						<h3>Hogyan segít ebben a Traveltrix?</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet mauris eu turpis euismod rutrum dapibus vitae neque. Suspendisse potenti. Mauris eu erat et sapien posuere bibendum at fermentum purus. Fusce molestie ultrices tortor sed tincidunt. Nam at sapien enim, quis vestibulum tortor. Pellentesque et leo nulla, nec vulputate nulla. Sed blandit quam eu dolor viverra ac suscipit est sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras ac libero eu massa sollicitudin mattis porta sollicitudin turpis. Vivamus elementum nisl non neque gravida ultricies. Cras dapibus tempor neque a scelerisque. Sed vulputate, risus eget.</p>
					</li>
					<li id="ot">
						<h2>Helyi kultúra és életérzés</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet mauris eu turpis euismod rutrum dapibus vitae neque. Suspendisse potenti. Mauris eu erat et sapien posuere bibendum at fermentum purus. Fusce molestie ultrices tortor sed tincidunt. Nam at sapien enim, quis <img src="http://placekitten.com/g/200/130" alt="" /> vestibulum tortor. Pellentesque et leo nulla, nec vulputate nulla. Sed blandit quam eu dolor viverra ac suscipit est sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras ac libero eu massa sollicitudin mattis porta sollicitudin turpis. Vivamus elementum nisl non neque gravida ultricies. Cras dapibus tempor neque a scelerisque. Sed vulputate, risus eget.</p>
						<h3>Hogyan segít ebben a Traveltrix?</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet mauris eu turpis euismod rutrum dapibus vitae neque. Suspendisse potenti. Mauris eu erat et sapien posuere bibendum at fermentum purus. Fusce molestie ultrices tortor sed tincidunt. Nam at sapien enim, quis vestibulum tortor. Pellentesque et leo nulla, nec vulputate nulla. Sed blandit quam eu dolor viverra ac suscipit est sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras ac libero eu massa sollicitudin mattis porta sollicitudin turpis. Vivamus elementum nisl non neque gravida ultricies. Cras dapibus tempor neque a scelerisque. Sed vulputate, risus eget.</p>
					</li>
				</ul>
			</div>
		</section>
	</div>
	<footer>
		<div id="footer">
			
		</div>
	</footer>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js">
		</script>
		<script>
window.jQuery || document.write('<script src="lib/js/jquery-1.7.js">\x3C/script>')
		</script>
		<script type="text/javascript" src="lib/js/jquery-ui.js">
		<script type="text/javascript" src="lib/js/video.js">
		</script>
		<script type="text/javascript" src="lib/js/main.js">
		</script>
		<script>
var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
s.parentNode.insertBefore(g,s)}(document,'script'));
		</script>
		<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
		     chromium.org/developers/how-tos/chrome-frame-getting-started -->
		<!--[if lt IE 7 ]>
		  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		  <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
	</body>
</html>