<?php
if(!defined('ABSPATH')) exit;
class PAG_Deactivator {
    public static function deactivate() {
        flush_rewrite_rules();
    }
}
