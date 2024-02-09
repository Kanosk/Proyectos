import slideClick from './slideClick';
import cerrarGaleria from './cerrarGaleria';
import carousel from './carousel';
import { cargarAnteriorSiguiente } from './cargarImagen';

const galeria = document.getElementById('galeria');

galeria.addEventListener('click', (e) => {
	e.preventDefault();

	const boton = e.target.closest('button');

	if (boton?.dataset?.accion === 'cerrar-galeria' || e.target?.dataset?.accion === 'cerrar-galeria') {
		cerrarGaleria();
	}

	if (boton?.dataset?.accion === 'siguiente-imagen') {
		cargarAnteriorSiguiente('siguiente');
	}

	if (boton?.dataset?.accion === 'anterior-imagen') {
		cargarAnteriorSiguiente('anterior');
	}

	if (e.target?.dataset?.idFoto) {
		slideClick(e);
	}

	if (boton && boton?.dataset.accion === 'siguiente-slide') {
		carousel('adelante');
	}

	if (boton && boton?.dataset.accion === 'anterior-slide') {
		carousel('atras');
	}
});
