<?php

/**
 * Template part for showing pagination in the search (sales || lettings) listing page.
 */

$current_page = get_query_var( 'paged' );

if ( !$current_page ) {
  $current_page = 1;
}

$mid_size = 3;

if ( $current_page > $mid_size ) {
	$start_page = $current_page - $mid_size;
	$end_page = $current_page + $mid_size;
} else {
	$start_page = 1;
	$end_page = 1 + ($mid_size * 2);
}

if ( $end_page > $max_num_pages ) { // $max_num_pages from template
	$start_page = $max_num_pages - ($mid_size * 2);
	$end_page = $max_num_pages;
}

if ( !is_integer($start_page) ) {
	$start_page = (integer)$start_page;
}
if ( $start_page <= 0 ) {
	$start_page = 1;
}

if ( !is_integer($end_page) ) {
	$end_page = (integer)$end_page;
}
if ( $end_page <= 0 ) {
	$end_page = 1;
}

?>

<ul class="c-pagination">

	<?php if ( $current_page > 1 ): ?>
		<li class="prev page-numbers">

			<a href="<?php echo esc_html(get_pagenum_link( $current_page - 1 )) ?>" title="Previous Page">Previous</a>

		</li>
	<?php endif ?>

	<?php for ($i = $start_page; $i <= $end_page; $i++): ?>

		<li class="page-numbers<?php echo ( ( $current_page === $i ) ? ' current' : '' ) ?>">

			<?php if ( $current_page === $i ): ?>

				<span class="" title="Page <?php echo esc_html($i) ?>"><?php echo esc_html($i) ?></span>

			<?php else: ?>

				<a href="<?php echo esc_html(get_pagenum_link( $i )) ?>" title="Page <?php echo esc_html($i) ?>"><?php echo esc_html($i) ?></a>

			<?php endif; ?>
		</li>

	<?php endfor; ?>

	<?php if ( $current_page < $max_num_pages ): ?>
		<li class="next page-numbers">

			<a href="<?php echo esc_html(get_pagenum_link( $current_page + 1 )) ?>" title="Next Page">Next</a>

		</li>
	<?php endif ?>

</ul>
