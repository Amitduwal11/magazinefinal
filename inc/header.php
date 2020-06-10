<?php
define('BREADCRUBMS', ['contact', 'category', 'about', 'blank']);
define('CAT_COLOR', ['cat-1', 'cat-2', 'cat-3', 'cat-4']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>WebMag | <?php echo (isset($bread) && !empty($bread)) ? $bread : ''; ?></title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="assets/css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>

	<!-- Header -->
	<header id="header">
		<!-- Nav -->
		<div id="nav">
			<!-- Main Nav -->
			<div id="nav-fixed">
				<div class="container">
					<!-- logo -->
					<div class="nav-logo">
						<a href="index" class="logo"><img src="./assets/img/logo.png" alt=""></a>
					</div>
					<!-- /logo -->

					<!-- nav -->
					<ul class="nav-menu nav navbar-nav">
						<?php
						$Category = new category();
						$categories = $Category->getAllCategory();
						if ($categories) {
							foreach ($categories as $key => $category) {
						?>
								<li class="<?php echo CAT_COLOR[$category->id % 4] ?>"><a href="category?id=<?php echo $category->id ?>"><?php echo $category->categoryname; ?></a></li>
						<?php
							}
						}
						?>

					</ul>
					<!-- /nav -->

					<!-- search & aside toggle -->
					<div class="nav-btns">
						<button class="aside-btn"><i class="fa fa-bars"></i></button>
						<button class="search-btn"><i class="fa fa-search"></i></button>
						<form class="search-form" action="../search" method="get">
							<input class="search-input" type="text" name="search" placeholder="Enter Your Search ...">
							<button class="search-close"><i class="fa fa-times"></i></button>
						</form>
					</div>
					<!-- /search & aside toggle -->
				</div>
			</div>
			<!-- /Main Nav -->

			<!-- Aside Nav -->
			<div id="nav-aside">
				<!-- nav -->
				<div class="section-row">
					<ul class="nav-aside-menu">
						<li><a href="index">Home</a></li>
						<li><a href="about">About Us</a></li>
						<li><a href="blank">Join Us</a></li>
						<li><a href="blank">Advertisement</a></li>
						<li><a href="contact">Contacts</a></li>
					</ul>
				</div>
				<!-- /nav -->

				<!-- widget posts -->
				<div class="section-row">
					<h3>Recent Posts</h3>
					<!-- recent -->
					<?php
					$Blog = new blog();
					$recentBlog = $Blog->getAllRecentBlogWithLimit(0, 4);
					//debugger($recentBlog);
					if ($recentBlog) {
						foreach ($recentBlog as $key => $blog) {
							if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH . 'blog/' . $blog->image)) {
								$thumbnail = UPLOAD_URL . 'blog/' . $blog->image;
							} else {
								$thumbnail = UPLOAD_URL . 'noimg.png';
							}
					?>
							<div>
								<div class="post post-widget">
									<a class="post-img" href="blog-post?id=<?php echo $blog->id; ?>"><img src="<?php echo ($thumbnail) ?>" alt=""></a>
									<div class="post-body">
										<h5><a href="blog-post?id=<?php echo $blog->id; ?>"><?php echo $blog->title; ?></a></h5>
									</div>
								</div>
							</div>
					<?php
						}
					}
					?>
				</div>
				<!-- /widget posts -->

				<!-- social links -->
				<div class="section-row">
					<h3>Follow us</h3>
					<?php
					$Followus = new followus();
					$follows = $Followus->getAllFollowUs();
					//debugger($follows);
					?>
					<ul class="nav-aside-social">
						<li><a href="<?php echo $follows[1]->url ?>" class="share-twitter"><i class="<?php echo $follows[1]->iconname ?>"></i></a></li>
						<li><a href="<?php echo $follows[2]->url ?>" class="share-linkedin"><i class="<?php echo $follows[2]->iconname ?>"></i></a></li>
						<li><a href="<?php echo $follows[3]->url ?>" class="share-pinterest"><i class="<?php echo $follows[3]->iconname ?>"></i></a></li>
						<li><a href="<?php echo $follows[4]->url ?>" class="share-gmail"><i class="<?php echo $follows[4]->iconname ?>"></i></a></li>
					</ul>
				</div>
				<!-- /social links -->

				<!-- aside nav close -->
				<button class="nav-aside-close"><i class="fa fa-times"></i></button>
				<!-- /aside nav close -->
			</div>
			<!-- Aside Nav -->
		</div>
		<!-- /Nav -->

		<?php
		if (in_array(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME), BREADCRUBMS)) {
		?>
			<!-- Page Header -->
			<div class="page-header">
				<div class="container">
					<div class="row">
						<div class="col-md-10">
							<ul class="page-header-breadcrumb">
								<li><a href="index">Home</a></li>
								<li><?php echo (isset($bread) && !empty($bread)) ? $bread : ""; ?></li>
							</ul>
							<h1><?php echo (isset($bread) && !empty($bread)) ? $bread : ""; ?></h1>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Header -->
		<?php
		} else if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == 'blog-post') {
			if (isset($blog_info->image) && !empty($blog_info->image) && file_exists(UPLOAD_PATH . 'blog/' . $blog_info->image)) {
				$thumbnail = UPLOAD_URL . 'blog/' . $blog_info->image;
			} else {
				$thumbnail = UPLOAD_URL . 'noimg.jpg';
			}
		?>
			<div id="post-header" class="page-header">
				<div class="background-img" style="background-image: url('<?php echo $thumbnail ?>');"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-10">
							<div class="post-meta">
								<a class="post-category <?php echo CAT_COLOR[$blog_info->categoryid % 4] ?>" href="category?id=<?php echo $blog_info->categoryid ?>"><?php echo $blog_info->category; ?></a>
								<span class="post-date"><?php echo date("M d, Y", strtotime($blog_info->created_date)); ?></span>
							</div>
							<h1><?php echo $blog_info->title; ?></h1>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		?>

	</header>
	<!-- /Header -->