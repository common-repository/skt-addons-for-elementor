<?php
namespace Skt_Addons_Elementor\Elementor\Extension;

use Elementor\Controls_Manager;
use Elementor\Element_Base;

defined('ABSPATH') || die();

class Wrapper_Link {

	public static function init() {
		add_action( 'elementor/element/column/section_advanced/after_section_end', [ __CLASS__, 'add_controls_section' ], 1 );
		add_action( 'elementor/element/section/section_advanced/after_section_end', [ __CLASS__, 'add_controls_section' ], 1 );
		add_action( 'elementor/element/common/_section_style/after_section_end', [ __CLASS__, 'add_controls_section' ], 1 );

		add_action( 'elementor/frontend/before_render', [ __CLASS__, 'before_section_render' ], 1 );
	}

	public static function add_controls_section( Element_Base $element) {
		$tabs = Controls_Manager::TAB_CONTENT;

		if ( 'section' === $element->get_name() || 'column' === $element->get_name() ) {
			$tabs = Controls_Manager::TAB_LAYOUT;
		}

		$element->start_controls_section(
			'_section_skt_addons_elementor_wrapper_link',
			[
				'label' => __( 'Wrapper Link', 'skt-addons-for-elementor' ) . skt_addons_elementor_get_section_icon(),
				'tab'   => $tabs,
			]
		);

		$element->add_control(
			'skt_addons_elementor_element_link',
			[
				'label'       => __( 'Link', 'skt-addons-for-elementor' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => 'https://example.com',
			]
		);

		$element->end_controls_section();
	}

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
		'link',
	];

	public static function validate_html_tag( $tag ) {
		return $tag && in_array( strtolower( $tag ), self::ALLOWED_HTML_WRAPPER_TAGS ) ? $tag : 'div';
    }

	public static function before_section_render( Element_Base $element ) {
		$link_settings = $element->get_settings_for_display( 'skt_addons_elementor_element_link' );
		if ( $link_settings && ! empty( $link_settings['url'] ) ) {
			$sanitized_data = array(
			    'url' => esc_url($link_settings['url']),
			    'is_external' => $link_settings['is_external'],
			    'nofollow' => $link_settings['nofollow'],
			    'custom_attributes' => $link_settings['custom_attributes']
			);
			$json_output = wp_json_encode($sanitized_data);
			$element->add_render_attribute(
				'_wrapper',
				[
					'data-skt-element-link' => $json_output,
					'style' => 'cursor: pointer'
				]
			);
		}
	}
}

Wrapper_Link::init();