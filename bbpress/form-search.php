<?php

/**
 * Search
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div class="inline-search clearfix pull-right">
    <form role="search" method="get" id="bbp-search-form" action="<?php bbp_search_url(); ?>" class="widget_search">
        <input tabindex="<?php bbp_tab_index(); ?>" type="text" value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" name="bbp_search" id="bbp_search"  class="serch-input">
        <button type="submit">
            <i class="fa fa-search"></i>
        </button>
    </form>
</div>
