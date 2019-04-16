<?php

namespace Inc\Base;

/**
 * Class Deactivate
 * @package Inc\Base
 */
class Deactivate {
	public static function deactivate() {
		flush_rewrite_rules();
	}
}