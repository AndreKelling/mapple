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
        <div class="mapple__search__tags">
			<?php if (! empty( $atts['title-filter-label'] ) ) { ?>
                <label>
					<?php echo $atts['title-filter-label']; ?>
                </label>
			<?php } ?>
            <span class="mapple__search__filter" data-mapple="tagFilter">
				<?php
				foreach($atts['clientTagNames'] as $button) {
					echo '<button>'.$button.'</button>';
				}
				?>
            </span>
        </div>
	<?php } ?>
</div>
