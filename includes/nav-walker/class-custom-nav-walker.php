<?php

namespace Elementor_Addon_Pixl_Dynamics;

class Custom_Nav_Walker extends \Walker_Nav_Menu
{
    protected $unique_id = '';

    public function __construct($unique_id = '')
    {
        $this->unique_id = $unique_id;
    }

    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n" . $indent . '<ul class="menu-dropdown lf-sub-menu-bg">';
    }

    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= $indent . "</ul>\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $li_classes = empty($item->classes) ? array() : (array) $item->classes;

        $has_children = in_array('menu-item-has-children', $li_classes);

        if ($has_children) {
            $li_classes[] = 'menu-hasdropdown';
        }

        if ($has_children && $depth > 0) {
            $li_classes[] = 'menu-hasflyout';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($li_classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts = array();
        $atts['title']  = ! empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = ! empty($item->target)     ? $item->target     : '';
        $atts['rel']    = ! empty($item->xfn)        ? $item->xfn        : '';
        $atts['href']   = ! empty($item->url)        ? $item->url        : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        $class_attr = '';

        foreach ($atts as $attr => $value) {
            if (! empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                if ($attr === 'class') {
                    $class_attr = $value; // capture existing class value
                } else {
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }
        }

        // Merge existing classes with top-level class
        if ($depth === 0) {
            $class_attr .= ' lf-double-line';
        }

        if (! empty($class_attr)) {
            $attributes .= ' class="' . esc_attr(trim($class_attr)) . '"';
        }


        $item_output = $args->before;

        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;

        
        // if ($has_children) {
        //     $item_output .= '<span class="sub-arrow-mobile">&#9660;</span>';
        // }


        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);


        if ($has_children) {
            $submenu_toggle_id = 'submenu-toggle-' . $item->ID . '-' . $this->unique_id;
            // Submenu toggle input (checkbox)
            $output .= '<input type="checkbox" id="' . esc_attr($submenu_toggle_id) . '" class="submenu-toggle" />';
            // Submenu toggle label (arrow)
            $output .= '<label for="' . esc_attr($submenu_toggle_id) . '" class="submenu-toggle-label"><span class="submenu-arrow">&#9660;</span></label>';
        }
    }


    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }
}
