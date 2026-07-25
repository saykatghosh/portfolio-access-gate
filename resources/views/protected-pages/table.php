<table class="pag-table pag-protected-table">

	<thead>

		<tr>

			<th width="60">

				<input
					type="checkbox"
					id="pag-master-checkbox">

			</th>

			<th>

				Page

			</th>

			<th width="90">

				ID

			</th>

			<th width="140">

				Status

			</th>

		</tr>

	</thead>

	<tbody>

	<?php if ( ! empty( $pages ) ) : ?>

		<?php foreach ( $pages as $page ) : ?>

			<?php

			$checked = in_array(
				$page->ID,
				$saved,
				true
			);

			?>

			<tr>

				<td>

					<input
						type="checkbox"
						class="pag-page-checkbox"
						name="protected_pages[]"
						value="<?php echo esc_attr( $page->ID ); ?>"
						<?php checked( $checked ); ?>>

				</td>

				<td>

					<strong>

						<?php echo esc_html( $page->post_title ); ?>

					</strong>

				</td>

				<td>

					#<?php echo esc_html( $page->ID ); ?>

				</td>

				<td>

					<?php if ( $checked ) : ?>

						<span class="pag-badge pag-success">

							Protected

						</span>

					<?php else : ?>

						<span class="pag-badge pag-light">

							Public

						</span>

					<?php endif; ?>

				</td>

			</tr>

		<?php endforeach; ?>

	<?php else : ?>

		<tr>

			<td colspan="4" class="pag-empty-state">

				No pages found.

			</td>

		</tr>

	<?php endif; ?>

	</tbody>

</table>