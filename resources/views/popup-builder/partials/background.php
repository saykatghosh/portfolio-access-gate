<div class="pag-control">

	<label>

		Background Image

	</label>

	<div class="pag-media-control">

		<input
			type="text"
			id="pag-background"
			class="regular-text"
			value="<?php echo esc_attr( $options['background'] ?? '' ); ?>"
			readonly>

		<button
			type="button"
			id="pag-upload-background"
			class="button">

			Choose Background

		</button>

		<button
			type="button"
			id="pag-remove-background"
			class="button">

			Remove

		</button>

	</div>

</div>