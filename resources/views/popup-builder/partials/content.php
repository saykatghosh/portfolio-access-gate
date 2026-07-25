<?php

$options = PAG_Popup_Settings::get();

?>

<section class="pag-builder-content">

	<div class="pag-panel-header">

		<h2>

			Content

		</h2>

	</div>

	<div class="pag-panel-body">

		<div class="pag-control">

			<label>

				Popup Title

			</label>

			<input
				type="text"
				id="pag-title"
				class="regular-text"
				value="<?php echo esc_attr( $options['title'] ); ?>">

		</div>

		<div class="pag-control">

			<label>

				Subtitle

			</label>

			<input
				type="text"
				id="pag-subtitle"
				class="regular-text"
				value="<?php echo esc_attr( $options['subtitle'] ); ?>">

		</div>

		<div class="pag-control">

			<label>

				Description

			</label>

			<textarea
				id="pag-description"
				rows="4"
				class="large-text"><?php echo esc_textarea( $options['description'] ); ?></textarea>

		</div>

		<div class="pag-control">

			<label>

				Button Text

			</label>

			<input
				type="text"
				id="pag-button"
				class="regular-text"
				value="<?php echo esc_attr( $options['button_text'] ); ?>">

		</div>

	</div>

</section>