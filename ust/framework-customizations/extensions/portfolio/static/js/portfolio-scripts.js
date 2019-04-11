jQuery(document).ready(function () {
    fw_ajax_portfolio_pagination('#load_more_projects', '.fw-portfolio-list');
});

function fw_ajax_portfolio_pagination(load_more_button_id, append_to_container_id) {
    var paged = FwPhpVars.paged;
    var max_num_pages = FwPhpVars.max_num_pages;
    var load_more_button = jQuery(load_more_button_id);
    load_more_button.on('click', function () {
        paged++;
        // show loading text
        load_more_button.children('span').text(FwPhpVars.loading_text);
        // get value from hidden input with id=current_portfolio_category
        var id = jQuery('#current_portfolio_category').val();
        var ajax_data = "action=fw_theme_ajax_get_projects&id=" + id + '&paged=' + paged;
        jQuery.ajax({
            type: "POST",
            url: FwPhpVars.ajax_url,
            data: ajax_data,
            success: function (rsp) {
                var obj = jQuery.parseJSON(rsp);
                for (var i = 0; i < parseInt(obj.items); i++) {
                    var boxes = jQuery(obj.html[i]);
                    jQuery(append_to_container_id).append(boxes);
                }

                if (max_num_pages <= paged) {
                    load_more_button.hide();
                }
                load_more_button.children('span').text(FwPhpVars.load_more_text);
            }
        });
    });
    // for hide pagination button if in current category initial number of posts <= post_per_page
    if (typeof(max_num_pages != undefined) && typeof(paged != undefined) || (max_num_pages <= paged)) {
        load_more_button.hide();
    }
    return false;
}