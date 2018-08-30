<table class="mapple__table" data-mapple="sortableTable">
    <thead>
    <tr>
        <th class="mapple__sort--title">
            <button class="mapple__sort" data-mapple-sort="mapple__sort--title" title="<?php echo __( 'sort', 'mapple' ) ?>" data-mapple-sort-asc></button>
	        <?php echo esc_html( $atts['title-name'] ); ?>
        </th>
        <th class="mapple__sort--address">
	        <?php echo esc_html( $atts['title-address'] ); ?>
        </th>
        <th class="mapple__sort--description">
	        <?php echo esc_html( $atts['title-desc'] ); ?>
        </th>
	    <?php if (! empty ($atts['with-tags'])) { ?>
            <th class="mapple__sort--keywords">
	            <?php echo esc_html( $atts['title-tags'] ); ?>
            </th>
	    <?php } ?>
    </tr>
    </thead>
    <tbody>
