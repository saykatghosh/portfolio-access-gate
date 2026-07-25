document.addEventListener("DOMContentLoaded", function () {

	const redirectType = document.querySelector(
		'select[name="pag_options[redirect_type]"]'
	);

	const redirectUrl = document.querySelector(
		'input[name="pag_options[redirect_url]"]'
	);

	if (redirectType && redirectUrl) {

		const row = redirectUrl.closest("tr");

		function toggleRedirectField() {

			if (redirectType.value === "custom") {
				row.style.display = "";
			} else {
				row.style.display = "none";
			}

		}

		toggleRedirectField();

		redirectType.addEventListener(
			"change",
			toggleRedirectField
		);

	}

	const hourInput = document.querySelector(
		'input[name="pag_options[cookie_hours]"]'
	);

	const minuteInput = document.querySelector(
		'input[name="pag_options[cookie_minutes]"]'
	);

	if (hourInput && minuteInput) {

		const info = document.createElement("p");

		info.className = "description";
		info.style.marginTop = "10px";

		minuteInput.parentNode.parentNode.appendChild(info);

		function updatePreview() {

			const h = parseInt(hourInput.value || 0, 10);
			const m = parseInt(minuteInput.value || 0, 10);

			let text = "Current Duration: ";

			if (h > 0) {
				text += h + (h === 1 ? " Hour" : " Hours");
			}

			if (h > 0 && m > 0) {
				text += " ";
			}

			if (m > 0) {
				text += m + (m === 1 ? " Minute" : " Minutes");
			}

			if (h === 0 && m === 0) {
				text += "1 Minute";
			}

			info.textContent = text;

		}

		updatePreview();

		hourInput.addEventListener("input", updatePreview);
		minuteInput.addEventListener("input", updatePreview);

	}

});