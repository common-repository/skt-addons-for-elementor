<?php
/**
 * Source Code
 *
 * @package Skt_Addons_Elementor
 */

namespace Skt_Addons_Elementor\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;

defined('ABSPATH') || die();

class Source_Code extends Base {

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0
	 * @access public
	 *
	 */
	public function get_title() {
		return __('Source Code', 'skt-addons-for-elementor');
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'skti skti-code-browser';
	}

	public function get_keywords() {
		return ['source-code', 'source', 'code'];
	}

	public function lng_type() {
		return [
			'markup' => __('HTML Markup', 'skt-addons-for-elementor'),
			'css' => __('CSS', 'skt-addons-for-elementor'),
			'clike' => __('Clike', 'skt-addons-for-elementor'),
			'javascript' => __('JavaScript', 'skt-addons-for-elementor'),
			'abap' => __('ABAP', 'skt-addons-for-elementor'),
			'abnf' => __('Augmented Backus–Naur form', 'skt-addons-for-elementor'),
			'actionscript' => __('ActionScript', 'skt-addons-for-elementor'),
			'ada' => __('Ada', 'skt-addons-for-elementor'),
			'apacheconf' => __('Apache Configuration', 'skt-addons-for-elementor'),
			'apl' => __('APL', 'skt-addons-for-elementor'),
			'applescript' => __('AppleScript', 'skt-addons-for-elementor'),
			'arduino' => __('Arduino', 'skt-addons-for-elementor'),
			'arff' => __('ARFF', 'skt-addons-for-elementor'),
			'asciidoc' => __('AsciiDoc', 'skt-addons-for-elementor'),
			'asm6502' => __('6502 Assembly', 'skt-addons-for-elementor'),
			'aspnet' => __('ASP.NET (C#)', 'skt-addons-for-elementor'),
			'autohotkey' => __('AutoHotkey', 'skt-addons-for-elementor'),
			'autoit' => __('Autoit', 'skt-addons-for-elementor'),
			'bash' => __('Bash', 'skt-addons-for-elementor'),
			'basic' => __('BASIC', 'skt-addons-for-elementor'),
			'batch' => __('Batch', 'skt-addons-for-elementor'),
			'bison' => __('Bison', 'skt-addons-for-elementor'),
			'bnf' => __('Bnf', 'skt-addons-for-elementor'),
			'brainfuck' => __('Brainfuck', 'skt-addons-for-elementor'),
			'bro' => __('Bro', 'skt-addons-for-elementor'),
			'c' => __('C', 'skt-addons-for-elementor'),
			'csharp' => __('Csharp', 'skt-addons-for-elementor'),
			'cpp' => __('Cpp', 'skt-addons-for-elementor'),
			'cil' => __('Cil', 'skt-addons-for-elementor'),
			'coffeescript' => __('Coffeescript', 'skt-addons-for-elementor'),
			'cmake' => __('Cmake', 'skt-addons-for-elementor'),
			'clojure' => __('Clojure', 'skt-addons-for-elementor'),
			'crystal' => __('Crystal', 'skt-addons-for-elementor'),
			'csp' => __('Csp', 'skt-addons-for-elementor'),
			'css-extras' => __('Css-extras', 'skt-addons-for-elementor'),
			'd' => __('D', 'skt-addons-for-elementor'),
			'dart' => __('Dart', 'skt-addons-for-elementor'),
			'diff' => __('Diff', 'skt-addons-for-elementor'),
			'django' => __('Django', 'skt-addons-for-elementor'),
			'dns-zone-file' => __('Dns-zone-file', 'skt-addons-for-elementor'),
			'docker' => __('Docker', 'skt-addons-for-elementor'),
			'ebnf' => __('Ebnf', 'skt-addons-for-elementor'),
			'eiffel' => __('Eiffel', 'skt-addons-for-elementor'),
			'ejs' => __('Ejs', 'skt-addons-for-elementor'),
			'elixir' => __('Elixir', 'skt-addons-for-elementor'),
			'elm' => __('Elm', 'skt-addons-for-elementor'),
			'erb' => __('Erb', 'skt-addons-for-elementor'),
			'erlang' => __('Erlang', 'skt-addons-for-elementor'),
			'fsharp' => __('Fsharp', 'skt-addons-for-elementor'),
			'firestore-security-rules' => __('Firestore-security-rules', 'skt-addons-for-elementor'),
			'flow' => __('Flow', 'skt-addons-for-elementor'),
			'fortran' => __('Fortran', 'skt-addons-for-elementor'),
			'gcode' => __('Gcode', 'skt-addons-for-elementor'),
			'gdscript' => __('Gdscript', 'skt-addons-for-elementor'),
			'gedcom' => __('Gedcom', 'skt-addons-for-elementor'),
			'gherkin' => __('Gherkin', 'skt-addons-for-elementor'),
			'git' => __('Git', 'skt-addons-for-elementor'),
			'glsl' => __('Glsl', 'skt-addons-for-elementor'),
			'gml' => __('Gml', 'skt-addons-for-elementor'),
			'go' => __('Go', 'skt-addons-for-elementor'),
			'graphql' => __('Graphql', 'skt-addons-for-elementor'),
			'groovy' => __('Groovy', 'skt-addons-for-elementor'),
			'haml' => __('Haml', 'skt-addons-for-elementor'),
			'handlebars' => __('Handlebars', 'skt-addons-for-elementor'),
			'haskell' => __('Haskell', 'skt-addons-for-elementor'),
			'haxe' => __('Haxe', 'skt-addons-for-elementor'),
			'hcl' => __('Hcl', 'skt-addons-for-elementor'),
			'http' => __('Http', 'skt-addons-for-elementor'),
			'hpkp' => __('Hpkp', 'skt-addons-for-elementor'),
			'hsts' => __('Hsts', 'skt-addons-for-elementor'),
			'ichigojam' => __('Ichigojam', 'skt-addons-for-elementor'),
			'icon' => __('Icon', 'skt-addons-for-elementor'),
			'inform7' => __('Inform7', 'skt-addons-for-elementor'),
			'ini' => __('Ini', 'skt-addons-for-elementor'),
			'io' => __('Io', 'skt-addons-for-elementor'),
			'j' => __('J', 'skt-addons-for-elementor'),
			'java' => __('Java', 'skt-addons-for-elementor'),
			'javadoc' => __('Javadoc', 'skt-addons-for-elementor'),
			'javadoclike' => __('Javadoclike', 'skt-addons-for-elementor'),
			'javastacktrace' => __('Javastacktrace', 'skt-addons-for-elementor'),
			'jolie' => __('Jolie', 'skt-addons-for-elementor'),
			'jq' => __('Jq', 'skt-addons-for-elementor'),
			'jsdoc' => __('Jsdoc', 'skt-addons-for-elementor'),
			'js-extras' => __('Js-extras', 'skt-addons-for-elementor'),
			'js-templates' => __('Js-templates', 'skt-addons-for-elementor'),
			'json' => __('Json', 'skt-addons-for-elementor'),
			'jsonp' => __('Jsonp', 'skt-addons-for-elementor'),
			'json5' => __('Json5', 'skt-addons-for-elementor'),
			'julia' => __('Julia', 'skt-addons-for-elementor'),
			'keyman' => __('Keyman', 'skt-addons-for-elementor'),
			'kotlin' => __('Kotlin', 'skt-addons-for-elementor'),
			'latex' => __('Latex', 'skt-addons-for-elementor'),
			'less' => __('Less', 'skt-addons-for-elementor'),
			'lilypond' => __('Lilypond', 'skt-addons-for-elementor'),
			'liquid' => __('Liquid', 'skt-addons-for-elementor'),
			'lisp' => __('Lisp', 'skt-addons-for-elementor'),
			'livescript' => __('Livescript', 'skt-addons-for-elementor'),
			'lolcode' => __('Lolcode', 'skt-addons-for-elementor'),
			'lua' => __('Lua', 'skt-addons-for-elementor'),
			'makefile' => __('Makefile', 'skt-addons-for-elementor'),
			'markdown' => __('Markdown', 'skt-addons-for-elementor'),
			'markup-templating' => __('Markup-templating', 'skt-addons-for-elementor'),
			'matlab' => __('Matlab', 'skt-addons-for-elementor'),
			'mel' => __('Mel', 'skt-addons-for-elementor'),
			'mizar' => __('Mizar', 'skt-addons-for-elementor'),
			'monkey' => __('Monkey', 'skt-addons-for-elementor'),
			'n1ql' => __('N1ql', 'skt-addons-for-elementor'),
			'n4js' => __('N4js', 'skt-addons-for-elementor'),
			'nand2tetris-hdl' => __('Nand2tetris-hdl', 'skt-addons-for-elementor'),
			'nasm' => __('Nasm', 'skt-addons-for-elementor'),
			'nginx' => __('Nginx', 'skt-addons-for-elementor'),
			'nim' => __('Nim', 'skt-addons-for-elementor'),
			'nix' => __('Nix', 'skt-addons-for-elementor'),
			'nsis' => __('Nsis', 'skt-addons-for-elementor'),
			'objectivec' => __('Objectivec', 'skt-addons-for-elementor'),
			'ocaml' => __('Ocaml', 'skt-addons-for-elementor'),
			'opencl' => __('Opencl', 'skt-addons-for-elementor'),
			'oz' => __('Oz', 'skt-addons-for-elementor'),
			'parigp' => __('Parigp', 'skt-addons-for-elementor'),
			'parser' => __('Parser', 'skt-addons-for-elementor'),
			'pascal' => __('Pascal', 'skt-addons-for-elementor'),
			'pascaligo' => __('Pascaligo', 'skt-addons-for-elementor'),
			'pcaxis' => __('Pcaxis', 'skt-addons-for-elementor'),
			'perl' => __('Perl', 'skt-addons-for-elementor'),
			'php' => __('Php', 'skt-addons-for-elementor'),
			'phpdoc' => __('Phpdoc', 'skt-addons-for-elementor'),
			'php-extras' => __('Php-extras', 'skt-addons-for-elementor'),
			'plsql' => __('Plsql', 'skt-addons-for-elementor'),
			'powershell' => __('Powershell', 'skt-addons-for-elementor'),
			'processing' => __('Processing', 'skt-addons-for-elementor'),
			'prolog' => __('Prolog', 'skt-addons-for-elementor'),
			'properties' => __('Properties', 'skt-addons-for-elementor'),
			'protobuf' => __('Protobuf', 'skt-addons-for-elementor'),
			'pug' => __('Pug', 'skt-addons-for-elementor'),
			'puppet' => __('Puppet', 'skt-addons-for-elementor'),
			'pure' => __('Pure', 'skt-addons-for-elementor'),
			'python' => __('Python', 'skt-addons-for-elementor'),
			'q' => __('Q', 'skt-addons-for-elementor'),
			'qore' => __('Qore', 'skt-addons-for-elementor'),
			'r' => __('R', 'skt-addons-for-elementor'),
			'jsx' => __('Jsx', 'skt-addons-for-elementor'),
			'tsx' => __('Tsx', 'skt-addons-for-elementor'),
			'renpy' => __('Renpy', 'skt-addons-for-elementor'),
			'reason' => __('Reason', 'skt-addons-for-elementor'),
			'regex' => __('Regex', 'skt-addons-for-elementor'),
			'rest' => __('Rest', 'skt-addons-for-elementor'),
			'rip' => __('Rip', 'skt-addons-for-elementor'),
			'roboconf' => __('Roboconf', 'skt-addons-for-elementor'),
			'ruby' => __('Ruby', 'skt-addons-for-elementor'),
			'rust' => __('Rust', 'skt-addons-for-elementor'),
			'sas' => __('Sas', 'skt-addons-for-elementor'),
			'sass' => __('Sass', 'skt-addons-for-elementor'),
			'scss' => __('Scss', 'skt-addons-for-elementor'),
			'scala' => __('Scala', 'skt-addons-for-elementor'),
			'scheme' => __('Scheme', 'skt-addons-for-elementor'),
			'shell-session' => __('Shell-session', 'skt-addons-for-elementor'),
			'smalltalk' => __('Smalltalk', 'skt-addons-for-elementor'),
			'smarty' => __('Smarty', 'skt-addons-for-elementor'),
			'soy' => __('Soy', 'skt-addons-for-elementor'),
			'splunk-spl' => __('Splunk-spl', 'skt-addons-for-elementor'),
			'sql' => __('Sql', 'skt-addons-for-elementor'),
			'stylus' => __('Stylus', 'skt-addons-for-elementor'),
			'swift' => __('Swift', 'skt-addons-for-elementor'),
			'tap' => __('Tap', 'skt-addons-for-elementor'),
			'tcl' => __('Tcl', 'skt-addons-for-elementor'),
			'textile' => __('Textile', 'skt-addons-for-elementor'),
			'toml' => __('Toml', 'skt-addons-for-elementor'),
			'tt2' => __('Tt2', 'skt-addons-for-elementor'),
			'turtle' => __('Turtle', 'skt-addons-for-elementor'),
			'twig' => __('Twig', 'skt-addons-for-elementor'),
			'typescript' => __('Typescript', 'skt-addons-for-elementor'),
			't4-cs' => __('T4-cs', 'skt-addons-for-elementor'),
			't4-vb' => __('T4-vb', 'skt-addons-for-elementor'),
			't4-templating' => __('T4-templating', 'skt-addons-for-elementor'),
			'vala' => __('Vala', 'skt-addons-for-elementor'),
			'vbnet' => __('Vbnet', 'skt-addons-for-elementor'),
			'velocity' => __('Velocity', 'skt-addons-for-elementor'),
			'verilog' => __('Verilog', 'skt-addons-for-elementor'),
			'vhdl' => __('Vhdl', 'skt-addons-for-elementor'),
			'vim' => __('Vim', 'skt-addons-for-elementor'),
			'visual-basic' => __('Visual-basic', 'skt-addons-for-elementor'),
			'wasm' => __('Wasm', 'skt-addons-for-elementor'),
			'wiki' => __('Wiki', 'skt-addons-for-elementor'),
			'xeora' => __('Xeora', 'skt-addons-for-elementor'),
			'xojo' => __('Xojo', 'skt-addons-for-elementor'),
			'xquery' => __('Xquery', 'skt-addons-for-elementor'),
			'yaml' => __('Yaml', 'skt-addons-for-elementor'),
		];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {
		$this->__source_code_content_controls();
		$this->__custom_color_content_controls();
	}

	protected function __source_code_content_controls() {

		$this->start_controls_section(
			'_section_source_code',
			[
				'label' => __('Source Code', 'skt-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'lng_type',
			[
				'label' => __('Language Type', 'skt-addons-for-elementor'),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'markup',
				'options' => $this->lng_type(),
			]
		);

		$this->add_control(
			'theme',
			[
				'label' => __('Theme', 'skt-addons-for-elementor'),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'prism',
				'options' => [
					'prism' => __('Default', 'skt-addons-for-elementor'),
					'prism-coy' => __('Coy', 'skt-addons-for-elementor'),
					'prism-dark' => __('Dark', 'skt-addons-for-elementor'),
					'prism-funky' => __('Funky', 'skt-addons-for-elementor'),
					'prism-okaidia' => __('Okaidia', 'skt-addons-for-elementor'),
					'prism-solarizedlight' => __('Solarized light', 'skt-addons-for-elementor'),
					'prism-tomorrow' => __('Tomorrow', 'skt-addons-for-elementor'),
					'prism-twilight' => __('Twilight', 'skt-addons-for-elementor'),
					'custom' => __('Custom Color', 'skt-addons-for-elementor'),
				],
                'style_transfer' => true,
			]
		);

		$this->add_control(
			'source_code',
			[
				'label' => __('Source Code', 'skt-addons-for-elementor'),
				'type' => Controls_Manager::CODE,
				'rows' => 20,
				'default' => '<p class="random-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>',
				'placeholder' => __('Source Code....', 'skt-addons-for-elementor'),
				'condition' => [
					'lng_type!' => '',
				],
			]
		);
		$this->add_control(
			'copy_btn_text_show',
			[
				'label' => __('Copy Button Text Show?', 'skt-addons-for-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
                'style_transfer' => true,
			]
		);
		$this->add_control(
			'copy_btn_text',
			[
				'label' => __('Copy Button Text', 'skt-addons-for-elementor'),
				'type' => Controls_Manager::TEXT,
				'rows' => 10,
				'default' => __('Copy to clipboard', 'skt-addons-for-elementor'),
				'placeholder' => __('Copy Button Text', 'skt-addons-for-elementor'),
				'condition' => [
					'copy_btn_text_show' => 'yes',
				],
			]
		);
		$this->add_control(
			'after_copy_btn_text',
			[
				'label' => __('After Copy Button Text', 'skt-addons-for-elementor'),
				'type' => Controls_Manager::TEXT,
				'rows' => 10,
				'default' => __('Copied', 'skt-addons-for-elementor'),
				'placeholder' => __('Copied', 'skt-addons-for-elementor'),
				'condition' => [
					'copy_btn_text_show' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __custom_color_content_controls() {

		$this->start_controls_section(
			'_section_source_code_custom_color',
			[
				'label' => __('Custom Color', 'skt-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'theme' => 'custom',
				],
			]
		);
		$this->add_control(
			'custom_background',
			[
				'label' => __( 'Background Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom :not(pre) > code[class*="language-"],{{WRAPPER}} .custom pre[class*="language-"]' => 'background: {{VALUE}}',
				],
				'condition' => [
					'theme' => 'custom',
				],
			]
		);
		$this->add_control(
			'custom_text_color',
			[
				'label' => __( 'Text Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom code[class*="language-"],{{WRAPPER}} .custom pre[class*="language-"]' => 'color: {{VALUE}}',
				],
				'condition' => [
					'theme' => 'custom',
				],
			]
		);
		$this->add_control(
			'custom_text_shadow_color',
			[
				'label' => __( 'Text shadow Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom code[class*="language-"],{{WRAPPER}} .custom pre[class*="language-"]' => 'text-shadow: 0 1px {{VALUE}}',
				],
				'condition' => [
					'theme' => 'custom',
				],
			]
		);
		$this->add_control(
			'custom_slate_gray',
			[
				'label' => __( 'Slate Gray Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom .token.comment,{{WRAPPER}} .custom .token.prolog,{{WRAPPER}} .custom .token.doctype,{{WRAPPER}} .custom .token.cdata' => 'color: {{VALUE}}',
				],
				'condition' => [
					'theme' => 'custom',
				],
			]
		);
		$this->add_control(
			'custom_dusty_gray',
			[
				'label' => __( 'Dusty Gray Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom .token.punctuation' => 'color: {{VALUE}}',
				],
				'condition' => [
					'theme' => 'custom',
				],
			]
		);
		$this->add_control(
			'custom_fresh_eggplant',
			[
				'label' => __( 'Fresh Eggplant Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom .token.property,{{WRAPPER}} .custom .token.tag,{{WRAPPER}} .custom .token.boolean,{{WRAPPER}} .custom .token.number,{{WRAPPER}} .custom .token.constant,{{WRAPPER}} .custom .token.symbol,{{WRAPPER}} .custom .token.deleted' => 'color: {{VALUE}}',
				],
				'condition' => [
					'theme' => 'custom',
				],
			]
		);
		$this->add_control(
			'custom_limeade',
			[
				'label' => __( 'Limeade Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom .token.selector,{{WRAPPER}} .custom .token.attr-name,{{WRAPPER}} .custom .token.string,{{WRAPPER}} .custom .token.char,{{WRAPPER}} .custom .token.builtin,{{WRAPPER}} .custom .token.inserted' => 'color: {{VALUE}}',
				],
				'condition' => [
					'theme' => 'custom',
				],
			]
		);
		$this->add_control(
			'custom_sepia_skin',
			[
				'label' => __( 'Sepia Skin Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom .token.operator,{{WRAPPER}} .custom .token.entity,{{WRAPPER}} .custom .token.url,{{WRAPPER}} .custom .language-css .token.string,{{WRAPPER}} .custom .style .token.string' => 'color: {{VALUE}}',
				],
				'condition' => [
					'theme' => 'custom',
				],
			]
		);
		$this->add_control(
			'custom_xanadu',
			[
				'label' => __( 'Xanadu Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom .token.operator,{{WRAPPER}} .custom .token.entity,{{WRAPPER}} .custom .token.url,{{WRAPPER}} .custom .language-css .token.string,{{WRAPPER}} .custom .style .token.string' => 'background: {{VALUE}}',
				],
				'condition' => [
					'theme' => 'custom',
				],
			]
		);
		$this->add_control(
			'custom_deep_cerulean',
			[
				'label' => __( 'Deep Cerulean Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom .token.atrule,{{WRAPPER}} .custom .token.attr-value,{{WRAPPER}} .custom .token.keyword' => 'color: {{VALUE}}',
				],
				'condition' => [
					'theme' => 'custom',
				],
			]
		);
		$this->add_control(
			'custom_cabaret',
			[
				'label' => __( 'Cabaret Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom .token.function,{{WRAPPER}} .custom .token.class-name' => 'color: {{VALUE}}',
				],
				'condition' => [
					'theme' => 'custom',
				],
			]
		);
		$this->add_control(
			'custom_tangerine',
			[
				'label' => __( 'Tangerine Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom .token.regex,{{WRAPPER}} .custom .token.important,{{WRAPPER}} .custom .token.variable' => 'color: {{VALUE}}',
				],
				'condition' => [
					'theme' => 'custom',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
     * Register widget style controls
     */
	protected function register_style_controls() {

		$this->start_controls_section(
			'_section_source_code_style',
			[
				'label' => __('Style', 'skt-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'source_code_box_height',
			[
				'label' => __('Height', 'skt-addons-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .skt-source-code pre' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __('Box Border', 'skt-addons-for-elementor'),
				'selector' => '{{WRAPPER}}  .skt-source-code pre[class*="language-"]',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label' => __('Border Radius', 'skt-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .skt-source-code pre[class*="language-"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'source_code_box_padding',
			[
				'label' => __('Padding', 'skt-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .skt-source-code pre' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'source_code_box_margin',
			[
				'label' => __('Margin', 'skt-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .skt-source-code pre' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'copy_btn_color',
			[
				'label' => __( 'Copy Button Text Color', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-copy-code-button' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
				'condition' => [
					'copy_btn_text_show' => 'yes',
				],
			]
		);

		$this->add_control(
			'copy_btn_bg',
			[
				'label' => __( 'Copy Button Background', 'skt-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skt-copy-code-button' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'copy_btn_text_show' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$source_code = $settings['source_code'];
		$theme = !empty($settings['theme']) ? $settings['theme'] : 'prism';
		$this->add_render_attribute('skt-code-wrap', 'class', 'skt-source-code');
		$this->add_render_attribute('skt-code-wrap', 'class', $theme);
		$this->add_render_attribute('skt-code-wrap', 'data-lng-type', $settings['lng_type']);
		if ('yes' == $settings['copy_btn_text_show'] && $settings['after_copy_btn_text']) {
			$this->add_render_attribute('skt-code-wrap', 'data-after-copy', $settings['after_copy_btn_text']);
		}
		$this->add_render_attribute('skt-code', 'class', 'language-' . $settings['lng_type']);
		?>
		<?php if (!empty($source_code)): ?>
			<div <?php $this->print_render_attribute_string('skt-code-wrap'); ?>>
			<pre>
			<?php if ('yes' == $settings['copy_btn_text_show'] && $settings['copy_btn_text']): ?>
				<button class="skt-copy-code-button"><?php echo esc_html($settings['copy_btn_text']) ?></button>
			<?php endif; ?>
				<code <?php $this->print_render_attribute_string('skt-code'); ?>>
					<?php echo esc_html($source_code); ?>
				</code>
			</pre>
			</div>
		<?php endif; ?>
		<?php
	}

	public function content_template() {
		?>
		<#
		var source_code = settings.source_code;
		view.addRenderAttribute( 'skt-code-wrap', 'class', 'skt-source-code');
		view.addRenderAttribute( 'skt-code-wrap', 'class', settings.theme);
		view.addRenderAttribute( 'skt-code-wrap', 'data-lng-type', settings.lng_type);
		if('yes' == settings.copy_btn_text_show && settings.after_copy_btn_text){
		view.addRenderAttribute( 'skt-code-wrap', 'data-after-copy', settings.after_copy_btn_text);
		}
		view.addRenderAttribute( 'skt-code', 'class', 'language-'+settings.lng_type);

		#>
		<# if( source_code ){ #>
		<div {{{ view.getRenderAttributeString( 'skt-code-wrap' ) }}}>
		<pre>
			<# if( 'yes' == settings.copy_btn_text_show && settings.copy_btn_text ){ #>
				<button class="skt-copy-code-button">{{{settings.copy_btn_text}}}</button>
			<# } #>
				<code {{{ view.getRenderAttributeString( 'skt-code' ) }}}>{{ source_code }}</code>
			</pre>
		</div>
		<# } #>

		<?php
	}
}