<div class="mapple__search">
    <div class="mapple__search__field">
        <label for="mapple-search"><?php echo $atts['title-search'] ?></label>
        <input
            id="mapple-search"
            data-mapple="searchTable"
            type="text"
            placeholder="<?php echo $atts['title-search-placeholder'] ?>"
        />
    </div>

    <?php if (! empty ($atts['with-tags'])) { ?>
        <div class="mapple__search__tags" data-mapple="tagFilter">
            <?php $args = array(
                'type' => 'clients',
                'taxonomy' => 'post_tag'
            );
            $tags = get_terms($args);

            foreach($tags as $tag) {
                echo '<button>' . $tag->name.'</button>';
            } ?>
        </div>
    <?php } ?>
</div>
