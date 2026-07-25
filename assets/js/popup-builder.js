document.addEventListener("DOMContentLoaded", function () {

	const title = document.getElementById("pag-title");
	const subtitle = document.getElementById("pag-subtitle");
	const description = document.getElementById("pag-description");
	const button = document.getElementById("pag-button");

	const preview = document.querySelector(".pag-preview-box");

	if (!preview) {
		return;
	}

	const previewTitle = preview.querySelector("h3");
	const previewSubtitle = preview.querySelector("p");
	const previewButton = preview.querySelector("button");

	let previewDescription = preview.querySelector(".pag-preview-description");

	if (!previewDescription) {

		previewDescription = document.createElement("p");

		previewDescription.className = "pag-preview-description";

		previewSubtitle.insertAdjacentElement(
			"afterend",
			previewDescription
		);

	}

	function updatePreview() {

		previewTitle.textContent = title.value;

		previewSubtitle.textContent = subtitle.value;

		previewDescription.textContent = description.value;

		previewButton.textContent = button.value;

	}

	updatePreview();

	title.addEventListener("input", updatePreview);
	subtitle.addEventListener("input", updatePreview);
	description.addEventListener("input", updatePreview);
	button.addEventListener("input", updatePreview);

	/* ============================
	   Save
	============================ */

	const saveButton = document.querySelector(".button-primary");

	if (!saveButton) {
		return;
	}

	saveButton.addEventListener("click", function () {

		saveButton.disabled = true;

		saveButton.textContent = "Saving...";

		const data = new FormData();

		data.append("action", "pag_save_popup");

		data.append("nonce", pagAdmin.nonce);

		data.append("title", title.value);

		data.append("subtitle", subtitle.value);

		data.append("description", description.value);

		data.append("button", button.value);

		fetch(pagAdmin.ajax_url, {

			method: "POST",

			body: data

		})
		.then(response => response.json())
		.then(response => {

			if (response.success) {

				saveButton.textContent = "Saved ✓";

			}
			else {

				saveButton.textContent = "Failed";

			}

			setTimeout(function () {

				saveButton.disabled = false;

				saveButton.textContent = "Save Changes";

			}, 1500);

		});

	});

});