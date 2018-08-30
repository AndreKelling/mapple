<input data-mapple="searchTable" type="text" />
<?php if (! empty ($atts['with-tags'])) { ?>
    <div class="mapple-tags" data-mapple="tagFilter">
	    <?php $args = array(
		    'type' => 'clients',
		    'taxonomy' => 'post_tag'
	    );
	    $tags = get_terms($args);

	    foreach($tags as $tag) {
		    echo '<span>' . $tag->name.'</span>';
	    } ?>
    </div>
<?php }