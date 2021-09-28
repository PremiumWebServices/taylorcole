<div class="c-card_blog">
<aside class="c-card_aside">
 <?php
	 the_post_thumbnail(
		 'edge-blog--teaser',
		 [
			 'class' => 'c-card__media c-card__image',
		 ]
	 );
 ?>

<?php
 /**
	* Show fallback image.
	*/
 if ( ! has_post_thumbnail() ) :
	 echo wp_get_attachment_image(
		 get_option( 'posts_image' ),
		 'edge-blog--teaser',
		 false,
		 [
			 'class' => 'c-card__media c-card__image',
		 ]
	 );
 endif;
?>
</aside>

<article class="c-card_info">
<h2 class="c-card_title"><?php echo esc_html(the_title()); ?></h2>
<?php
				echo wp_kses_post(
					the_excerpt()
				);
			?>

<?php $categories = wp_get_post_categories($post->ID);
            if ( ! empty( $categories ) ) {
							$cat_output = "";

							foreach($categories as $category)
							{
								$cat_name = get_category( $category )->name;
								$cat_output .= $cat_name . ', ';

							}

							$cat_output = rtrim($cat_output, ', ');
							?>

							<p>Topic:<br />
              <span class="c-blog_card-category">
                  <?php echo esc_html( $cat_output ); ?>
              </span>
							</p>
          <?php
          } ?>



<a href="<?php echo esc_url(get_the_permalink()); ?>" class="c-btn c-btn--primary">read more</a>

</article>

				</div>
