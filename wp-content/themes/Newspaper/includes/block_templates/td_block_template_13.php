<?php
/**
 * this is the default block template
 * Class td_block_header_13
 */
class td_block_template_13 extends td_block_template {



    /**
     * renders the CSS for each block, each template may require a different css generated by the theme
     * @return string CSS the rendered css and <style> block
     */
    function get_css() {


        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class =  $this->get_unique_block_class();

        // the css that will be compiled by the block, <style> - will be removed by the compiler
        $raw_css = "
        <style>

            /* @button_color */
            .$unique_block_class .td-pulldown-category {
                color: @button_color !important;
            }

            /* @header_text_color */
            .$unique_block_class .td-block-title > a,
            .$unique_block_class .td-block-title > span {
                color: @header_text_color !important;
            }

            /* @big_text_color */
            .$unique_block_class .td-block-subtitle {
                color: @big_text_color !important;
            }

            /* @accent_text_color */
            .$unique_block_class .td_module_wrap:hover .entry-title a,
            .$unique_block_class .td_quote_on_blocks,
            .$unique_block_class .td-opacity-cat .td-post-category:hover,
            .$unique_block_class .td-opacity-read .td-read-more a:hover,
            .$unique_block_class .td-opacity-author .td-post-author-name a:hover,
            .$unique_block_class .td-instagram-user a {
                color: @accent_text_color !important;
            }

            .$unique_block_class .td-next-prev-wrap a:hover,
            .$unique_block_class .td-load-more-wrap a:hover {
                background-color: @accent_text_color !important;
                border-color: @accent_text_color !important;
            }

            .$unique_block_class .td-read-more a,
            .$unique_block_class .td-weather-information:before,
            .$unique_block_class .td-weather-week:before,
            .$unique_block_class .td-exchange-header:before,
            .td-footer-wrapper .$unique_block_class .td-post-category,
            .$unique_block_class .td-post-category:hover {
                background-color: @accent_text_color !important;
            }
        </style>
    ";

        $td_css_compiler = new td_css_compiler($raw_css);
        $td_css_compiler->load_setting_raw('button_color', $this->get_att('button_color'));
        $td_css_compiler->load_setting_raw('header_text_color', $this->get_att('header_text_color'));
        $td_css_compiler->load_setting_raw('accent_text_color', $this->get_att('accent_text_color'));
        $td_css_compiler->load_setting_raw('big_text_color', $this->get_att('big_text_color'));

        $compiled_style = $td_css_compiler->compile_css();


        return $compiled_style;
    }


    /**
     * renders the block title
     * @return string HTML
     */
    function get_block_title() {

        $custom_title = $this->get_att('custom_title');
        $custom_url = $this->get_att('custom_url');



        if (empty($custom_title)) {
            $td_pull_down_items = $this->get_td_pull_down_items();
            if (empty($td_pull_down_items)) {
                //no title selected and we don't have pulldown items
                return '';
            }
            // we don't have a title selected BUT we have pull down items! we cannot render pulldown items without a block title
            $custom_title = 'Block title';
        }

        // description text
        $title_alignment = '';
        $description_text = $this->get_att('big_title_text');
        if (empty($description_text)) {
            $title_alignment = ' td-title-align';
        }


        // there is a custom title
        $buffy = '';
        $buffy .= '<h4 class="td-block-title' . $title_alignment . '">';
        if (!empty($custom_url)) {
            $buffy .= '<a href="' . esc_url($custom_url) . '">' . esc_html($custom_title) . '</a>';
        } else {
            $buffy .= '<span>' . esc_html($custom_title) . '</span>';
        }

        $buffy .= '<div class="td-block-subtitle">' . esc_html($description_text) . '</div>';

        $buffy .= '</h4>';
        return $buffy;
    }


    /**
     * renders the filter of the block
     * @return string
     */
    function get_pull_down_filter() {

        $buffy = '';

        $custom_url = $this->get_att('custom_url');
        $category_id = $this->get_att('category_id');

        if (empty($custom_url) && empty($category_id)) {
            return '';
        }

        // button text
        $button_text = $this->get_att('button_text');
        if (empty($button_text)) {
            if (empty($category_id)) {
		        $button_text = 'Read more';
	        } else {
		        $button_text = 'Continue to the category';
	        }
        }

        if (empty($custom_url)) {
            $custom_url = get_category_link($category_id);
        }

        $buffy .= '<a href="' . esc_url($custom_url) . '" class="td-pulldown-category"><span>' . esc_html($button_text) . '</span><i class="td-icon-category"></i></a>';


        return $buffy;
    }
}