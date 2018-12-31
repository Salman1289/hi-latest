<div class="courses-searching layout-top">
    <form role="search" method="get" action="<?php echo site_url( '/' ); ?>">
        <button type="submit"><i class="fa fa-search"></i></button>
        <input type="text" value="" name="s" id="s" placeholder="<?php echo esc_attr( $instance['label'] ); ?>" class="form-control courses-search-input" autocomplete="on" />
        <input type="hidden" value="course" name="ref" />
        <span class="widget-search-close"></span>
    </form>
    <ul class="courses-list-search list-unstyled"></ul>
</div>