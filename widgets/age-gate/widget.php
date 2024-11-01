<?php
/**
 * Card widget class
 *
 * @package Skt_Addons_Elementor
 */
namespace Skt_Addons_Elementor\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

defined( 'ABSPATH' ) || die();

class Age_Gate extends Base {

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Age Gate', 'skt-addons-for-elementor' );
	}

	public function get_custom_help_url() {
		return '';
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'skti skti-age-gate';
	}

	public function get_keywords() {
		return [ 'age-gate','age','gate' ];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {
		$this->__age_gate_content_controls();
		$this->__header_content_controls();
		$this->__form_body_content_controls();
		$this->__footer_content_controls();
		$this->__other_content_controls();
	}

	protected function __age_gate_content_controls() {

		$this->start_controls_section(
			'age_gate_content_section',
			[
				'label' => esc_html__( 'Age Gate', 'skt-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'editor_mood',
			[
				'label'   => esc_html__( 'Editor Preview', 'skt-addons-for-elementor' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => esc_html__( 'Yes', 'skt-addons-for-elementor' ),
				'label_off' => esc_html__( 'No', 'skt-addons-for-elementor' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
            'age_gate_style',
			[
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Age Gate Style', 'skt-addons-for-elementor'),
                'label_block' => 'yes',
                'default' => 'confirm-age',
                'options' => [
                    'confirm-age' => esc_html__('Confirm Age', 'skt-addons-for-elementor'),
                    'confirm-dob' => esc_html__('Confirm Date Of Birth', 'skt-addons-for-elementor'),
                    'confirm-by-boolean' => esc_html__('Confirm by Yes/No', 'skt-addons-for-elementor'),
                ],
            ]
        );

		$this->end_controls_section();
	}

	protected function __header_content_controls() {

		$this->start_controls_section(
			'header_content_section',
			[
				'label' => esc_html__( 'Header', 'skt-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		 $this->add_control(
			'header_img',
			[
				'label' => esc_html__( 'Image', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => ['active'   => true,],
				'default' => [
					'url' => SKT_ADDONS_ELEMENTOR_ASSETS . 'imgs/skt-logo.png',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [ 'active' => true,],
				'default' => esc_html__( 'Age Verification', 'skt-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Enter Your Title', 'skt-addons-for-elementor' ),
				'label_block' => true,
			]
		);

        $this->add_control(
            'desc',
            [
            	'label' => esc_html__( 'Description', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'You must be 18 years of age to enter this website.', 'skt-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Enter Description', 'skt-addons-for-elementor' ),
				'dynamic' => ['active'   => true,],
            ]
        );

		$this->add_responsive_control(
			'header_alignment',
			[
				'label' => esc_html__( 'Alignment', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-header' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __form_body_content_controls() {

		$this->start_controls_section(
			'form_body_content_section',
			[
				'label' => esc_html__( 'Form Body', 'skt-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'dob_limit',
			[
				'label' => esc_html__( 'Minimum Age Limit', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'dynamic' => [
					'active' => true,
				],
				'min' => 6,
				'max' => 100,
				'default' => 18,
				'condition' => [
					'age_gate_style' => 'confirm-dob',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'body_width',
			[
				'label' => esc_html__( 'Form Content Width', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'separator' => 'before',
				'size_units' => ['px','%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 5,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 270,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-wrapper .skt-age-gate-form-body' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'age_gate_style' => ['confirm-dob','confirm-by-boolean'],
				],
			]
		);

		$this->add_control(
			'btn_one_heading',
			[
				'label' => esc_html__( 'Button One', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Text', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => ['active'   => true,],
				'default' => esc_html__( "Yes, I'm 18 or older", 'skt-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Button Text', 'skt-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label' => esc_html__( 'Icon', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::ICONS,
				'skin' => 'inline',
				'default' => [
					'value' => 'skti skti-play-next',
					'library' => 'skt-icon',
				],
			]
		);

		$this->add_control(
            'icon_position', [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Icon Position', 'skt-addons-for-elementor'),
                'default' => 'after',
                'options' => [
                    'before' => esc_html__('Before', 'skt-addons-for-elementor'),
                     'after' => esc_html__('After', 'skt-addons-for-elementor'),
                ],
                'condition' => [
                	'button_icon[value]!' => '',
				],
            ]
        );

        $this->add_control(
			'btn_two_heading',
			[
				'label' => esc_html__( 'Button Two', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'age_gate_style' => 'confirm-by-boolean',
				],
			]
		);

        $this->add_control(
			'btn_two_text',
			[
				'label' => esc_html__( 'Text', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => ['active'   => true,],
				'default' => esc_html__( 'No', 'skt-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Enter Text', 'skt-addons-for-elementor' ),
				'condition' => [
					'age_gate_style' => 'confirm-by-boolean',
				],
			]
		);

		$this->add_control(
			'btn_two_icon',
			[
				'label' => esc_html__( 'Icon', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::ICONS,
				'skin' => 'inline',
				'condition' => [
					'age_gate_style' => 'confirm-by-boolean',
				],
			]
		);

		$this->add_control(
            'btn_two_icon_position', [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Icon Position', 'skt-addons-for-elementor'),
                'default' => 'second-icon-before',
                'options' => [
                    'second-icon-before' => esc_html__('Prefix', 'skt-addons-for-elementor'),
                     'second-icon-after' => esc_html__('Postfix', 'skt-addons-for-elementor'),
                ],
                'condition' => [
                	'age_gate_style' => 'confirm-by-boolean',
					'btn_two_icon[value]!' => '',
				],
            ]
        );

        $this->add_responsive_control(
			'form_body_alignment',
			[
				'label' => esc_html__( 'Alignment', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-wrapper.skt-age-gate-confirm-age .skt-age-gate-form-body' => 'align-items: {{VALUE}};justify-content: {{VALUE}};',
					'{{WRAPPER}} .skt-age-gate-wrapper.skt-age-gate-confirm-dob .skt-age-gate-boxes' => 'align-items: {{VALUE}};justify-content: {{VALUE}};',
					'{{WRAPPER}} .skt-age-gate-wrapper.skt-age-gate-confirm-by-boolean .skt-age-gate-boxes' => 'align-items: {{VALUE}};justify-content: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __footer_content_controls() {

		$this->start_controls_section(
			'footer_content_section',
			[
				'label' => esc_html__( 'Footer', 'skt-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
            'footer_text',
            [
            	'label' => esc_html__( 'Footer Text', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'By entering this site you are agreeing to the Terms of use and Privacy Policy.', 'skt-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Type your extra info here', 'skt-addons-for-elementor' ),
				'dynamic' => [
					'active'   => true,

				],
            ]
        );

        $this->add_control(
			'warning_message',
            [
            	'label' => esc_html__( 'Warning Message', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'You are not allowed to visit this website without being 18.', 'skt-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Enter Your Message', 'skt-addons-for-elementor' ),
				'dynamic' => ['active'   => true,],
				'condition' => [
					'age_gate_style' => ['confirm-dob','confirm-by-boolean'],
				],
				'separator' => 'before',
            ]
		);

		$this->add_responsive_control(
			'footer_alignment',
			[
				'label' => esc_html__( 'Alignment', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-footer-text' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __other_content_controls() {

		$this->start_controls_section(
			'other_opt',
			[
				'label' => esc_html__( 'Others Option', 'skt-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'side_img',
			[
				'label' => esc_html__( 'Side Image', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => ['active'   => true,],
			]
		);

		$this->add_control(
			'side_img_pos',
			[
				'label' => esc_html__( 'Position', 'skt-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'center center',
				'options' => [
					'' => esc_html__( 'Default','skt-addons-for-elementor' ),
					'top left' => esc_html__( 'Top Left','skt-addons-for-elementor' ),
					'top center' => esc_html__( 'Top Center','skt-addons-for-elementor' ),
					'top right' => esc_html__( 'Top Right','skt-addons-for-elementor' ),
					'center left' => esc_html__( 'Center Left','skt-addons-for-elementor' ),
					'center center' => esc_html__( 'Center Center','skt-addons-for-elementor' ),
					'center right' => esc_html__( 'Center Right', 'skt-addons-for-elementor' ),
					'bottom left' => esc_html__( 'Bottom Left', 'skt-addons-for-elementor' ),
					'bottom center' => esc_html__( 'Bottom Center','skt-addons-for-elementor' ),
					'bottom right' => esc_html__( 'Bottom Right','skt-addons-for-elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-boxes.skt-age-gate-side-image' => 'background-position:{{VALUE}} !important;',
				],
				'condition' => [
					'side_img[url]!' => '',
				],
			]
		);

		$this->add_control(
			'img_direction',
			[
				'label'   => esc_html__( 'Image Direction', 'skt-addons-for-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => '2',
				'options' => [
					'0'    => [
						'title' => esc_html__( 'Left', 'skt-addons-for-elementor' ),
						'icon'  => 'eicon-angle-left',
					],
					'2' => [
						'title' => esc_html__( 'Right', 'skt-addons-for-elementor' ),
						'icon'  => 'eicon-angle-right',
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .skt-age-gate-boxes' => 'order: 1;',
					'{{WRAPPER}} .skt-age-gate-boxes.skt-age-gate-side-image' => 'order: {{VALUE}};',
				],
				'condition' => [
					'side_img[url]!' => '',
				],
			]
		);

		$this->add_control(
			'age_gate_cookies_time',
			[
				'label' => esc_html__( 'Cookies Expiry Time', 'skt-addons-for-elementor' ),
				'description' => '<p style="color: #f73333;">' .esc_html__( 'This is required. Otherwise the age gate will spawn on every refresh.', 'skt-addons-for-elementor' ) . '</p>',
				'type' => Controls_Manager::NUMBER,
				'dynamic' => [
					'active' => true,
				],
				'min' => 0,
				'max' => 365,
				'default' => 10,
			]
		);

		$this->end_controls_section();
	}

	/**
     * Register widget style controls
     */
	protected function register_style_controls() {

		$this->__box_style_controls();
		$this->__header_style_controls();
		$this->__date_input_style_controls();
		$this->__button_style_controls();
		$this->__button_two_style_controls();
		$this->__footer_style_controls();
		$this->__warning_msg_style_controls();
	}

	protected function __box_style_controls() {

		$this->start_controls_section(
            'box_style_section',
            [
                'label' => esc_html__('Box', 'skt-addons-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'box_width',
			[
				'label' => esc_html__( 'Width', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'separator' => 'before',
				'size_units' => ['px','%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				// 'default' => [
				// 	'unit' => 'px',
				// 	'size' => 576,
				// ],
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-inner-wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_height',
			[
				'label' => esc_html__( 'Height', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px','%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-inner-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => esc_html__( 'Background Type', 'skt-addons-for-elementor' ),
			    'types' => [ 'classic', 'gradient' ],
			    'selector' => '{{WRAPPER}} .skt-age-gate-inner-wrapper',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => esc_html__( 'Border', 'skt-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .skt-age-gate-inner-wrapper',
			]
		);

		$this->add_responsive_control(
			'box_bradiusNml',
			[
				'label'      => esc_html__( 'Border Radius', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .skt-age-gate-inner-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_ShadowNml',
				'label' => esc_html__( 'Box Shadow', 'skt-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .skt-age-gate-inner-wrapper',
			]
		);

		$this->add_control(
			'overlay_heading',
			[
				'label' => esc_html__( 'Overlay', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'overlay_color',
			[
				'label' => esc_html__( 'Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-wrapper:after' => 'background: {{VALUE}};',
				],
			]
		);

		$background_types = [ 'classic' => 'color' ];
		if ( isset( $background_types['classic'] ) && $background_types['classic'] === 'color' ) {
		    unset( $background_types['classic'] );
		}

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_background',
				'label' => esc_html__( 'Background', 'skt-addons-for-elementor' ),
			    'types' => [ 'classic' ],   // Resolved escaping issued
			    'selector' => '{{WRAPPER}} .skt-age-gate-wrapper', 
			]
		);

        $this->end_controls_section();
	}

	protected function __header_style_controls() {

		$this->start_controls_section(
            'header_style_section',
            [
                'label' => esc_html__('Header', 'skt-addons-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'header_img[url]!' => '',
				],
            ]
        );

		$this->__image_style_controls();

		$this->__title_style_controls();

		$this->__desc_style_controls();

        $this->end_controls_section();
	}

	protected function __image_style_controls() {

		$this->add_control(
			'image_heading',
			[
				'label' => esc_html__( 'Image', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);

       $this->add_responsive_control(
            'img_size',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Size', 'skt-addons-for-elementor'),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
						'step' => 1,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-inner-wrapper .skt-age-gate-boxes .skt-age-gate-image img' => 'max-width: {{SIZE}}{{UNIT}}',
				],
            ]
        );

        $this->add_responsive_control(
			'img_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .skt-age-gate-inner-wrapper .skt-age-gate-boxes .skt-age-gate-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'img_margin',
			[
				'label' => esc_html__( 'Margin', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-inner-wrapper .skt-age-gate-boxes .skt-age-gate-image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

	}

	protected function __title_style_controls() {

		$this->add_control(
			'title_heading',
			[
				'label' => esc_html__( 'Title', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo',
				'label' => esc_html__( 'Typography', 'skt-addons-for-elementor' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY
				],
				'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-title',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);
	}

	protected function __desc_style_controls() {

		$this->add_control(
			'desc_heading',
			[
				'label' => esc_html__( 'Description', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-description' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typo',
				'label' => esc_html__( 'Typography', 'skt-addons-for-elementor' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY
				],
				'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-description',
			]
		);

		$this->add_responsive_control(
			'desc_padding',
			[
				'label'      => esc_html__( 'Padding', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'desc_margin',
			[
				'label' => esc_html__( 'Margin', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);
	}

	protected function __confirm_text_style_controls() {

		$this->start_controls_section(
            'confirm_text_style_section',
            [
                'label' => esc_html__('Confirm Text', 'skt-addons-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
			'confirm_text_heading',
			[
				'label' => esc_html__( 'Confirm Text', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'confirm_text_color',
			[
				'label' => esc_html__( 'Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-checkbox' => 'color: {{VALUE}};',
				],

			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'confirm_text_typo',
				'label' => esc_html__( 'Typography', 'skt-addons-for-elementor' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY
				],
				'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-checkbox',
				'separator' => 'before',
			]
		);

        $this->end_controls_section();
	}

	protected function __date_input_style_controls() {

		$this->start_controls_section(
            'date_input_style_section',
            [
                'label' => esc_html__('Date Input', 'skt-addons-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
					'age_gate_style' => 'confirm-dob',
				],
            ]
        );

		$this->add_responsive_control(
			'date_input_padding',
			[
				'label' => esc_html__( 'Padding', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-date-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'age_gate_style' => 'confirm-dob',
				],
			]
		);

        $this->add_responsive_control(
			'date_input_margin',
			[
				'label' => esc_html__( 'Margin', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-date-input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'age_gate_style' => 'confirm-dob',
				],
			]
		);

		$this->add_control(
            'date_input_color',
            [
                'label' => esc_html__('Color', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-date-input' => 'color:{{VALUE}};',
                ],
				'condition' => [
					'age_gate_style' => 'confirm-dob',
				],
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_input_typo',
				'label' => esc_html__( 'Typography', 'skt-addons-for-elementor' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY
				],
				'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-date-input',
				'condition' => [
					'age_gate_style' => 'confirm-dob',
				],
			]
		);

		$background_control = [
		    'name' => 'date_input_bg',
		    'label' => esc_html__( 'Background Type', 'skt-addons-for-elementor' ),
		    'types' => [ 'classic', 'gradient' ],
		    'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-date-input',
		    'condition' => [
		        'age_gate_style' => 'confirm-dob',
		    ],
		];

		if ( in_array( 'classic', $background_control['types'] ) ) {
		    $background_control['exclude']['classic'] = 'image';
		}

		$this->add_group_control(
		    Group_Control_Background::get_type(),
		    $background_control
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'date_input_border',
				'label' => esc_html__( 'Border', 'skt-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-date-input',
				'condition' => [
					'age_gate_style' => 'confirm-dob',
				],
			]
		);

		$this->add_responsive_control(
			'date_input_bradius',
			[
				'label'      => esc_html__( 'Border Radius', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-date-input'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'age_gate_style' => 'confirm-dob',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'date_input_Shadow',
				'label' => esc_html__( 'Box Shadow', 'skt-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-date-input',
				'condition' => [
					'age_gate_style' => 'confirm-dob',
				],
			]
		);

        $this->end_controls_section();
	}

	protected function __button_style_controls() {

		$this->start_controls_section(
            'btn_one_style_section',
            [
                'label' => esc_html__('Button One', 'skt-addons-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_one_typo',
				'label' => esc_html__( 'Typography', 'skt-addons-for-elementor' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY
				],
				'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-age-btn,{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn,{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn',
			]
		);

		$this->add_responsive_control(
			'btn_one_padding',
			[
				'label' => esc_html__( 'Padding', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-age-btn,
					{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn,
					{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'btn_one_margin',
			[
				'label' => esc_html__( 'Margin', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-age-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->start_controls_tabs( 'btn_one_tab' );

		$this->start_controls_tab(
			'btn_one_normal',
			[
				'label' => esc_html__( 'Normal', 'skt-addons-for-elementor' ),
			]
		);

		$this->add_control(
            'btn_one_color',
            [
                'label' => esc_html__('Text Color', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-age-btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

         $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_one_bg',
				'label' => esc_html__( 'Background Type', 'skt-addons-for-elementor' ),
			    'types' => [ 'classic', 'gradient' ],
			    'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-age-btn,
				{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn,
				{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_one_border',
				'label' => esc_html__( 'Border', 'skt-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-age-btn,
					{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn,
					{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn',
			]
		);

		$this->add_responsive_control(
			'btn_one_bradius',
			[
				'label'      => esc_html__( 'Border Radius', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-age-btn,
					{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn,
					{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_one_Shadow',
				'label' => esc_html__( 'Box Shadow', 'skt-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-age-btn,
					{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn,
					{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'btn_one_hover',
			[
				'label' => esc_html__( 'Hover', 'skt-addons-for-elementor' ),
			]
		);

		$this->add_control(
            'btn_one_color_hvr',
            [
                'label' => esc_html__('Text Color', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-age-btn,
					{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn,
					{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn'=> 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_one_bg_hvr',
				'label' => esc_html__( 'Background Type', 'skt-addons-for-elementor' ),
			    'types' => [ 'classic', 'gradient' ],
			    'selector' => '{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-age-btn,
				{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn,
				{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_one_hvr_border',
				'label' => esc_html__( 'Border', 'skt-addons-for-elementor' ),
				'selector' =>  '{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-age-btn,
					{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn,
					{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn',
			]
		);

		$this->add_responsive_control(
			'btn_one_hvr_border_bradius',
			[
				'label'      => esc_html__( 'Border Radius', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					 '{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-age-btn,
					{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn,
					{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_one_hvr_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'skt-addons-for-elementor' ),
				'selector' =>  '{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-age-btn,
					{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn,
					{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn',

			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'btn_one_icon_heading',
			[
				'label' => esc_html__( 'Icon', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
                'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

        $this->add_responsive_control(
            'btn_one_icon_size',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Size', 'skt-addons-for-elementor'),
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 200,
						'step' => 1,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-confirm-age .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-age-btn i,{{WRAPPER}} .skt-age-gate-confirm-dob .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn i,{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .skt-age-gate-confirm-age .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-age-btn svg,{{WRAPPER}} .skt-age-gate-confirm-dob .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn svg,{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				],
                'condition' => [
					'button_icon[value]!' => '',
				],
            ]
        );

		$this->add_responsive_control(
            'btn_one_icon_space',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Offset', 'skt-addons-for-elementor'),
				'size_units' => [ 'px','%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-confirm-age .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-age-btn i,{{WRAPPER}} .skt-age-gate-confirm-dob .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn i,{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn i,{{WRAPPER}} .skt-age-gate-confirm-age .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-age-btn svg,{{WRAPPER}} .skt-age-gate-confirm-dob .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn svg,{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn svg' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
				'condition'    => [
				 	'icon_position' => [ 'after' ],
					'button_icon[value]!' => '',
				],
            ]
        );

		$this->add_responsive_control(
            'btn_one_icon_space_left',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Offset', 'skt-addons-for-elementor'),
				'size_units' => [ 'px','%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-confirm-age .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-age-btn i,{{WRAPPER}} .skt-age-gate-confirm-dob .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn i,{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn i,{{WRAPPER}} .skt-age-gate-confirm-age .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-age-btn svg,{{WRAPPER}} .skt-age-gate-confirm-dob .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn svg,{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn svg' => 'margin-right: {{SIZE}}{{UNIT}}',
				],
				'condition'    => [
				 	'icon_position' => [ 'before' ],
					'button_icon[value]!' => '',
				],
            ]
        );

        $this->add_responsive_control(
			'btn_one_icon_margin',
			[
				'label' => esc_html__( 'Margin', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-confirm-age .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-age-btn i,{{WRAPPER}} .skt-age-gate-confirm-dob .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn i,{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn i,{{WRAPPER}} .skt-age-gate-confirm-age .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-age-btn svg,{{WRAPPER}} .skt-age-gate-confirm-dob .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn svg,{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
                'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

        $this->start_controls_tabs(
			'btn_one_icon_tabs',
			[
                'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->start_controls_tab(
			'btn_one_icon_color_normal',
			[
				'label' => esc_html__( 'Normal', 'skt-addons-for-elementor' ),
                'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'btn_one_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-confirm-age .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-age-btn i,{{WRAPPER}} .skt-age-gate-confirm-dob .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn i,{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .skt-age-gate-confirm-age .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-age-btn svg,{{WRAPPER}} .skt-age-gate-confirm-dob .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn svg,{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn svg' => 'fill: {{VALUE}};',
				],
                'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'btn_one_icon_hover',
			[
				'label' => esc_html__( 'Hover', 'skt-addons-for-elementor' ),
                'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'btn_one_icon_hvr_color',
			[
				'label' => esc_html__( 'Icon Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-confirm-age .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-age-btn i,{{WRAPPER}} .skt-age-gate-confirm-dob .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn i,{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .skt-age-gate-confirm-age .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-age-btn svg,{{WRAPPER}} .skt-age-gate-confirm-dob .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-dob-btn svg,{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-yes-btn svg' => 'fill: {{VALUE}};',
					'condition' => [
						'button_icon[value]!' => '',
					],
				],
			]
		);

		$this->end_controls_tab();
	    $this->end_controls_tabs();

        $this->end_controls_section();
	}

	protected function __button_two_style_controls() {

		$this->start_controls_section(
            'btn_two_style_section',
            [
                'label' => esc_html__('Button Two', 'skt-addons-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
					'age_gate_style' => 'confirm-by-boolean',
				],
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_two_typo',
				'label' => esc_html__( 'Typography', 'skt-addons-for-elementor' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY
				],
				'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-no-btn',
			]
		);

		$this->add_responsive_control(
			'btn_two_padding',
			[
				'label' => esc_html__( 'Padding', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-no-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_two_margin',
			[
				'label' => esc_html__( 'Margin', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-no-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->start_controls_tabs( 'btn_two_tabs' );

		$this->start_controls_tab(
			'btn_two_normal',
			[
				'label' => esc_html__( 'Normal', 'skt-addons-for-elementor' ),
			]
		);

		$this->add_control(
            'btn_two_color',
            [
                'label' => esc_html__('Text Color', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-no-btn' => 'color:{{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_two_bg',
				'label' => esc_html__( 'Background Type', 'skt-addons-for-elementor' ),
			    'types' => [ 'classic', 'gradient' ],
			    'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-no-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_two_border',
				'label' => esc_html__( 'Border', 'skt-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-no-btn',
			]
		);

		$this->add_responsive_control(
			'btn_two_border_bradius',
			[
				'label'      => esc_html__( 'Border Radius', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-no-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_two_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'skt-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-no-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'btn_two_hvr',
			[
				'label' => esc_html__( 'Hover', 'skt-addons-for-elementor' ),
			]
		);

		$this->add_control(
            'btn_two_hvr_color',
            [
                'label' => esc_html__('Text Color', 'skt-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-no-btn' => 'color:{{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_two_hvr_bg',
				'label' => esc_html__( 'Background Type', 'skt-addons-for-elementor' ),
			    'types' => [ 'classic', 'gradient' ],
			    'selector' => '{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-no-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_two_hvr_border',
				'label' => esc_html__( 'Border', 'skt-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-no-btn',
			]
		);

		$this->add_responsive_control(
			'btn_two_hvr_border_bradius',
			[
				'label'      => esc_html__( 'Border Radius', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-no-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_two_hvr_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'skt-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-no-btn',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'btn_two_icon_heading',
			[
				'label' => esc_html__( 'Icon', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
                'condition' => [
					'age_gate_style' => 'confirm-by-boolean',
					'second_button_icon[value]!' => '',
				],
			]
		);

        $this->add_responsive_control(
            'btn_two_icon_size',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Size', 'skt-addons-for-elementor'),
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 200,
						'step' => 1,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-no-btn i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-no-btn svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				],
                'condition' => [
					'age_gate_style' => 'confirm-by-boolean',
					'second_button_icon[value]!' => '',
				],
            ]
        );

		$this->add_responsive_control(
            'btn_two_icon_space',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Offset', 'skt-addons-for-elementor'),
				'size_units' => [ 'px','%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-no-btn i,{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-no-btn svg' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
				'condition'    => [
				 	'btn_two_icon_position' => [ 'age_scnd_icon_postfix' ],
					 'age_gate_style' => 'confirm-by-boolean',
					 'second_button_icon[value]!' => '',
				 ],
            ]
        );

		$this->add_responsive_control(
            'btn_two_icon_space_left',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Offset', 'skt-addons-for-elementor'),
				'size_units' => [ 'px','%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-no-btn i,{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-no-btn svg' => 'margin-right: {{SIZE}}{{UNIT}}',
				],
				 'condition'    => [
				 	'btn_two_icon_position' => [ 'age_scnd_icon_prefix' ],
					'age_gate_style' => 'confirm-by-boolean',
					'second_button_icon[value]!' => '',
				],
            ]
        );

        $this->add_responsive_control(
			'btn_two_icon_margin',
			[
				'label' => esc_html__( 'Margin', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-no-btn i,{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-no-btn svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
                'condition' => [
					'age_gate_style' => 'confirm-by-boolean',
					'second_button_icon[value]!' => '',
				],
			]
		);

        $this->start_controls_tabs(
			'btn_two_icon_tabs',
			[
				'condition' => [
					'age_gate_style' => 'confirm-by-boolean',
					'second_button_icon[value]!' => '',
				],
			]
		);

		$this->start_controls_tab(
			'btn_two_icon_color_normal',
			[
				'label' => esc_html__( 'Normal', 'skt-addons-for-elementor' ),
                'condition' => [
					'age_gate_style' => 'confirm-by-boolean',
					'second_button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'btn_two_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-no-btn i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes .skt-age-gate-form-body .skt-age-gate-confirm-no-btn svg' => 'fill: {{VALUE}};',
				],
                'condition' => [
					'age_gate_style' => 'confirm-by-boolean',
					'second_button_icon[value]!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'btn_two_icon_hvr_tab',
			[
				'label' => esc_html__( 'Hover', 'skt-addons-for-elementor' ),
                'condition' => [
					'age_gate_style' => 'confirm-by-boolean',
					'second_button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'btn_two_icon_hvr_color',
			[
				'label' => esc_html__( 'Icon Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-no-btn i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .skt-age-gate-confirm-by-boolean .skt-age-gate-boxes:hover .skt-age-gate-form-body .skt-age-gate-confirm-no-btn svg' => 'fill: {{VALUE}};',
				],
                'condition' => [
					'age_gate_style' => 'confirm-by-boolean',
					'second_button_icon[value]!' => '',
				],
			]
		);

		$this->end_controls_tab();
	    $this->end_controls_tabs();

        $this->end_controls_section();
	}

	protected function __footer_style_controls() {

		$this->start_controls_section(
            'footer_style_section',
            [
                'label' => esc_html__('Footer', 'skt-addons-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                	'footer_text!' => '',
				],
            ]
        );

		$this->add_control(
			'footer_text_color',
			[
				'label' => esc_html__( 'Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-footer-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'footer_text_typo',
				'label' => esc_html__( 'Typography', 'skt-addons-for-elementor' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT
				],
				'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-footer-text',
			]
		);

		$this->add_responsive_control(
			'footer_padding',
			[
				'label' => esc_html__( 'Padding', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-footer-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'footer_margin',
			[
				'label' => esc_html__( 'Margin', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-footer-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

        $this->end_controls_section();
	}

	protected function __warning_msg_style_controls() {

		$this->start_controls_section(
            'warning_msg_style_section',
            [
                'label' => esc_html__('Warning Message', 'skt-addons-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'age_gate_style' => ['confirm-dob','confirm-by-boolean'],
				],
            ]
        );

		$this->add_responsive_control(
			'warning_msg_padding',
			[
				'label'      => esc_html__( 'Padding', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-warning-msg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'warning_msg_margin',
			[
				'label' => esc_html__( 'Margin', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-warning-msg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'warning_msg_typo',
				'label' => esc_html__( 'Typography', 'skt-addons-for-elementor' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY
				],
				'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-warning-msg',
			]
		);

		$this->add_control(
			'warning_msg_color',
			[
				'label' => esc_html__( 'Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-warning-msg' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'warning_msg_bg',
				'label' => esc_html__( 'Background Type', 'skt-addons-for-elementor' ),
			    'types' => [ 'classic', 'gradient' ],
			    'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-warning-msg',
			]
		);

		 $this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'warning_msg_border',
					'label' => esc_html__( 'Border', 'skt-addons-for-elementor' ),
					'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-warning-msg',
				]
	    );

		$this->add_responsive_control(
			'warning_msg_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-warning-msg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'warning_msg_shadow',
				'label' => esc_html__( 'Box Shadow', 'skt-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .skt-age-gate-boxes .skt-age-gate-warning-msg',
			]
		);

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$right_img_class='';

		$this->add_render_attribute(
			'wrapper',
			'class',
			[
				'skt-age-gate-wrapper',
				'skt-age-gate-'.$settings['age_gate_style'],
			]
		);

		if( $settings['age_gate_cookies_time'] != '0' ) {
			$this->add_render_attribute( 'wrapper', 'data-age_gate_cookies_time', $settings['age_gate_cookies_time']);
		}

		if( $settings["editor_mood"] != 'yes' ) {
			$this->add_render_attribute( 'wrapper', 'data-editor_mood', 'no' );
		}

		if(!empty($settings['age_gate_style']) && $settings['age_gate_style']=='confirm-dob'){
			$birthyears = !empty($settings['dob_limit']) ? $settings['dob_limit'] : '18';
			$this->add_render_attribute( 'wrapper', 'data-userbirth', $birthyears);
		}

		$right_img_class = !empty($settings['side_img']['url']) ? 'skt-age-gate-equ-width-50' : '';
		$this->add_render_attribute( 'box', 'class', ['skt-age-gate-boxes',$right_img_class]);

		if((\Elementor\Plugin::$instance->editor->is_edit_mode()) && $settings["editor_mood"] != 'yes') {
			printf(
				"<p>%s</p>",
				esc_html__( 'Age Gate:- This is just a placeholder & will not be shown on the live page.', 'skt-addons-for-elementor' )
			);
			return;
		}
		?>

		<div <?php echo wp_kses_post($this->get_render_attribute_string( 'wrapper' )); ?>>
			<div class="skt-age-gate-inner-wrapper">

				<div <?php echo wp_kses_post($this->get_render_attribute_string( 'box' )); ?>>

					<div class="skt-age-gate-header">
						<?php if(!empty($settings['warning_message'])): ?>
							<div class="skt-age-gate-warning-msg"><?php echo wp_kses_post($settings['warning_message']) ?></div>
						<?php endif; ?>

						<?php if( !empty($settings['header_img']['url']) ): ?>
							<?php if( !empty($settings['header_img']['id']) ): ?>
								<?php $image_url = wp_get_attachment_image_url( $settings['header_img']['id'], 'full' ); ?>
								<div class="skt-age-gate-image"><img src="<?php echo esc_url($image_url); ?>"></div>
							<?php else: ?>
								<div class="skt-age-gate-image"><img src="<?php echo esc_url($settings['header_img']['url']); ?>"></div>
							<?php endif; ?>
						<?php endif; ?>

						<?php if( !empty($settings['title']) ): ?>
							<div class="skt-age-gate-title"><?php echo esc_html($settings['title']); ?></div>
						<?php endif; ?>

						<?php if( !empty($settings['desc']) ): ?>
							<div class="skt-age-gate-description"><?php $this->print_unescaped_setting( 'desc' ); ?></div>
						<?php endif; ?>
					</div>

					<div class="skt-age-gate-form-body">
						<?php if( !empty($settings['age_gate_style']) ): ?>

							<?php if($settings['age_gate_style']=='confirm-age'): ?>
								<button type="submit" class="skt-age-gate-confirm-age-btn skt-age-gate-btn-ex">
									<?php
										if ( $settings['icon_position'] == 'before' && !empty($settings['button_icon']['value']) ) {
											Icons_Manager::render_icon( $settings["button_icon"], [ 'aria-hidden' => 'true' ]);
										}
										echo esc_html($settings['button_text']);
										if ( $settings['icon_position'] == 'after' && !empty($settings['button_icon']['value']) ) {
											Icons_Manager::render_icon( $settings["button_icon"], [ 'aria-hidden' => 'true' ]);
										}
									?>
								</button>
							<?php endif; ?>

							<?php if($settings['age_gate_style']=='confirm-dob'): ?>
								<input type="date" class="skt-age-gate-date-input" name="skt-age-gate-birth" value="<?php echo wp_kses_post(gmdate('Y-m-d'));?>" min="1900-01-01" max="2100-01-01">
								<button type="submit" class="skt-age-gate-confirm-dob-btn skt-age-gate-btn-ex">
									<?php
										if ( $settings['icon_position'] == 'before' && !empty($settings['button_icon']['value']) ) {
											Icons_Manager::render_icon( $settings["button_icon"], [ 'aria-hidden' => 'true' ]);
										}
										echo esc_html($settings['button_text']);
										if ( $settings['icon_position'] == 'after' && !empty($settings['button_icon']['value']) ) {
											Icons_Manager::render_icon( $settings["button_icon"], [ 'aria-hidden' => 'true' ]);
										}
									?>
								</button>
							<?php endif; ?>

							<?php if($settings['age_gate_style']=='confirm-by-boolean'): ?>
								<button type="submit" class="skt-age-gate-confirm-yes-btn skt-age-gate-btn-ex" name="skt-age-gate-confirm-yes-btn">
									<?php
										if ( $settings['icon_position'] == 'before' && !empty($settings['button_icon']['value']) ) {
											Icons_Manager::render_icon( $settings["button_icon"], [ 'aria-hidden' => 'true' ]);
										}
										echo esc_html($settings['button_text']);
										if ( $settings['icon_position'] == 'after' && !empty($settings['button_icon']['value']) ) {
											Icons_Manager::render_icon( $settings["button_icon"], [ 'aria-hidden' => 'true' ]);
										}
									?>
								</button>
								<button type="submit" class="skt-age-gate-confirm-no-btn skt-age-gate-btn-ex" name="skt-age-gate-confirm-no-btn">
									<?php
										if ( $settings['btn_two_icon_position'] == 'second-icon-before' && !empty($settings['btn_two_icon']['value']) ) {
											Icons_Manager::render_icon( $settings["second_button_icon"], [ 'aria-hidden' => 'true' ]);
										}
										echo esc_html($settings['btn_two_text']);
										if ( $settings['btn_two_icon_position'] == 'second-icon-after' && !empty($settings['btn_two_icon']['value']) ) {
											Icons_Manager::render_icon( $settings["second_button_icon"], [ 'aria-hidden' => 'true' ]);
										}
									?>
								</button>
							<?php endif; ?>

						<?php endif; ?>
					</div>

					<?php if( !empty($settings['footer_text']) ): ?>
						<div class="skt-age-gate-footer-text"><p><?php $this->print_unescaped_setting( 'footer_text' ); ?></p></div>
					<?php endif; ?>
				</div>

				<?php if( !empty($settings['side_img']['url']) ): ?>
					<div class="skt-age-gate-boxes skt-age-gate-side-image <?php echo esc_attr($right_img_class); ?>" style="background-image:url(<?php echo esc_url($settings['side_img']['url']); ?>);background-size:cover;   background-attachment:inherit;"></div>
				<?php endif; ?>

			</div>
		</div>

		<?php
	}

}