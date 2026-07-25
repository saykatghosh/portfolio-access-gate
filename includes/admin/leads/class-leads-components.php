<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Leads_Components {

	/**
	 * Render avatar with user initials.
	 */
	public static function avatar( $name ) {

		$name = trim( (string) $name );

		if ( '' === $name ) {
			$name = esc_html__( 'User', 'portfolio-access-gate' );
		}

		$parts = preg_split( '/\s+/', $name );

		$initials = '';

		if ( ! empty( $parts[0] ) ) {
			$initials .= strtoupper( mb_substr( $parts[0], 0, 1 ) );
		}

		if ( count( $parts ) > 1 ) {
			$initials .= strtoupper( mb_substr( end( $parts ), 0, 1 ) );
		}

		?>

		<div class="pag-avatar">

			<?php echo esc_html( $initials ); ?>

		</div>

		<?php
	}

	/**
	 * Render email type badge.
	 */
	public static function email_badge( $domain ) {

		$domain = strtolower( sanitize_text_field( $domain ) );

		$free_domains = array(
			'gmail.com',
			'yahoo.com',
			'outlook.com',
			'hotmail.com',
			'live.com',
			'icloud.com',
			'aol.com',
			'proton.me',
			'protonmail.com',
		);

		$is_business = ! in_array(
			$domain,
			$free_domains,
			true
		);

		$badge_class = $is_business
			? 'pag-business'
			: 'pag-free';

		?>

		<span class="pag-badge <?php echo esc_attr( $badge_class ); ?>">

			<?php

			echo esc_html(
				$is_business
					? __( 'Business', 'portfolio-access-gate' )
					: __( 'Free', 'portfolio-access-gate' )
			);

			?>

		</span>

		<?php
	}

	/**
	 * Render empty state.
	 */
	public static function empty_state(
		$message = ''
	) {

		if ( '' === $message ) {
			$message = __( 'No leads found.', 'portfolio-access-gate' );
		}

		?>

		<tr>

			<td colspan="6" class="pag-empty-state">

				<?php echo esc_html( $message ); ?>

			</td>

		</tr>

		<?php
	}

}