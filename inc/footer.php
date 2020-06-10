<!-- Footer -->
<footer id="footer">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-5">
						<div class="footer-widget">
							<div class="footer-logo">
								<a href="index" class="logo"><img src="./assets/img/logo.png" alt=""></a>
							</div>
							<ul class="footer-nav">
								<li><a href="blank">Privacy Policy</a></li>
								<li><a href="blank">Advertisement</a></li>
							</ul>
							<div class="footer-copyright">
								<span>
								&copy; <?php echo Date("Y"); ?> All Rights Reserved
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-6">
								<div class="footer-widget">
									<h3 class="footer-title">About Us</h3>
									<ul class="footer-links">
										<li><a href="about">About Us</a></li>
										<li><a href="blank">Join Us</a></li>
										<li><a href="contact">Contacts</a></li>
									</ul>
								</div>
							</div>
							<div class="col-md-6">
								<div class="footer-widget">
									<h3 class="footer-title">Categories</h3>
									<ul class="footer-links">
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
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="footer-widget">
							<h3 class="footer-title">Join our Newsletter</h3>
							<div class="footer-newsletter">
							<form action="process/newsletter" method="post">
									<input class="input" type="email" name="email" placeholder="Enter your email">
									<input type="hidden" name="id" id="id" value="">
									<button type="submit" class="newsletter-btn"><i class="fa fa-paper-plane"></i></button>
							</form>
							</div>
							<?php
								$Followus = new followus();
								$follows = $Followus->getAllFollowUs();
								//debugger($follows);
							?>
							<ul class="footer-social">
							
							<li><a href="<?php echo $follows[1]->url ?>" class="share-twitter"><i class="<?php echo $follows[1]->iconname ?>"></i></a></li>
							<li><a href="<?php echo $follows[2]->url ?>" class="share-linkedin"><i class="<?php echo $follows[2]->iconname ?>"></i></a></li>
							<li><a href="<?php echo $follows[3]->url ?>" class="share-pinterest"><i class="<?php echo $follows[3]->iconname ?>"></i></a></li>
							<li><a href="<?php echo $follows[4]->url ?>" class="share-gmail"><i class="<?php echo $follows[4]->iconname ?>"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</footer>
		<!-- /Footer -->
		<!-- jQuery Plugins -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/main.js"></script>
	</body>
</html>