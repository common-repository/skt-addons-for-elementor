<?php
/**
 * Post Info widget class
 *
 * @package Skt_Addons
 */
namespace Skt_Addons_Elementor\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;

defined( 'ABSPATH' ) || die();

class Post_Info extends Base {

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Post Info', 'skt-addons-for-elementor' );
	}

	public function get_custom_help_url() {
		return '#';
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
		return 'skti skti-tb-post-info';
	}

	public function get_keywords() {
		return [ 'post', 'info', 'date', 'time', 'author', 'taxonomy', 'comments', 'terms', 'avatar' ];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {
		$this->__post_meta_content_controls();

	}

	protected function __post_meta_content_controls() {
		$this->start_controls_section(
			'_section_post_meta',
			[
				'label' => __( 'Meta Data', 'skt-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'Layout', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'inline',
				'options' => [
					'traditional' => [
						'title' => __( 'Default', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-editor-list-ul',
					],
					'inline' => [
						'title' => __( 'Inline', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-ellipsis-h',
					],
				],
				'render_type' => 'template',
				'classes' => 'skt-control-start-end',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'type',
			[
				'label' => __( 'Type', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'author' => __( 'Author', 'skt-addons-for-elementor' ),
					'date' => __( 'Date', 'skt-addons-for-elementor' ),
					'time' => __( 'Time', 'skt-addons-for-elementor' ),
					'comments' => __( 'Comments', 'skt-addons-for-elementor' ),
					'terms' => __( 'Terms', 'skt-addons-for-elementor' ),
					'custom' => __( 'Custom', 'skt-addons-for-elementor' ),
				],
			]
		);

		$repeater->add_control(
			'date_format',
			[
				'label' => __( 'Date Format', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => 'Default',
					'0' => _x( 'March 6, 2018 (F j, Y)', 'Date Format', 'skt-addons-for-elementor' ),
					'1' => '2018-03-06 (Y-m-d)',
					'2' => '03/06/2018 (m/d/Y)',
					'3' => '06/03/2018 (d/m/Y)',
					'custom' => __( 'Custom', 'skt-addons-for-elementor' ),
				],
				'condition' => [
					'type' => 'date',
				],
			]
		);

		$repeater->add_control(
			'custom_date_format',
			[
				'label' => __( 'Custom Date Format', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'F j, Y',
				'condition' => [
					'type' => 'date',
					'date_format' => 'custom',
				],
				'description' => sprintf(
					/* translators: %s: Allowed data letters (see: http://php.net/manual/en/function.date.php). */
					__( 'Use the letters: %s', 'skt-addons-for-elementor' ),
					'l D d j S F m M n Y y'
				),
			]
		);

		$repeater->add_control(
			'time_format',
			[
				'label' => __( 'Time Format', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => 'Default',
					'0' => '3:31 pm (g:i a)',
					'1' => '3:31 PM (g:i A)',
					'2' => '15:31 (H:i)',
					'custom' => __( 'Custom', 'skt-addons-for-elementor' ),
				],
				'condition' => [
					'type' => 'time',
				],
			]
		);
		$repeater->add_control(
			'custom_time_format',
			[
				'label' => __( 'Custom Time Format', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'g:i a',
				'placeholder' => 'g:i a',
				'condition' => [
					'type' => 'time',
					'time_format' => 'custom',
				],
				'description' => sprintf(
					/* translators: %s: Allowed time letters (see: http://php.net/manual/en/function.time.php). */
					__( 'Use the letters: %s', 'skt-addons-for-elementor' ),
					'g G H i a A'
				),
			]
		);

		$repeater->add_control(
			'taxonomy',
			[
				'label' => __( 'Taxonomy', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'default' => [],
				'options' => $this->get_taxonomies(),
				'condition' => [
					'type' => 'terms',
				],
			]
		);

		$repeater->add_control(
			'text_prefix',
			[
				'label' => __( 'Before', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'type!' => 'custom',
				],
			]
		);

		$repeater->add_control(
			'show_avatar',
			[
				'label' => __( 'Avatar', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'type' => 'author',
				],
			]
		);

		$repeater->add_responsive_control(
			'avatar_size',
			[
				'label' => __( 'Size', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .skt-icon-list-icon' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'show_avatar' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'comments_custom_strings',
			[
				'label' => __( 'Custom Format', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => false,
				'condition' => [
					'type' => 'comments',
				],
			]
		);

		$repeater->add_control(
			'string_no_comments',
			[
				'label' => __( 'No Comments', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'No Comments', 'skt-addons-for-elementor' ),
				'condition' => [
					'comments_custom_strings' => 'yes',
					'type' => 'comments',
				],
			]
		);

		$repeater->add_control(
			'string_one_comment',
			[
				'label' => __( 'One Comment', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'One Comment', 'skt-addons-for-elementor' ),
				'condition' => [
					'comments_custom_strings' => 'yes',
					'type' => 'comments',
				],
			]
		);

		$repeater->add_control(
			'string_comments',
			[
				'label' => __( 'Comments', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html( '%s Comments', 'skt-addons-for-elementor' ),
				'condition' => [
					'comments_custom_strings' => 'yes',
					'type' => 'comments',
				],
			]
		);

		$repeater->add_control(
			'custom_text',
			[
				'label' => __( 'Custom', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
				'condition' => [
					'type' => 'custom',
				],
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'type!' => 'time',
				],
			]
		);

		$repeater->add_control(
			'custom_url',
			[
				'label' => __( 'Custom URL', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'type' => 'custom',
				],
			]
		);

		$repeater->add_control(
			'show_icon',
			[
				'label' => __( 'Icon', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => __( 'None', 'skt-addons-for-elementor' ),
					'default' => __( 'Default', 'skt-addons-for-elementor' ),
					'custom' => __( 'Custom', 'skt-addons-for-elementor' ),
				],

				'default' => 'default',
				'condition' => [
					'show_avatar!' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'selected_icon',
			[
				'label' => __( 'Choose Icon', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'condition' => [
					'show_icon' => 'custom',
					'show_avatar!' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'type' => 'author',
						'selected_icon' => [
							'value' => 'far fa-user-circle',
							'library' => 'fa-regular',
						],
					],
					[
						'type' => 'date',
						'selected_icon' => [
							'value' => 'fas fa-calendar',
							'library' => 'fa-solid',
						],
					],
					[
						'type' => 'time',
						'selected_icon' => [
							'value' => 'far fa-clock',
							'library' => 'fa-regular',
						],
					],
					[
						'type' => 'comments',
						'selected_icon' => [
							'value' => 'far fa-comment-dots',
							'library' => 'fa-regular',
						],
					],
				],
				'title_field' => '{{{ elementor.helpers.renderIcon( this, selected_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} <span style="text-transform: capitalize;">{{{ type }}}</span>',
			]
		);


        $this->end_controls_section();
	}

	/**
	 * Register styles related controls
	 */
	protected function register_style_controls() {
		$this->__list_style_controls();
		$this->__icon_style_controls();
		$this->__text_style_controls();
	}


	protected function __list_style_controls() {

        $this->start_controls_section(
            '_section_list_style',
            [
                'label' => __( 'List', 'skt-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'space_between',
			[
				'label' => __( 'Space Between', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .skt-icon-list-items:not(.skt-inline-items) .skt-icon-list-item:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .skt-icon-list-items:not(.skt-inline-items) .skt-icon-list-item:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .skt-icon-list-items.skt-inline-items .skt-icon-list-item' => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .skt-icon-list-items.skt-inline-items' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .skt-icon-list-items.skt-inline-items .skt-icon-list-item::after' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_align',
			[
				'label' => __( 'Alignment', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __( 'Start', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-h-align-center',
					],
					'flex-end' => [
						'title' => __( 'End', 'skt-addons-for-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} ul.skt-inline-items.skt-icon-list-items' => 'justify-content:{{VALUE}};'
				]
			]
		);

		$this->add_control(
			'divider',
			[
				'label' => __( 'Divider', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'skt-addons-for-elementor' ),
				'label_on' => __( 'On', 'skt-addons-for-elementor' ),
				'selectors' => [
					'{{WRAPPER}} .skt-icon-list-item:not(:last-child):after' => 'content: ""',
				],
				'separator' => 'before',

			]
		);

		$this->add_control(
			'divider_style',
			[
				'label' => __( 'Style', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => __( 'Solid', 'skt-addons-for-elementor' ),
					'double' => __( 'Double', 'skt-addons-for-elementor' ),
					'dotted' => __( 'Dotted', 'skt-addons-for-elementor' ),
					'dashed' => __( 'Dashed', 'skt-addons-for-elementor' ),
				],
				'default' => 'solid',
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .skt-icon-list-items:not(.skt-inline-items) .skt-icon-list-item:not(:last-child):after' => 'border-top-style: {{VALUE}};',
					'{{WRAPPER}} .skt-icon-list-items.skt-inline-items .skt-icon-list-item:not(:last-child):after' => 'border-left-style: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'divider_weight',
			[
				'label' => __( 'Weight', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .skt-icon-list-items:not(.skt-inline-items) .skt-icon-list-item:not(:last-child):after' => 'border-top-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .skt-inline-items .skt-icon-list-item:not(:last-child):after' => 'border-left-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_width',
			[
				'label' => __( 'Width', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => [
					'divider' => 'yes',
					'view!' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .skt-icon-list-item:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_height',
			[
				'label' => __( 'Height', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => [
					'divider' => 'yes',
					'view' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .skt-icon-list-item:not(:last-child):after' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label' => __( 'Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ddd',
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .skt-icon-list-item:not(:last-child):after' => 'border-color: {{VALUE}};',
				],
			]
		);


        $this->end_controls_section();
	}

	protected function __icon_style_controls() {
		$this->start_controls_section(
			'_section_icon_style',
			[
				'label' => __( 'Icon', 'skt-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .skt-icon-list-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .skt-icon-list-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 14,
				],
				'range' => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .skt-icon-list-icon' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .skt-icon-list-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .skt-icon-list-icon svg' => '--e-icon-list-icon-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __text_style_controls(){
		$this->start_controls_section(
			'_section_text_style',
			[
				'label' => __( 'Text', 'skt-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_indent',
			[
				'label' => __( 'Indent', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'body:not(.rtl) {{WRAPPER}} .skt-icon-list-text' => 'padding-left: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .skt-icon-list-text' => 'padding-right: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .skt-icon-list-text, {{WRAPPER}} .skt-icon-list-text a' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'selector' => '{{WRAPPER}} .skt-icon-list-item',
			]
		);

		$this->end_controls_section();
	}

	// Get List of Taxonomy

	protected function get_taxonomies() {
		$taxonomies = get_taxonomies( [
			'show_in_nav_menus' => true,
		], 'objects' );

		$options = [
			'' => __( 'Choose', 'skt-addons-for-elementor' ),
		];

		foreach ( $taxonomies as $taxonomy ) {
			$options[ $taxonomy->name ] = $taxonomy->label;
		}

		return $options;
	}



	protected function get_meta_data( $repeater_item ) {
		$item_data = [];

		switch ( $repeater_item['type'] ) {
			case 'author':
				$user_id = get_post_field( 'post_author', get_the_ID() );
				$item_data['text'] = get_the_author_meta( 'display_name', $user_id );
				$item_data['icon'] = 'fa fa-user-circle-o'; // Default icon.
				$item_data['selected_icon'] = [
					'value' => 'far fa-user-circle',
					'library' => 'fa-regular',
				]; // Default icons.
				$item_data['itemprop'] = 'author';

				if ( 'yes' === $repeater_item['link'] ) {
					$item_data['url'] = [
						'url' => get_author_posts_url( $user_id ),
					];
				}

				if ( 'yes' === $repeater_item['show_avatar'] ) {
					$item_data['image'] = get_avatar_url( $user_id, 96 );
				}

				break;

			case 'date':
				$custom_date_format = empty( $repeater_item['custom_date_format'] ) ? 'F j, Y' : $repeater_item['custom_date_format'];

				$format_options = [
					'default' => 'F j, Y',
					'0' => 'F j, Y',
					'1' => 'Y-m-d',
					'2' => 'm/d/Y',
					'3' => 'd/m/Y',
					'custom' => $custom_date_format,
				];

				$item_data['text'] = get_the_time( $format_options[ $repeater_item['date_format'] ] );
				$item_data['icon'] = 'fa fa-calendar'; // Default icon
				$item_data['selected_icon'] = [
					'value' => 'fas fa-calendar',
					'library' => 'fa-solid',
				]; // Default icons.
				$item_data['itemprop'] = 'datePublished';

				if ( 'yes' === $repeater_item['link'] ) {
					$item_data['url'] = [
						'url' => get_day_link( get_post_time( 'Y' ), get_post_time( 'm' ), get_post_time( 'j' ) ),
					];
				}
				break;

			case 'time':
				$custom_time_format = empty( $repeater_item['custom_time_format'] ) ? 'g:i a' : $repeater_item['custom_time_format'];

				$format_options = [
					'default' => 'g:i a',
					'0' => 'g:i a',
					'1' => 'g:i A',
					'2' => 'H:i',
					'custom' => $custom_time_format,
				];
				$item_data['text'] = get_the_time( $format_options[ $repeater_item['time_format'] ] );
				$item_data['icon'] = 'fa fa-clock-o'; // Default icon
				$item_data['selected_icon'] = [
					'value' => 'far fa-clock',
					'library' => 'fa-regular',
				]; // Default icons.
				break;

			case 'comments':
				if ( comments_open() ) {
					$default_strings = [
						'string_no_comments' => __( 'No Comments', 'skt-addons-for-elementor' ),
						'string_one_comment' => __( 'One Comment', 'skt-addons-for-elementor' ),
						'string_comments' => esc_html( '%s Comments', 'skt-addons-for-elementor' ),
					];

					if ( 'yes' === $repeater_item['comments_custom_strings'] ) {
						if ( ! empty( $repeater_item['string_no_comments'] ) ) {
							$default_strings['string_no_comments'] = $repeater_item['string_no_comments'];
						}

						if ( ! empty( $repeater_item['string_one_comment'] ) ) {
							$default_strings['string_one_comment'] = $repeater_item['string_one_comment'];
						}

						if ( ! empty( $repeater_item['string_comments'] ) ) {
							$default_strings['string_comments'] = $repeater_item['string_comments'];
						}
					}

					$num_comments = (int) get_comments_number(); // get_comments_number returns only a numeric value

					if ( 0 === $num_comments ) {
						$item_data['text'] = $default_strings['string_no_comments'];
					} else {
						$item_data['text'] = sprintf( translate_noop_plural( $default_strings['string_one_comment'], $default_strings['string_comments'], $num_comments, 'skt-addons-for-elementor' ), $num_comments );
					}

					if ( 'yes' === $repeater_item['link'] ) {
						$item_data['url'] = [
							'url' => get_comments_link(),
						];
					}
					$item_data['icon'] = 'fa fa-commenting-o'; // Default icon
					$item_data['selected_icon'] = [
						'value' => 'far fa-comment-dots',
						'library' => 'fa-regular',
					]; // Default icons.
					$item_data['itemprop'] = 'commentCount';
				}
				break;

			case 'terms':
				$item_data['icon'] = 'fa fa-tags'; // Default icon
				$item_data['selected_icon'] = [
					'value' => 'fas fa-tags',
					'library' => 'fa-solid',
				]; // Default icons.
				$item_data['itemprop'] = 'about';

				$taxonomy = $repeater_item['taxonomy'];
				$terms = wp_get_post_terms( get_the_ID(), $taxonomy );
				foreach ( $terms as $term ) {
					$item_data['terms_list'][ $term->term_id ]['text'] = $term->name;
					if ( 'yes' === $repeater_item['link'] ) {
						$item_data['terms_list'][ $term->term_id ]['url'] = get_term_link( $term );
					}
				}
				break;

			case 'custom':
				$item_data['text'] = $repeater_item['custom_text'];
				$item_data['icon'] = 'fa fa-info-circle'; // Default icon.
				$item_data['selected_icon'] = [
					'value' => 'far fa-tags',
					'library' => 'fa-regular',
				]; // Default icons.

				if ( 'yes' === $repeater_item['link'] && ! empty( $repeater_item['custom_url'] ) ) {
					$item_data['url'] = $repeater_item['custom_url'];
				}

				break;
		}

		$item_data['type'] = $repeater_item['type'];

		if ( ! empty( $repeater_item['text_prefix'] ) ) {
			$item_data['text_prefix'] = esc_html( $repeater_item['text_prefix'] );
		}

		return $item_data;
	}

	protected function render_item( $repeater_item ) {
		$item_data = $this->get_meta_data( $repeater_item );
		$repeater_index = $repeater_item['_id'];

		if ( empty( $item_data['text'] ) && empty( $item_data['terms_list'] ) ) {
			return;
		}

		$has_link = false;
		$link_key = 'link_' . $repeater_index;
		$item_key = 'item_' . $repeater_index;

		$this->add_render_attribute( $item_key, 'class',
			[
				'skt-icon-list-item',
				'elementor-repeater-item-' . $repeater_item['_id'],
			]
		);

		$active_settings = $this->get_active_settings();

		if ( 'inline' === $active_settings['view'] ) {
			$this->add_render_attribute( $item_key, 'class', 'skt-inline-item' );
		}

		if ( ! empty( $item_data['url']['url'] ) ) {
			$has_link = true;

			$this->add_link_attributes( $link_key, $item_data['url'] );
		}

		if ( ! empty( $item_data['itemprop'] ) ) {
			$this->add_render_attribute( $item_key, 'itemprop', $item_data['itemprop'] );
		}

		?>
		<li <?php echo wp_kses_post($this->get_render_attribute_string( $item_key )); ?>>
			<?php if ( $has_link ) : ?>
			<a <?php echo wp_kses_post($this->get_render_attribute_string( $link_key )); ?>>
				<?php endif; ?>
				<?php $this->render_item_icon_or_image( $item_data, $repeater_item, $repeater_index ); ?>
				<?php $this->render_item_text( $item_data, $repeater_index ); ?>
				<?php if ( $has_link ) : ?>
			</a>
		<?php endif; ?>
		</li>
		<?php
	}

	protected function render_item_icon_or_image( $item_data, $repeater_item, $repeater_index ) {
		// Set icon according to user settings.
		$migration_allowed = Icons_Manager::is_migration_allowed();
		if ( ! $migration_allowed ) {
			if ( 'custom' === $repeater_item['show_icon'] && ! empty( $repeater_item['icon'] ) ) {
				$item_data['icon'] = $repeater_item['icon'];
			} elseif ( 'none' === $repeater_item['show_icon'] ) {
				$item_data['icon'] = '';
			}
		} else {
			if ( 'custom' === $repeater_item['show_icon'] && ! empty( $repeater_item['selected_icon'] ) ) {
				$item_data['selected_icon'] = $repeater_item['selected_icon'];
			} elseif ( 'none' === $repeater_item['show_icon'] ) {
				$item_data['selected_icon'] = [];
			}
		}

		if ( empty( $item_data['icon'] ) && empty( $item_data['selected_icon'] ) && empty( $item_data['image'] ) ) {
			return;
		}

		$migrated = isset( $repeater_item['__fa4_migrated']['selected_icon'] );
		$is_new = empty( $repeater_item['icon'] ) && $migration_allowed;
		$show_icon = 'none' !== $repeater_item['show_icon'];

		if ( ! empty( $item_data['image'] ) || $show_icon ) {
			?>
			<span class="skt-icon-list-icon">
			<?php
			if ( ! empty( $item_data['image'] ) ) :
				$image_data = 'image_' . $repeater_index;
				$this->add_render_attribute( $image_data, 'src', $item_data['image'] );
				$this->add_render_attribute( $image_data, 'alt', $item_data['text'] );
				?>
					<img class="skt-avatar" <?php echo wp_kses_post($this->get_render_attribute_string( $image_data )); ?>>
				<?php elseif ( $show_icon ) : ?>
					<?php if ( $is_new || $migrated ) :
						Icons_Manager::render_icon( $item_data['selected_icon'], [ 'aria-hidden' => 'true' ] );
					else : ?>
						<i class="<?php echo esc_attr( $item_data['icon'] ); ?>" aria-hidden="true"></i>
					<?php endif; ?>
				<?php endif; ?>
			</span>
			<?php
		}
	}

	protected function render_item_text( $item_data, $repeater_index ) {
		$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'icon_list', $repeater_index );

		$this->add_render_attribute( $repeater_setting_key, 'class', [ 'skt-icon-list-text', 'skt-post-info__item', 'skt-post-info__item--type-' . $item_data['type'] ] );
		if ( ! empty( $item['terms_list'] ) ) {
			$this->add_render_attribute( $repeater_setting_key, 'class', 'skt-terms-list' );
		}

		?>
		<span <?php echo wp_kses_post($this->get_render_attribute_string( $repeater_setting_key )); ?>>
			<?php if ( ! empty( $item_data['text_prefix'] ) ) : ?>
				<span class="skt-post-info__item-prefix"><?php echo esc_html( $item_data['text_prefix'] ); ?></span>
			<?php endif; ?>
			<?php
			if ( ! empty( $item_data['terms_list'] ) ) :
				$terms_list = [];
				$item_class = 'skt-post-info__terms-list-item';
				?>
				<span class="skt-post-info__terms-list">
				<?php
				foreach ( $item_data['terms_list'] as $term ) :
					if ( ! empty( $term['url'] ) ) :
						$terms_list[] = '<a href="' . esc_attr( $term['url'] ) . '" class="' . $item_class . '">' . esc_html( $term['text'] ) . '</a>';
					else :
						$terms_list[] = '<span class="' . $item_class . '">' . esc_html( $term['text'] ) . '</span>';
					endif;
				endforeach;

				echo wp_kses_post(implode( ', ', $terms_list ));
				?>
				</span>
			<?php else : ?>
				<?php
				echo wp_kses( $item_data['text'], [
					'a' => [
						'href' => [],
						'title' => [],
						'rel' => [],
					],
				] );
				?>
			<?php endif; ?>
		</span>
		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		ob_start();
		if ( ! empty( $settings['icon_list'] ) ) {
			foreach ( $settings['icon_list'] as $repeater_item ) {
				$this->render_item( $repeater_item );
			}
		}
		$items_html = ob_get_clean();

		if ( empty( $items_html ) ) {
			return;
		}

		if ( 'inline' === $settings['view'] ) {
			$this->add_render_attribute( 'icon_list', 'class', 'skt-inline-items' );
		}

		$this->add_render_attribute( 'icon_list', 'class', [ 'skt-icon-list-items', 'skt-post-info' ] );
		?>
		<ul <?php echo wp_kses_post($this->get_render_attribute_string( 'icon_list' )); ?>>
			<?php echo $items_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped  ?>
		</ul>
		<?php
	}


}