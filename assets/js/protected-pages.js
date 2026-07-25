document.addEventListener("DOMContentLoaded", function () {

	const master = document.getElementById("pag-master-checkbox");
	const rows = document.querySelectorAll(".pag-page-checkbox");

	const search = document.getElementById("pag-search-pages");

	const selectAll = document.getElementById("pag-select-all");

	const clearAll = document.getElementById("pag-clear-all");

	const counter = document.getElementById("pag-selected-count");

	function updateCounter() {

		const checked = document.querySelectorAll(
			".pag-page-checkbox:checked"
		).length;

		if (counter) {

			counter.textContent = checked + " Selected";

		}

		if (master) {

			master.checked = checked === rows.length && rows.length > 0;

		}

	}

	if (master) {

		master.addEventListener("change", function () {

			rows.forEach(function (row) {

				row.checked = master.checked;

			});

			updateCounter();

		});

	}

	if (selectAll) {

		selectAll.addEventListener("click", function () {

			rows.forEach(function (row) {

				row.checked = true;

			});

			updateCounter();

		});

	}

	if (clearAll) {

		clearAll.addEventListener("click", function () {

			rows.forEach(function (row) {

				row.checked = false;

			});

			updateCounter();

		});

	}

	rows.forEach(function (row) {

		row.addEventListener("change", updateCounter);

	});

	if (search) {

		search.addEventListener("keyup", function () {

			const keyword = this.value.toLowerCase();

			document.querySelectorAll(".pag-protected-table tbody tr").forEach(function (tr) {

				tr.style.display = tr.innerText
					.toLowerCase()
					.includes(keyword)
					? ""
					: "none";

			});

		});

	}

	updateCounter();

});