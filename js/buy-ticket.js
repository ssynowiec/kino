document.addEventListener('DOMContentLoaded', () => {
	const film = document.getElementById('film');
	film.addEventListener('change', option => {
		const filmId = option.target.value;
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function () {
			document.getElementById('seans').innerHTML = this.responseText;
			document.getElementById('quantity').max = 0;
			document.getElementById('quantity').min = 0;
			document.getElementById('quantity').value = 0;
			document.getElementById('quantity').step = 0;
			document
				.querySelectorAll('input[name="seans"]')
				.forEach(element => {
					element.addEventListener('change', option => {
						const seansId = option.target.value;
						const xhttp = new XMLHttpRequest();
						xhttp.onload = function () {
							if (this.responseText == '0') {
								document.getElementById('quantity').max = 0;
								document.getElementById('quantity').min = 0;
								document.getElementById('quantity').value = 0;
								document.getElementById('quantity').step = 0;
							} else {
								document.getElementById('quantity').max =
									this.responseText;
								document.getElementById('quantity').min = 1;
								document.getElementById('quantity').value = 1;
								document.getElementById('quantity').step = 1;
							}
						};
						xhttp.open(
							'GET',
							`./get_film_limits.php?seans=${seansId}`,
							true,
						);
						xhttp.send();
					});
				});
		};
		xhttp.open('GET', `./get_film_dates.php?film=${filmId}`, true);
		xhttp.send();
	});
});
