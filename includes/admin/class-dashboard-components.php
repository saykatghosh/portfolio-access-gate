<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Dashboard_Components {

	/**
	 * Dashboard Stat Card.
	 */
	public static function card( $icon, $title, $value, $color = 'primary' ) {
		?>
		<div class="pag-card pag-card-<?php echo esc_attr( $color ); ?>">

			<div class="pag-card-icon">
				<?php echo wp_kses_post( $icon ); ?>
			</div>

			<div class="pag-card-content">

				<span>
					<?php echo esc_html( $title ); ?>
				</span>

				<h2>
					<?php echo esc_html( number_format_i18n( $value ) ); ?>
				</h2>

			</div>

		</div>
		<?php
	}

	/**
	 * Section Header.
	 */
	public static function section( $title, $subtitle = '' ) {
		?>

		<div class="pag-section-header">

			<h2>
				<?php echo esc_html( $title ); ?>
			</h2>

			<?php if ( ! empty( $subtitle ) ) : ?>

				<p>
					<?php echo esc_html( $subtitle ); ?>
				</p>

			<?php endif; ?>

		</div>

		<?php
	}

	/**
	 * Quick Actions.
	 */
	public static function quick_actions() {
		?>

		<div class="pag-box">

			<?php
			self::section(
				'Quick Actions',
				'Frequently used actions.'
			);
			?>

			<div class="pag-actions">

				<a
					class="button button-primary"
					href="<?php echo esc_url( admin_url( 'admin.php?page=pag-protected-pages' ) ); ?>">
					Protected Pages
				</a>

				<a
					class="button"
					href="<?php echo esc_url( admin_url( 'admin.php?page=pag-leads' ) ); ?>">
					View Leads
				</a>

				<a
					class="button"
					href="<?php echo esc_url( admin_url( 'admin.php?page=pag-settings' ) ); ?>">
					Settings
				</a>

			</div>

		</div>

		<?php
	}

}