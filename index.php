<?php
	$RSS_title = array();
	$RSS_cat = array();
	$RSS_des = array();
	$RSS_link = array();

	$rss_link = "https://www.lebigdata.fr/feed";
	$rss_load = simplexml_load_file($rss_link);
	foreach ($rss_load->channel->item as $item) {
		array_push($RSS_title, $item->title);
		array_push($RSS_cat, $item->category);
		array_push($RSS_des, $item->description);
		array_push($RSS_link, $item->link);
		/*$_SESSION["RSS_img"] = "";*/
	}
	list($title1, $title2, $title3) = $RSS_title;
	list($cat1, $cat2, $cat3) = $RSS_cat;
	list($des1, $des2, $des3) = $RSS_des;
	list($link1, $link2, $link3) = $RSS_link;
	
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
   	<!-- JS -->
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
				<a href="index.html" aria-current="page">Accueil</a>
				<a href="galerie.php" aria-current="Galerie">Galerie</a>
				<a href="#contact">Contact</a>
			</div>
		</div>
	</nav>
	<script src="JS/navBare.js"></script>
</header>
<body id="top">
   	<section class="section-intro" id="intro">
		<div class="div-intro">
			<h5>Hello, World.</h5>
			<h1>Telle Maxens</h1>
			<p class="intro-position">
				<span>Etudian à Cambrai</span>
				<span>BTS SIO</span>
			</p>
		</div>
		<ul class="intro-social">
			<li><a href="#"><i class="fa fa-linkedin">linkedin</i></a></li> <!-- lien -->
		</ul>
   	</section>

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
					<a href="#" title="Tableau de compétences" class="button stroke smoothscroll">Tableau de compétences</a>
					<a href="#" title="Télécharger CV" class="button button-primary">Télécharger CV</a>
					<a href="#" title="Télécharger MOOC de l'ANSII" class="button button-primary">MOOC de l'ANSII</a>
				</div>   		
			</div>  		
		</div>

		<div class="tab-Comp">
			<h3>Compétences :</h3>
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
   	</section>  

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
	   					<p>Lorem ipsum Occaecat do esse ex et dolor culpa nisi ex in magna consectetur nisi cupidatat laboris esse eiusmod deserunt aute do quis velit esse sed Ut proident cupidatat nulla esse cillum laborum occaecat nostrud sit dolor incididunt amet est occaecat nisi incididunt.</p>
	   				</div>
	   			</div>
   			</div> 			
   		</div>
	</section>

	<section id="projects" class="section-projet">
		<div class="projects-content">
			<div class="dev-projects">  
				<h2 class="h2-projects">Projects :</h2>
				<p class="txt-projects">
					Affichier les projects.
				</p>		     	
			</div>
		</div>
   	</section>

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
					<small>2h ago</small>
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
					<?php echo $title2 ?>
				</h4>
				<p>
					<?php echo $des2; ?>
				</p>
				<div class="user">
					<div class="user-info">
					<h5><?php echo $link2; ?></h5>
					<small>Yesterday</small>
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
					<?php echo $title3 ?>
				</h4>
				<p>
					<?php echo $des3; ?>
				</p>
				<div class="user">
					<div class="user-info">
					<h5><?php echo $link3; ?></h5>
					<small>1w ago</small>
					</div>
				</div>
			</div>
		</div>
	</section>

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
   	</footer>
</body>
</html>