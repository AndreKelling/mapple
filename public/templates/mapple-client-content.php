<?php
/**
 * The view for the client title used in the loop
 */

?>
<tr>
    <td data-label="Title" class="title">
        <span class="client-list-name" itemprop="name"><?php echo $item->post_title; ?></span>
    </td>
    <td data-label="Location" class="location">
    <?php  if ( ! empty( $meta['client-location'][0] ) ) {

        ?>

            <div class="client-list-location"><?php echo esc_html( $meta['client-location'][0] ); ?></div>
        <?php
    }
    ?>
    </td>
    <td data-label="Link" class="link">
        <a class="map-list-link" href="<?php echo esc_url( get_permalink( $item->ID ) ); ?>">
            link internal
        </a>
    </td>
</tr>
