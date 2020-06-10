<?php
include $_SERVER['DOCUMENT_ROOT'] . 'config/init.php';
$bread = 'Home';
include 'inc/header.php';
?>

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->

		<div class="row">
			<?php
			$Blog = new blog();
			$featuredBlog = $Blog->getAllFeaturedBlogWithLimit(0, 2);
			if (isset($featuredBlog) && !empty($featuredBlog)) {
				foreach ($featuredBlog as $key => $blog) {
			?>
					<div class="col-md-6">
						<div class="post post-thumb">
							<?php
							if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH . 'blog/' . $blog->image)) {
								$thumbnail = UPLOAD_URL . 'blog/' . $blog->image;
							} else {
								$thumbnail = UPLOAD_URL . 'noimg.jpg';
							}
							?>
							<a class="post-img" href="blog-post?id=<?php echo ($blog->id) ?>"><img src="<?php echo $thumbnail ?>" alt="" style="height: 350px"></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category <?php echo CAT_COLOR[$blog->categoryid % 4] ?>" href="category?id=<?php echo $blog->categoryid ?>"><?php echo $blog->category; ?></a>
									<span class="post-date"><?php echo date('M d Y', strtotime($blog->created_date)); ?></span>
								</div>
								<h3 class="post-title "><a href="blog-post?id=<?php echo ($blog->id) ?>"><?php echo $blog->title; ?></a></h3>
							</div>
						</div>
					</div>
			<?php

				}
			}
			?>
			<!-- post -->
		</div>


		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>Recent Posts</h2>
				</div>
			</div>

			<!-- post -->
			<!-- recent -->
			<?php
			$recentBlog = $Blog->getAllRecentBlogWithLimit(0, 6);
			//debugger($recentBlog);
			$Count = 0;
			if ($recentBlog) {
				foreach ($recentBlog as $key => $blog) {
					if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH . 'blog/' . $blog->image)) {
						$thumbnail = UPLOAD_URL . 'blog/' . $blog->image;
					} else {
						$thumbnail = UPLOAD_URL . 'noimg.jpg';
					}
			?>
					<div class="col-md-4">
						<div class="post">
							<a class="post-img" href="blog-post?id=<?php echo $blog->id; ?>"><img src="<?php echo ($thumbnail) ?>" alt="" style="height:250px"></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category <?php echo CAT_COLOR[$blog->categoryid % 4] ?>" href="category?id=<?php echo $blog->categoryid ?>"><?php echo  $blog->category; ?></a>
									<span class="post-date"><?php echo date('M d Y', strtotime($blog->created_date)); ?></span>
								</div>
								<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id; ?>"><?php echo $blog->title; ?></a></h3>
							</div>
						</div>
					</div>
					<?php
					$Count += 1;
					if ($Count % 3 == 0) {
					?><div class="clearfix visible-md visible-lg"></div>
			<?php
					}
				}
			}
			?>

		</div>
		<!-- /row -->

		<!-- row -->
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<!-- post -->
					<?php
					$popularBlog = $Blog->getAllPopularBlogWithLimit(0, 1);
					if ($popularBlog) {
						//debugger($popularBlog);
						if (isset($popularBlog[0]->image) && !empty($popularBlog[0]->image) && file_exists(UPLOAD_PATH . 'blog/' . $popularBlog[0]->image)) {
							$thumbnail = UPLOAD_URL . 'blog/' . $popularBlog[0]->image;
						} else {
							$thumbnail = UPLOAD_URL . 'noimg.jpg';
						}
					?>
						<div class="col-md-12">
							<div class="post post-thumb">
								<a class="post-img" href="blog-post?id=<?php echo $popularBlog[0]->id; ?>"><img src="<?php echo ($thumbnail) ?>" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category <?php echo CAT_COLOR[$popularBlog[0]->categoryid % 4] ?>" href="category?id=<?php echo $popularBlog[0]->categoryid ?>"><?php echo $popularBlog[0]->category ?></a>
										<span class="post-date"><?php echo date("M d, Y", strtotime($popularBlog[0]->created_date))  ?></span>
									</div>
									<h3 class="post-title"><a href="blog-post?id=<?php echo $popularBlog[0]->id; ?>"><?php echo $popularBlog[0]->title; ?></a></h3>
								</div>
							</div>
						</div>
					<?php

					}
					?>
					<!-- /post -->

					<!-- post -->
					<?php
					$recentBlog = $Blog->getAllRecentBlogWithLimit(6, 6);
					//debugger($recentBlog);
					$Count = 0;
					if ($recentBlog) {
						foreach ($recentBlog as $key => $blog) {
							if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH . 'blog/' . $blog->image)) {
								$thumbnail = UPLOAD_URL . 'blog/' . $blog->image;
							} else {
								$thumbnail = UPLOAD_URL . 'noimg.jpg';
							}
					?>
							<div class="col-md-6">
								<div class="post">
									<a class="post-img" href="blog-post?id=<?php echo $blog->id; ?>"><img src="<?php echo ($thumbnail) ?>" alt="" style="height:250px"></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category <?php echo CAT_COLOR[$blog->categoryid % 4] ?>" href="category?id=<?php echo $blog->categoryid ?>"><?php echo  $blog->category; ?></a>
											<span class="post-date"><?php echo date('M d Y', strtotime($blog->created_date)); ?></span>
										</div>
										<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id; ?>"><?php echo $blog->title; ?></a></h3>
									</div>
								</div>
							</div>
							<?php
							$Count += 1;
							if ($Count % 2 == 0) {
							?><div class="clearfix visible-md visible-lg"></div>
					<?php
							}
						}
					}
					?>
					<!-- /post -->
				</div>
			</div>

			<div class="col-md-4">
				<!-- post widget -->
				<div class="aside-widget">
					<div class="section-title">
						<h2>Most Read</h2>
					</div>
					<?php
					$popularBlog = $Blog->getAllPopularBlogWithLimit(1, 4);
					if ($popularBlog) {
						foreach ($popularBlog as $key => $blog) {
							if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH . 'blog/' . $blog->image)) {
								$thumbnail = UPLOAD_URL . 'blog/' . $blog->image;
							} else {
								$thumbnail = UPLOAD_URL . 'noimg.jpg';
							}
					?>
							<div class="post post-widget">
								<a class="post-img" href="blog-post?id=<?php echo $blog->id; ?>"><img src="<?php echo ($thumbnail) ?>" alt=""></a>
								<div class="post-body">
									<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id; ?>"><?php echo $blog->title; ?></a></h3>
								</div>
							</div>
					<?php
						}
					}
					?>

				</div>
				<!-- /post widget -->

				<!-- post widget -->
				<div class="aside-widget">
					<div class="section-title">
						<h2>Featured Posts</h2>
						<?php
						$featuredBlog = $Blog->getAllFeaturedBlogWithLimit(1, 3);
						if (isset($featuredBlog) && !empty($featuredBlog)) {
							foreach ($featuredBlog as $key => $blog) {
						?>

								<div class="post post-thumb">
									<?php
									if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH . 'blog/' . $blog->image)) {
										$thumbnail = UPLOAD_URL . 'blog/' . $blog->image;
									} else {
										$thumbnail = UPLOAD_URL . 'noimg.jpg';
									}
									?>
									<a class="post-img" href="blog-post?id=<?php echo ($blog->id) ?>"><img src="<?php echo $thumbnail ?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category <?php echo CAT_COLOR[$blog->categoryid % 4] ?>" href="category?id=<?php echo $blog->categoryid ?>"><?php echo $blog->category; ?></a>
											<span class="post-date"><?php echo date('M d Y', strtotime($blog->created_date)); ?></span>
										</div>
										<h3 class="post-title "><a href="blog-post?id=<?php echo ($blog->id) ?>"><?php echo $blog->title; ?></a></h3>
									</div>
								</div>

						<?php
							}
						}
						?>
					</div>

				</div>
				<!-- /post widget -->
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
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<!-- section -->
<div class="section section-grey">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="section-title text-center">
					<h2>Featured Posts</h2>
				</div>
			</div>

			<!-- post -->
			<?php
			$featuredBlog = $Blog->getAllFeaturedBlogWithLimit(2, 3);
			if (isset($featuredBlog) && !empty($featuredBlog)) {
				foreach ($featuredBlog as $key => $blog) {
			?>
					<div class="col-md-4">
						<div class="post">
							<?php
							if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH . 'blog/' . $blog->image)) {
								$thumbnail = UPLOAD_URL . 'blog/' . $blog->image;
							} else {
								$thumbnail = UPLOAD_URL . 'noimg.jpg';
							}
							?>
							<a class="post-img" href="blog-post?id=<?php echo ($blog->id) ?>"><img src="<?php echo $thumbnail ?>" style="height: 220px" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category <?php echo CAT_COLOR[$blog->categoryid % 4] ?>" href="category?id=<?php echo $blog->categoryid ?>"><?php echo $blog->category; ?></a>
									<span class="post-date"><?php echo date('M d Y', strtotime($blog->created_date)); ?></span>
								</div>
								<h3 class="post-title "><a href="blog-post?id=<?php echo ($blog->id) ?>"><?php echo $blog->title; ?></a></h3>
							</div>
						</div>
					</div>

			<?php
				}
			}
			?>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<!-- row -->
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<div class="section-title">
							<h2>Most Read</h2>
						</div>
					</div>
					<?php
					//from above
					$popularBlog = $Blog->getAllPopularBlogWithLimit(0, 4);
					//debugger($popularBlog);
					if ($popularBlog) {
						foreach ($popularBlog as $key => $blog) {
							if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH . 'blog/' . $blog->image)) {
								$thumbnail = UPLOAD_URL . 'blog/' . $blog->image;
							} else {
								$thumbnail = UPLOAD_URL . 'noimg.jpg';
							}
					?>

							<div class="col-md-12">
								<div class="post post-row">
									<a class="post-img" href="blog-post?id=<?php echo $blog->id; ?>"><img src="<?php echo ($thumbnail) ?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category <?php echo CAT_COLOR[$blog->categoryid % 5] ?>" href="category?id=<?php echo $blog->categoryid ?>"><?php echo $blog->category; ?></a>
											<span class="post-date"><?php echo date("M d, Y", strtotime($blog->created_date)); ?></span>
										</div>
										<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id; ?>"><?php echo $blog->title; ?></a></h3>
										<p><?php echo substr(html_entity_decode($blog->content), 0, 100) . "...<br>" ?>
											<a href="blog-post?id=<?php echo $blog->id; ?>">Read More</a>
										</p>
									</div>
								</div>
							</div>
					<?php
						}
					}
					?>


				</div>
			</div>


			<div class="col-md-4">
				<!-- ad -->
				<?php
							$ADS = new advertisement();
							$ads = $ADS->getAdvertisementbyType('simple');
							//debugger($ads);
							if (isset($ads[0]->image) && !empty($ads[0]->image) && file_exists(UPLOAD_PATH.'advertisement/'.$ads[0]->image)) {
													$thumbnail = UPLOAD_URL.'advertisement/'.$ads[0]->image;
												}else{
													$thumbnail = UPLOAD_URL.'noimg.jpg';
												}

						?>
						<div class="aside-widget text-center">
							<a class="post-img" href="<?php echo $ads[0]->url ?>" style="display: inline-block;margin: auto;">
								<img  class="img-responsive" src="<?php echo $thumbnail ?>" alt="">
							</a>
							<div class="post-body">
									<h3 class="post-title"><a href="<?php echo $ads[0]->url ?>"><?php echo $ads[0]->caption; ?></a></h3>
							</div>	
						</div>
						<!-- /ad -->

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
									<li><a href="#" class="<?php echo CAT_COLOR[$category->id%4] ?>"><?php echo($category->categoryname) ?><span>
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
									<li><a href="archive?id=<?php echo $archive->id ?>"><?php echo date('M d, Y',strtotime($archive->date)); ?></a></li>
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