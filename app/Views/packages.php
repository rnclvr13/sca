<!--Start Package-->
	<section class="ftco-section ftco-destination section-body" class="destination" id="package">
		<div class="container">
			<div class="row justify-content-start mb-5 pb-3">
				<div class="col-md-7 heading-section ftco-animate">
					<h2 class="mb-4"><strong>Top </strong> Tour Packages</h2>
				</div>
			</div>
			<div class="container">
				<div class="row d-flex">
					<?php if($packages): ?>
					<?php foreach($packages as $package): ?>
					<div class="col-md-3 d-flex ftco-animate">
						<div class="blog-entry align-self-stretch">
							<a href="#" class="block-20">
								<img src="public/uploads/images/<?= $package['package_img']; ?>" alt="" style="width: 100%; height: 100%; object-fit: cover;">
							</a>
							<div class="text p-3">
								<div class="d-flex">
									<div class="one">
										<h3><a href="#"><?= $package['title']; ?></a></h3>
										<p class="rate">
											<?php
												$rating = $package['rating'];
												$color = '';
												for($count = 1; $count <= 5; $count++){
													if($count <= $rating){

														$color = 'color:#ffcc00;';
														?><i class="icon-star" style="<?php echo $color; ?>"></i><?php

													}else{

														$color = 'color:#ccc;';
														?><i class="icon-star" style="<?php echo $color; ?>"></i><?php
													}
												}
												?>
											<span><?= round($package['rating'], 2); ?> Rating</span>
										</p>
									</div>
								</div>
								<p><?= $package['body']; ?></p>
								<p class="days"><span>1 to 3 hours</span></p>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<div class="row mt-5">
					<div class="col text-center">
						<a class="btn cta-btn" href="<?= site_url("package") ?>">Read More</a>
						<div class="form-group">
					</div>
				</div>
			</div>
				</div>
			</div>
		</div>
	</div>

	</section>
	<!--end packages-->
