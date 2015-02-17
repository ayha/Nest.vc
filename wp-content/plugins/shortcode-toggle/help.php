<?php
function shortcode_toggle_register_options_page() {
	add_management_page(__('Shortcode Toggle Help Page', SHORTCODE_TOGGLE_TEXT_DOMAIN), __('Shortcode Toggle', SHORTCODE_TOGGLE_TEXT_DOMAIN), 'manage_options', SHORTCODE_TOGGLE_TEXT_DOMAIN.'-help', 'shortcode_toggle_help_page');
}
add_action('admin_menu', 'shortcode_toggle_register_options_page');

function shortcode_toggle_help_page() {
?>
<style>
.padding-bottom{
	padding-bottom: 20px;
}
</style>
<div class="wrap">
	<h2><?php _e("Shortcode Toggle Help Page", SHORTCODE_TOGGLE_TEXT_DOMAIN); ?></h2>
	<div class="help-page">
		<?php settings_fields('shortcode_toggle_options'); ?>
		<h3><?php _e("Shortcode Usage", SHORTCODE_TOGGLE_TEXT_DOMAIN); ?></h3>
		<p><?php _e("You may add following short code to your post.", SHORTCODE_TOGGLE_TEXT_DOMAIN); ?></p>
		<div>
			<code>[toggle title="<?php _e("Title", SHORTCODE_TOGGLE_TEXT_DOMAIN); ?>"]<?php _e("Some Content...", SHORTCODE_TOGGLE_TEXT_DOMAIN); ?>[/toggle]</code>
			<div style="padding-bottom: 20px;"></div>
			<?php echo do_shortcode('[toggle title="'.__("Title", SHORTCODE_TOGGLE_TEXT_DOMAIN).'"]'.__("Some Content...", SHORTCODE_TOGGLE_TEXT_DOMAIN).'[/toggle]'); ?>
		</div>
	</div>
</div>
<?php
}
?>