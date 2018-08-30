<div class="mapple__search">
    <div class="mapple__search__field">
        <input
                data-mapple="searchTable"
                type="text"
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
