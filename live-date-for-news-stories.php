<?php
/**
*	Plugin Name: Live Date for News Stories
* Text Domain: live-date-for-news-stories
*	Plugin URI: https://lab.mertskaplan.com/liveDate4news
*	Description: Haberler için okurun zaman çizgisine göre değişen "ne zaman" bilgisi. <code>[liveDate4news]15.4.2018 17:41[/liveDate4news]</code> şeklinde kısa kod ile kullanabilirsiniz.
*	Version: 1.0
*	License: GNU GPL v3
*	Author: Mert S. Kaplan <mail@mertskaplan.com>
*	Author URI: https://mertskaplan.com
**/

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
		$return = 'ERROR!';
	} elseif ($timestamp >= $littleAgo) {
		$return = 'biraz önce';
	} elseif ($timestamp >= $today) {
		$return = 'bugün';
	} elseif ($timestamp >= $yesterday) {
		$return = 'dün';
	} elseif ($timestamp >= $pastDays) {
		$return = 'geçtiğimiz günlerde';
	} elseif ($timestamp >= $lastWeek && date('W', $timestamp) == date('W', $now)) {
		$return = 'geçtiğimiz günlerde';
	} elseif ($timestamp >= $lastWeek && (date('W', $timestamp) == date('W', $now) - 1 || (date('W', $timestamp) == 12 && date('W', $now) == 1))) {
		$return = 'geçen hafta';
	} elseif (date('n Y', $timestamp) == date('n Y', $now)) {
		$return = 'geçtiğimiz haftalarda';
	} elseif ((date('Y', $timestamp) == date('Y', $now) && (date('n', $timestamp) == date('n', $now) - 1)) || (date('Y', $timestamp) == date('Y', $now) - 1 && (date('n', $timestamp) == 12 && date('n', $now) == 1))) {
		$return = 'geçen ay';
	} else {
		$return = strftime('%e %B %Y', $timestamp) .' tarihinde';
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
