<?php
/**
 * Single Product widget class
 *
 * @package Skt_Addons
 */

namespace Skt_Addons_Elementor\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Skt_Addons_Elementor\Elementor\Controls\Lazy_Select;
use Skt_Addons_Elementor\Lazy_Query_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;

defined( 'ABSPATH' ) || die();

class Edd_Single_Product extends Base {

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'EDD Single Product', 'skt-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'skti skti-post-grid';
	}

	public function get_keywords() {
		return ['edd', 'single-product', 'single', 'product', 'woocommerce', 'single-shop', 'shop', 'skt-skin'];
	}


	/**
	 * Register content related controls
	 */
	protected function register_content_controls() {

		$this->start_controls_section(
			'_section_single_product',
			[
				'label' => __( 'Single Product', 'skt-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'skin',
			[
				'label'   => __( 'Skin', 'skt-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'classic'   => __( 'Classic', 'skt-addons-for-elementor' ),
					'standard'  => __( 'Standard', 'skt-addons-for-elementor' ),
					'landscape' => __( 'Landscape', 'skt-addons-for-elementor' ),
				],
				'default' => 'classic',
			]
		);

		$this->add_control(
			'posts_post_type',
			[
				'label'   => __( 'Hidden Style', 'skt-addons-for-elementor' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'download',
			]
		);

		$this->add_control(
			'posts_selected_ids',
			[
				'label'       => __( 'Search & Select Product', 'skt-addons-for-elementor' ),
				'type'        => Lazy_Select::TYPE,
				'multiple'    => false,
				'placeholder' => 'Type & Search Product',
				'mininput'    => 0,
				'label_block' => true,
				'lazy_args'   => [
					'query'        => Lazy_Query_Manager::QUERY_POSTS,
					'widget_props' => [
						'post_type' => 'posts_post_type',
					],
				],
			]
		);

		$this->end_controls_section();

		//Featured Image Control
		$this->featured_image_content_controls();

		//Settings Control
		$this->settings_content_controls();

	}


	/**
	 * Featured Image Control
	 */
	protected function featured_image_content_controls() {

		$this->start_controls_section(
			'_section_feature_image',
			[
				'label' => __( 'Featured Image', 'skt-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'normal_image',
			[
				'label'                            => __( 'Normal Image', 'skt-addons-for-elementor' ),
				'show_label'                       => true,
				'type'                             => Controls_Manager::MEDIA,
				'media_type'                       => 'image',
				'should_include_svg_inline_option' => false,
			]
		);

		$this->add_control(
			'hover_image',
			[
				'label'                            => __( 'Hover Image', 'skt-addons-for-elementor' ),
				'show_label'                       => true,
				'type'                             => Controls_Manager::MEDIA,
				'media_type'                       => 'image',
				'should_include_svg_inline_option' => false,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'           => 'thumbnail',
				'default'        => 'thumbnail',
				'style_transfer' => true,
			]
		);

		//this control only for landscape
		$this->add_control(
			'landscape_image_position',
			[
				'label'          => __( 'Image Position', 'skt-addons-for-elementor' ),
				'type'           => Controls_Manager::CHOOSE,
				'label_block'    => false,
				'options'        => [
					'left'  => [
						'title' => __( 'Left', 'skt-addons-for-elementor' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'skt-addons-for-elementor' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'toggle'         => false,
				'default'        => 'left',
				'prefix_class'   => 'skt-edd-single-product__img_pos-',
				'style_transfer' => true,
				'condition'      => [
					'skin' => 'landscape',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Settings content Control
	 */
	protected function settings_content_controls() {

		$this->start_controls_section(
			'_section_settings',
			[
				'label' => __( 'Settings', 'skt-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'badge_text',
			[
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'label'       => __( 'Badge Text', 'skt-addons-for-elementor' ),
				'placeholder' => __( 'Your badge one text', 'skt-addons-for-elementor' ),
				'description' => __( 'Leave it blank to hide badge text.', 'skt-addons-for-elementor' ),
				'default'     => __( 'cyber deal', 'skt-addons-for-elementor' ),
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'discount_text',
			[
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'label'       => __( 'Discount Text', 'skt-addons-for-elementor' ),
				'placeholder' => __( 'Your discount text', 'skt-addons-for-elementor' ),
				'description' => __( 'Leave it blank to hide discount text.', 'skt-addons-for-elementor' ),
				'default'     => __( '50% off', 'skt-addons-for-elementor' ),
				'dynamic'     => [
					'active' => true,
				],
				'condition'   => [
					'skin' => 'classic',
				],
			]
		);

		// $this->add_control(
		// 	'show_rating',
		// 	[
		// 		'type' => Controls_Manager::SWITCHER,
		// 		'label' => __( 'Show Rating', 'skt-addons-for-elementor' ),
		// 		'default' => 'yes',
		// 		'return_value' => 'yes',
		// 		'style_transfer' => true,
		// 	]
		// );

		$this->add_control(
			'show_cat',
			[
				'type'           => Controls_Manager::SWITCHER,
				'label'          => __( 'Show Category', 'skt-addons-for-elementor' ),
				'default'        => 'yes',
				'return_value'   => 'yes',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'show_price',
			[
				'type'           => Controls_Manager::SWITCHER,
				'label'          => __( 'Show Price', 'skt-addons-for-elementor' ),
				'default'        => 'yes',
				'return_value'   => 'yes',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'show_cart_button',
			[
				'type'           => Controls_Manager::SWITCHER,
				'label'          => __( 'Show Cart Button', 'skt-addons-for-elementor' ),
				'default'        => 'yes',
				'return_value'   => 'yes',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'add_to_cart_text',
			[
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'label'       => __( 'Add To Cart Text', 'skt-addons-for-elementor' ),
				'placeholder' => __( 'Your add to cart text', 'skt-addons-for-elementor' ),
				'default'     => 'Add to Cart',
				'dynamic'     => [
					'active' => true,
				],
				'condition'   => [
					'show_cart_button' => 'yes',
					'skin!'            => 'standard',
				],
			]
		);

		$this->add_control(
			'show_quick_view_button',
			[
				'type'           => Controls_Manager::SWITCHER,
				'label'          => __( 'Show Quick View Button', 'skt-addons-for-elementor' ),
				'default'        => 'yes',
				'return_value'   => 'yes',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'type'        => Controls_Manager::NUMBER,
				'label'       => __( 'Excerpt Length', 'skt-addons-for-elementor' ),
				'description' => __( 'Leave it blank to hide excerpt.', 'skt-addons-for-elementor' ),
				'min'         => 0,
				'default'     => 15,
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => __( 'Title HTML Tag', 'skt-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
				'default' => 'h2',
			]
		);

		//this control for landscape
		$this->add_control(
			'content_align',
			[
				'label'                => __( 'Content Alignment', 'skt-addons-for-elementor' ),
				'type'                 => Controls_Manager::CHOOSE,
				'options'              => [
					'top'    => [
						'title' => __( 'Top', 'skt-addons-for-elementor' ),
						'icon'  => 'eicon-v-align-top',
					],
					'center' => [
						'title' => __( 'Center', 'skt-addons-for-elementor' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'skt-addons-for-elementor' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'default'              => 'top',
				'toggle'               => false,
				'style_transfer'       => true,
				'selectors_dictionary' => [
					'top'    => '-webkit-box-pack: start; -ms-flex-pack: start; justify-content: flex-start;',
					'center' => '-webkit-box-pack: center; -ms-flex-pack: center; justify-content: center;',
					'bottom' => '-webkit-box-pack: end; -ms-flex-pack: end; justify-content: flex-end;',
				],
				'selectors'            => [
					'{{WRAPPER}} .skt-edd-single-product__content' => '{{VALUE}}',
				],
				'condition'            => [
					'skin' => 'landscape',
				],
			]
		);

		$this->end_controls_section();
	}


	/**
	 * Register Style controls
	 */
	public function register_style_controls() {

		$this->box_style_tab_controls();

		$this->badge_discount_style_controls_section();

		$this->image_style_controls_section();

		$this->content_style_controls_section();

		$this->cart_and_qv_button_style_controls_section();

		$this->qv_modal_style_controls();
	}

	/**
	 * Item Box Style controls
	 */
	protected function box_style_tab_controls() {

		$this->start_controls_section(
			'_section_item_box_style',
			[
				'label' => __( 'Item Box', 'skt-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label'      => __( 'Padding', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__item ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'item_border',
				'selector' => '{{WRAPPER}} .skt-edd-single-product__item ',
			]
		);

		$this->add_responsive_control(
			'item_border_radius',
			[
				'label'      => __( 'Border Radius', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__item ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .skt-edd-single-product__item ',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'item_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .skt-edd-single-product__item ',
			]
		);

		$this->end_controls_section();
	}

	protected function badge_discount_style_controls_section() {

		$this->start_controls_section(
			'_section_style_badge',
			[
				'label'      => __( 'Badge', 'skt-addons-for-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'badge_text',
									'operator' => '!=',
									'value'    => '',
								],
								[
									'name'     => 'discount_text',
									'operator' => '!=',
									'value'    => '',
								],
							],
						],
						[
							'terms' => [
								[
									'name'     => 'skin',
									'operator' => '!=',
									'value'    => '',
								],
							],
						],
					],
				],
			]
		);

		$this->badge__offset();

		// this control for classic
		$this->add_responsive_control(
			'badge_discount_spacing',
			[
				'label'      => __( 'Space Between', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__badge span:nth-of-type(2)' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'badge_text',
							'operator' => '!=',
							'value'    => '',
						],
						[
							'name'     => 'discount_text',
							'operator' => '!=',
							'value'    => '',
						],
						[
							'name'     => 'skin',
							'operator' => '===',
							'value'    => 'classic',
						],
					],
				],
			]
		);

		$this->badge_style_controls();

		$this->discount_style_controls();

		$this->end_controls_section();
	}

	protected function badge__offset() {

		$this->add_control(
			'badge_offset_toggle',
			[
				'label'        => __( 'Offset', 'skt-addons-for-elementor' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'badge_offset_x',
			[
				'label'      => __( 'Left', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition'  => [
					'badge_offset_toggle' => 'yes',
				],
				'range'      => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__badge' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'badge_offset_y',
			[
				'label'      => __( 'Top', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition'  => [
					'badge_offset_toggle' => 'yes',
				],
				'range'      => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__badge' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_popover();
	}

	protected function badge_style_controls() {

		$this->add_control(
			'_heading_badge_style',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Badge', 'skt-addons-for-elementor' ),
				'separator' => 'before',
				'condition' => [
					'badge_text!' => '',
					'skin!'       => 'standard',
				],
			]
		);

		$this->add_responsive_control(
			'badge_width',
			[
				'label'      => __( 'Width', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} span.skt-edd-single-product__badge-text' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'badge_text!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'badge_height',
			[
				'label'      => __( 'Height', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} span.skt-edd-single-product__badge-text' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'badge_text!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'badge_padding',
			[
				'label'      => __( 'Padding', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} span.skt-edd-single-product__badge-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'badge_text!' => '',
				],
			]
		);

		$this->add_control(
			'badge_color',
			[
				'label'     => __( 'Text Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} span.skt-edd-single-product__badge-text' => 'color: {{VALUE}};',
				],
				'condition' => [
					'badge_text!' => '',
				],
			]
		);

		$this->add_control(
			'badge_bg_color',
			[
				'label'     => __( 'Background Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} span.skt-edd-single-product__badge-text' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'badge_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'badge_border',
				'selector'  => '{{WRAPPER}} span.skt-edd-single-product__badge-text',
				'condition' => [
					'badge_text!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'badge_border_radius',
			[
				'label'      => __( 'Border Radius', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} span.skt-edd-single-product__badge-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'badge_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'badge_box_shadow',
				'selector'  => '{{WRAPPER}} span.skt-edd-single-product__badge-text',
				'condition' => [
					'badge_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'badge_typography',
				'label'     => __( 'Typography', 'skt-addons-for-elementor' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'default'   => [
					'font_size' => [''],
				],
				'selector'  => '{{WRAPPER}} span.skt-edd-single-product__badge-text',
				'condition' => [
					'badge_text!' => '',
				],
			]
		);
	}

	protected function discount_style_controls() {

		$this->add_control(
			'_heading_discount_style',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Discount', 'skt-addons-for-elementor' ),
				'separator' => 'before',
				'condition' => [
					'discount_text!' => '',
					'skin'           => 'classic',
				],
			]
		);

		$this->add_responsive_control(
			'discount_width',
			[
				'label'      => __( 'Width', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} span.skt-edd-single-product__discount-text' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'discount_text!' => '',
					'skin'           => 'classic',
				],
			]
		);

		$this->add_responsive_control(
			'discount_height',
			[
				'label'      => __( 'Height', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} span.skt-edd-single-product__discount-text' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'discount_text!' => '',
					'skin'           => 'classic',
				],
			]
		);

		$this->add_responsive_control(
			'discount_padding',
			[
				'label'      => __( 'Padding', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} span.skt-edd-single-product__discount-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'discount_text!' => '',
					'skin'           => 'classic',
				],
			]
		);

		$this->add_control(
			'discount_color',
			[
				'label'     => __( 'Text Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} span.skt-edd-single-product__discount-text' => 'color: {{VALUE}};',
				],
				'condition' => [
					'discount_text!' => '',
					'skin'           => 'classic',
				],
			]
		);

		$this->add_control(
			'discount_bg_color',
			[
				'label'     => __( 'Background Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} span.skt-edd-single-product__discount-text' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'discount_text!' => '',
					'skin'           => 'classic',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'discount_border',
				'selector'  => '{{WRAPPER}} span.skt-edd-single-product__discount-text',
				'condition' => [
					'discount_text!' => '',
					'skin'           => 'classic',
				],
			]
		);

		$this->add_responsive_control(
			'discount_border_radius',
			[
				'label'      => __( 'Border Radius', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} span.skt-edd-single-product__discount-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'discount_text!' => '',
					'skin'           => 'classic',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'discount_box_shadow',
				'selector'  => '{{WRAPPER}} span.skt-edd-single-product__discount-text',
				'condition' => [
					'discount_text!' => '',
					'skin'           => 'classic',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'discount_typography',
				'label'     => __( 'Typography', 'skt-addons-for-elementor' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'default'   => [
					'font_size' => [''],
				],
				'selector'  => '{{WRAPPER}} span.skt-edd-single-product__discount-text',
				'condition' => [
					'discount_text!' => '',
					'skin'           => 'classic',
				],
			]
		);
	}

	/**
	 * Image Style controls section tab
	 */
	protected function image_style_controls_section() {

		$this->start_controls_section(
			'_section_style_img',
			[
				'label' => __( 'Image', 'skt-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->image_style_controls();

		$this->end_controls_section();
	}

	protected function image_style_controls() {

		//this control for classic & standard
		$this->add_responsive_control(
			'img_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'skin!' => 'landscape',
				],
			]
		);

		$this->add_responsive_control(
			'img_width',
			[
				'label'      => __( 'Width', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [
						'min' => 50,
						'max' => 500,
					],
					'em' => [
						'min' => .5,
						'max' => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__img img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_height',
			[
				'label'      => __( 'Height', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [
						'min' => 50,
						'max' => 500,
					],
					'em' => [
						'min' => .5,
						'max' => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__img img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_padding',
			[
				'label'      => __( 'Padding', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__img img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'img_border',
				'selector' => '{{WRAPPER}} .skt-edd-single-product__img img',
			]
		);

		$this->add_responsive_control(
			'img_border_radius',
			[
				'label'      => __( 'Border Radius', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'img_box_shadow',
				'selector' => '{{WRAPPER}} .skt-edd-single-product__img img',
			]
		);

		$this->start_controls_tabs( '_tabs_img_effects' );

		$this->start_controls_tab(
			'_tab_img_effects_normal',
			[
				'label' => __( 'Normal', 'skt-addons-for-elementor' ),
			]
		);

		$this->add_responsive_control(
			'img_opacity',
			[
				'label'     => __( 'Opacity', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .skt-edd-single-product__img img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'img_css_filters',
				'selector' => '{{WRAPPER}} .skt-edd-single-product__img img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_img_effects_hover',
			[
				'label' => __( 'Hover', 'skt-addons-for-elementor' ),
			]
		);

		$this->add_responsive_control(
			'img_hover_opacity',
			[
				'label'     => __( 'Opacity', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .skt-edd-single-product__item :hover .skt-edd-single-product__img img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'img_hover_css_filters',
				'selector' => '{{WRAPPER}} .skt-edd-single-product__item :hover .skt-edd-single-product__img img',
			]
		);

		$this->add_control(
			'img_hover_transition',
			[
				'label'     => __( 'Transition Duration', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max'  => 3,
						'step' => 0.1,
					],
				],
				'default'   => [
					'size' => .2,
				],
				'selectors' => [
					'{{WRAPPER}} .skt-edd-single-product__img img' => 'transition-duration: {{SIZE}}s;',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
	}


	/**
	 * Content Style controls section tab
	 */
	protected function content_style_controls_section() {

		$this->start_controls_section(
			'_section_style_content',
			[
				'label' => __( 'Content', 'skt-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => __( 'Padding', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// $this->rating_style_controls();

		$this->cat_style_controls();

		$this->title_style_controls();

		$this->excerpt_style_controls();

		$this->price_style_controls();

		$this->end_controls_section();
	}

	/**
	 * Ratting Style controls
	 */
	protected function rating_style_controls() {

		$this->add_control(
			'_heading_rating_style',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Rating', 'skt-addons-for-elementor' ),
				'condition' => [
					'show_rating' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'rating_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__ratings' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'show_rating' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'rating_size',
			[
				'label'      => __( 'Size', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__ratings' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'show_rating' => 'yes',
				],
			]
		);

		$this->add_control(
			'rating_color',
			[
				'label'     => __( 'Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-edd-single-product__ratings .star-rating' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_rating' => 'yes',
				],
			]
		);
	}

	/**
	 * Category Style controls
	 */
	protected function cat_style_controls() {

		$this->add_control(
			'_heading_cat_style',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Category', 'skt-addons-for-elementor' ),
				'condition' => [
					'show_cat' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'cat_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'show_cat' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'cat_padding',
			[
				'label'      => __( 'Padding', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'show_cat' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'cat_border_test',
				'label'     => __( 'Border', 'skt-addons-for-elementor' ),
				'selector'  => '{{WRAPPER}} .skt-edd-single-product__category a',
				'condition' => [
					'show_cat' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'cat_border_radius',
			[
				'label'      => __( 'Border Radius', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'show_cat' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'cat_typography',
				'label'     => __( 'Typography', 'skt-addons-for-elementor' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
				'selector'  => '{{WRAPPER}} .skt-edd-single-product__category a',
				'condition' => [
					'show_cat' => 'yes',
				],
			]
		);

		$this->start_controls_tabs(
			'cat_tabs',
			[
				'condition' => [
					'show_cat' => 'yes',
				],
			]
		);
		$this->start_controls_tab(
			'cat_normal_tab',
			[
				'label' => __( 'Normal', 'skt-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'cat_color',
			[
				'label'     => __( 'Text Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-edd-single-product__category a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'cat_background',
				'label'    => __( 'Background', 'skt-addons-for-elementor' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .skt-edd-single-product__category a',
			]
		);

		$this->add_control(
			'cat_border_color',
			[
				'label'     => __( 'Border Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-edd-single-product__category a' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'cat_hover_tab',
			[
				'label' => __( 'Hover', 'skt-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'cat_hover_color',
			[
				'label'     => __( 'Text Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-edd-single-product__category a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'cat_hover_background',
				'label'    => __( 'Background', 'skt-addons-for-elementor' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .skt-edd-single-product__category a:hover',
			]
		);

		$this->add_control(
			'cat_hover_border_color',
			[
				'label'     => __( 'Border Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-edd-single-product__category a:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
	}

	/**
	 * Title Style controls
	 */
	protected function title_style_controls() {

		$this->add_control(
			'_heading_title_style',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Title', 'skt-addons-for-elementor' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'skt-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .skt-edd-single-product__title',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-edd-single-product__title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => __( 'HoverColor', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-edd-single-product__title:hover a' => 'color: {{VALUE}}',
				],
			]
		);
	}

	/**
	 * Excerpt Style controls
	 */
	protected function excerpt_style_controls() {

		$this->add_control(
			'_heading_excerpt_style',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Excerpt', 'skt-addons-for-elementor' ),
				'separator' => 'before',
				'condition' => [
					'excerpt_length!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'excerpt_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'excerpt_length!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label'     => __( 'Text Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-edd-single-product__desc' => 'color: {{VALUE}}',
				],
				'condition' => [
					'excerpt_length!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'excerpt_typography',
				'label'     => __( 'Typography', 'skt-addons-for-elementor' ),
				'selector'  => '{{WRAPPER}} .skt-edd-single-product__desc',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'condition' => [
					'excerpt_length!' => '',
				],
			]
		);

	}

	/**
	 * Price Style controls
	 */
	protected function price_style_controls() {

		$this->add_control(
			'_heading_price_style',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Price', 'skt-addons-for-elementor' ),
				'separator' => 'before',
				'condition' => [
					'show_price' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'price_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .skt-edd-single-product__price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'show_price' => 'yes',
				],
			]
		);

		$this->add_control(
			'price_color',
			[
				'label'     => __( 'Text Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-edd-single-product__price' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_price' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'price_typography',
				'label'     => __( 'Typography', 'skt-addons-for-elementor' ),
				'selector'  => '{{WRAPPER}} .skt-edd-single-product__price',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'condition' => [
					'show_price' => 'yes',
				],
			]
		);
	}

	protected function cart_and_qv_button_style_controls_section() {

		$this->start_controls_section(
			'_section_cart_and_qv_style_buttons',
			[
				'label'      => __( 'Cart & Quick View', 'skt-addons-for-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'show_cart_button',
									'operator' => '==',
									'value'    => 'yes',
								],
								[
									'name'     => 'show_quick_view_button',
									'operator' => '==',
									'value'    => 'yes',
								],
							],
						],
						[
							'terms' => [
								[
									'name'     => 'skin',
									'operator' => '!=',
									'value'    => '',
								],
							],
						],
					],
				],
			]
		);

		$this->cart_button_style_controls();

		$this->qv_button_style_controls();

		// control for classic
		$this->add_control(
			'classic_qv_position',
			[
				'label'        => __( 'Position', 'skt-addons-for-elementor' ),
				'type'         => Controls_Manager::SELECT,
				'label_block'  => false,
				'default'      => 'top-right',
				'options'      => [
					'top-left'     => __( 'Top Left', 'skt-addons-for-elementor' ),
					'top-right'    => __( 'Top Right', 'skt-addons-for-elementor' ),
					'bottom-left'  => __( 'Bottom Left', 'skt-addons-for-elementor' ),
					'bottom-right' => __( 'Bottom Right', 'skt-addons-for-elementor' ),
				],
				'prefix_class' => 'skt-edd-single-product__qv_pos-',
				'condition'    => [
					'skin' => 'classic',
				],
			]
		);
		// control for landscape
		$this->add_control(
			'landscape_qv_position',
			[
				'label'        => __( 'Position', 'skt-addons-for-elementor' ),
				'type'         => Controls_Manager::SELECT,
				'label_block'  => false,
				'default'      => 'top-right',
				'options'      => [
					'top-left'  => __( 'Top Left', 'skt-addons-for-elementor' ),
					'top-right' => __( 'Top Right', 'skt-addons-for-elementor' ),
				],
				'prefix_class' => 'skt-edd-single-product__qv_pos-',
				'condition'    => [
					'skin' => 'landscape',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function cart_button_style_controls() {

		// control for standard
		$this->add_responsive_control(
			'cart_btn_spacing',
			[
				'label'      => __( 'Space Between', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .button'        => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .added_to_cart' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'skin'                            => 'standard',
					'standard_show_quick_view_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'_heading_cart_btn',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Cart Button', 'skt-addons-for-elementor' ),
				'condition' => [
					'show_cart_button' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'cart_btn_padding',
			[
				'label'      => __( 'Padding', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .button, {{WRAPPER}} .added_to_cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .skt-edd-single-product__atc-btn .edd-submit.button.blue' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .skt-edd-single-product__atc-btn .edd-add-to-cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'show_cart_button' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'cart_btn_typography',
				'selector'  => '
				{{WRAPPER}} .button,
				{{WRAPPER}} .added_to_cart, 
				{{WRAPPER}} .skt-edd-single-product__atc-btn .edd-add-to-cart, 
				{{WRAPPER}} .skt-edd-single-product__atc-btn .edd-submit.button.blue',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'condition' => [
					'show_cart_button' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'cart_btn_border',
				'selector'  => '
				{{WRAPPER}} .button, 
				{{WRAPPER}} .added_to_cart, 
				{{WRAPPER}} .skt-edd-single-product__atc-btn .edd-add-to-cart, 
				{{WRAPPER}} .skt-edd-single-product__atc-btn .edd-submit.button.blue',
				'condition' => [
					'show_cart_button' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'cart_btn_border_radius',
			[
				'label'      => __( 'Border Radius', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .button, {{WRAPPER}} .added_to_cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .skt-edd-single-product__atc-btn .edd-add-to-cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'show_cart_button' => 'yes',
				],
			]
		);

		$this->start_controls_tabs(
			'_tabs_cart_btn_stat',
			[
				'condition' => [
					'show_cart_button' => 'yes',
				],
			]
		);

		$this->start_controls_tab(
			'_tab_cart_btn_normal',
			[
				'label'     => __( 'Normal', 'skt-addons-for-elementor' ),
				'condition' => [
					'show_cart_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'cart_btn_color',
			[
				'label'     => __( 'Text Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .button, {{WRAPPER}} .added_to_cart' => 'color: {{VALUE}};',
					'{{WRAPPER}} .skt-edd-single-product__atc-btn .edd-add-to-cart, {{WRAPPER}} .skt-edd-single-product__atc-btn .edd-submit.button.blue' => 'color: {{VALUE}};',
					'{{WRAPPER}} .button i' => 'border-right-color: {{VALUE}};',
				],
				'condition' => [
					'show_cart_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'cart_btn_bg_color',
			[
				'label'     => __( 'Background Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button, {{WRAPPER}} .added_to_cart' => 'background: {{VALUE}};',
					'{{WRAPPER}} .skt-edd-single-product__atc-btn .edd-add-to-cart, {{WRAPPER}} .skt-edd-single-product__atc-btn .edd-submit.button.blue' => 'background: {{VALUE}};',
				],
				'condition' => [
					'show_cart_button' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'cart_btn_box_shadow',
				'selector'  => '{{WRAPPER}} .button, {{WRAPPER}} .added_to_cart, {{WRAPPER}} .skt-edd-single-product__atc-btn .edd-add-to-cart, {{WRAPPER}} .skt-edd-single-product__atc-btn .edd-submit.button.blue',
				'condition' => [
					'show_cart_button' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_cart_btn_hover',
			[
				'label'     => __( 'Hover', 'skt-addons-for-elementor' ),
				'condition' => [
					'show_cart_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'cart_btn_hover_color',
			[
				'label'     => __( 'Text Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button:hover, {{WRAPPER}} .button:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .added_to_cart:hover, {{WRAPPER}} .added_to_cart:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .skt-edd-single-product__atc-btn .edd-add-to-cart:hover, {{WRAPPER}} .skt-edd-single-product__atc-btn .edd-submit.button.blue:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .button:hover i' => 'border-right-color: {{VALUE}};',
				],
				'condition' => [
					'show_cart_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'cart_btn_hover_bg_color',
			[
				'label'     => __( 'Background Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button:hover, {{WRAPPER}} .button:focus' => 'background: {{VALUE}};',
					'{{WRAPPER}} .added_to_cart:hover, {{WRAPPER}} .added_to_cart:focus' => 'background: {{VALUE}};',
					'{{WRAPPER}} .skt-edd-single-product__atc-btn .edd-add-to-cart:hover, {{WRAPPER}} .skt-edd-single-product__atc-btn .edd-submit.button.blue:hover' => 'background: {{VALUE}};',
				],
				'condition' => [
					'show_cart_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'cart_btn_hover_border_color',
			[
				'label'     => __( 'Border Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button:hover, {{WRAPPER}} .button:focus' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .added_to_cart:hover, {{WRAPPER}} .added_to_cart:focus' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .skt-edd-single-product__atc-btn .edd-add-to-cart:hover, {{WRAPPER}} .skt-edd-single-product__atc-btn .edd-submit.button.blue:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'show_cart_button'        => 'yes',
					'cart_btn_border_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'cart_btn_hover_box_shadow',
				'selector'  => '
				{{WRAPPER}} .button:hover,
				{{WRAPPER}} .button:focus,
				{{WRAPPER}} .added_to_cart:hover,
				{{WRAPPER}} .added_to_cart:focus,
				{{WRAPPER}} .skt-edd-single-product__atc-btn .edd-add-to-cart:hover,
				{{WRAPPER}} .skt-edd-single-product__atc-btn .edd-submit.button.blue:hover',
				'condition' => [
					'show_cart_button' => 'yes',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

	}

	protected function qv_button_style_controls() {

		$this->add_control(
			'_heading_qv_button',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Quick View Button', 'skt-addons-for-elementor' ),
				'separator' => 'before',
				'condition' => [
					'show_quick_view_button' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'qv_btn_padding',
			[
				'label'      => __( 'Padding', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .skt-pqv-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'show_quick_view_button' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'qv_btn_typography',
				'selector'  => '{{WRAPPER}} .skt-pqv-btn',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'condition' => [
					'show_quick_view_button' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'qv_btn_border',
				'selector'  => '{{WRAPPER}} .skt-pqv-btn',
				'condition' => [
					'show_quick_view_button' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'qv_btn_border_radius',
			[
				'label'      => __( 'Border Radius', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .skt-pqv-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'show_quick_view_button' => 'yes',
				],
			]
		);

		$this->start_controls_tabs(
			'_tabs_qv_btn_stat',
			[
				'condition' => [
					'show_quick_view_button' => 'yes',
				],
			]
		);

		$this->start_controls_tab(
			'_tab_qv_btn_normal',
			[
				'label'     => __( 'Normal', 'skt-addons-for-elementor' ),
				'condition' => [
					'show_quick_view_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'qv_btn_color',
			[
				'label'     => __( 'Text Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .skt-pqv-btn' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_quick_view_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'qv_btn_bg_color',
			[
				'label'     => __( 'Background Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-pqv-btn' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'show_quick_view_button' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'qv_btn_box_shadow',
				'selector'  => '{{WRAPPER}} .skt-pqv-btn',
				'condition' => [
					'show_quick_view_button' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_qv_btn_hover',
			[
				'label'     => __( 'Hover', 'skt-addons-for-elementor' ),
				'condition' => [
					'show_quick_view_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'qv_btn_hover_color',
			[
				'label'     => __( 'Text Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-pqv-btn:hover, {{WRAPPER}} .skt-pqv-btn:focus' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_quick_view_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'qv_btn_hover_bg_color',
			[
				'label'     => __( 'Background Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-pqv-btn:hover, {{WRAPPER}} .skt-pqv-btn:focus' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'show_quick_view_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'qv_btn_hover_border_color',
			[
				'label'     => __( 'Border Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-pqv-btn:hover, {{WRAPPER}} .skt-pqv-btn:focus' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'show_quick_view_button' => 'yes',
					'qv_btn_border_border!'  => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'qv_btn_hove_box_shadow',
				'selector'  => '{{WRAPPER}} .skt-pqv-btn:hover, {{WRAPPER}} .skt-pqv-btn:focus',
				'condition' => [
					'show_quick_view_button' => 'yes',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
	}

	/**
	 * Quick View Modal Style controls
	 */
	protected function qv_modal_style_controls() {

		$this->start_controls_section(
			'_section_style_qv_modal',
			[
				'label'     => __( 'Quick View Modal', 'skt-addons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_quick_view_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'_heading_qv_title',
			[
				'label' => __( 'Title', 'skt-addons-for-elementor' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'qv_title_spacing',
			[
				'label'     => __( 'Bottom Spacing', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'qv_title_typography',
				'label'    => __( 'Typography', 'skt-addons-for-elementor' ),
				'selector' => '.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__title',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$this->add_control(
			'qv_title_color',
			[
				'label'     => __( 'Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__title' => 'color: {{VALUE}};',
				],
			]
		);

		// $this->add_control(
		// 	'_heading_qv_rating',
		// 	[
		// 		'label' => __( 'Rating', 'skt-addons-for-elementor' ),
		// 		'type' => Controls_Manager::HEADING,
		// 		'separator' => 'before'
		// 	]
		// );

		// $this->add_responsive_control(
		// 	'qv_rating_spacing',
		// 	[
		// 		'label' => __( 'Bottom Spacing', 'skt-addons-for-elementor' ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'selectors' => [
		// 			'.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__rating' => 'margin-bottom: {{SIZE}}{{UNIT}};'
		// 		],
		// 	]
		// );

		// $this->add_control(
		// 	'qv_rating_color',
		// 	[
		// 		'label' => __( 'Color', 'skt-addons-for-elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__rating' => 'color: {{VALUE}};',
		// 		]
		// 	]
		// );

		$this->add_control(
			'_heading_qv_price',
			[
				'label'     => __( 'Price', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'qv_price_spacing',
			[
				'label'     => __( 'Bottom Spacing', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'qv_price_typography',
				'label'    => __( 'Typography', 'skt-addons-for-elementor' ),
				'selector' => '.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__price',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_control(
			'qv_price_color',
			[
				'label'     => __( 'Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'_heading_qv_summary',
			[
				'label'     => __( 'Summary', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'qv_summary_spacing',
			[
				'label'     => __( 'Bottom Spacing', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__summary' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'qv_summary_typography',
				'label'    => __( 'Typography', 'skt-addons-for-elementor' ),
				'selector' => '.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__summary',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_control(
			'qv_summary_color',
			[
				'label'     => __( 'Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__summary' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'_heading_qv_cart',
			[
				'label'     => __( 'Add To Cart', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'qv_cart_padding',
			[
				'label'      => __( 'Padding', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__cart .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'qv_cart_border_radius',
			[
				'label'      => __( 'Border Radius', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__cart .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'qv_cart_border',
				'selector' => '.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__cart .button',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'qv_cart_typography',
				'label'    => __( 'Typography', 'skt-addons-for-elementor' ),
				'selector' => '.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__cart .button',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->start_controls_tabs( '_tab_qv_cart_stats' );
		$this->start_controls_tab(
			'_tab_qv_cart_normal',
			[
				'label' => __( 'Normal', 'skt-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'qv_cart_color',
			[
				'label'     => __( 'Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__cart .button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'qv_cart_bg_color',
			[
				'label'     => __( 'Background Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__cart .button' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'_tab_qv_cart_hover',
			[
				'label' => __( 'Hover', 'skt-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'qv_cart_hover_color',
			[
				'label'     => __( 'Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__cart .button:hover, .skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__cart .button:focus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'qv_cart_hover_bg_color',
			[
				'label'     => __( 'Background Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__cart .button:hover, .skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__cart .button:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'qv_cart_hover_border_color',
			[
				'label'     => __( 'Border Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__cart .button:hover, .skt-pqv-edd.skt-pqv-edd--{{ID}} .skt-pqv-edd__cart .button:focus' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'qv_cart_border_border!' => '',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}


	/**
	 * adding woocommerce filter
	 *
	 * @return void
	 */
	public function __add_hooks() {
		add_filter( 'edd_purchase_link_defaults', [ $this, 'hide_button_prices'] );

	}

	/**
	 * removing woocommerce filter
	 *
	 * @return void
	 */
	public function __remove_hooks() {

	}



	/**
	 * @param  $args
	 * @return mixed
	 */
	public function hide_button_prices( $args ) {
		$args['price'] = (bool) false;

		return $args;
	}

	public function skt_edd_ajax_add_to_cart_link( $product_id ) {
		$url = add_query_arg(
			[
				'action'      => 'skt_edd_ajax_add_to_cart_link',
				'download_id' => $product_id,
				'nonce'       => wp_create_nonce( 'skt_edd_ajax_add_to_cart_link' ),
			],
			admin_url( 'admin-ajax.php' )
		);

		printf(
			'<a href="%s" data-download-id="%s" nonce="%s" class="button skt_edd_ajax_btn"><i class="fas fa-shopping-cart"></i></a>',
			'#',
			$product_id, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
			wp_create_nonce( 'skt_edd_ajax_add_to_cart_link' ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
		);
	}

	/**
	 * Get feature image markup
	 *
	 * @return void
	 */
	protected function get_feature_image( $settings ) {
		?>
			<a href="<?php the_permalink(); ?>" rel="bookmark" class="skt-edd-single-product__feature_img">
				<?php
				if ( $settings['normal_image']['url'] && $settings['normal_image']['id'] ) {
					echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'normal_image' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
				} else {
					the_post_thumbnail( 'medium' );
				}
					echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'hover_image' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
				?>
			</a>
		<?php
	}


	/**
	 * print quick view button markup
	 *
	 * @param [init] $product_id
	 * @return void
	 */
	protected function print_quick_view_button( $product_id ) {
		$url = add_query_arg(
			[
				'action'      => 'skt_show_edd_product_quick_view',
				'download_id' => $product_id,
				'nonce'       => wp_create_nonce( 'skt_show_edd_product_quick_view' ),
			],
			admin_url( 'admin-ajax.php' )
		);

		printf(
			'<a href="#" data-mfp-src="%s" class="skt-pqv-btn" title="%s" data-modal-class="skt-pqv-edd--%s"><i class="fas fa-expand-alt"></i></a>',
			esc_url( $url ),
			esc_attr__( 'Quick View', 'skt-addons-for-elementor' ),
			$this->get_id() // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
		);
	}

	/**
	 * get badge markup
	 *
	 * @return void
	 */
	protected function get_badge( $settings ) {
		$badge_text    = $settings['badge_text'];
		$discount_text = 'classic' == $settings['skin'] ? $settings['discount_text'] : '';
		?>
			<?php if ( $badge_text || $discount_text ) : ?>
				<div class="skt-edd-single-product__badge">
					<?php
					if ( $badge_text ) {
						printf( '<span %1$s>%2$s</span>',
							'class="skt-edd-single-product__badge-text"',
							esc_html( $badge_text )
						);
					}
					if ( $discount_text ) {
						printf( '<span %1$s>%2$s</span>',
							'class="skt-edd-single-product__discount-text"',
							esc_html( $discount_text )
						);
					}
					?>
				</div>
			<?php endif; ?>
		<?php
	}


	/**
	 * update add to cart button markup
	 *
	 * @param [string] $html
	 * @param [object] $product
	 * @param [array] $args
	 * @return void
	 */
	public function __update_add_to_cart( $html, $product, $args ) {
		$settings = $this->get_settings_for_display();
		return sprintf(
			'<a href="%s" data-quantity="%s" class="%s" title="%s" %s><i class="fa fa-shopping-cart"></i>%s</a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
			esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
			esc_html( $product->add_to_cart_text() ),
			isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
			'standard' == $settings['skin'] ? '<span class="skt-screen-reader-text">' . esc_html( $product->add_to_cart_text() ) . '</span>' : esc_html( $product->add_to_cart_text() )
		);
	}


	/**
	 * get hover button markup
	 *
	 * @param [object] $product
	 * @return void
	 */
	protected function get_hover_button( $product, $settings ) {
		$show_cart_button       = 'standard' == $settings['skin'] ? $settings['show_cart_button'] : '';
		$show_quick_view_button = $settings['show_quick_view_button']
		?>
			<?php if ( $show_cart_button === 'yes' || $show_quick_view_button === 'yes' ) : ?>
				<div class="skt-edd-single-product__btns">
					<?php
					if ( $show_cart_button === 'yes' ) {
						$this->skt_edd_ajax_add_to_cart_link( $product );
					}
					if ( $show_quick_view_button === 'yes' ) {
						$this->print_quick_view_button( $product );
					}
					?>
				</div>
			<?php endif; ?>
		<?php
	}


	public function get_products_query_args() {
		$settings               = $this->get_settings_for_display();
		$args                   = [];
		$args['post_type']      = 'download';
		$args['posts_per_page'] = 1;
		$args['post_status']    = 'publish';
		$args['p']              = $settings['posts_selected_ids'];

		if ( empty( $settings['posts_selected_ids'] ) ) {
			$args['order']   = 'ASC';
			$args['orderby'] = 'title';
		}

		return $args;
	}

	public function get_query() {
		return get_posts( $this->get_products_query_args() );
	}

	public static function show_edd_missing_alert() {
		if ( current_user_can( 'activate_plugins' ) ) {
			printf(
				'<div %s>%s</div>',
				'style="margin: 1rem;padding: 1rem 1.25rem;border-left: 5px solid #f5c848;color: #856404;background-color: #fff3cd;"',
				esc_attr__( 'Easy Digital Downloads is missing! Please install and activate Easy Digital Downloads.', 'skt-addons-for-elementor' )
			);
		}
	}

	public static function show_alert_to_add_product() {
		printf(
			'<div %s>%s</div>',
			'style="margin: 1rem;padding: 1rem 1.25rem;border-left: 5px solid #f5c848;color: #856404;background-color: #fff3cd;"',
			esc_attr__( 'Please add some product to view.', 'skt-addons-for-elementor' )
		);
	}


	public function render() {

		// Show Alart
		if ( ! function_exists( 'EDD' ) ) {
			$this->show_edd_missing_alert();
			return;
		}
		if ( empty( $this->get_query() ) ) {
			$this->show_alert_to_add_product();
			return;
		}

		// Add EDD hooks
		$this->__add_hooks();

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			'wrapper',
			'class',
			[
				'skt-edd-single-product__item ',
				'skt-edd-single-product__' . $settings['skin'],
			]
		);

		$this->{'render_' . $settings['skin']}( $settings );

		// Remove EDD hooks
		// $this->__remove_hooks();
	}

	public function render_classic( $settings ) {

		$products = (array) $this->get_query();

		global $post;

		foreach ( $products as $post ) :
			setup_postdata( $post );
			// global $product;
			?>
			<article <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

				<div class="skt-edd-single-product__img">

					<?php $this->get_feature_image( $settings ); ?>

					<?php $this->get_badge( $settings ); ?>

					<?php $this->get_hover_button( get_the_ID(), $settings ); ?>

				</div>

				<div class="skt-edd-single-product__content">

					<!-- Ratings div will here -->

					<?php if ( $settings['show_cat'] === 'yes' ) : ?>
						<div class="skt-edd-single-product__category">
							<?php echo skt_addons_elementor_pro_the_first_taxonomy( $post->ID, 'download_category', ['class' => 'skt-edd-single-product__category_inner'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped  ?>
						</div>
					<?php endif; ?>
                    <?php
					// Resolved escaping issue
						$title_tag = isset( $settings['title_tag'] ) ? sanitize_html_class( $settings['title_tag'] ) : 'h2';
						echo '<' . esc_attr( $title_tag ) . ' class="skt-edd-single-product__title">';
						echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_html( get_the_title() ) . '</a>';
						echo '</' . esc_attr( $title_tag ) . '>';
					?>
					<?php if ( ! empty( $settings['excerpt_length'] ) ) : ?>
						<p class="skt-edd-single-product__desc">
							<?php echo skt_addons_elementor_pro_get_excerpt( $post->ID, $settings['excerpt_length'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped  ?>
						</p>
					<?php endif; ?>

					<?php if ( $settings['show_price'] === 'yes' || $settings['show_cart_button'] === 'yes' ) : ?>
						<div class="skt-edd-single-product__price">
							<?php if ( $settings['show_price'] === 'yes' ) : ?>
								<?php edd_price( $post->ID ); ?>
							<?php endif; ?>
						</div>
						<?php if ( $settings['show_cart_button'] === 'yes' ) : ?>
							<div class="skt-edd-single-product__atc-btn">
								<?php
								if ( edd_has_variable_prices( $post->ID ) ) {
									printf('<a href="%s" class="button">%s</a>',
										esc_url( get_the_permalink( $post->ID ) ),
										esc_attr__( 'Select Options', 'skt-addons-for-elementor' )
									);
								} else {
									echo edd_get_purchase_link( [ 'download_id' => $post->ID, 'text' => $settings['add_to_cart_text'] ] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 

								}

								?>
							</div>
						<?php endif; ?>
					<?php endif; ?>

				</div>
			</article>
			<?php
		endforeach;

		wp_reset_postdata();
	}


	public function render_landscape( $settings ) {

		$products = (array) $this->get_query();

		global $post;

		foreach ( $products as $post ) :
			setup_postdata( $post );

			// global $product;
			?>
			<article <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

				<div class="skt-edd-single-product__img">

					<?php $this->get_feature_image( $settings ); ?>

					<?php $this->get_badge( $settings ); ?>

				</div>

				<div class="skt-edd-single-product__content">

						<!-- Ratings div will here -->


					<?php if ( $settings['show_cat'] === 'yes' ) : ?>
						<div class="skt-edd-single-product__category">
							<?php echo skt_addons_elementor_pro_the_first_taxonomy( $post->ID, 'download_category', ['class' => 'skt-edd-single-product__category_inner'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped  ?>
						</div>
					<?php endif; ?>
                     <?php
					// Resolved escaping issue
						$title_tag = isset( $settings['title_tag'] ) ? sanitize_html_class( $settings['title_tag'] ) : 'h2';
						echo '<' . esc_attr( $title_tag ) . ' class="skt-edd-single-product__title">';
						echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_html( get_the_title() ) . '</a>';
						echo '</' . esc_attr( $title_tag ) . '>';
					?>

					<?php if ( ! empty( $settings['excerpt_length'] ) ) : ?>
						<p class="skt-edd-single-product__desc">
							<?php echo skt_addons_elementor_pro_get_excerpt( $post->ID, $settings['excerpt_length'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</p>
					<?php endif; ?>

					<?php if ( $settings['show_price'] === 'yes' || $settings['show_cart_button'] === 'yes' ) : ?>
						<div class="skt-edd-single-product__price">
							<?php if ( $settings['show_price'] === 'yes' ) : ?>
								<?php edd_price( get_the_ID() ); ?>
							<?php endif; ?>

						</div>
						<?php if ( $settings['show_cart_button'] === 'yes' ) : ?>
								<div class="skt-edd-single-product__atc-btn">
									<?php
									if ( edd_has_variable_prices( $post->ID ) ) {
										printf('<a href="%s" class="button">%s</a>',
											esc_url( get_the_permalink( $post->ID ) ),
											esc_attr__( 'Select Options', 'skt-addons-for-elementor' )
										);
									} else {
										echo edd_get_purchase_link( [ 'download_id' => $post->ID, 'text' => $settings['add_to_cart_text'] ] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 

									}

									?>
								</div>
						<?php endif; ?>
					<?php endif; ?>
					<?php $this->get_hover_button( get_the_ID(), $settings ); ?>
				</div>


			</article>
			<?php
		endforeach;

		wp_reset_postdata();
	}

	public function render_standard( $settings ) {
		$products = (array) $this->get_query();
		global $post;
		foreach ( $products as $post ) :
			setup_postdata( $post );
			// global $product;
			?>
			<article <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
				<div class="skt-edd-single-product__img">
					<?php $this->get_feature_image( $settings ); ?>
					<?php $this->get_badge( $settings ); ?>
					<?php $this->get_hover_button( get_the_ID(), $settings ); ?>
				</div>
				<div class="skt-edd-single-product__content">
					<?php if ( $settings['show_cat'] === 'yes' ) : ?>
						<div class="skt-edd-single-product__category">
							<?php echo skt_addons_elementor_pro_the_first_taxonomy( $post->ID, 'download_category', ['class' => 'skt-edd-single-product__category_inner'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped  ?>
						</div>
					<?php endif; ?>
                    <?php
						// Resolved escaping issue
						$title_tag = isset( $settings['title_tag'] ) ? sanitize_html_class( $settings['title_tag'] ) : 'h2';
						echo '<' . esc_attr( $title_tag ) . ' class="skt-edd-single-product__title">';
						echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_html( get_the_title() ) . '</a>';
						echo '</' . esc_attr( $title_tag ) . '>';
					?>
					<?php if ( ! empty( $settings['excerpt_length'] ) ) : ?>
						<p class="skt-edd-single-product__desc">
							<?php echo skt_addons_elementor_pro_get_excerpt( $post->ID, $settings['excerpt_length'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</p>
					<?php endif; ?>
					<?php if ( $settings['show_price'] === 'yes' ) : ?>
						<div class="skt-edd-single-product__price">
							<?php edd_price( $post->ID ); ?>
						</div>
					<?php endif; ?>
				</div>
			</article>
			<?php
		endforeach;
		wp_reset_postdata();
	}
}