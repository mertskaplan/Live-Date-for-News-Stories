<?php
/**
*	Name: Live Date for News Stories
*	Version: 1.0
*	Author: Mert S. Kaplan, @mertskaplan
*	Contact: mail@mertskaplan.com
*	Licanse: GNU General Public License v3.0
**/

function liveDateForNewsStory($date, $capital = false, $dateFormat = 'little-endian') {
	if ($dateFormat == 'timestamp') {
		$timestamp = $date;
	} else {
    	$timestamp = strtotime($date);
	}

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
	return ($capital == true) ? ucfirst($return) : $return;
}
