<?php
include $_SERVER['DOCUMENT_ROOT'] . 'config/init.php';
if (isset($_GET['id']) && !empty($_GET['id'])) {
	$blog_id = (int) $_GET['id'];
	if ($blog_id) {
		$Blog = new blog();
		$blog_info = $Blog->getBlogbyId($blog_id);
		if ($blog_info) {
			$blog_info = $blog_info[0];
			$data = array(
				'view' => $blog_info->view + 1
			);
			$Blog->updateBlogById($data, $blog_id);
			$bread = 'Blog';
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
			<!-- Post content -->
			<div class="col-md-8">
				<div class="section-row sticky-container">
					<div class="main-post">
						<?php echo html_entity_decode($blog_info->content); ?>
					</div>
					<?php
								$Followus = new followus();
								$follows = $Followus->getAllFollowUs();
								//debugger($follows);
							?>
							<div class="post-shares sticky-shares">
								<a href="<?php echo $follows[0]->url ?>" class="share-twitter"><i class="<?php echo $follows[0]->iconname ?>"></i></a>
								<a href="<?php echo $follows[1]->url ?>" class="share-twitter"><i class="<?php echo $follows[1]->iconname ?>"></i></a>
								<a href="<?php echo $follows[2]->url ?>" class="share-linkedin"><i class="<?php echo $follows[2]->iconname ?>"></i></a>
								<a href="<?php echo $follows[3]->url ?>" class="share-pinterest"><i class="<?php echo $follows[3]->iconname ?>"></i></a>
								<a href="<?php echo $follows[4]->url ?>" class="share-gmail"><i class="<?php echo $follows[4]->iconname ?>"></i></a>
								
							</div>
				</div>

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

				<!-- author -->
				<!-- <div class="section-row">
							<div class="post-author">
								<div class="media">
									<div class="media-left">
										<img class="media-object" src="./assets/img/author.png" alt="">
									</div>
									<div class="media-body">
										<div class="media-heading">
											<h3>John Doe</h3>
										</div>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
										<ul class="author-social">
											<li><a href="#"><i class="fa fa-facebook"></i></a></li>
											<li><a href="#"><i class="fa fa-twitter"></i></a></li>
											<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
											<li><a href="#"><i class="fa fa-instagram"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div> -->
				<!-- /author -->

				<!-- comments -->
				<div class="section-row">
					<div class="section-title">
						<h2>
							<?php
							$Comment = new comment();
							$count = $Comment->getNumberCommentByBlog($blog_id);
							echo $count[0]->total;
							?>
							Comments
						</h2>
					</div>

					<div class="post-comments">
						<!-- comment -->
						<!-- <div class="media">
									<div class="media-left">
										<img class="media-object" src="./assets/img/avatar.png" alt="">
									</div>
									<div class="media-body">
										<div class="media-heading">
											<h4>John Doe</h4>
											<span class="time">March 27, 2018 at 8:00 am</span>
											<a href="#" class="reply">Reply</a>
										</div>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
										comment
										<div class="media">
											<div class="media-left">
												<img class="media-object" src="./assets/img/avatar.png" alt="">
											</div>
											<div class="media-body">
												<div class="media-heading">
													<h4>John Doe</h4>
													<span class="time">March 27, 2018 at 8:00 am</span>
													<a href="#" class="reply">Reply</a>
												</div>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
											</div>
										</div>
										/comment
									</div>
								</div> -->
						<!-- /comment -->

						<?php
						$comments = $Comment->getAllAcceptCommentByBlog($blog_id);
						if ($comments) {
							foreach ($comments as $key => $comment) {
						?>
								<!-- comment -->
								<div class="media">
									<div class="media-left">
										<img class="media-object" src="./assets/img/avatar.png" alt="">
									</div>
									<div class="media-body">
										<div class="media-heading">
											<h4><?php echo $comment->name; ?></h4>
											<span class="time"><?php echo date("M d, Y h:i:s a", strtotime($comment->created_date)); ?></span>
											<a href="#ReplySection" class="reply" onclick="comment(this);" data-commentID="<?php echo ($comment->id) ?>">Reply</a>
										</div>
										<p><?php echo html_entity_decode($comment->message); ?></p>

										<?php
										$replies = $Comment->getAllAcceptReplyByBlogByComment($blog_id, $comment->id);
										if ($replies) {
											foreach ($replies as $key => $reply) {
										?>
												<!-- reply -->
												<div class="media">
													<div class="media-left">
														<img class="media-object" src="./assets/img/avatar.png" alt="">
													</div>
													<div class="media-body">
														<div class="media-heading">
															<h4><?php echo $reply->name; ?></h4>
															<span class="time"><?php echo date('M d, Y h:i:s a', strtotime($reply->created_date)); ?></span>
															<a href="#ReplySection" class="reply" onclick="comment(this);" data-commentID="<?php echo ($comment->id) ?>">Reply</a>
														</div>
														<p><?php echo $reply->message; ?></p>
													</div>
												</div>
												<!-- /reply -->
										<?php
											}
										}

										?>

									</div>
								</div>
								<!-- /comment -->
						<?php
							}
						}
						?>

					</div>
				</div>
				<!-- /comments -->

				<!-- reply -->
				<div class="section-row" id="ReplySection">
					<div class="section-title">
						<h2>Leave a reply</h2>
						<p>your email address will not be published. required fields are marked *</p>
					</div>
					<form class="post-reply" action="process/comment" method="post">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<span>Name *</span>
									<input class="input" type="text" name="name">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<span>Email *</span>
									<input class="input" type="email" name="email">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<span>Website</span>
									<input class="input" type="text" name="website">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<textarea class="input" name="message" placeholder="Message"></textarea>
								</div>
								<input type="hidden" name="commentid" id="comment_id" value="">
								<input type="hidden" name="blogid" value="<?php echo ($blog_id) ?>">
								<button class="primary-button" type="submit">Submit</button>
							</div>
						</div>
					</form>
				</div>
				<!-- /reply -->
			</div>
			<!-- /Post content -->

			<!-- aside -->
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
					$Blog = new blog();
					$popularBlog = $Blog->getAllPopularBlogWithLimit(0, 4);
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

				<!-- post widget -->
				<!-- <div class="aside-widget">
							<div class="section-title">
								<h2>Featured Posts</h2>
							</div>
							<div class="post post-thumb">
								<a class="post-img" href="blog-post.html"><img src="./assets/img/post-2.jpg" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-blog cat-3" href="#">Jquery</a>
										<span class="post-date">March 27, 2018</span>
									</div>
									<h3 class="post-title"><a href="blog-post.html">Ask HN: Does Anybody Still Use JQuery?</a></h3>
								</div>
							</div>

							<div class="post post-thumb">
								<a class="post-img" href="blog-post.html"><img src="./assets/img/post-1.jpg" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-blog cat-2" href="#">JavaScript</a>
										<span class="post-date">March 27, 2018</span>
									</div>
									<h3 class="post-title"><a href="blog-post.html">Chrome Extension Protects Against JavaScript-Based CPU Side-Channel Attacks</a></h3>
								</div>
							</div>
						</div> -->
				<!-- /post widget -->

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
			<!-- /aside -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<?php include 'inc/footer.php';; ?>
<script>
	$('blockquote').addClass('blockquote');

	function comment(element) {
		var id = $(element).data();
		console.log(id.commentid);
		$('#comment_id').val(id.commentid);
	}
</script>