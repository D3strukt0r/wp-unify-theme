<?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')): ?>
<!-- Footer -->
<div class="g-bg-black-opacity-0_9 g-color-white-opacity-0_8 g-py-60">
    <div class="container">
        <div class="row">
	        <?php if (is_active_sidebar('footer-1')): ?>
                <!-- Footer Content -->
                <div class="col-lg-3 col-md-6 g-mb-40 g-mb-0--lg">
			        <?php dynamic_sidebar('footer-1'); ?>
                </div>
                <!-- End Footer Content -->
	        <?php endif; ?>
	        <?php if (is_active_sidebar('footer-2')): ?>
                <!-- Footer Content -->
                <div class="col-lg-3 col-md-6 g-mb-40 g-mb-0--lg">
			        <?php dynamic_sidebar('footer-2'); ?>
                </div>
                <!-- End Footer Content -->
	        <?php endif; ?>
	        <?php if (is_active_sidebar('footer-3')): ?>
                <!-- Footer Content -->
                <div class="col-lg-3 col-md-6 g-mb-40 g-mb-0--lg">
			        <?php dynamic_sidebar('footer-3'); ?>
                </div>
                <!-- End Footer Content -->
	        <?php endif; ?>
	        <?php if (is_active_sidebar('footer-4')): ?>
                <!-- Footer Content -->
                <div class="col-lg-3 col-md-6">
			        <?php dynamic_sidebar('footer-4'); ?>
                </div>
                <!-- End Footer Content -->
	        <?php endif; ?>
        </div>
    </div>
</div>
<!-- End Footer -->
<?php endif; ?>

<!-- Copyright Footer -->
<footer class="g-bg-gray-dark-v1 g-color-white-opacity-0_8 g-py-20">
    <div class="container">
        <div class="row">
            <div class="col-md-8 text-center text-md-left g-mb-15 g-mb-0--md">
                <div class="d-lg-flex">
                    <small class="d-block g-font-size-default g-mr-10 g-mb-10 g-mb-0--md"><?php echo date('Y'); ?> © <?php echo '<a href="'.home_url().'">'.get_bloginfo('name').'</a>'; ?>. All Rights Reserved.</small>
	                <?php if (has_nav_menu('unify-social')): ?>
		                <?php $copyrightMenu = get_menu_items_by_registered_slug('unify-copyright'); ?>
                        <?php if ($copyrightMenu): ?>
                            <ul class="u-list-inline">
                                <?php $first = true; ?>
                                <?php foreach($copyrightMenu as $item): ?>
                                    <?php if (!$first): ?>
                                        <li class="list-inline-item">
                                            <span>|</span>
                                        </li>
                                    <?php endif; ?>
	                                <?php $first = false; ?>
                                    <li class="list-inline-item">
                                        <a href="<?php echo $item->url; ?>"><?php echo $item->post_title; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
		                <?php endif; ?>
	                <?php endif; ?>
                </div>
            </div>
            <?php if (has_nav_menu('unify-social')): ?>
            <?php $socialMenu = get_menu_items_by_registered_slug('unify-social'); ?>
            <div class="col-md-4 align-self-center">
                <ul class="list-inline text-center text-md-right mb-0">
                    <?php foreach($socialMenu as $item): ?>
                    <li class="list-inline-item g-mx-10" data-toggle="tooltip" data-placement="top" title="<?php echo $item->post_title; ?>">
                        <a href="<?php echo $item->url; ?>" class="g-color-white-opacity-0_5 g-color-white--hover">
	                        <?php echo $item->post_content; ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>
</footer>
<!-- End Copyright Footer -->
