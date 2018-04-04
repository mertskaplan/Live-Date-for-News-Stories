<?php
/**
*	Plugin Name: Live Date for News Stories
*	Text Domain: live-date-for-news-stories
*	Doman Path: /lang
*	Plugin URI: https://lab.mertskaplan.com/liveDate4news
*	Description: Haberler için okurun zaman çizgisine göre değişen "ne zaman" bilgisi. <code>[liveDate4news]15.4.2018 17:41[/liveDate4news]</code> şeklinde kısa kod ile kullanabilirsiniz.
*	Version: 1.0
*	License: GNU GPL v3
*	Author: Mert S. Kaplan <mail@mertskaplan.com>
*	Author URI: https://mertskaplan.com
**/

load_plugin_textdomain( 'live-date-for-news-stories', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
function liveDate4news($capital, $content) {
	$timestamp = strtotime($content);
	$now = time();
	$date = date('j F Y', $now);
	$littleAgo = $now - (60 * 20);
	$today = strtotime($date);
	$yesterday = strtotime($date . '-1 day');
	$pastDays = strtotime($date . '-3 day');
	$lastWeek = strtotime($date . '-7 day');

	if ($timestamp > $now) {
		$return = __('ERROR!', 'live-date-for-news-stories');
	} elseif ($timestamp >= $littleAgo) {
		$return = __('a little ago');
	} elseif ($timestamp >= $today) {
		$return = __('today', 'live-date-for-news-stories');
	} elseif ($timestamp >= $yesterday) {
		$return = __('yesterday', 'live-date-for-news-stories');
	} elseif ($timestamp >= $pastDays) {
		$return = __('in the past days', 'live-date-for-news-stories');
	} elseif ($timestamp >= $lastWeek && date('W', $timestamp) == date('W', $now)) {
		$return = __('in the past days', 'live-date-for-news-stories');
	} elseif ($timestamp >= $lastWeek && (date('W', $timestamp) == date('W', $now) - 1 || (date('W', $timestamp) == 12 && date('W', $now) == 1))) {
		$return = __('last week', 'live-date-for-news-stories');
	} elseif (date('n Y', $timestamp) == date('n Y', $now)) {
		$return = __('in the past few weeks', 'live-date-for-news-stories');
	} elseif ((date('Y', $timestamp) == date('Y', $now) && (date('n', $timestamp) == date('n', $now) - 1)) || (date('Y', $timestamp) == date('Y', $now) - 1 && (date('n', $timestamp) == 12 && date('n', $now) == 1))) {
		$return = __('last month', 'live-date-for-news-stories');
	} else {
		if (WPLANG == 'tr_TR') {
			setlocale(LC_TIME, 'tr_TR.UTF-8');
			$return = strftime('%e %B %Y', $timestamp) .' tarihinde';
		} else {
			$return = __('on', 'live-date-for-news-stories'). date(' j F, Y', $timestamp);
		}
	}
	return (empty($capital)) ? $return : ucfirst($return);
}
add_shortcode('liveDate4news', 'liveDate4news');
function shortcode_button_script() {
    if(wp_script_is("quicktags")) {
?>
		<script type="text/javascript">
			function getSel()
			{
				var txtarea = document.getElementById("content");
				var start = txtarea.selectionStart;
				var finish = txtarea.selectionEnd;
				return txtarea.value.substring(start, finish);
			}
			QTags.addButton(
				"code_shortcode",
				"liveDate4news",
				callback
			);

			function callback()
			{
				var selected_text = getSel();
				QTags.insertContent("[liveDate4news]" +  selected_text + "[/liveDate4news]");
			}
		</script>
<?php
    }
}
add_action("admin_print_footer_scripts", "shortcode_button_script");
