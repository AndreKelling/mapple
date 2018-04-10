<?php
/**
 * The view for the client title used in the loop
 */

?>
<tr>
    <td data-label="<?php echo __( 'Title', 'mapple' ) ?>" class="title">
        <?php echo $item->post_title; ?>
    </td>
    <td data-label="<?php echo __( 'Description', 'mapple' ) ?>" class="description">
        <?php echo empty($item->post_excerpt) ? wp_trim_words($item->post_content, 33, '...') : $item->post_excerpt; ?>
    </td>
    <?php //var_dump($item); ?>
    <td data-label="<?php echo __( 'Location', 'mapple' ) ?>" class="location">
    <?php  if ( ! empty( $meta['client-location'][0] ) ) {

        ?>

            <div class="client-list-location"><?php echo esc_html( $meta['client-location'][0] ); ?></div>
        <?php
    }
    ?>
    </td>
    <td data-label="<?php echo __( 'Link', 'mapple' ) ?>" class="link">
        <a class="map-list-link" href="<?php echo esc_url( get_permalink( $item->ID ) ); ?>">
            link internal
        </a>
    </td>
</tr>
