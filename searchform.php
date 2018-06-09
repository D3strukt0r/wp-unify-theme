<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <!-- Text Input -->
    <div class="input-group">
        <label class="g-mb-10" for="<?php echo $unique_id; ?>"><?php echo _x( 'Search for:', 'label', 'twentyseventeen' ); ?></label>
        <input id="<?php echo $unique_id; ?>" class="form-control form-control-md rounded-0" name="s" type="search" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'twentyseventeen' ); ?>" value="<?php echo get_search_query(); ?>" />
        <div class="input-group-addon p-0">
            <button class="btn rounded-0 btn-primary btn-md g-font-size-14 g-px-18" type="submit">Search</button>
        </div>
    </div>
    <!-- End Text Input -->
</form>
