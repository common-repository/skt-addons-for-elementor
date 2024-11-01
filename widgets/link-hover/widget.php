<?php
/**
 * Link Hover widget class
 *
 * @package Skt_Addons_Elementor
 */

namespace Skt_Addons_Elementor\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Skt_Addons_Elementor\Elementor\Traits\Link_Hover_Markup;

class Link_Hover extends Base {
	use Link_Hover_Markup;

	/**
	 * Get widget title.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Animated Link', 'skt-addons-for-elementor' );
	}

	public function get_custom_help_url() {
		return '#';
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'skti skti-animated-link';
	}

	public function get_keywords() {
		return array('link', 'hover', 'animation');
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {

		$this->start_controls_section(
			'_section_title',
			array(
				'label' => __( 'Link Content', 'skt-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'animation_style',
			array(
				'label'   => __( 'Animation Style', 'skt-addons-for-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'carpo',
				'options' => array(
					'carpo'   => __( 'Carpo', 'skt-addons-for-elementor' ),
					'carme'   => __( 'Carme', 'skt-addons-for-elementor' ),
					'dia'     => __( 'Dia', 'skt-addons-for-elementor' ),
					'eirene'  => __( 'Eirene', 'skt-addons-for-elementor' ),
					'elara'   => __( 'Elara', 'skt-addons-for-elementor' ),
					'ersa'    => __( 'Ersa', 'skt-addons-for-elementor' ),
					'helike'  => __( 'Helike', 'skt-addons-for-elementor' ),
					'herse'   => __( 'Herse', 'skt-addons-for-elementor' ),
					'io'      => __( 'Io', 'skt-addons-for-elementor' ),
					'iocaste' => __( 'Iocaste', 'skt-addons-for-elementor' ),
					'kale'    => __( 'Kale', 'skt-addons-for-elementor' ),
					'leda'    => __( 'Leda', 'skt-addons-for-elementor' ),
					'metis'   => __( 'Metis', 'skt-addons-for-elementor' ),
					'mneme'   => __( 'Mneme', 'skt-addons-for-elementor' ),
					'thebe'   => __( 'Thebe', 'skt-addons-for-elementor' ),
				),
			)
		);

		$this->add_control(
			'link_text',
			array(
				'label'       => __( 'Title', 'skt-addons-for-elementor' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Animated Link', 'skt-addons-for-elementor' ),
				'placeholder' => __( 'Type Link Title', 'skt-addons-for-elementor' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_responsive_control(
            'link_align',
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
                    ]
                ],
                'default' => 'left',
                'toggle' => true,
                // 'prefix_class' => 'skt-align-',
                'selectors_dictionary' => [
                    'left' => 'justify-content: flex-start',
                    'center' => 'justify-content: center',
                    'right' => 'justify-content: flex-end',
                ],
                'selectors' => [
                    '{{WRAPPER}} .skt_addons_elementor_content__item' => '{{VALUE}}'
                ]
            ]
        );

		$this->add_control(
			'link_url',
			array(
				'label'         => __( 'Link', 'skt-addons-for-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'skt-addons-for-elementor' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => false,
					'nofollow'    => true,
				),
			)
		);

		$this->end_controls_section();
	}

	/**
     * Register widget style controls
     */
	protected function register_style_controls() {

		$this->start_controls_section(
			'_section_media_style',
			array(
				'label' => __( 'Link Content', 'skt-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => __( 'Content Box Padding', 'skt-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .skt_addons_elementor_content__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Link Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .skt-link' => 'color: {{VALUE}};',
				),
			)
		);

        $this->add_control(
			'title_hover_color',
			array(
				'label'     => __( 'Link Hover Color', 'skt-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .skt-link:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'skt-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .skt-link',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		self::{'render_' . $settings['animation_style'] . '_markup'}( $settings );
	}
}