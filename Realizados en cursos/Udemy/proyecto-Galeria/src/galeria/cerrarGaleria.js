const galeria = document.getElementById('galeria');

const cerrarGaleria = () => {
	galeria.classList.remove('galeria--active');
	document.body.style.overflow = 'visible';
};

export default cerrarGaleria;