// document.addEventListener("DOMContentLoaded", function () {

// 	const toggle = document.getElementById("pag-theme-toggle");

// 	if (!toggle) {
// 		return;
// 	}

// 	const body = document.body;

// 	const savedTheme = localStorage.getItem("pag-admin-theme");

// 	if (savedTheme === "dark") {

// 		body.classList.add("pag-dark");

// 		toggle.classList.add("active");

// 	}

// 	toggle.addEventListener("click", function () {

// 		body.classList.toggle("pag-dark");

// 		toggle.classList.toggle("active");

// 		localStorage.setItem(

// 			"pag-admin-theme",

// 			body.classList.contains("pag-dark")
// 				? "dark"
// 				: "light"

// 		);

// 	});

// });