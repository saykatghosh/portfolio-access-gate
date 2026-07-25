document.addEventListener("DOMContentLoaded", function () {

	const title = document.getElementById("pag-title");
	const subtitle = document.getElementById("pag-subtitle");
	const description = document.getElementById("pag-description");
	const button = document.getElementById("pag-button");

	const logo = document.getElementById("pag-logo");
	const uploadLogo = document.getElementById("pag-upload-logo");
	const removeLogo = document.getElementById("pag-remove-logo");
	const preview = document.querySelector(".pag-preview-box");
    const background = document.getElementById("pag-background");
    const uploadBackground = document.getElementById("pag-upload-background");
    const removeBackground = document.getElementById("pag-remove-background");



	if (!preview) {
		return;
	}

	const previewTitle = preview.querySelector("h3");
	const previewSubtitle = preview.querySelector("p");
	const previewButton = preview.querySelector("button");
    const previewLogo = document.getElementById("pag-preview-logo");

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

        if (logo.value) {

            previewLogo.src = logo.value;

            previewLogo.style.display = "block";

        } else {

            previewLogo.src = "";

            previewLogo.style.display = "none";

}

if (background.value) {

	preview.style.backgroundImage = 'url("' + background.value + '")';

	preview.style.backgroundSize = "cover";

	preview.style.backgroundPosition = "center";

} else {

	preview.style.backgroundImage = "";

}

	}
    

	updatePreview();

	title.addEventListener("input", updatePreview);
	subtitle.addEventListener("input", updatePreview);
	description.addEventListener("input", updatePreview);
	button.addEventListener("input", updatePreview);

	/* ============================
	   Logo Upload
	============================ */

	if ( uploadLogo ) {

		const mediaUploader = wp.media({

			title: "Select Logo",

			button: {
				text: "Use Logo"
			},

			multiple: false

		});

		uploadLogo.addEventListener("click", function () {

			mediaUploader.open();

		});

		mediaUploader.on("select", function () {

			const attachment = mediaUploader
				.state()
				.get("selection")
				.first()
				.toJSON();

			logo.value = attachment.url;
            updatePreview();

		});

	}

	if ( removeLogo ) {

		removeLogo.addEventListener("click", function () {

			logo.value = "";
            updatePreview();

		});

	}

    /* ============================
   Background Upload
============================ */

if ( uploadBackground ) {

	const bgUploader = wp.media({

		title: "Select Background",

		button: {
			text: "Use Background"
		},

		multiple: false

	});

	uploadBackground.addEventListener("click", function () {

		bgUploader.open();

	});

	bgUploader.on("select", function () {

		const attachment = bgUploader
			.state()
			.get("selection")
			.first()
			.toJSON();

		background.value = attachment.url;

		updatePreview();

	});

}

if ( removeBackground ) {

	removeBackground.addEventListener("click", function () {

		background.value = "";

		updatePreview();

	});
}

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
		data.append("logo", logo.value);
        data.append("background", background.value);

		fetch(pagAdmin.ajax_url, {

			method: "POST",

			body: data

		})
		.then(response => response.json())
		.then(response => {

			if (response.success) {

				saveButton.textContent = "Saved ✓";

			} else {

				saveButton.textContent = "Failed";

			}

			setTimeout(function () {

				saveButton.disabled = false;

				saveButton.textContent = "Save Changes";

			}, 1500);

		});

	});

});