<?php

namespace Skt_Addons_Elementor\Elementor\Extension;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;

defined('ABSPATH') || die();

class Advanced_Tooltip {

    static $should_script_enqueue = false;

    public static function init() {
        add_action('elementor/element/common/_section_style/after_section_end', [__CLASS__, 'add_controls_section'], 1);

        add_action('elementor/frontend/widget/before_render', [__CLASS__, 'should_script_enqueue']);

        add_action('elementor/preview/enqueue_scripts', [__CLASS__, 'enqueue_scripts']);
    }

    public static function enqueue_scripts() {
        $suffix = skt_addons_elementor_is_script_debug_enabled() ? '.' : '.min.';

        $extension_js = SKT_ADDONS_ELEMENTOR_DIR_PATH . 'assets/js/extension-advanced-tooltip' . $suffix . 'js';
        $extension_js_url = SKT_ADDONS_ELEMENTOR_DIR_URL . 'assets/js/extension-advanced-tooltip' . $suffix . 'js';
        if ( file_exists( $extension_js ) ) {
            wp_enqueue_script(
                'extension-tootips-effects',
                $extension_js_url,
                array( 'elementor-frontend' ),
                filemtime( $extension_js ),
                true
            );
        }
    }

    /**
     * Set should_script_enqueue based extension settings
     *
     * @param Element_Base $section
     * @return void
     */
    public static function should_script_enqueue($section) {
        if (self::$should_script_enqueue) {
            return;
        }

        if ('enable' == $section->get_settings_for_display('skt_addons_elementor_advanced_tooltip_enable')) {
            self::$should_script_enqueue = true;

            self::enqueue_scripts();

            remove_action('elementor/frontend/section/before_render', [__CLASS__, 'should_script_enqueue']);
        }
    }

    public static function add_controls_section($element) {

        $element->start_controls_section(
            '_section_skt_addons_elementor_advanced_tooltip',
            [
                'label' => __('SKT Tooltip', 'skt-addons-for-elementor') . skt_addons_elementor_get_section_icon(),
                'tab'   => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'skt_addons_elementor_advanced_tooltip_enable',
            [
                'label'       => __('Enable SKT Tooltip?', 'skt-addons-for-elementor'),
                'type'        => Controls_Manager::SWITCHER,
                'label_on' => __('On', 'skt-addons-for-elementor'),
                'label_off' => __('Off', 'skt-addons-for-elementor'),
                'return_value' => 'enable',
                'prefix_class' => 'skt-advanced-tooltip-',
                'default' => '',
                'frontend_available' => true,
            ]
        );

        $element->start_controls_tabs('skt_addons_elementor_tooltip_tabs');

        $element->start_controls_tab('skt_addons_elementor_tooltip_settings', [
            'label' => __('Settings', 'skt-addons-for-elementor'),
            'condition' => [
                'skt_addons_elementor_advanced_tooltip_enable!' => '',
            ],
        ]);

        $element->add_control(
            'skt_addons_elementor_advanced_tooltip_content',
            [
                'label' => __('Content', 'skt-addons-for-elementor'),
                'type'      => Controls_Manager::TEXTAREA,
                'description' => skt_addons_elementor_get_allowed_html_desc('intermediate'),
                'rows' => 5,
                'default' => __('I am a tooltip', 'skt-addons-for-elementor'),
                'dynamic' => ['active' => true],
                'frontend_available' => true,
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_responsive_control(
            'skt_addons_elementor_advanced_tooltip_position',
            [
                'label' => __('Position', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => [
                    'top' => __('Top', 'skt-addons-for-elementor'),
                    'bottom' => __('Bottom', 'skt-addons-for-elementor'),
                    'left' => __('Left', 'skt-addons-for-elementor'),
                    'right' => __('Right', 'skt-addons-for-elementor'),
                ],
                'frontend_available' => true,
                'prefix_class' => 'skt-advanced-tooltip%s-',
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_control(
            'skt_addons_elementor_advanced_tooltip_animation',
            [
                'label' => __('Animation', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __('None', 'skt-addons-for-elementor'),
                    'skt_addons_elementor_fadeIn' => __('fadeIn', 'skt-addons-for-elementor'),
                    'skt_addons_elementor_zoomIn' => __('zoomIn', 'skt-addons-for-elementor'),
                    'skt_addons_elementor_rollIn' => __('rollIn', 'skt-addons-for-elementor'),
                    'skt_addons_elementor_bounce' => __('bounce', 'skt-addons-for-elementor'),
                    'skt_addons_elementor_slideInDown' => __('slideInDown', 'skt-addons-for-elementor'),
                    'skt_addons_elementor_slideInLeft' => __('slideInLeft', 'skt-addons-for-elementor'),
                    'skt_addons_elementor_slideInRight' => __('slideInRight', 'skt-addons-for-elementor'),
                    'skt_addons_elementor_slideInUp' => __('slideInUp', 'skt-addons-for-elementor'),
                ],
                'frontend_available' => true,
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_control(
            'skt_addons_elementor_advanced_tooltip_duration',
            [
                'label' => __('Animation Duration (ms)', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 5000,
                'step' => 50,
                'default' => 1000,
                'frontend_available' => true,
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_control(
            'skt_addons_elementor_advanced_tooltip_arrow',
            [
                'label' => __('Arrow', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'skt-addons-for-elementor'),
                'label_off' => __('Hide', 'skt-addons-for-elementor'),
                'return_value' => 'true',
                'default' => 'true',
                'frontend_available' => true,
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_control(
            'skt_addons_elementor_advanced_tooltip_arrow_notice',
            [
                'raw' => '<strong>' . esc_html__('Please note!', 'skt-addons-for-elementor') . '</strong> ' . esc_html__('By toggling Arrow to "HIDE" you get access to more background control.', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::RAW_HTML,
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'render_type' => 'ui',
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                    'skt_addons_elementor_advanced_tooltip_arrow' => 'true',
                ],
            ]
        );

        $element->add_control(
            'skt_addons_elementor_advanced_tooltip_trigger',
            [
                'label' => __('Trigger', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'hover',
                'options' => [
                    'click' => __('Click', 'skt-addons-for-elementor'),
                    'hover' => __('Hover', 'skt-addons-for-elementor'),
                ],
                'frontend_available' => true,
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_responsive_control(
            'skt_addons_elementor_advanced_tooltip_distance',
            [
                'label' => __('Distance', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '0',
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.skt-advanced-tooltip-enable .skt-advanced-tooltip-content' => '--skt-tooltip-arrow-distance: {{SIZE}}{{UNIT}};',
                    // '{{WRAPPER}}.skt-advanced-tooltip-enable .skt-advanced-tooltip-content' => '--skt-tooltip-arrow-distance: {{SIZE}}{{UNIT}};',
                    // '{{WRAPPER}}.skt-advanced-tooltip-enable .skt-advanced-tooltip-content' => '--skt-tooltip-arrow-distance: {{SIZE}}{{UNIT}};',
                    // '{{WRAPPER}}.skt-advanced-tooltip-enable .skt-advanced-tooltip-content' => '--skt-tooltip-arrow-distance: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_responsive_control(
            'skt_addons_elementor_advanced_tooltip_align',
            [
                'label' => __('Text Alignment', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'skt-addons-for-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'skt-addons-for-elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'skt-addons-for-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .skt-advanced-tooltip-content' => 'text-align: {{VALUE}};'
                ],
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->end_controls_tab();

        $element->start_controls_tab('skt_addons_elementor_advanced_tooltip_styles', [
            'label' => __('Styles', 'skt-addons-for-elementor'),
            'condition' => [
                'skt_addons_elementor_advanced_tooltip_enable!' => '',
            ],
        ]);

        $element->add_responsive_control(
            'skt_addons_elementor_advanced_tooltip_width',
            [
                'label' => __('Width', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '120',
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 800,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .skt-advanced-tooltip-content' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_responsive_control(
            'skt_addons_elementor_advanced_tooltip_arrow_size',
            [
                'label' => __('Tooltip Arrow Size (px)', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '5',
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .skt-advanced-tooltip-content::after' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                    'skt_addons_elementor_advanced_tooltip_arrow' => 'true',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'skt_addons_elementor_advanced_tooltip_typography',
                'separator' => 'after',
                'fields_options' => [
                    'typography' => [
                        'default' => 'yes'
                    ],
                    'font_family' => [
                        'default' => 'Nunito',
                    ],
                    'font_weight' => [
                        'default' => '500', // 100, 200, 300, 400, 500, 600, 700, 800, 900, normal, bold
                    ],
                    'font_size' => [
                        'default' => [
                            'unit' => 'px', // px, em, rem, vh
                            'size' => '14', // any number
                        ],
                    ],
                ],
                'selector' => '{{WRAPPER}} .skt-advanced-tooltip-content',
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'skt_addons_elementor_advanced_tooltip_title_section_bg_color',
                'label'    => __('Background', 'skt-addons-for-elementor'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .skt-advanced-tooltip-content',
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                    'skt_addons_elementor_advanced_tooltip_arrow!' => 'true',
                ],
            ]
        );

        $element->add_control(
            'skt_addons_elementor_advanced_tooltip_background_color',
            [
                'label' => __('Background Color', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .skt-advanced-tooltip-content' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .skt-advanced-tooltip-content::after' => '--skt-tooltip-arrow-color: {{VALUE}}',
                ],
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                    'skt_addons_elementor_advanced_tooltip_arrow' => 'true',
                ],
            ]
        );

        $element->add_control(
            'skt_addons_elementor_advanced_tooltip_color',
            [
                'label' => __('Text Color', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .skt-advanced-tooltip-content' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'skt_addons_elementor_advanced_tooltip_border',
                'label' => __('Border', 'skt-addons-for-elementor'),
                'selector' => '{{WRAPPER}} .skt-advanced-tooltip-content',
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                    'skt_addons_elementor_advanced_tooltip_arrow!' => 'true',
                ],
            ]
        );

        $element->add_responsive_control(
            'skt_addons_elementor_advanced_tooltip_border_radius',
            [
                'label' => __('Border Radius', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .skt-advanced-tooltip-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_responsive_control(
            'skt_addons_elementor_advanced_tooltip_padding',
            [
                'label' => __('Padding', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .skt-advanced-tooltip-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'skt_addons_elementor_advanced_tooltip_box_shadow',
                'selector' => '{{WRAPPER}} .skt-advanced-tooltip-content',
                'separator' => '',
                'condition' => [
                    'skt_addons_elementor_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->end_controls_tab();

        $element->end_controls_tabs();

        $element->end_controls_section();
    }
}

Advanced_Tooltip::init();