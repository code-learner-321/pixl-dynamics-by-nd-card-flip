<?php

namespace Elementor_Addon_Pixl_Dynamics;

require_once plugin_dir_path(__FILE__) . '../nav-walker/class-custom-nav-walker.php';

use Elementor_Addon_Pixl_Dynamics\Custom_Nav_Walker;

require_once plugin_dir_path(__FILE__) . 'lf-animations/lf-animations.php';

use LFWidgets\Animations;


if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Widget_Base;

class Elementor_Link_Flow_Widget extends Widget_Base
{
    private $display_menu_id;
    public function get_script_depends(): array
    {
        return ['widget-link-flow-js', 'link-flow-script-js'];
    }

    public function get_style_depends(): array
    {
        return ['widget-link-flow-menu-style', 'widget-font-awsome-style'];
    }

    public function get_name(): string
    {
        return 'elementor-link-flow';
    }

    public function get_title(): string
    {
        return esc_html__('Link Flow', 'pixl-dynamics-by-nd');
    }

    public function get_icon(): string
    {
        return 'eicon-mega-menu';
    }

    public function get_categories(): array
    {
        return ['pixel-dynamics'];
    }

    public function get_keywords(): array
    {
        return ['nav', 'navigation', 'link', 'flow'];
    }

    public function get_custom_help_url(): string
    {
        return 'https://developers.elementor.com/docs/widgets/';
    }

    public function has_widget_inner_wrapper(): bool
    {
        return false;
    }

    protected function is_dynamic_content(): bool
    {
        return false;
    }
    private function get_menus()
    {
        $menus = wp_get_nav_menus();

        $menu_list = [];

        foreach ($menus as $menu) {
            $menu_list[$menu->slug] = $menu->name;
        }

        return $menu_list;
    }
    private function get_default_slug()
    {
        $menu = $this->get_menus();

        return key($menu);
    }
    protected function register_controls(): void
    {
        $this->start_controls_section(
            'menu_selection',
            [
                'label' => __('Menu Settings', 'pixl-dynamics-by-nd'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'menu',
            [
                'label'   => __('Select Menu', 'pixl-dynamics-by-nd'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_menus(),
                'default' => $this->get_default_slug(),
                'label_block' => false,
            ]
        );



        $this->add_control(
            'submenu_arrow_toggle',
            [
                'label' => esc_html__('Show Menu Arrow', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'plugin-name'),
                'label_off' => esc_html__('Hide', 'plugin-name'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        # Add a control to select menu animations
        $this->add_control(
            'lf_menu_animations',
            [
                'label' => esc_html__('Select Menu Animations', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__('Default', 'plugin-name'),
                    'top_underline' => esc_html__('Top Underline', 'plugin-name'),
                    'bottom_underline' => esc_html__('Bottom Underline', 'plugin-name'),
                    'double_line' => esc_html__('Double Line', 'plugin-name'),
                    'frame_pulse' => esc_html__('Frame Pulse', 'plugin-name'),
                ],
                'default' => 'default',
            ]
        );
        $this->add_control('group_heading_menu_link_bg', [
            'label' => esc_html__('Color', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'lf_menu_animations' => 'double_line',
            ],
        ]);
        $this->add_control(
            'menu_link_bg_color',
            [
                'label' => esc_html__('Hover Link Background Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#3a3a3aff',
                'condition' => [
                    'lf_menu_animations' => 'double_line',
                ],
            ]
        );
        $this->add_control(
            'menu_link_text_color',
            [
                'label' => esc_html__('Hover Link Text Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} nav.menu>ul>li>a.lf-double-line:hover' => 'color: {{VALUE}}!important;',
                ],
                'condition' => [
                    'lf_menu_animations' => 'double_line',
                ],
            ]
        );


        // it should come here
        $this->add_control('group_heading_hover_bg', [
            'label' => esc_html__('Color', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'lf_menu_animations' => 'frame_pulse',
            ],
        ]);
        $this->add_control(
            'menu_link_hover_bg_color',
            [
                'label' => esc_html__('Menu Hover Background Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'condition' => [
                    'lf_menu_animations' => 'frame_pulse',
                ],
            ]
        );

        // Arrow Color Control for Frame Pulse
        $this->add_control(
            'menu_link_arrow_color',
            [
                'label' => esc_html__('Frame Pulse Arrow Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f7f7f7ff',
                'condition' => [
                    'lf_menu_animations' => 'frame_pulse',
                ],
                'separator' => 'before',
            ]
        );




        $this->end_controls_section();

        // typography for menu links...
        $this->start_controls_section(
            'section_style_typography',
            [
                'label' => __('Typography', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__('Menu Link', 'custom-elementor-widget'),
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} nav.menu> ul > li a',
            ]
        );
        $this->end_controls_section();
        // typography for menu links...


        /*Style Section...*/
        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Menu Styles', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'lf_alignment',
            [
                'label'   => __('Menu Alignment', 'plugin-domain'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'left'  => __('Left', 'plugin-domain'),
                    'right' => __('Right', 'plugin-domain'),
                    'center' => __('Center', 'plugin-domain'),
                ],
                'default' => 'right',
            ]
        );
        // Padding control 
        $this->add_control('group_heading_menu_padding', [
            'label' => esc_html__('Padding Between Links', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $this->add_responsive_control(
            'link_padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'top' => '8',
                    'right' => '8',
                    'bottom' => '8',
                    'left' => '8',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} nav.menu ul>li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );





        $this->add_control(
            'menu_link_arrow_double_line_color',
            [
                'label' => esc_html__('Arrow Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'condition' => [
                    'lf_menu_animations' => 'double_line',
                ],
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'menu-bg',
            [
                'label' => __('Menu Background', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control('group_heading_menu_bg', [
            'label' => esc_html__('Menu Background Color', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $this->add_control(
            'navbar_bg_color',
            [
                'label' => esc_html__('Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f2f2f2ff',
                'selectors' => [
                    '{{WRAPPER}} nav.menu' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        // nav bar text color
        $this->add_control(
            'nav_txt_color',
            [
                'label' => esc_html__('Text Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#505050ff',
                'selectors' => [
                    '{{WRAPPER}} nav.menu > ul > li > a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control('group_heading_submenu_bg', [
            'label' => esc_html__('Sub Menu Background Color', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $this->add_control(
            'navbar_sub_menu_bg_color',
            [
                'label' => esc_html__('Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f0f0f0ff',
                'selectors' => [
                    '{{WRAPPER}} .lf-sub-menu-bg' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'nav_subtxt_color',
            [
                'label' => esc_html__('Text Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#5a5a5aff',
                'selectors' => [
                    '{{WRAPPER}} .menu-dropdown a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();



        $this->start_controls_section(
            'mobile_menu_label',
            [
                'label' => __('Mobile Label Styles', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control('group_heading_arrow', [
            'label' => esc_html__('Arrow Padding', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);




        //WORK AREA.. 
        $this->add_control(
            'lf_label_padding',
            [
                'label' => __('Padding (All Devices)', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => '8',
                    'right' => '8',
                    'bottom' => '8',
                    'left' => '8',
                    'unit' => 'px',
                ],
            ]
        );

        $this->add_control('group_heading_arrow_bg_color', [
            'label' => esc_html__('Arrow Label Background Color', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $this->add_control(
            'menu_link_arrow_label_bg_color',
            [
                'label' => esc_html__('Arrow Label Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(189, 189, 189, 0.3)',
            ]
        );

        $this->add_control('group_heading_arrow_size', [
            'label' => esc_html__('Arrow Size', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $this->add_control(
            'lf_arrow_size',
            [
                'label' => __('Arrow Size', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 25,
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render(): void
    {
        $unique_id = uniqid('pixl-link-flow-');
?>
<div class="elementor-link-flow-wrapper">
    <?php

            $settings = $this->get_settings_for_display();

            $lf_alignment = isset($settings['lf_alignment']) ? esc_attr($settings['lf_alignment']) : 'right';
            $lf_menu_animations = isset($settings['lf_menu_animations']) ? esc_attr($settings['lf_menu_animations']) : 'none';

            $menu_link_text_color = isset($settings['menu_link_text_color']) ? $settings['menu_link_text_color'] : '#ffffff';
            $menu_link_bg_color = isset($settings['menu_link_bg_color']) ? $settings['menu_link_bg_color'] : '#3a3a3aff';
            $menu_link_arrow_double_line_color = isset($settings['menu_link_arrow_double_line_color']) ? $settings['menu_link_arrow_double_line_color'] : '#3a3a3aff';
            $menu_link_arrow_color = isset($settings['menu_link_arrow_color']) ? $settings['menu_link_arrow_color'] : '#3a3a3aff';


            $this->display_menu_id = $settings['menu'];
            $show_arrow = $settings['submenu_arrow_toggle'];

            $lf_select_animation = new Animations();

            if ($lf_menu_animations == "top_underline") {
                $lf_select_animation->render_underline_top($this->display_menu_id, $lf_alignment, $show_arrow, $unique_id);
            } elseif ($lf_menu_animations == "bottom_underline") {
                $lf_select_animation->render_underline_below($this->display_menu_id, $lf_alignment, $show_arrow, $unique_id);
            } elseif ($lf_menu_animations == "double_line") {
                $lf_select_animation->render_double_line($this->display_menu_id, $lf_alignment, $show_arrow, $menu_link_text_color, $menu_link_arrow_double_line_color, $unique_id);
            } elseif ($lf_menu_animations == "default") {
                $lf_select_animation->render_default($settings, $this->display_menu_id, $lf_alignment, $show_arrow, $unique_id);
            } elseif ($lf_menu_animations == "frame_pulse") {
                $lf_select_animation->render_frame_pulse($settings, $this->display_menu_id, $lf_alignment, $show_arrow, $menu_link_arrow_color, $unique_id);
            } else {
                $lf_select_animation->render_default($this->display_menu_id, $lf_alignment, $show_arrow, $unique_id);
            }
            ?>
</div>
<?php
    }  /* ends render..*/
}