<aside class="pag-builder-preview">

	<div class="pag-preview-header">

		<h2>

			Live Preview

		</h2>

		<div>

			🖥️ 📱

		</div>

	</div>

	<?php if ( ! empty( $options['logo'] ) ) : ?>

	<img
		id="pag-preview-logo"
		src="<?php echo esc_url( $options['logo'] ); ?>"
		alt="Logo">

<?php else : ?>

	<img
		id="pag-preview-logo"
		src=""
		alt="Logo"
		style="display:none;">

<?php endif; ?>

	<div
	class="pag-preview-box"
	id="pag-preview-box"

	<?php if ( ! empty( $options['background'] ) ) : ?>

		style="
			background-image:url('<?php echo esc_url( $options['background'] ); ?>');
			background-size:cover;
			background-position:center;
		"

	<?php endif; ?>

>

	<?php if ( ! empty( $options['logo'] ) ) : ?>

		<img
			id="pag-preview-logo"
			src="<?php echo esc_url( $options['logo'] ); ?>"
			alt="Logo">

	<?php else : ?>

		<img
			id="pag-preview-logo"
			src=""
			alt="Logo"
			style="display:none;">

	<?php endif; ?>

	<h3>

		<?php echo esc_html( $options['title'] ); ?>

	</h3>

	<p>

		<?php echo esc_html( $options['subtitle'] ); ?>

	</p>

	<p class="pag-preview-description">

		<?php echo esc_html( $options['description'] ); ?>

	</p>

	<input
		type="text"
		placeholder="Full Name">

	<input
		type="email"
		placeholder="Business Email">

	<button>

		<?php echo esc_html( $options['button_text'] ); ?>

	</button>

</div>

</aside>