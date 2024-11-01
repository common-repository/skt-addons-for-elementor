<?php
/**
 * Page_Title widget class
 *
 * @package Skt_Addons
 */
namespace Skt_Addons_Elementor\Elementor\Widget;

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

defined( 'ABSPATH' ) || die();

class Page_Title extends Base {
	const ALLOWED_HTML_WRAPPER_TAGS = [
		'a',
		'article',
		'aside',
		'button',
		'div',
		'footer',
		'h1',
		'h2',
		'h3',
		'h4',
		'h5',
		'h6',
		'header',
		'main',
		'nav',
		'p',
		'section',
		'span',
	];

	public static function validate_html_tag( $tag ) { 		return $tag && in_array( strtolower( $tag ), self::ALLOWED_HTML_WRAPPER_TAGS ) ? $tag : 'div';
    }

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Page Title', 'skt-addons-for-elementor' );
	}

	public function get_custom_help_url() {
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
		return 'skti skti-tb-page-title';
	}

	public function get_keywords() {
		return [ 'page title', 'Title', 'text' ];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {
		$this->__page_title_content_control();

	}
	protected function __page_title_content_control() {
		$this->start_controls_section(
			'_section_page_tile',
			[
				'label' => __( 'Page Title', 'skt-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'page_title_tag',
			[
				'label' => esc_html__( 'Title HTML Tag', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'h1'  => [
						'title' => esc_html__( 'H1', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-editor-h1'
					],
					'h2'  => [
						'title' => esc_html__( 'H2', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-editor-h2'
					],
					'h3'  => [
						'title' => esc_html__( 'H3', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-editor-h3'
					],
					'h4'  => [
						'title' => esc_html__( 'H4', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-editor-h4'
					],
					'h5'  => [
						'title' => esc_html__( 'H5', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-editor-h5'
					],
					'h6'  => [
						'title' => esc_html__( 'H6', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-editor-h6'
					]
				],
				'default' => 'h2',
				'toggle' => false,
			]
		);
        $this->add_control(
			'size',
			[
				'label' => esc_html__( 'Size', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'skt-addons-for-elementor' ),
					'small' => esc_html__( 'Small', 'skt-addons-for-elementor' ),
					'medium' => esc_html__( 'Medium', 'skt-addons-for-elementor' ),
					'large' => esc_html__( 'Large', 'skt-addons-for-elementor' ),
					'xl' => esc_html__( 'XL', 'skt-addons-for-elementor' ),
					'xxl' => esc_html__( 'XXL', 'skt-addons-for-elementor' ),
				],
			]
		);

        $this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justify', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};'
				]
			]
		);

        $this->end_controls_section();
	}

	/**
	 * Register styles related controls
	 */
	protected function register_style_controls() {
		$this->__page_title_style_controls();
	}


	protected function __page_title_style_controls() {

        $this->start_controls_section(
            '_section_style_page',
            [
                'label' => __( 'Title', 'skt-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'page_title_color',
			[
				'label' => esc_html__( 'Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-page-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'page_title_typography',
				'label' => __( 'Typography', 'skt-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .skt-page-title',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'page_text_shadow',
				'selector' => '{{WRAPPER}} .skt-page-title',
			]
		);
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$html_content =  esc_html($settings['page_title_tag']);
		$this->add_render_attribute('title', 'class', 'skt-page-title');

        if ( ! empty( $settings['size'] ) ) {
            $this->add_render_attribute('title', 'class', 'elementor-size-' . $settings['size']);
        }
        // Resolved escaping issue
        printf('<%1$s %2$s>%3$s</%1$s>', esc_attr(Page_Title::validate_html_tag($html_content)), wp_kses_post($this->get_render_attribute_string('title')), esc_attr(get_the_title()) );
	}
}

