<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Popup_Settings {

	const OPTION_NAME = 'pag_popup_options';

	/**
	 * Default popup settings.
	 */
	public static function defaults() {

		return array(

			/*
			|--------------------------------------------------------------------------
			| Template
			|--------------------------------------------------------------------------
			*/

			'template' => 'classic',

			/*
			|--------------------------------------------------------------------------
			| Content
			|--------------------------------------------------------------------------
			*/

			'title'       => 'Unlock Portfolio',
			'subtitle'    => 'Business Access Required',
			'description' => 'Please enter your business email to continue.',

			/*
			|--------------------------------------------------------------------------
			| Form
			|--------------------------------------------------------------------------
			*/

			'name_label'        => 'Full Name',
			'email_label'       => 'Business Email',
			'button_text'       => 'Access Portfolio',
			'privacy_text'      => 'We respect your privacy.',
			'success_message'   => 'Access Granted.',

			/*
			|--------------------------------------------------------------------------
			| Branding
			|--------------------------------------------------------------------------
			*/

			'logo'              => '',
			'background_image'  => '',

			/*
			|--------------------------------------------------------------------------
			| Layout
			|--------------------------------------------------------------------------
			*/

			'width'             => 520,
			'radius'            => 18,

			/*
			|--------------------------------------------------------------------------
			| Colors
			|--------------------------------------------------------------------------
			*/

			'background_color'  => '#ffffff',
			'overlay_color'     => '#000000',
			'overlay_opacity'   => 60,

			/*
			|--------------------------------------------------------------------------
			| Typography
			|--------------------------------------------------------------------------
			*/

			'font_family'       => 'Inter',
			'title_size'        => 30,
			'text_size'         => 16,

			/*
			|--------------------------------------------------------------------------
			| Buttons
			|--------------------------------------------------------------------------
			*/

			'button_color'      => '#2563eb',
			'button_text_color' => '#ffffff',

		);

	}

	/**
	 * Get popup settings.
	 */
	public static function get() {

		return wp_parse_args(

			get_option(
				self::OPTION_NAME,
				array()
			),

			self::defaults()

		);

	}

	/**
	 * Save popup settings.
	 */
	public static function save( $settings ) {

		update_option(

			self::OPTION_NAME,

			wp_parse_args(
				$settings,
				self::defaults()
			)

		);

	}

}