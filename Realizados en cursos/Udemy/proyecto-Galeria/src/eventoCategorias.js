import dataFotos from './datos/fotos';
import { cargarImagen } from './galeria/cargarImagen';

const contenedorCategorias = document.getElementById('categorias');
const galeria = document.getElementById('galeria');
let categoriaActiva;

contenedorCategorias.addEventListener('click', (e) => {
	e.preventDefault();

	if (e.target.closest('a')) {
		categoriaActiva = e.target.closest('a').dataset.categoria;
		galeria.dataset.categoria = categoriaActiva;
		const fotos = dataFotos.fotos[categoriaActiva];
		const carousel = galeria.querySelector('.galeria__carousel-slides');

		carousel.innerHTML = '';

		document.body.style.overflow = 'hidden';

		galeria.classList.add('galeria--active');

		const { id, nombre, ruta, descripcion } = fotos[0];
		cargarImagen(id, nombre, ruta, descripcion);

		fotos.forEach((foto) => {
			const slide = `
				<a href="#" class="galeria__carousel-slide">
					<img class="galeria__carousel-image" src="${foto.ruta}" alt="" data-id-foto="${foto.id}" />
				</a>
			`;
			carousel.innerHTML += slide;
	});

		galeria.querySelector('.galeria__carousel-slide').classList.add('galeria__carousel-slide--active');
	}
});
