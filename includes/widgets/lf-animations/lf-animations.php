<?php

namespace LFWidgets;

use Elementor_Addon_Pixl_Dynamics\Custom_Nav_Walker;

class Animations
{

    public function render_underline_top($display_menu_id, $lf_alignment, $show_arrow, $unique_id = ''): void
    {
        $unique_class = $unique_id ? htmlspecialchars($unique_id, ENT_QUOTES, 'UTF-8') : 'lf-unique-default';
        $unique_class_css = preg_replace('/[^a-zA-Z0-9_-]/', '', $unique_class);
        $menu_id = 'menu-toggle-' . $unique_class_css;
?>
        <style>
            @media screen and (min-width: 1025px) {
                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li {
                    position: relative;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li::before {
                    content: "";
                    display: block;
                    background-color: #000000;
                    height: 2px;
                    left: 0;
                    top: 0;
                    transform: scale(0, 1);
                    transition: transform ease-in-out 250ms;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li:hover::before {
                    transform: scale(1, 1);
                }
            }

            @media screen and (max-width: 1024px) {

                .menu.<?php echo esc_attr($unique_class_css);

                        ?>>ul,
                .menu-righticon {
                    display: none;
                }

                #<?php echo esc_attr($menu_id);

                    ?>:checked+ul {
                    display: block;
                    -webkit-animation: grow 0.5s ease-in-out;
                    animation: grow 0.5s ease-in-out;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>ul>li a {
                    display: flex;
                    justify-content: space-between;
                }

                .menu-dropdown {
                    display: none;
                }

                .submenu-toggle:checked~.menu-dropdown {
                    display: block;
                    animation: grow 0.5s ease-in-out;
                }

                .submenu-toggle,
                .submenu-toggle-label {
                    display: inline-block;
                    cursor: pointer;
                }

                .submenu-toggle-label {
                    margin-left: 8px;
                }

            }
        </style>
        <nav role='navigation' class="menu <?php echo esc_attr($unique_class); ?>">
            <label for="<?php echo esc_attr($menu_id); ?>">Menu <i class="fa fa-bars"></i></label>
            <input type="checkbox" class="menu-toggle" id="<?php echo esc_attr($menu_id); ?>">
            <?php
            echo wp_nav_menu(array(
                'menu'          => $display_menu_id,
                'container'     => false,
                'menu_class'    => 'menu-align-' . esc_attr($lf_alignment),
                'walker'        => new Custom_Nav_Walker($unique_class_css),
                'arrow_desktop' => $show_arrow,
            ));
            ?>
        </nav>
    <?php
    }
    public function render_underline_below($display_menu_id, $lf_alignment, $show_arrow, $unique_id = ''): void
    {
        $unique_class = $unique_id ? htmlspecialchars($unique_id, ENT_QUOTES, 'UTF-8') : 'lf-unique-default';
        $unique_class_css = preg_replace('/[^a-zA-Z0-9_-]/', '', $unique_class);
        $menu_id = 'menu-toggle-below-' . $unique_class_css;
    ?>
        <style>
            @media screen and (min-width: 1025px) {
                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li {
                    position: relative;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li::after {
                    content: "";
                    display: block;
                    background-color: #000000;
                    width: 100%;
                    height: 2px;
                    left: 0;
                    bottom: 0;
                    transform: scale(0, 1);
                    transition: transform ease-in-out 250ms;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li:hover::after {
                    transform: scale(1, 1);
                }
            }

            @media screen and (max-width: 1024px) {

                .menu.<?php echo esc_attr($unique_class_css);

                        ?>>ul,
                .menu-righticon {
                    display: none;
                }

                #<?php echo esc_attr($menu_id);

                    ?>:checked+ul {
                    display: block;
                    -webkit-animation: grow 0.5s ease-in-out;
                    animation: grow 0.5s ease-in-out;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>ul>li a {
                    display: flex;
                    justify-content: space-between;
                }
            }
        </style>
        <nav role='navigation' class="menu <?php echo esc_attr($unique_class); ?>">
            <label for="<?php echo esc_attr($menu_id); ?>">Menu <i class="fa fa-bars"></i></label>
            <input type="checkbox" class="menu-toggle" id="<?php echo esc_attr($menu_id); ?>">
            <?php
            echo wp_nav_menu(array(
                'menu'          => $display_menu_id,
                'container'     => false,
                'menu_class'    => 'menu-align-' . esc_attr($lf_alignment),
                'walker'        => new Custom_Nav_Walker($unique_class_css),
                'arrow_desktop' => $show_arrow,
            ));
            ?>
        </nav>
    <?php
    }
    public function render_double_line($display_menu_id, $lf_alignment, $show_arrow, $menu_link_text_color = '#ffffff', $menu_link_arrow_double_line_color = '#3a3a3aff', $unique_id = ''): void
    {
        $unique_class = $unique_id ? htmlspecialchars($unique_id, ENT_QUOTES, 'UTF-8') : 'lf-unique-default';
        $unique_class_css = preg_replace('/[^a-zA-Z0-9_-]/', '', $unique_class);
        $menu_id = 'menu-toggle-double-' . $unique_class_css;
    ?>
        <style>
            @media screen and (min-width: 1025px) {
                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul {
                    list-style: none;
                    position: relative;
                    display: flex;
                    gap: 0px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li {
                    position: relative;
                    z-index: 1;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li>a {
                    text-decoration: none;
                    transition: 1s;
                    position: relative;
                    z-index: 2;
                    pointer-events: auto;
                    color: <?php echo esc_attr($menu_link_text_color);
                            ?>;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li::before {
                    content: '';
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    top: 0;
                    left: 0;
                    border-top: 1px solid rgb(0, 0, 0);
                    border-bottom: 1px solid rgb(0, 0, 0);
                    transform: scaleY(2);
                    opacity: 0;
                    transition: .5s;
                    z-index: -1;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li:hover::before {
                    transform: scaleY(1.2);
                    opacity: 1;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li::after {
                    content: '';
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    background-color: <?php echo esc_attr($menu_link_arrow_double_line_color);
                                        ?>;
                    top: 1px;
                    left: 0;
                    transform: scale(0);
                    opacity: 0;
                    transition: .5s;
                    z-index: -1;
                    pointer-events: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li:hover::after {
                    transform: scale(1);
                    opacity: 1;
                }
            }

            @media screen and (max-width: 1024px) {

                .menu.<?php echo esc_attr($unique_class_css);

                        ?>>ul,
                .menu-righticon {
                    display: none;
                }

                #<?php echo esc_attr($menu_id);

                    ?>:checked+ul {
                    display: block;
                    -webkit-animation: grow 0.5s ease-in-out;
                    animation: grow 0.5s ease-in-out;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>ul>li a {
                    display: flex;
                    justify-content: space-between;
                    color: <?php echo esc_attr($menu_link_text_color);
                            ?>;
                }
            }
        </style>
        <nav role='navigation' class="menu <?php echo esc_attr($unique_class); ?>">
            <label for="<?php echo esc_attr($menu_id); ?>">Menu <i class="fa fa-bars"></i></label>
            <input type="checkbox" class="menu-toggle" id="<?php echo esc_attr($menu_id); ?>">
            <?php
            echo wp_nav_menu(array(
                'menu'          => $display_menu_id,
                'container'     => false,
                'menu_class'    => 'menu-align-' . esc_attr($lf_alignment),
                'walker'        => new Custom_Nav_Walker($unique_class_css),
                'arrow_desktop' => $show_arrow,
            ));
            ?>
        </nav>
    <?php
    }
    public function render_frame_pulse($settings, $display_menu_id, $lf_alignment, $show_arrow, $menu_link_arrow_color, $unique_id = ''): void
    {
        $unique_class = $unique_id ? htmlspecialchars($unique_id, ENT_QUOTES, 'UTF-8') : 'lf-unique-default';
        $unique_class_css = preg_replace('/[^a-zA-Z0-9_-]/', '', $unique_class);
        $menu_id = 'menu-toggle-double-' . $unique_class_css;


        // Compose inline font-size style
        // ...existing code...
        $arrow_padding = $settings['lf_label_padding'] ?? [];
        $top    = isset($arrow_padding['top'])    ? $arrow_padding['top']    : '0';
        $right  = isset($arrow_padding['right'])  ? $arrow_padding['right']  : '0';
        $bottom = isset($arrow_padding['bottom']) ? $arrow_padding['bottom'] : '0';
        $left   = isset($arrow_padding['left'])   ? $arrow_padding['left']   : '0';
        $unit   = $arrow_padding['unit'] ?? 'px';
        $padding_css = "{$top}{$unit} {$right}{$unit} {$bottom}{$unit} {$left}{$unit}";
        // ...existing code...
    ?>

        <style>
            @media screen and (min-width: 1025px) {
                nav.menu.<?= esc_attr($unique_class_css);

                            ?>>ul {
                    list-style: none;
                    position: relative;
                    display: flex;
                    gap: 0px;
                }

                .submenu-toggle-label {
                    position: relative;
                    padding: 4px;
                    display: inline-flex;
                    justify-content: center;
                    align-items: center;
                    width: fit-content;
                }

                nav.menu.<?= esc_attr($unique_class_css);

                            ?>>ul>li:hover>label>span.submenu-arrow {
                    color: <?= esc_attr($settings['menu_link_arrow_color']);
                            ?> !important;
                    transition: .5s;
                }

                nav.menu.<?= esc_attr($unique_class_css);

                            ?>>ul>li {
                    position: relative;
                }

                nav.menu.<?= esc_attr($unique_class_css);

                            ?>>ul>li::before {
                    content: "";
                    position: absolute;
                    bottom: 12px;
                    left: 12px;
                    width: 14px;
                    height: 14px;
                    border: 2px solid <?= esc_attr($settings['menu_link_hover_bg_color']);
                                        ?>;
                    border-width: 0 0 3px 3px;
                    transition: opacity .5s;
                    opacity: 0;

                }

                nav.menu.<?= esc_attr($unique_class_css);

                            ?>>ul>li:hover {
                    background-color: <?= esc_attr($settings['menu_link_hover_bg_color']);
                                        ?> !important;

                }

                nav.menu.<?= esc_attr($unique_class_css);

                            ?>>ul>li:hover>a {
                    color: #fff !important;
                }

                nav.menu.<?= esc_attr($unique_class_css);

                            ?>>ul>li:hover::before {
                    bottom: -8px;
                    left: -8px;
                    opacity: 1;
                    transition: .5s;
                }

                nav.menu.<?= esc_attr($unique_class_css);

                            ?>>ul>li::after {
                    content: "";
                    position: absolute;
                    top: 12px;
                    right: 12px;
                    width: 14px;
                    height: 14px;
                    border: 2px solid <?= esc_attr($settings['menu_link_hover_bg_color']);
                                        ?>;
                    border-width: 3px 3px 0 0;
                    transition: .5s;
                    opacity: 0;
                }

                nav.menu.<?= esc_attr($unique_class_css);

                            ?>>ul>li:hover::after {
                    top: -8px;
                    right: -8px;
                    opacity: 1;
                }
            }

            @media screen and (max-width: 1024px) {
                .submenu-toggle-label {

                    position: relative;
                    padding: <?php echo esc_attr($padding_css);
                                ?>;
                    display: inline-flex;
                    justify-content: center;
                    align-items: center;
                    width: fit-content;
                    margin-left: 50px;
                }

                .submenu-toggle-label,
                .submenu-toggle-label span.submenu-arrow {
                    font-size: <?= esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']);
                                ?>;
                }

                .submenu-toggle-label {
                    display: inline-block;
                }

                .menu.<?= esc_attr($unique_class_css);

                        ?>>ul,
                .menu-righticon {
                    display: none;
                }

                #<?php echo esc_attr($menu_id);

                    ?>:checked+ul {
                    display: block;
                    -webkit-animation: grow 0.5s ease-in-out;
                    animation: grow 0.5s ease-in-out;
                }

                .submenu-toggle:checked~.menu-dropdown {
                    display: block;
                    animation: grow 0.5s ease-in-out;
                }
            }
        </style>


        <nav role='navigation' class="menu <?php echo $unique_class; ?>">
            <label for="<?php echo esc_attr($menu_id); ?>">Menu <i class="fa fa-bars"></i></label>
            <input type="checkbox" id="<?php echo esc_attr($menu_id); ?>">
            <?php
            echo wp_nav_menu(array(
                'menu'          => $display_menu_id,
                'container'     => false,
                'menu_class'    => 'menu-align-' . $lf_alignment,
                'walker'        => new Custom_Nav_Walker($unique_class_css),
                'arrow_desktop' => $show_arrow,
            ));
            ?>
        </nav>
    <?php
    }
    public function render_default($settings, $display_menu_id, $lf_alignment, $show_arrow, $unique_id = ''): void
    {

        $unique_class = $unique_id ? htmlspecialchars($unique_id, ENT_QUOTES, 'UTF-8') : 'lf-unique-default';
        $unique_class_css = preg_replace('/[^a-zA-Z0-9_-]/', '', $unique_class);
        $menu_id = 'menu-toggle-double-' . $unique_class_css;

        $arrow_padding = $settings['lf_label_padding'] ?? [];
        $top    = isset($arrow_padding['top'])    ? $arrow_padding['top']    : '0';
        $right  = isset($arrow_padding['right'])  ? $arrow_padding['right']  : '0';
        $bottom = isset($arrow_padding['bottom']) ? $arrow_padding['bottom'] : '0';
        $left   = isset($arrow_padding['left'])   ? $arrow_padding['left']   : '0';
        $unit   = $arrow_padding['unit'] ?? 'px';
        $padding_css = "{$top}{$unit} {$right}{$unit} {$bottom}{$unit} {$left}{$unit}";

    ?>
        <style>
            @media screen and (min-width: 1025px) {
                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul {
                    list-style: none;
                    position: relative;
                    display: flex;
                    gap: 0px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li>a {
                    text-transform: capitalize;

                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li {
                    position: relative;
                }



                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li>a:hover::after {
                    top: -8px;
                    right: -8px;
                    opacity: 1;
                }

            }

            /* narrow styles */
            @media screen and (max-width: 1024px) {

                .menu.<?php echo esc_attr($unique_class_css);

                        ?>>ul,
                .menu-righticon {
                    display: none;
                }

                #<?php echo esc_attr($menu_id);

                    ?>:checked+ul {
                    display: block;
                    -webkit-animation: grow 0.5s ease-in-out;
                    animation: grow 0.5s ease-in-out;
                }

                
                #<?php echo esc_attr($menu_id); ?>:checked+.nav-label span:nth-child(1) {
                    transform: rotate(45deg);
                    position: absolute;
                    top: 10px;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.nav-label span:nth-child(2) {
                    opacity: 0;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.nav-label span:nth-child(3) {
                    transform: rotate(-45deg);
                    position: absolute;
                    top: 10px;
                }


                .submenu-toggle:checked~.menu-dropdown {
                    display: block;
                    animation: grow 0.5s ease-in-out;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li {
                    position: relative;
                    display: flex;
                    flex-wrap: wrap;
                    align-items: center;

                }

                nav.menu.<?php echo esc_attr($unique_class_css);
                            ?>>ul>li>a,
                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li>label {
                    flex: 1 1 auto;
                    float: right
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li>label>span.submenu-arrow {
                    float: right;
                    padding: <?= esc_attr($padding_css);
                                ?>;
                    font-size: <?= esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']);
                                ?>;
                    background-color: <?= esc_attr($settings['menu_link_arrow_label_bg_color']);
                                        ?>;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li>ul {
                    width: 100%;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li>ul>li>a,
                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li>ul>li>label {
                    flex: 1 1 auto;
                    ?>;
                }


                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li ul li a {
                    flat: :left;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li ul li label {
                    float: right;
                }

                nav.menu>label.nav-label {
                    /* background-color: red; */
                    display: flex;
                    align-items: end;

                    flex-direction: column;
                    justify-content: space-between;
                }

                /* nav.menu{
                    display: flex;
                    align-items: start;
                    justify-content: start;
                } */

                nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul>li>ul>li>label>span.submenu-arrow {
                    float: right;
                    padding: <?= esc_attr($padding_css);
                                ?>;
                    font-size: <?= esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']);
                                ?>;
                    background-color: <?= esc_attr($settings['menu_link_arrow_label_bg_color']);
                                        ?>;

                }

                nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul>li ul li label span.submenu-arrow {
                    padding: <?= esc_attr($padding_css);
                                ?>;
                    font-size: <?= esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']);
                                ?>;
                    background-color: <?= esc_attr($settings['menu_link_arrow_label_bg_color']);
                                        ?>;
                }
            }
        </style>
        <?php

        ?>
        <!-- <i class="fa fa-bars"></i> -->
        <nav role='navigation' class="menu <?php echo $unique_class; ?>">
            <label style="align-self: center;" for="<?php echo esc_attr($menu_id); ?>" class="nav-label lf-hamburger">
                <span></span>
                <span></span>
                <span></span>
            </label>
            <input type="checkbox" id="<?php echo esc_attr($menu_id); ?>">

            <?php
            echo wp_nav_menu(array(
                'menu'          => $display_menu_id,
                'container'     => false,
                'menu_class'    => 'menu-align-' . $lf_alignment,
                'walker'        => new Custom_Nav_Walker($unique_class_css),
                'arrow_desktop' => $show_arrow,
                'fallback_cb'   => false,
            ));
            ?>
        </nav>
<?php
    }
}

?>