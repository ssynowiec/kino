document.addEventListener('DOMContentLoaded', () => {
	const places = document.querySelectorAll('.chair[name="place[]"]');
	places.forEach(place => {
		place.addEventListener('click', () => {
			const i = document.getElementById('quantity').value;
			const checked = document.querySelectorAll('.chair:checked');
			const reserved = document.querySelectorAll(
				'.chair[name="place[]"]:disabled',
			);
			if (checked.length - reserved.length >= i) {
				places.forEach(place => {
					if (place.checked === false) {
						place.classList.add('disable');
						place.disabled = true;
					}
				});
			} else {
				places.forEach(place => {
					if (place.checked === false) {
						place.classList.remove('disable');
						place.disabled = false;
					}
				});
			}
		});
	});
});
