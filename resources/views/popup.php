<div id="pag-overlay">

	<div id="pag-popup">

		<div class="pag-brand">

			<?php
			$logo = apply_filters(
				'pag_popup_logo',
				''
			);

			if ( ! empty( $logo ) ) :
			?>

				<img
					src="<?php echo esc_url( $logo ); ?>"
					alt="Logo">

			<?php else : ?>

				<div class="pag-lock-icon">

					🔒

				</div>

			<?php endif; ?>

		</div>

		<div class="pag-header">

			<h2>

				Access Our Work

			</h2>

			<p>

				Please verify your business details to continue.

			</p>

		</div>

		<form id="pag-form">

			<?php wp_nonce_field(
				'pag_nonce',
				'pag_nonce'
			); ?>

			<input
				type="hidden"
				id="pag-page-id"
				value="<?php echo esc_attr( get_queried_object_id() ); ?>">

			<input
				type="hidden"
				id="pag-page-title"
				value="<?php echo esc_attr( get_the_title( get_queried_object_id() ) ); ?>">

			<div class="pag-field">

				<label>

					Full Name

				</label>

				<input
					type="text"
					id="pag-name"
					placeholder="John Smith"
					required>

			</div>

			<div class="pag-field">

				<label>

					Business Email

				</label>

				<input
					type="email"
					id="pag-email"
					placeholder="john@company.com"
					required>

			</div>

			<div id="pag-message"></div>

			<button
				id="pag-submit"
				type="submit">

				View Portfolio

			</button>

			<?php PAG_Honeypot::field(); ?>

		</form>

		<div class="pag-footer">

			<svg
				width="16"
				height="16"
				viewBox="0 0 24 24"
				fill="currentColor">

				<path d="M12 2l8 4v6c0 5.5-3.8 9.8-8 10-4.2-.2-8-4.5-8-10V6z"/>

			</svg>

			<span>

				Secure verification • Business use only

			</span>

		</div>

	</div>

</div>