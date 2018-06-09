<?php

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}

function unify_starter_comment($comment, $args, $depth) {
// $GLOBALS['comment'] = $comment;

if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'media' ); ?>>
    <div class="comment-body">
		<?php _e( 'Pingback:', 'wp-bootstrap-starter' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'wp-bootstrap-starter' ), '<span class="edit-link">', '</span>' ); ?>
    </div>

<?php else : ?>

    <div class="media g-mb-30">
	    <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'], '', '', array('class' => 'd-flex g-width-60 g-height-60 rounded-circle g-mt-3 g-mr-20') ); ?>
        <div class="media-body">
            <div class="d-flex align-items-start g-mb-15 g-mb-10--sm">
                <div class="d-block">
                    <h5 class="h6 g-color-black g-font-weight-600"><?php printf( __( '%s <span class="says">says:</span>', 'wp-bootstrap-starter' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></h5>
                    <span class="d-block g-color-gray-dark-v5 g-font-size-11"><?php comment_time( 'c' ); ?></span>
	                <?php edit_comment_link( __( '<span style="margin-left: 5px;" class="glyphicon glyphicon-edit"></span> Edit', 'wp-bootstrap-starter' ), '<span class="edit-link">', '</span>' ); ?>
                </div>
                <div class="ml-auto">
	                <span class="u-link-v5 g-color-black g-color-primary--hover g-font-weight-600 g-font-size-12 text-uppercase"><?php comment_reply_link(
		                array_merge(
			                $args, array(
				                'add_below' => 'div-comment',
				                'depth' 	=> $depth,
				                'max_depth' => $args['max_depth'],
			                )
		                )
	                ); ?></span>
                </div>
            </div>

	        <?php if ( '0' == $comment->comment_approved ) : ?>
                <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'wp-bootstrap-starter' ); ?></p>
	        <?php endif; ?>

            <p><?php comment_text(); ?></p>
        </div>
    </div>

	<?php
	endif;
}

?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if (have_comments()) : ?>
        <div class="g-brd-y g-brd-gray-light-v4 g-py-30 mb-5">
            <h3 class="h6 g-color-black g-font-weight-600 text-uppercase mb-0">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'twentyseventeen' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s Reply to &ldquo;%2$s&rdquo;',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'twentyseventeen'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?></h3>
        </div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'wp-bootstrap-starter' ); ?></h2>
                <div class="nav-links">

                    <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'wp-bootstrap-starter' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'wp-bootstrap-starter' ) ); ?></div>

                </div><!-- .nav-links -->
            </nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

        <!-- Blog Single Item Comments -->
        <div class="g-brd-bottom g-brd-gray-light-v4 g-pb-30 g-mb-50">
			<?php
			wp_list_comments( array( 'callback' => 'unify_starter_comment', 'avatar_size' => 50 ));
			?>
        </div>
        <!-- End Blog Single Item Comments -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'wp-bootstrap-starter' ); ?></h2>
                <div class="nav-links">

                    <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'wp-bootstrap-starter' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'wp-bootstrap-starter' ) ); ?></div>

                </div><!-- .nav-links -->
            </nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php _e( 'Comments are closed.', 'twentyseventeen' ); ?></p>
	<?php
	endif;

	comment_form(array(
		'comment_field' =>  '<div class="g-mb-30"><textarea class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus g-resize-none rounded-3 g-py-13 g-px-15" rows="12" placeholder="Your message"></textarea></div>',
        'title_reply' => 'Add comment',
        'title_reply_before' => '<h3 class="h6 g-color-black g-font-weight-600 text-uppercase g-mb-30">',
        'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s btn u-btn-primary g-font-weight-600 g-font-size-12 text-uppercase g-py-12 g-px-25" value="%4$s" />'
    ));
	?>

</div><!-- #comments -->
