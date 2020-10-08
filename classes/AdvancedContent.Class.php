<?php

/**
 * Class AdvancedContent
 */
class AdvancedContent {
	/**
	 * @var null
	 */
	private static $instance = null;

	/**
	 * AdvancedContent constructor.
	 */
	private function __construct() {
		add_shortcode('display_content', [$this, 'display_content']);
	}

	/**
	 * @return null|\AdvancedContent
	 */
	static function getInstance() {
		if (self::$instance == null) {
			self::$instance = new AdvancedContent();
		}

		return self::$instance;
	}

	/**
	 * displays all the content of the shortcodes
	 */
	function display_content() {
		function display_content($atts) {
			$a = shortcode_atts( array(
				'type'           => 'carousel',
				'size'           => 'big',
				'posts_per_page' => 6,
				//        'category_name' => 'uncategorized',
				'post_type'      => 'post'
			), $atts );

			$args = array (
				'post_type'	=> $a['post_type'],
				'posts_per_page' => $a['posts_per_page'],
				'category_name' => $a['category_name']
			);

			$content = new WP_Query($args);
			ob_start();
			?>
			<?php if ($content->have_posts()) : ?>
				<div class="content-shortcode <?php echo $a['type'] . ' ' . $a['size']. ' ' .$a['post_type']; ?>">
					<?php if (('carousel' == $a['type']) && ('full' == $a['size'])) : ?>
						<div class="swiper-container">
							<div class="swiper-wrapper">
								<?php
								while ( $content->have_posts() ) : $content->the_post();
									?>
									<div class="swiper-slide">
										<div class="wrap">
											<div class="inner-wrap">
												<a href="<?php the_permalink(); ?>">
													<?php anfUtility::thumbnail(array('size' => 'image-carousel')); ?>
												</a>
												<div class="inner">
													<div class="meta"><?php echo anfUtility::getTerms(); ?></div>
													<h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
												</div>
											</div>
										</div>
									</div>
								<?php
								endwhile;
								?>
							</div>
							<a href="#" class="arrow left"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
							<a href="#" class="arrow right"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
						</div>
					<?php endif; ?>
					<?php if (('carousel' == $a['type']) && ('big' == $a['size'])) : ?>
						<div class="swiper-container cf-large-2 cf-medium-2">
							<div class="swiper-wrapper">
								<?php
								while ( $content->have_posts() ) : $content->the_post();
									?>
									<div class="swiper-slide">
										<div class="wrap">
											<div class="inner-wrap">
												<a href="<?php the_permalink(); ?>">
													<?php anfUtility::thumbnail(array('size' => 'image-carousel')); ?>
													<h4 class="title"><?php the_title(); ?></h4>
												</a>
											</div>
											<div class="inner">

												<div class="excerpt">
													<?php echo substr(get_the_excerpt(), 0, 200); ?>
												</div>
												<a href="<?php the_permalink(); ?>" class="more-link">READ MORE</a>
											</div>
										</div>
									</div>
								<?php
								endwhile;
								?>
							</div>
							<a href="#" class="arrow left"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
							<a href="#" class="arrow right"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
						</div>
					<?php endif; ?>

					<?php if (('carousel' == $a['type']) && ('small' == $a['size'])) : ?>
						<div class="swiper-container cf-large-3 cf-medium-2">
							<div class="swiper-wrapper">
								<?php
								while ( $content->have_posts() ) : $content->the_post();
									?>
									<div class="swiper-slide">
										<div class="wrap">
											<a href="<?php the_permalink(); ?>">
												<?php anfUtility::thumbnail(array('size' => 'service-thumb')); ?>
											</a>
											<div class="inner">
												<h4 class="title"><?php the_title(); ?></h4>
												<div class="excerpt">
													<?php echo substr(get_the_excerpt(), 0, 200); ?>
												</div>
												<a href="<?php the_permalink(); ?>">READ MORE</a>
											</div>
										</div>
									</div>
								<?php
								endwhile;
								?>
							</div>

							<a href="#" class="arrow left"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
							<a href="#" class="arrow right"><i class="fa fa-angle-right" aria-hidden="true"></i></a>

							<div class="pagination"></div>
						</div>
					<?php endif; ?>

					<?php if (('feed' == $a['type']) && ('big' == $a['size'])) : ?>
						<div class="post-feed <?php echo $a['size']; ?>">
							<?php while($content->have_posts()) : $content->the_post(); ?>
								<div class="item">
									<a href="<?php the_permalink(); ?>"> <h3 class="title"><?php the_title(); ?></h3></a>
									<div class="meta">
										<?php echo get_the_date();?> / <?php echo anfUtility::getTerms(); ?>
									</div>

									<div class="image">
										<a href="<?php the_permalink(); ?>">
											<?php anfUtility::thumbnail(array('size' => 'large')); ?>
										</a>
									</div>
									<div class="wrap">

										<div class="excerpt">
											<?php the_excerpt(); ?>
										</div>

										<div class="share_buttons">
											<?php echo do_shortcode('[addtoany]');?>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>

					<?php if (('feed' == $a['type']) && ('small' == $a['size'])) : ?>
						<div class="post-feed <?php echo $a['size']; ?>">
							<?php while($content->have_posts()) : $content->the_post(); ?>
								<div class="item">
									<div class="columns small-12 medium-4 no-padding">
										<div class="image">
											<a href="<?php the_permalink(); ?>">
												<?php anfUtility::thumbnail(array('size' => 'image-grid')); ?>
											</a>
										</div>
									</div>
									<div class="columns small-12 medium-8">
										<div class="wrap">
											<!--
                                    <div class="meta">
                                        <?php echo anfUtility::getTerms(); ?>
                                    </div>
-->
											<a href="<?php the_permalink(); ?>"><h4 class="title"><?php the_title(); ?></h4></a>
											<a class="more-link" href="<?php the_permalink(); ?>">Read</a>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>

					<?php if (('grid' == $a['type']) && ('big' == $a['size'])) : ?>
						<div class="post-grid">
							<ul class="medium-block-grid-3">
								<?php while($content->have_posts()) : $content->the_post(); ?>
									<li class="post-item post-<?php the_ID(); ?>">
										<div class="wrap">
											<a href="<?php the_permalink(); ?>">
												<?php anfUtility::thumbnail(array('size' => 'service-thumb')); ?>
												<div class="inner">
													<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
												</div>
											</a>
										</div>
									</li>
								<?php endwhile; ?>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; wp_reset_postdata(); ?>
			<?php
			return ob_get_clean();
		}
	}
}