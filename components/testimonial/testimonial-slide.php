<?php
/**
 * Partial: Testimonial
 *
 * @package EDGE\EDGECreative\Partials
 */

?>

<article
	class="c-testimonial c-testimonial--feature"
	itemprop="review"
	itemscope
	itemtype="http://schema.org/Review"
	>

	<blockquote class="c-testimonial__quote">
		<span itemprop="description">
			<?php
				the_content();
			?>
		</span>
		<footer class="c-testimonial__author">
			<?php
				the_title(
					'<p><strong itemprop="author">',
					'</strong></p>'
				);
			?>
		</footer>
	</blockquote>

</article>
