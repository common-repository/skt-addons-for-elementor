<?php
/**
 * Chart widget class
 *
 * @package Skt_Addons_Elementor
 */
namespace Skt_Addons_Elementor\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Skt_Addons_Elementor\Widget\Radar_Chart\Data_Map;

defined( 'ABSPATH' ) || die();

class Radar_Chart extends Base {

	/**
	 * Get widget title.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Radar Chart', 'skt-addons-for-elementor' );
	}

//	public function get_custom_help_url() {
//		return '';
//	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'skti skti-graph-pie';
	}

	public function get_keywords() {
		return [ 'chart', 'radar', 'statistic' ];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {
		$this->__chart_content_controls();
		$this->__settings_content_controls();
	}

	protected function __chart_content_controls() {

		$this->start_controls_section(
			'_section_chart',
			[
				'label' => __( 'Radar Chart', 'skt-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'labels',
			[
				'label'       => __( 'Labels', 'skt-addons-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'January, February, March, April, May', 'skt-addons-for-elementor' ),
				'description' => __( 'Write multiple label with comma ( , ) separator. Example: January, February, March etc', 'skt-addons-for-elementor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'bar_tabs' );

		$repeater->start_controls_tab(
			'bar_tab_content',
			[
				'label' => __( 'Content', 'skt-addons-for-elementor' ),
			]
		);

		$repeater->add_control(
			'label',
			[
				'label'   => __( 'Label', 'skt-addons-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'data',
			[
				'label'       => __( 'Data', 'skt-addons-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'description' => __( 'Write data values with comma ( , ) separator. Example: 20, 30, 40, 50', 'skt-addons-for-elementor' ),
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'bar_tab_style',
			[
				'label' => __( 'Style', 'skt-addons-for-elementor' ),
			]
		);

		$repeater->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'skt-addons-for-elementor' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$repeater->add_control(
			'border_color',
			[
				'label' => __( 'Border Color', 'skt-addons-for-elementor' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$repeater->add_control(
			'pointer_color',
			[
				'label' => __( 'Pointer Color', 'skt-addons-for-elementor' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$repeater->end_controls_tab();

		$this->add_control(
			'chart_data',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ label }}}',
				'default'     => [
					[
						'label'              => 'SKT Addons',
						'data'               => '47, 10, 45, 75, 10',
						'background_color'   => 'rgba(86, 45, 212, 0.17)',
						'border_color'       => '#5A37CF',
						'pointer_color'      => '#3449CD',
					],
					[
						'label'              => 'Other Addons',
						'data'               => '5, 53, 18, 33, 54',
						'background_color'   => 'rgba(226, 73, 138, 0.22)',
						'border_color'       => '#E2498A',
						'pointer_color'      => '#E22978',
					]
				]
			]
		);

		$this->end_controls_section();
	}

	protected function __settings_content_controls() {

		$this->start_controls_section(
			'settings',
			[
				'label' => __( 'Settings', 'skt-addons-for-elementor' ),
			]
		);

		$this->add_responsive_control(
			'chart_height',
			[
				'label'       => __( 'Chart Height', 'skt-addons-for-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min' => 50,
						'max' => 1500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 500,
				],
				'selectors'   => [
					'{{WRAPPER}} .skt-radar-chart-container' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tooltip_display',
			[
				'label'        => __( 'Show Tooltips', 'skt-addons-for-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'title_display',
			[
				'label'        => __( 'Show Title', 'skt-addons-for-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'chart_title',
			[
				'label'       => __( 'Title', 'skt-addons-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'SKT Addons Rocks', 'skt-addons-for-elementor' ),
				'condition' => [
					'title_display' => 'yes'
				]
			]
		);

		$this->add_control(
			'legend_heading',
			[
				'label'     => __( 'Legend', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'legend_display',
			[
				'label'        => __( 'Show Legend', 'skt-addons-for-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'legend_position',
			[
				'label'     => __( 'Position', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'top',
				'options'   => [
					'top'    => __( 'Top', 'skt-addons-for-elementor' ),
					'left'   => __( 'Left', 'skt-addons-for-elementor' ),
					'bottom' => __( 'Bottom', 'skt-addons-for-elementor' ),
					'right'  => __( 'Right', 'skt-addons-for-elementor' ),
				],
				'condition' => [
					'legend_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'legend_reverse',
			[
				'label'        => __( 'Reverse', 'skt-addons-for-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
				'condition'    => [
					'legend_display'  => 'yes',
				],
			]
		);

		$this->add_control(
			'animation_heading',
			[
				'label'     => __( 'Animation', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'chart_animation_duration',
			[
				'label' => __( 'Duration', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10000,
				'step' => 1,
				'default' => 1000,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'animation_options',
			[
				'label'     => __( 'Easing', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'linear',
				'options'   => [
					'linear'    => __( 'Linear', 'skt-addons-for-elementor' ),
					'easeInCubic'   => __( 'Ease In Cubic', 'skt-addons-for-elementor' ),
					'easeInCirc' => __( 'Ease In Circ', 'skt-addons-for-elementor' ),
					'easeInBounce' => __( 'Ease In Bounce', 'skt-addons-for-elementor' ),
				]
			]
		);

		$this->end_controls_section();
	}

	/**
     * Register widget style controls
     */
	protected function register_style_controls() {
		$this->__common_style_controls();
		$this->__legend_style_controls();
		$this->__tooltip_style_controls();
	}

	protected function __common_style_controls() {

		$this->start_controls_section(
			'_section_style_common',
			[
				'label' => __( 'Common', 'skt-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'layout_padding',
			[
				'label' => __( 'Padding', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
			]
		);

		$this->add_control(
			'line_tension',
			[
				'label' => __( 'Line Tension', 'skt-addons-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label' => __( 'Border Width', 'skt-addons-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
			]
		);

		$this->add_control(
			'pointer_border_width',
			[
				'label' => __( 'Pointer Border Width', 'skt-addons-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
			]
		);

		$this->add_control(
			'title_typography_toggle',
			[
				'label' => __( 'Title Typography', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'None', 'skt-addons-for-elementor' ),
				'label_on' => __( 'Custom', 'skt-addons-for-elementor' ),
				'return_value' => 'yes',
				'condition' => [
					'title_display' => 'yes'
				]
			]
		);

		$this->start_popover();

		$this->add_control(
			'title_font_size',
			[
				'label' => __( 'Font Size', 'skt-addons-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'condition' => [
					'title_display' => 'yes',
					'title_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'title_font_family',
			[
				'label' => __( 'Font Family', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::FONT,
				'default' => '',
				'condition' => [
					'title_display' => 'yes',
					'title_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'title_font_weight',
			[
				'label'   => esc_html__( 'Font Weight', 'skt-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'skt-addons-for-elementor' ),
					'normal' => __( 'Normal', 'skt-addons-for-elementor' ),
					'bold'   => __( 'Bold', 'skt-addons-for-elementor' ),
					'300'    => __( '300', 'skt-addons-for-elementor' ),
					'400'    => __( '400', 'skt-addons-for-elementor' ),
					'600'    => __( '600', 'skt-addons-for-elementor' ),
					'700'    => __( '700', 'skt-addons-for-elementor' )
				],
				'condition' => [
					'title_display' => 'yes',
					'title_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'title_font_style',
			[
				'label'   => esc_html__( 'Font Style', 'skt-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''        => __( 'Default', 'skt-addons-for-elementor' ),
					'normal'  => __( 'Normal', 'skt-addons-for-elementor' ),
					'italic'  => __( 'Italic', 'skt-addons-for-elementor' ),
					'oblique' => __( 'Oblique', 'skt-addons-for-elementor' ),
				],
				'condition' => [
					'title_display' => 'yes',
					'title_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'title_font_color',
			[
				'label' => __( 'Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'title_display' => 'yes',
					'title_typography_toggle' => 'yes'
				]
			]
		);

		$this->end_popover();

		$this->end_controls_section();
	}

	protected function __legend_style_controls() {

		$this->start_controls_section(
			'_section_style_legend',
			[
				'label' => __( 'Legend', 'skt-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'lagend_note',
			[
				'label' => false,
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( 'Lagend is Switched off from Content > Settings.', 'skt-addons-for-elementor' ),
				'condition' => [
					'legend_display!' => 'yes'
				]
			]
		);

		$this->add_control(
			'legend_box_width',
			[
				'label' => __( 'Box Width', 'skt-addons-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 70,
					],
				],
				'condition' => [
					'legend_display' => 'yes'
				]
			]
		);

		$this->add_control(
            'legend_typography_toggle',
            [
                'label' => __( 'Typography', 'skt-addons-for-elementor' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'None', 'skt-addons-for-elementor' ),
                'label_on' => __( 'Custom', 'skt-addons-for-elementor' ),
				'return_value' => 'yes',
				'condition' => [
					'legend_display' => 'yes'
				]
            ]
		);

		$this->start_popover();

		$this->add_control(
			'legend_font_size',
			[
				'label' => __( 'Font Size', 'skt-addons-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'condition' => [
					'legend_display' => 'yes',
					'legend_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'legend_font_family',
			[
				'label' => __( 'Font Family', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::FONT,
				'default' => '',
				'condition' => [
					'legend_display' => 'yes',
					'legend_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'legend_font_weight',
			[
				'label'   => esc_html__( 'Font Weight', 'skt-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'skt-addons-for-elementor' ),
					'normal' => __( 'Normal', 'skt-addons-for-elementor' ),
					'bold'   => __( 'Bold', 'skt-addons-for-elementor' ),
					'300'    => __( '300', 'skt-addons-for-elementor' ),
					'400'    => __( '400', 'skt-addons-for-elementor' ),
					'600'    => __( '600', 'skt-addons-for-elementor' ),
					'700'    => __( '700', 'skt-addons-for-elementor' )
				],
				'condition' => [
					'legend_display' => 'yes',
					'legend_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'legend_font_style',
			array(
				'label'   => esc_html__( 'Font Style', 'skt-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''        => __( 'Default', 'skt-addons-for-elementor' ),
					'normal'  => __( 'Normal', 'skt-addons-for-elementor' ),
					'italic'  => __( 'Italic', 'skt-addons-for-elementor' ),
					'oblique' => __( 'Oblique', 'skt-addons-for-elementor' ),
				),
				'condition' => [
					'legend_display' => 'yes',
					'legend_typography_toggle' => 'yes'
				]
			)
		);

		$this->add_control(
			'legend_font_color',
			[
				'label' => __( 'Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'legend_display' => 'yes',
					'legend_typography_toggle' => 'yes'
				]
			]
		);

		$this->end_popover();

		$this->end_controls_section();
	}

	protected function __tooltip_style_controls() {

		$this->start_controls_section(
			'_section_style_tooltip',
			[
				'label' => __( 'Tooltip', 'skt-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tooltip_padding',
			[
				'label' => __( 'Padding', 'skt-addons-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'condition' => [
					'tooltip_display' => 'yes',
				]
			]
		);

		$this->add_control(
			'tooltip_border_width',
			[
				'label' => __( 'Border Width', 'skt-addons-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'condition' => [
					'tooltip_display' => 'yes',
				]
			]
		);

		$this->add_control(
			'tooltip_border_radius',
			[
				'label' => __( 'Border Radius', 'skt-addons-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'condition' => [
					'tooltip_display' => 'yes',
				]
			]
		);

		$this->add_control(
			'tooltip_caret_size',
			[
				'label' => __( 'Caret Size', 'skt-addons-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'condition' => [
					'tooltip_display' => 'yes',
				]
			]
		);

		$this->add_control(
			'tooltip_mode',
			[
				'label'   => esc_html__( 'Mode', 'skt-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Select Mode', 'skt-addons-for-elementor' ),
					'nearest' => __( 'Nearest', 'skt-addons-for-elementor' ),
					'index' => __( 'Index', 'skt-addons-for-elementor' ),
					'x' => __( 'X', 'skt-addons-for-elementor' ),
					'y' => __( 'Y', 'skt-addons-for-elementor' ),
				],
				'default' => '',
				'condition' => [
					'tooltip_display' => 'yes',
				]
			]
		);

		$this->add_control(
			'tooltip_background_color',
			[
				'label' => esc_html__( 'Background Color', 'skt-addons-for-elementor' ),
				'type'  => Controls_Manager::COLOR,
				'condition' => [
					'tooltip_display' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_border_color',
			[
				'label' => esc_html__( 'Border Color', 'skt-addons-for-elementor' ),
				'type'  => Controls_Manager::COLOR,
				'condition' => [
					'tooltip_display' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_title_typography_toggle',
			[
				'label' => __( 'Title Typography', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'None', 'skt-addons-for-elementor' ),
				'label_on' => __( 'Custom', 'skt-addons-for-elementor' ),
				'return_value' => 'yes',
				'condition' => [
					'tooltip_display' => 'yes'
				]
			]
		);

		$this->start_popover();

		$this->add_control(
			'tooltip_title_font_size',
			[
				'label' => __( 'Font Size', 'skt-addons-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_title_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_title_font_family',
			[
				'label' => __( 'Font Family', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::FONT,
				'default' => '',
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_title_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_title_font_weight',
			[
				'label'   => esc_html__( 'Font Weight', 'skt-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'skt-addons-for-elementor' ),
					'normal' => __( 'Normal', 'skt-addons-for-elementor' ),
					'bold'   => __( 'Bold', 'skt-addons-for-elementor' ),
					'300'    => __( '300', 'skt-addons-for-elementor' ),
					'400'    => __( '400', 'skt-addons-for-elementor' ),
					'600'    => __( '600', 'skt-addons-for-elementor' ),
					'700'    => __( '700', 'skt-addons-for-elementor' )
				],
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_title_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_title_font_style',
			[
				'label'   => esc_html__( 'Font Style', 'skt-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''        => __( 'Default', 'skt-addons-for-elementor' ),
					'normal'  => __( 'Normal', 'skt-addons-for-elementor' ),
					'italic'  => __( 'Italic', 'skt-addons-for-elementor' ),
					'oblique' => __( 'Oblique', 'skt-addons-for-elementor' ),
				],
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_title_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_title_font_color',
			[
				'label' => __( 'Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_title_typography_toggle' => 'yes'
				]
			]
		);

		$this->end_popover();

		$this->add_control(
			'tooltip_body_typography_toggle',
			[
				'label' => __( 'Body Typography', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'None', 'skt-addons-for-elementor' ),
				'label_on' => __( 'Custom', 'skt-addons-for-elementor' ),
				'return_value' => 'yes',
				'condition' => [
					'tooltip_display' => 'yes'
				]
			]
		);

		$this->start_popover();

		$this->add_control(
			'tooltip_body_font_size',
			[
				'label' => __( 'Font Size', 'skt-addons-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_body_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_body_font_family',
			[
				'label' => __( 'Font Family', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::FONT,
				'default' => '',
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_body_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_body_font_weight',
			[
				'label'   => esc_html__( 'Font Weight', 'skt-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'skt-addons-for-elementor' ),
					'normal' => __( 'Normal', 'skt-addons-for-elementor' ),
					'bold'   => __( 'Bold', 'skt-addons-for-elementor' ),
					'300'    => __( '300', 'skt-addons-for-elementor' ),
					'400'    => __( '400', 'skt-addons-for-elementor' ),
					'600'    => __( '600', 'skt-addons-for-elementor' ),
					'700'    => __( '700', 'skt-addons-for-elementor' )
				],
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_body_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_body_font_style',
			[
				'label'   => esc_html__( 'Font Style', 'skt-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''        => __( 'Default', 'skt-addons-for-elementor' ),
					'normal'  => __( 'Normal', 'skt-addons-for-elementor' ),
					'italic'  => __( 'Italic', 'skt-addons-for-elementor' ),
					'oblique' => __( 'Oblique', 'skt-addons-for-elementor' ),
				],
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_body_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_body_font_color',
			[
				'label' => __( 'Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_body_typography_toggle' => 'yes'
				]
			]
		);

		$this->end_popover();

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		include_once SKT_ADDONS_ELEMENTOR_DIR_PATH . "widgets/radar-chart/classes/data-map.php";

		$this->add_render_attribute(
			'container',
			[
				'class'         => 'skt-radar-chart-container',
				'data-settings' => Data_Map::initial($settings)
			]
		);

		$this->add_render_attribute( 'canvas',
			[
				'id' => 'skt-radar-chart',
				'role'  => 'img',
			]
		);
		?>
		<div <?php echo wp_kses_post($this->get_render_attribute_string( 'container' )); ?>>

			<canvas <?php echo wp_kses_post($this->get_render_attribute_string( 'canvas' )); ?>></canvas>

		</div>

	<?php
	}
}