<?php
/*session_start();
echo "<h3>\$_SERVER funkcije:</h3>";
echo "Ime fajla - \$_SERVER['SCRIPT_NAME'] ".$_SERVER['SCRIPT_NAME']."<br>";
echo "Ime fajla - \$_SERVER['PHP_SELF'] ".$_SERVER['PHP_SELF']."<br>";
echo "IP adresa - \$_SERVER['REMOTE_ADDR'] ".$_SERVER['REMOTE_ADDR']."<br>";
echo "Ime hosta - \$_SERVER['HTTP_HOST'] ".$_SERVER['HTTP_HOST']."<br>";
echo "Br porta - \$_SERVER['SERVER_PORT'] ".$_SERVER['SERVER_PORT']."<br>";
*/?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Lineweb2</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&amp;subset=latin-ext" rel="stylesheet">
<meta name="viewport" content="width=device-width">
    <?php include_once "inc/favicon.html" ?>
</head>

<body>
<div id="wrapper">
	<header id="header" class="cl">
		<?php include('inc/nav.php') ?>
	</header> <!--end #header-->
	
	<div id="front"> <!-- mogli bi id da nazovemo i banner -->
			<img src="images/front.jpg" alt="front.jpg">
			<img src="images/front-over.png" alt="front-over.jpg" class="front-over">
	</div> <!--end #front-->
	
	<div id="main" class="cl">
		<div class="block">
			<h2>WE ARE LINEWEB</h2>
			<img src="images/computer.png" alt="computer.png">
			<div id="intro">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident nisi molestiae aut in alias, et, fugit iusto distinctio fugiat corrupti deleniti ducimus qui harum dolore voluptas? Voluptates, exercitationem. Consectetur deleniti eos sunt at cum adipisci ex, voluptatibus necessitatibus dolorem. Sequi a corporis at, expedita recusandae hic quod nihil quos debitis, distinctio accusantium. Porro obcaecati adipisci tempore laboriosam. Corrupti, velit.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos perferendis exercitationem et facere laboriosam error, omnis aut corporis pariatur consectetur deleniti eos sunt at cum adipisci ex, voluptatibus obcaecati adipisci tempore laboriosam. Corrupti, velit. <a href="#">Read&nbsp;more...</a></p> <!-- Read more sa &nbsp; se koristi da se nebi desilo da bi mogao link da se pojavi u 2 recenice jer se sastoji iz vise reci... -->
			</div>
		</div>
		<div class="block">
			<h2>contact us</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime facere architecto, dicta nostrum <a href="#">Read&nbsp;more...</a></p>
		</div>
		<div class="block cl"> <!-- vise klasa se stavljaju u jedan tag i odvajaju spaceom... stavio sam cl (clear) klasu pored block da bi prepoznao svoju decu jer su floatovani... kada bi hteo ispod ovog diva da postavim neki novi sadrzaj a da nema clear svojstvo, podvukao bi se ispod!!! -->
			<h2>Latest News</h2>
			<article class="article">
				<h4>LOREM IPSUM DOLAR</h4>
				<img src="images/news1.jpg" alt="news1.jpg">
				<p>Lorem ipsum dolor sit amet,  <a href="#">Read&nbsp;more...</a></p>
			</article>
			<article class="article">
				<h4>LOREM IPSUM DOLAR SIT AMET</h4>
				<img src="images/news2.jpg" alt="news2.jpg">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam dolor autem, dolore iusto repellat nemo aut perspiciatis laboriosam sit inventore distinctio nihil dolorum enim, quo esse, natus quod deserunt dolores. <a href="#">Read&nbsp;more...</a></p>
			</article>
		</div>
	</div> <!--end #main-->
	
	<aside id="sidebar" class="cl">
		<div class="block">
			<h2>info</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime facere architecto, dicta nostrum</p>
		</div>
		<div class="block">
			<h2>popular tags</h2>
			<ul>
				<li><a href="#">First</a></li>
				<li><a href="#">Second</a></li>
				<li><a href="#">third</a></li>
				<li><a href="#">something</a></li>
				<li><a href="#">about</a></li>
				<li><a href="#">web</a></li>
				<li><a href="#">design</a></li>
			</ul>
			<img src="images/reklama.gif" alt="reklama.gif">
		</div>
	</aside> <!--end #sidebar-->
	
	<footer id="footer">
		<p>Copyright &copy; Lineweb</p>
	</footer> <!--end #footer-->

</div> <!-- end of wrapper -->
</body>
</html>
