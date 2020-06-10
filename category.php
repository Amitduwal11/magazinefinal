<?php
include $_SERVER['DOCUMENT_ROOT'] . 'config/init.php';
if (isset($_GET['id']) && !empty($_GET['id'])) {
	$cat_id = (int) $_GET['id'];
	if ($cat_id) {
		$Category = new category();
		$category_info = $Category->getCategorybyId($cat_id);
		if ($category_info) {
			$category_info = $category_info[0];
			$bread = $category_info->categoryname;
		} else {
			redirect('index');
		}
	} else {
		redirect('index');
	}
} else {
	redirect('index');
}

include 'inc/header.php';
?>
<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<?php
					$Blog = new blog();
					$featuredBlog = $Blog->getAllFeaturedBlogByCategoryWithLimit($cat_id, 0, 3);
					if (isset($featuredBlog[0]) && !empty($featuredBlog[0])) {
					?>
						<!-- post -->
						<div class="col-md-12">
							<div class="post post-thumb">
								<?php
								if (isset($featuredBlog[0]->image) && !empty($featuredBlog[0]->image) && file_exists(UPLOAD_PATH . 'blog/' . $featuredBlog[0]->image)) {
									$thumbnail = UPLOAD_URL . 'blog/' . $featuredBlog[0]->image;
								} else {
									$thumbnail = UPLOAD_URL . 'noimg.jpg';
								}
								?>
								<a class="post-img" href="blog-post?id=<?php echo ($featuredBlog[0]->id) ?>"><img src="<?php echo ($thumbnail); ?>" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category <?php echo CAT_COLOR[$cat_id % 4] ?>" href="#"><?php echo $bread; ?></a>
										<span class="post-date"><?php echo date("M d, Y", strtotime($featuredBlog[0]->created_date)); ?></span>
									</div>
									<h3 class="post-title"><a href="blog-post?id=<?php echo ($featuredBlog[0]->id) ?>"><?php echo $featuredBlog[0]->title; ?></a></h3>
								</div>
							</div>
						</div>
						<!-- /post -->
					<?php
					}
					if (isset($featuredBlog[1]) && !empty($featuredBlog[1]) && isset($featuredBlog[2]) && !empty($featuredBlog[2])) {
					?>

						<!-- post -->
						<div class="col-md-6">
							<div class="post">
								<?php
								if (isset($featuredBlog[1]->image) && !empty($featuredBlog[1]->image) && file_exists(UPLOAD_PATH . 'blog/' . $featuredBlog[1]->image)) {
									$thumbnail = UPLOAD_URL . 'blog/' . $featuredBlog[1]->image;
								} else {
									$thumbnail = UPLOAD_URL . 'noimg.jpg';
								}
								?>
								<a class="post-img" href="blog-post?id=<?php echo ($featuredBlog[1]->id) ?>"><img src="<?php echo ($thumbnail); ?>" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category <?php echo CAT_COLOR[$cat_id % 4] ?>" href="#"><?php echo $bread; ?></a>
										<span class="post-date"><?php echo date("M d, Y", strtotime($featuredBlog[1]->created_date)); ?></span>
									</div>
									<h3 class="post-title"><a href="blog-post?id=<?php echo ($featuredBlog[1]->id) ?>"><?php echo $featuredBlog[1]->title; ?></a></h3>
								</div>
							</div>
						</div>
						<!-- /post -->

						<!-- post -->
						<div class="col-md-6">
							<div class="post">
								<?php
								if (isset($featuredBlog[2]->image) && !empty($featuredBlog[2]->image) && file_exists(UPLOAD_PATH . 'blog/' . $featuredBlog[2]->image)) {
									$thumbnail = UPLOAD_URL . 'blog/' . $featuredBlog[2]->image;
								} else {
									$thumbnail = UPLOAD_URL . 'noimg.jpg';
								}
								?>
								<a class="post-img" href="blog-post?id=<?php echo ($featuredBlog[2]->id) ?>"><img src="<?php echo ($thumbnail); ?>" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category <?php echo CAT_COLOR[$cat_id % 4] ?>" href="#"><?php echo $bread; ?></a>
										<span class="post-date"><?php echo date("M d, Y", strtotime($featuredBlog[2]->created_date)); ?></span>
									</div>
									<h3 class="post-title"><a href="blog-post?id=<?php echo ($featuredBlog[2]->id) ?>"><?php echo $featuredBlog[2]->title; ?></a></h3>
								</div>
							</div>
						</div>
						<!-- /post -->
					<?php
					}
					?>







					<div class="clearfix visible-md visible-lg"></div>

					<!-- ad -->
					<?php
					$ADS = new advertisement();
					$ads = $ADS->getAdvertisementbyType('wide');
					//debugger($ads);
					if (isset($ads[0]->image) && !empty($ads[0]->image) && file_exists(UPLOAD_PATH . 'advertisement/' . $ads[0]->image)) {
						$thumbnail = UPLOAD_URL . 'advertisement/' . $ads[0]->image;
					} else {
						$thumbnail = UPLOAD_URL . 'noimg.jpg';
					}

					?>
					<div class="aside-widget text-center">
						<a class="post-img" href="<?php echo $ads[0]->url ?>" style="display: inline-block;margin: auto;">
							<img class="img-responsive" src="<?php echo $thumbnail ?>" alt="">
						</a>
						<div class="post-body">
							<h3 class="post-title"><a href="<?php echo $ads[0]->url ?>"><?php echo $ads[0]->caption; ?></a></h3>
						</div>
					</div>
					<!-- /ad -->
					<div class="col-md-12">
						<div class="section-title">
							<h2>Recent Posts</h2>
						</div>
					</div>
					<?php
					$recentBlog = $Blog->getAllRecentBlogByCategoryWithLimit($cat_id, 0, 4);
					if ($recentBlog) {
						foreach ($recentBlog as $key => $blog) {
							if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH . 'blog/' . $blog->image)) {
								$thumbnail = UPLOAD_URL . 'blog/' . $blog->image;
							} else {
								$thumbnail = UPLOAD_URL . 'noimg.jpg';
							}
					?>
							<!-- post -->
							<div class="col-md-12">
								<div class="post post-row">

									<a class="post-img" href="blog-post?id=<?php echo $blog->id ?>"><img src="<?php echo ($thumbnail); ?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category <?php echo CAT_COLOR[$cat_id % 4] ?>" href="#"><?php echo $bread; ?></a>
											<span class="post-date"><?php echo date("M d, Y", strtotime($blog->created_date)); ?></span>
										</div>
										<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id ?>"><?php echo $blog->title; ?></a></h3>
										<p>
											<?php echo substr(html_entity_decode($blog->content), 0, 100) . "...<br>"; ?>
											<a href="blog-post?id=<?php echo $blog->id ?>">Read More</a>
										</p>
									</div>
								</div>
							</div>
							<!-- /post -->
					<?php
						}
					}
					?>



					<div class="col-md-12">

					</div>
				</div>
			</div>

			<div class="col-md-4">
				<!-- ad -->
				<?php
				$ADS = new advertisement();
				$ads = $ADS->getAdvertisementbyType('simple');
				//debugger($ads);
				if (isset($ads[0]->image) && !empty($ads[0]->image) && file_exists(UPLOAD_PATH . 'advertisement/' . $ads[0]->image)) {
					$thumbnail = UPLOAD_URL . 'advertisement/' . $ads[0]->image;
				} else {
					$thumbnail = UPLOAD_URL . 'noimg.jpg';
				}

				?>
				<div class="aside-widget text-center">
					<a class="post-img" href="<?php echo $ads[0]->url ?>" style="display: inline-block;margin: auto;">
						<img class="img-responsive" src="<?php echo $thumbnail ?>" alt="">
					</a>
					<div class="post-body">
						<h3 class="post-title"><a href="<?php echo $ads[0]->url ?>"><?php echo $ads[0]->caption; ?></a></h3>
					</div>
				</div>
				<!-- /ad -->

				<!-- post widget -->
				<div class="aside-widget">
					<div class="section-title">
						<h2>Most Read</h2>
					</div>

					<?php
					$popularBlog = $Blog->getAllPopularBlogByCategoryWithLimit($cat_id, 0, 4);
					if ($popularBlog) {
						foreach ($popularBlog as $key => $blog) {
							if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH . 'blog/' . $blog->image)) {
								$thumbnail = UPLOAD_URL . 'blog/' . $blog->image;
							} else {
								$thumbnail = UPLOAD_URL . 'noimg.jpg';
							}
					?>
							<div class="post post-widget">
								<a class="post-img" href="blog-post?id=<?php echo $blog->id ?>"><img src="<?php echo ($thumbnail); ?>" alt=""></a>
								<div class="post-body">
									<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id ?>"><?php echo $blog->title; ?></a></h3>
								</div>
							</div>

					<?php
						}
					}
					?>


				</div>
				<!-- /post widget -->

				<!-- catagories -->
				<div class="aside-widget">
					<div class="section-title">
						<h2>Catagories</h2>
					</div>
					<div class="category-widget">
						<ul>
							<?php
							if ($categories) {
								foreach ($categories as $key => $category) {
							?>
									<li><a href="#" class="<?php echo CAT_COLOR[$category->id % 4] ?>"><?php echo ($category->categoryname) ?><span>
												<?php
												$Count = $Blog->getNumberBlogByCategory($category->id);
												echo $Count[0]->total;
												?>
											</span></a></li>
							<?php
								}
							}
							?>

						</ul>
					</div>
				</div>
				<!-- /catagories -->

						<!-- tags -->
						<div class="aside-widget">
							<div class="tags-widget">
								<ul>
									<?php
										$Category = new category();
										$categories = $Category->getAllCategory();
										if($categories){
											foreach ($categories as $key => $category) {
									?>
												<li><a href="category?id=<?php echo $category->id ?>"><?php echo $category->categoryname?></a></li>
									<?php	
											}
										}
									?>
									<!-- <li><a href="#">Add</a></li> -->
								</ul>
							</div>
						</div>
						<!-- /tags -->
						
				<!-- archive -->
				<div class="aside-widget">
					<div class="section-title">
						<h2>Archive</h2>
					</div>
					<div class="archive-widget">
						<ul>
							<?php
							$Archive = new archive();
							$archives = $Archive->getAllArchive();
							if ($archives) {
								foreach ($archives as $key => $archive) {
							?>
									<li><a href="archive?id=<?php echo $archive->id ?>"><?php echo date('M d, Y', strtotime($archive->date)); ?></a></li>
							<?php
								}
							}
							?>
						</ul>
					</div>
				</div>
				<!-- /archive -->
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<?php include 'inc/footer.php'; ?>