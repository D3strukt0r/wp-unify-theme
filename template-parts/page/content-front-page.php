
<!-- Blog Minimal Blocks -->
<article class="g-mb-100">
	<div class="g-mb-30">
		<span class="d-block g-color-gray-dark-v4 g-font-weight-700 g-font-size-12 text-uppercase mb-2"><?php the_time('F j, Y'); ?></span>
		<h2 class="h4 g-color-black g-font-weight-600 mb-3">
            <?php /*<i class="fa fa-thumb-tack"></i>*/ ?>
			<a href="<?php echo get_permalink(); ?>" class="u-link-v5 g-color-black g-color-primary--hover"><?php the_title() ?></a>
		</h2>
		<p class="g-color-gray-dark-v4 g-line-height-1_8"><?php the_content(); ?></p>
		<?php the_shortlink('Read more...', '', '<span class="g-font-size-13">', '<span>') ?>
	</div>

	<ul class="list-inline g-brd-y g-brd-gray-light-v3 g-font-size-13 g-py-13 mb-0">
		<li class="list-inline-item g-color-gray-dark-v4 mr-2">
            <span class="d-inline-block g-color-gray-dark-v4">
                <img class="g-g-width-20 g-height-20 rounded-circle mr-2" src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ), array('size' => 100) ); ?>" alt="Image Description">
                <?php the_author(); ?>
            </span>
		</li>
		<li class="list-inline-item g-color-gray-dark-v4">
			<a class="d-inline-block g-color-gray-dark-v4 g-color-white--hover g-bg-gray-dark-v2--hover rounded g-transition-0_3 g-text-underline--none--hover g-px-15 g-py-5" href="#!">
				<i class="align-middle g-font-size-default mr-1 icon-finance-206 u-line-icon-pro"></i>
                <?php echo get_comments_number(); comments_number(); // TODO: Comments count not working ?>
			</a>
		</li>
	</ul>
</article>
<!-- End Blog Minimal Blocks -->
