<?php
	$RSS_title = array();
	$RSS_cat = array();
	$RSS_des = array();
	$RSS_link = array();
	$RSS_date = array();

	$rss_link = "https://www.lebigdata.fr/feed";
	$rss_load = simplexml_load_file($rss_link);
	foreach ($rss_load->channel->item as $item) {
		array_push($RSS_title, $item->title);
		array_push($RSS_cat, $item->category);
		array_push($RSS_des, $item->description);
		array_push($RSS_link, $item->link);
		array_push($RSS_date, $item->pubDate);
		/*$_SESSION["RSS_img"] = "";*/
	}
	list($title1, $title2, $title3) = $RSS_title;
	list($cat1, $cat2, $cat3) = $RSS_cat;
	list($des1, $des2, $des3) = $RSS_des;
	list($link1, $link2, $link3) = $RSS_link;
	list($link1, $link2, $link3) = $RSS_link;
	list($date1, $date2, $date3) = $RSS_date;
	
	/*https://www.journaldugeek.com/feed/rss/*/
	/*https://www.lebigdata.fr/feed*/
	/*https://www.clubic.com/feed/clubic.rss*/
	/*https://www.lesnumeriques.com/rss.html !!! Nom diff !!!*/
?>

<!DOCTYPE html>
<html lang="fr">
<head>
   	<meta charset="utf-8">
	<title>PortFolio Telle Maxens</title>
	<meta name="keywords" content="PortFolio, Portefolio, Telle Maxens"/>
	<meta name="description" content="Binevenue sur mon PortFolio : Telle Maxens">
	<meta name="author" content="Telle Maxens">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 	<!-- CSS -->
	<link rel="stylesheet" href="css/navFooter.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/projects.css">
	<link rel="stylesheet" href="css/CompSlide.css">
	<link rel="stylesheet" href="css/btnAbout.css">
   	<!-- JS -->
	<script src="js/CompSlide.js"></script>
   	<!-- icon-->
	<link rel="icon" type="image/png" href="ressources/favicon.png">
</head>
<header>
	<nav>
		<div class="main-navlinks">
			<button class="hamburger" type="button" aria-label="Toggle navigation" aria-expanded="false">
					<span></span>
					<span></span>
					<span></span>
			</button>
			<div class="navlinks-container">
				<a href="index.html">Accueil</a>
				<a href="#">A propos</a>
				<a href="#">Projets</a>
				<a href="#">Étude</a>
				<a href="#">Veille</a>
				<a href="#contact">Contact</a>
			</div>
		</div>
	</nav>
	<script src="JS/navBare.js"></script>
</header>

<body id="top">
<!--Bloc intro-->
   	<section class="section-intro" id="intro">
	   	<div class="degrader">
			<img src="ressources/images/source-code_1280.jpg" alt="Photo d'un code sur visual studio code" class="intro-img">
		</div>
		<div class="div-intro">
			<h5>Hello, World.</h5>
			<h1>Telle Maxens</h1>
			<p class="intro-position">
				<span>Etudiant à Cambrai</span>
				<span>en BTS SIO</span>
			</p>
		</div>
		<ul class="intro-social">
			<li><a href="#"><i class="fa fa-linkedin">linkedin</i></a></li> <!-- lien -->
		</ul>
   	</section>

<!--Bloc about-->
   	<section id="about" class="section-about">  
		<div class="about-content">
			<div class="div-about">
				<h2>À propos de moi</h2>
				<h5>Laissez-moi me présenter.</h5>
				<div class="intro-info">
					<img src="ressources/favicon.png" alt="Profile Picture">
					<p class="intro-txt">
						Lorem ipsum Exercitation culpa qui dolor consequat exercitation fugiat laborum ex ea eiusmod ad do aliqua 
						occaecat nisi ad irure sunt id pariatur Duis laboris amet exercitation veniam labore consectetur ea id quis eiusmod.
					</p>
				</div>   			
			</div> 
			<div class="button-section">
				<div class="div-btn">
					<a href="#" title="Tableau de compétences" class="button">
						<span class="spanBtn"></span>
						<span class="spanBtn"></span>
						<span class="spanBtn"></span>
						<span class="spanBtn"></span>
						Tableau de compétences
					</a>
					<a href="#" title="Télécharger CV" class="button">
						<span class="spanBtn"></span>
						<span class="spanBtn"></span>
						<span class="spanBtn"></span>
						<span class="spanBtn"></span>
						Télécharger CV
					</a>
					<a href="#" title="Télécharger MOOC de l'ANSII" class="button">
						<span class="spanBtn"></span>
						<span class="spanBtn"></span>
						<span class="spanBtn"></span>
						<span class="spanBtn"></span>
						MOOC de l'ANSII
					</a>
					<a href="#" title="Télécharger l'atelier du RGPD" class="button">
						<span class="spanBtn"></span>
						<span class="spanBtn"></span>
						<span class="spanBtn"></span>
						<span class="spanBtn"></span>
						l'atelier du RGPD
					</a>
				</div>   		
			</div>  		
		</div>
		
		<div class="bodyCompSlide">
			<article class="wrapper">
				<div class="marquee">
					<div class="marquee__group">
						<img src="ressources/images/logo-php.png" alt="Logo PHP">
						<img src="ressources/images/logo-html.png" alt="Logo HTML">
						<img src="ressources/images/logo-css.png" alt="Logo CSS">
						<img src="ressources/images/logo-js.png" alt="Logo JS">
						<img src="ressources/images/logo-java.png" alt="Logo JAVA">
						<img src="ressources/images/logo-lua.png" alt="Logo LUA">
						<img src="ressources/images/logo-sql.png" alt="Logo SQL">
					</div>
					<div class="marquee__group">
						<img src="ressources/images/logo-php.png" alt="Logo PHP">
						<img src="ressources/images/logo-html.png" alt="Logo HTML">
						<img src="ressources/images/logo-css.png" alt="Logo CSS">
						<img src="ressources/images/logo-js.png" alt="Logo JS">
						<img src="ressources/images/logo-java.png" alt="Logo JAVA">
						<img src="ressources/images/logo-lua.png" alt="Logo LUA">
						<img src="ressources/images/logo-sql.png" alt="Logo SQL">
					</div>
				</div>
			</article>
			<article class="wrapper">
				<div class="marquee">
					<div class="marquee__group2">
						<img src="ressources/images/logo-php.png" alt="Logo PHP">
						<img src="ressources/images/logo-html.png" alt="Logo HTML">
						<img src="ressources/images/logo-css.png" alt="Logo CSS">
						<img src="ressources/images/logo-js.png" alt="Logo JS">
						<img src="ressources/images/logo-java.png" alt="Logo JAVA">
						<img src="ressources/images/logo-lua.png" alt="Logo LUA">
						<img src="ressources/images/logo-sql.png" alt="Logo SQL">
					</div>
					<div class="marquee__group2">
						<img src="ressources/images/logo-php.png" alt="Logo PHP">
						<img src="ressources/images/logo-html.png" alt="Logo HTML">
						<img src="ressources/images/logo-css.png" alt="Logo CSS">
						<img src="ressources/images/logo-js.png" alt="Logo JS">
						<img src="ressources/images/logo-java.png" alt="Logo JAVA">
						<img src="ressources/images/logo-lua.png" alt="Logo LUA">
						<img src="ressources/images/logo-sql.png" alt="Logo SQL">
					</div>
				</div>
			</article>
		</div>
<!--
		<div class="tab-Comp">
			<h3>Softskills :</h3>
			<ul class="skill-bars">
				<li>
					<div class="progress percent90"><span>90%</span></div>
					<strong>HTML</strong>
				</li>
				<li>
					<div class="progress percent85"><span>75%</span></div>
					<strong>CSS</strong>
				</li>
				<li>
					<div class="progress percent70"><span>75%</span></div>
					<strong>MySQL</strong>
				</li>
				<li>
					<div class="progress percent95"><span>90%</span></div>
					<strong>PHP</strong>
				</li>
				<li>
					<div class="progress percent75"><span>50%</span></div>
					<strong>Lua</strong>
				</li>
			</ul>	
		</div>
-->
   	</section>  

<!--Bloc Edute-->
<!--
	<section id="etude" class="section-etude">
   		<div class="etude-timeline">
   			<div class="etude-header">
   				<h2>Etudes :</h2>
   			</div>
   			<div class="timeline-wrap">
   				<div class="timeline-block">
	   				<div class="timeline-ico">
	   					<i class="fa fa-briefcase"></i>
	   				</div>
	   				<div class="timeline-header">
	   					<h3>BTS SIO SLAM 1er année</h3>
						<h3>Saint Luc Cambrai</h3>
	   					<p>Mai 2022</p>
	   				</div>
	   				<div class="timeline-content">
	   					<p>
							Lorem ipsum Occaecat do esse ex et dolor culpa nisi ex in magna consectetur nisi cupidatat laboris esse eiusmod deserunt aute
							do quis velit esse sed Ut proident cupidatat nulla esse cillum laborum occaecat nostrud sit dolor incididunt amet est occaecat nisi.
						</p>
	   				</div>
	   			</div>
	   			<div class="timeline-block">
	   				<div class="timeline-ico">
	   					<i class="fa fa-briefcase"></i>
	   				</div>
	   				<div class="timeline-header">
	   					<h3>BAC Pro SN</h3>
						<h3>Saint Luc Cambrai</h3>
	   					<p>Juin 2021</p>
	   				</div>
	   				<div class="timeline-content">
	   					<p>
							Lorem ipsum Occaecat do esse ex et dolor culpa nisi ex in magna consectetur nisi cupidatat laboris esse eiusmod deserunt aute 
							do quis velit esse sed Ut proident cupidatat nulla esse cillum laborum occaecat nostrud sit dolor incididunt amet est occaecat nisi incididunt.
						</p>
	   				</div>
	   			</div>
	   			<div class="timeline-block">
	   				<div class="timeline-ico">
	   					<i class="fa fa-briefcase"></i>
	   				</div>
	   				<div class="timeline-header">
	   					<h3>Brevet de collège</h3>
						<h3>Jean Rostant Le Cateau-Cambresies</h3>
	   					<p>Juin 2018</p>
	   				</div>
	   				<div class="timeline-content">
	   					<p>
							Lorem ipsum Occaecat do esse ex et dolor culpa nisi ex in magna consectetur nisi cupidatat laboris esse eiusmod deserunt aute do quis velit esse 
							sed Ut proident cupidatat nulla esse cillum laborum occaecat nostrud sit dolor incididunt amet est occaecat nisi incididunt.
						</p>
	   				</div>
	   			</div>
   			</div> 			
   		</div>
	</section>
-->

<!--Bloc Projets-->
	<section id="projects" class="section-projet">
		<div class="dev-projects">  
			<h2 class="h2-projects">Projects :</h2>		     	
		</div>

		<div class="body-projects">
			<div class="container">
				<div class="card">
					<div class="box">
						<div class="content">
							<h2>25/06/22</h2>
							<h3>Black art's Tatoo</h3>
							<p>Site internet effectuer pour un salon de tatouage.</p>
							<a href="https://blackartstattoo.fr" target="_bank">Voir Plus</a>
						</div>
					</div>
				</div>

				<div class="card">
					<div class="box">
						<div class="content">
							<h2>04/02/23</h2>
							<h3>J'ai pas de nom</h3>
							<p>Site internet effectuer pour J'ai pas encore fait.</p>
							<a href="#" target="_bank">Voir Plus</a>
						</div>
					</div>
				</div>
			</div>
		</div>
   	</section>

<!--Bloc Veille-->
	<section id="veille" class="section-veille">
		<div class="div-veille">
   			<div>
   				<h2>Veilles :</h2>
   			</div>
   		</div>
   		<div class="container">
			<div class="card">
				<div class="card-header">
				<img src="https://c0.wallpaperflare.com/preview/483/210/436/car-green-4x4-jeep.jpg" alt="rover"/>
				</div>
				<div class="card-body">
				<span class="tag tag-teal"><?php echo $cat1; ?></span>
				<h4>
					<?php echo $title1; ?>
				</h4>
				<p>
					<?php echo $des1; ?>
				</p>
				<div class="user">
					<div class="user-info">
					<h5><?php echo $link1; ?></h5>
					<small><?php echo $date2; ?></small>
					</div>
				</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
				<img src="https://www.newsbtc.com/wp-content/uploads/2020/06/mesut-kaya-LcCdl__-kO0-unsplash-scaled.jpg" alt="ballons"/>
				</div>
				<div class="card-body">
				<span class="tag tag-purple"><?php echo $cat2; ?></span>
				<h4>
					<?php echo $title2; ?>
				</h4>
				<p>
					<?php echo $des2; ?>
				</p>
				<div class="user">
					<div class="user-info">
					<h5><?php echo $link2; ?></h5>
					<small><?php echo $date2; ?></small>
					</div>
				</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
				<img src="https://images6.alphacoders.com/312/thumb-1920-312773.jpg" alt="city"/>
				</div>
				<div class="card-body">
				<span class="tag tag-pink"><?php echo $cat3; ?></span>
				<h4>
					<?php echo $title3; ?>
				</h4>
				<p>
					<?php echo $des3; ?>
				</p>
				<div class="user">
					<div class="user-info">
					<h5><?php echo $link3; ?></h5>
					<small><?php echo $date3; ?></small>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>

<footer>
    <div class="row">
     	<div class="col-six tab-full pull-right social">
     		<ul class="footer-social">        
				<li><a href="#"><i class="fa fa-linkedin"></i></a></li> <!-- lien -->
			</ul> 
		</div>
      	<div class="col-six tab-full">
	      	<div class="copyright">
		        <span>© Copyright Telle Maxens 2022</span>			                  
	      	</div>
      	</div>	
	</div>
</footer>
</html>