<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Dashboard_Components {

	/**
	 * Dashboard Stat Card.
	 */
	public static function card( $icon, $title, $value, $color = 'primary', $trend = null ) {
		?>

		<div class="pag-card pag-card-<?php echo esc_attr( $color ); ?>">

			<div class="pag-card-top">

				<div class="pag-card-icon">
					<?php echo $icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>

				<?php if ( ! empty( $trend ) ) : ?>

					<div class="pag-card-trend">

						<?php echo esc_html( $trend ); ?>

					</div>

				<?php endif; ?>

			</div>

			<div class="pag-card-content">

				<span class="pag-card-label">
					<?php echo esc_html( $title ); ?>
				</span>

				<h2 class="pag-card-value">
					<?php echo esc_html( number_format_i18n( $value ) ); ?>
				</h2>

			</div>

		</div>

		<?php
	}

	/**
	 * Section Header.
	 */
	public static function section( $title, $subtitle = '', $action = '' ) {
		?>

		<div class="pag-section-header">

			<div>

				<h2>

					<?php echo esc_html( $title ); ?>

				</h2>

				<?php if ( ! empty( $subtitle ) ) : ?>

					<p>

						<?php echo esc_html( $subtitle ); ?>

					</p>

				<?php endif; ?>

			</div>

			<?php if ( ! empty( $action ) ) : ?>

				<div class="pag-section-action">

					<?php echo wp_kses_post( $action ); ?>

				</div>

			<?php endif; ?>

		</div>

		<?php
	}

	/**
	 * Button.
	 */
	public static function button( $label, $url, $type = 'primary' ) {

		$class = ( 'primary' === $type )
			? 'pag-btn pag-btn-primary'
			: 'pag-btn pag-btn-outline';

		?>

		<a
			href="<?php echo esc_url( $url ); ?>"
			class="<?php echo esc_attr( $class ); ?>"
		>

			<?php echo esc_html( $label ); ?>

		</a>

		<?php
	}

		public static function icon_users() {

		return '
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
			<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
			<circle cx="9" cy="7" r="4"/>
			<path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
			<path d="M16 3.13a4 4 0 0 1 0 7.75"/>
		</svg>';

	}

	public static function icon_calendar() {

		return '
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
			<rect x="3" y="4" width="18" height="18" rx="2"/>
			<line x1="16" y1="2" x2="16" y2="6"/>
			<line x1="8" y1="2" x2="8" y2="6"/>
			<line x1="3" y1="10" x2="21" y2="10"/>
		</svg>';

	}

	public static function icon_chart() {

		return '
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
			<polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/>
			<polyline points="16 7 22 7 22 13"/>
		</svg>';

	}

	public static function icon_building() {

		return '
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
			<rect x="4" y="2" width="16" height="20" rx="2"/>
			<path d="M9 22v-4h6v4"/>
			<path d="M8 6h.01M12 6h.01M16 6h.01M8 10h.01M12 10h.01M16 10h.01M8 14h.01M12 14h.01M16 14h.01"/>
		</svg>';

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

				<?php

				self::button(
					'Protected Pages',
					admin_url( 'admin.php?page=pag-protected-pages' ),
					'primary'
				);

				self::button(
					'View Leads',
					admin_url( 'admin.php?page=pag-leads' ),
					'outline'
				);

				self::button(
					'Settings',
					admin_url( 'admin.php?page=pag-settings' ),
					'outline'
				);

				?>

			</div>

		</div>

		<?php
	}

}