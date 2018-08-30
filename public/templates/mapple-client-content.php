<?php $id = $item->ID; ?>
<tr data-mapple-id="<?php echo $id; ?>">
    <td class="mapple__sort--title">
        <a href="<?php echo esc_url( get_permalink( $id ) ); ?>" title="<?php echo __( 'to client detailpage', 'mapple' ) ?>">
            <?php echo $item->post_title; ?>
        </a>
    </td>
    <td data-label="<?php echo esc_html( $atts['title-address'] ); ?>" class="mapple__sort--address">
        <?php  if ( ! empty( $meta['client-address'][0] ) ) {
            echo esc_html( $meta['client-address'][0] );
        } ?>
    </td>
    <td data-label="<?php echo esc_html( $atts['title-desc'] ); ?>" class="mapple__sort--description">
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
    <?php if (! empty ($atts['with-tags'])) { ?>
        <td data-label="<?php echo esc_html( $atts['title-tags'] ); ?>" class="mapple__tags mapple__sort--keywords">
            <?php
            $post_tags = get_the_terms( $id, 'post_tag');

            if ( $post_tags ) {
	            foreach( $post_tags as $tag ) {
		            echo $tag->name . ' ';
	            }
            }
            ?>
        </td>
    <?php } ?>
</tr>
