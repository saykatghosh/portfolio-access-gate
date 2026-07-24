document.addEventListener("DOMContentLoaded", function () {

	const form = document.getElementById("pag-form");

	if (!form) {
		return;
	}

	document.body.classList.add("pag-lock");

	const submit = document.getElementById("pag-submit");
	const message = document.getElementById("pag-message");
	const popup = document.getElementById("pag-popup");

	form.addEventListener("submit", function (e) {

		e.preventDefault();

		message.className = "";
		message.innerHTML = "";

		submit.disabled = true;

		submit.innerHTML =
			'<span class="pag-spinner"></span> Verifying...';

		const data = new URLSearchParams();

		data.append("action", "pag_submit");
		data.append("nonce", pag_ajax.nonce);

		data.append(
			"name",
			document.getElementById("pag-name").value.trim()
		);

		data.append(
			"email",
			document.getElementById("pag-email").value.trim()
		);

		data.append(
			"page_id",
			document.getElementById("pag-page-id").value
		);

		data.append(
			"page_title",
			document.getElementById("pag-page-title").value
		);

		fetch(pag_ajax.ajax_url, {

			method: "POST",

			headers: {
				"Content-Type": "application/x-www-form-urlencoded"
			},

			body: data.toString()

		})
		.then(function (response) {

			return response.json();

		})
		.then(function (response) {

			submit.disabled = false;

			if (!response.success) {

				submit.innerHTML = "View Portfolio";

				message.className = "pag-error";

				message.innerHTML = response.data.message;

				return;

			}

			message.className = "pag-success";

			message.innerHTML =
				"✅ Access Granted<br><small>Redirecting...</small>";

			submit.innerHTML = "Access Granted";

			submit.style.background = "#16a34a";

			popup.style.transition = ".35s";

			popup.style.transform = "scale(.96)";

			popup.style.opacity = "0";

			setTimeout(function () {

				window.location.href = response.data.redirect;

			}, 900);

		})
		.catch(function () {

			submit.disabled = false;

			submit.innerHTML = "View Portfolio";

			message.className = "pag-error";

			message.innerHTML = "Unexpected server error.";

		});

	});

	document.addEventListener("keydown", function (e) {

		if (e.key === "Escape") {

			e.preventDefault();

		}

	});

});