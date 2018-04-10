<tr>
    <td class="mapple__sort--title">
        <?php echo $item->post_title; ?>
    </td>
    <td data-label="<?php echo __( 'Description', 'mapple' ) ?>" class="mapple__sort--description">
        <?php echo empty($item->post_excerpt) ? wp_trim_words($item->post_content, 33, '...') : $item->post_excerpt; ?>
    </td>
    <?php //var_dump($item); ?>
    <td data-label="<?php echo __( 'Location', 'mapple' ) ?>" class="mapple__sort--location">
    <?php  if ( ! empty( $meta['client-location'][0] ) ) {

        ?>

            <?php echo esc_html( $meta['client-location'][0] ); ?>
        <?php
    }
    ?>
    </td>
    <td data-label="<?php echo __( 'Link', 'mapple' ) ?>" class="mapple__sort--link">
        <a href="<?php echo esc_url( get_permalink( $item->ID ) ); ?>">
            link internal
        </a>
    </td>
</tr>
