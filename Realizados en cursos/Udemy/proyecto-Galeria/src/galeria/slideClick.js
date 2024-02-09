import data from '../datos/fotos';
import { cargarImagen } from './cargarImagen';

const galeria = document.getElementById('galeria');

const slideClick = (e) => {
	const categoriaActiva = galeria.dataset.categoria;

	let id, ruta, nombre,descripcion;

	data.fotos[categoriaActiva].forEach((foto) => {
		if (foto.id === parseInt(e.target.dataset.idFoto)) {
			id = foto.id;
			ruta = foto.ruta;
			nombre = foto.nombre;
			descripcion = foto.descripcion;
		}
	});

	cargarImagen(id, nombre, ruta, descripcion);
};

export default slideClick;
