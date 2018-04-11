<tr>
    <td class="mapple__sort--title">
        <a href="<?php echo esc_url( get_permalink( $item->ID ) ); ?>" title="<?php echo __( 'to client detailpage', 'mapple' ) ?>">
            <?php echo $item->post_title; ?>
        </a>
    </td>
    <td data-label="<?php echo __( 'Address', 'mapple' ) ?>" class="mapple__sort--address">
        <?php  if ( ! empty( $meta['client-address'][0] ) ) {

            ?>

            <?php echo esc_html( $meta['client-address'][0] ); ?>
            <?php
        }
        ?>
    </td>
    <td data-label="<?php echo __( 'Description', 'mapple' ) ?>" class="mapple__sort--description">
        <?php echo empty($item->post_excerpt) ? wp_trim_words($item->post_content, 33, '...') : $item->post_excerpt; ?>

        <?php if ( ! empty( $meta['client-url'][0] ) ) { ?>
            <p class="mapple__client-url">
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
        <?php } ?>
    </td>
</tr>
