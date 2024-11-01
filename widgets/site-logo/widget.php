<?php

/**
 * Site_Logo widget class
 *
 * @package Skt_Addons
 */

namespace Skt_Addons_Elementor\Elementor\Widget;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

defined('ABSPATH') || die();

class Site_Logo extends Base {

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __('Site Logo', 'skt-addons-for-elementor');
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
		return 'skti skti-tb-site-logo';
	}

	public function get_keywords() {
		return ['logo', ' image'];
	}

	/**
	 * Register widget content controls
	 */
	protected function register_content_controls() {

		$this->start_controls_section(
			'_section_site_logo',
			[
				'label' => __('Logo', 'skt-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		// $this->add_group_control(
		// 	Group_Control_Image_Size::get_type(),
		// 	[
		// 		'name' => 'post_feature_image',
		// 		'default' => 'full',
		// 		'separator' => 'none',
		// 	]
		// );

		$this->add_control(
			'logo_type',
			[
				'label' => __('Logo', 'skt-addons-for-elementor'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'default' => [
						'title' => __('Default', 'skt-addons-for-elementor'),
						'icon' => 'eicon-site-logo',
					],
					'custom' => [
						'title' => __('Custom', 'skt-addons-for-elementor'),
						'icon' => 'eicon-image-rollover',
					]

				],
				'default' => 'default',
				'toggle' => true,
			]
		);

		$this->add_control(
			'sitelogo_image',
			[
				'label' => __('Site Logo', 'skt-addons-for-elementor'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'logo_type' => 'custom',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'logosize',
				'default' => 'large',
				'separator' => 'none',
				'condition' => [
					'logo_type' => 'custom',
				],
			]
		);


		$this->add_responsive_control(
			'align',
			[
				'label' => __('Alignment', 'skt-addons-for-elementor'),
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
					'justify' => [
						'title' => __('Justify', 'skt-addons-for-elementor'),
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
		$this->__site_logo_style_controls();
	}


	protected function __site_logo_style_controls() {

		$this->start_controls_section(
			'_section_style_thumbnail',
			[
				'label' => __('Logo style', 'skt-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'logo_width',
			[
				'label' => esc_html__('Size', 'skt-addons-for-elementor'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'vw'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'vw' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'logo_border',
				'label' => __('Border', 'skt-addons-for-elementor'),
				'selector' => '{{WRAPPER}}',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'logo_border_radius',
			[
				'label' => __('Border Radius', 'skt-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'logo_padding',
			[
				'label' => __('Padding', 'skt-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'logo_margin',
			[
				'label' => __('Margin', 'skt-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ($settings['logo_type'] == 'default') {
			if (has_custom_logo()) {
				the_custom_logo();
			}
		} else {
			// Resolved escaping issue
			echo '<a href="' . esc_url(home_url('/')) . '">' . wp_kses_post(Group_Control_Image_Size::get_attachment_image_html($settings, 'logosize', 'sitelogo_image')) . '</a>';
		}
	}
}
