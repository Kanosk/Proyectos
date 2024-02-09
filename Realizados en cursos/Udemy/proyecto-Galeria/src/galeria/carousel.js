const galeria = document.getElementById('galeria');

const carousel = (direccion) => {
	
	const opciones = {
		root: document.querySelector('.galeria__carousel'),
		rootMargin: '0px',
		threshold: 0.9, 
	};

	const observer = new IntersectionObserver((entradas) => {
		const slidesVisibles = entradas.filter((entrada) => {
			if (entrada.isIntersecting === true) {
				return entrada;
			}
		});

		if (direccion === 'atras') {
			const primerSlideVisible = slidesVisibles[0];
			const indexPrimerSlideVisible = entradas.indexOf(primerSlideVisible);

			if (indexPrimerSlideVisible >= 1) {
				
				entradas[indexPrimerSlideVisible - 1].target.scrollIntoView({
					behavior: 'smooth',
					inline: 'start',
				});
			}
		} else if (direccion === 'adelante') {
			
			const ultimoSlideVisible = slidesVisibles[slidesVisibles.length - 1];
			const indexUltimoSlideVisible = entradas.indexOf(ultimoSlideVisible);

			if (entradas.length - 1 > indexUltimoSlideVisible) {
				entradas[indexUltimoSlideVisible + 1].target.scrollIntoView({
					behavior: 'smooth',
					inline: 'start',
				});
			}
		}

		galeria.querySelectorAll('.galeria__carousel-slide').forEach((slide) => {
			observer.unobserve(slide);
		});
	}, opciones);

	galeria.querySelectorAll('.galeria__carousel-slide').forEach((slide) => {
		observer.observe(slide);
	});
};

export default carousel;
