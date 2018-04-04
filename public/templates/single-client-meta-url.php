<?php
/**
 * The view for the single client metadata for the url
 */

if ( ! empty( $meta['client-url'][0] ) ) { ?>
	<p class="<?php echo esc_attr( 'client-url' ); ?>">
		<?php
		if ( ! empty( $meta['client-urlname'][0] ) ) {
			$urlName = $meta['client-urlname'][0];
		} else {
			$urlName = $meta['client-url'][0];
		}
		?>

        <a href="<?php echo $meta['client-url'][0]; ?>" title="<?php echo $urlName; ?>" target="_blank" rel="nofollow">
            <?php echo $urlName; ?>
        </a>
    </p>
<?php }