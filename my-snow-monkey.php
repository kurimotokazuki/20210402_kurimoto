<?php
/**
 * Plugin name: My Snow Monkey
 * Description: このプラグインに、あなたの Snow Monkey 用カスタマイズコードを書いてください。
 * Version: 0.1.1
 *
 * @package my-snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Snow Monkey 以外のテーマを利用している場合は有効化してもカスタマイズが反映されないようにする
 */
$theme = wp_get_theme( get_template() );
if ( 'snow-monkey' !== $theme->template && 'snow-monkey/resources' !== $theme->template ) {
	return;
}
// 実際のページ用の CSS 読み込み
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_style(
			'my-snow-monkey',
			untrailingslashit( plugin_dir_url( __FILE__ ) ) . '/style.css',
			[ Framework\Helper::get_main_style_handle() ],
			filemtime( plugin_dir_path( __FILE__ ) )
		);
	}
);

// エディター用の CSS 読み込み
add_action(
	'after_setup_theme',
	function() {
		add_editor_style( '/../../plugins/my-snow-monkey/style.css' );
	}
);

add_action(
	'snow_monkey_prepend_body',
	function() {
		?>
		<div class="c-page-effect" data-page-effect="fadein" aria-hidden="false">
			<div class="c-page-effect__item">
				<div class="c-circle-spinner"></div>
			</div>
		</div>
		<?php
	}
);

