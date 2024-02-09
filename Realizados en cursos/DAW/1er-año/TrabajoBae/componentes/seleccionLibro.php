<div class="form-group">
  <label>Libros</label> <br>
  <select class="form-select" name="isbn[]" multiple aria-label="">
    <?php 
    $libros = new Libro(); 
    $listadoLibros = $libros->obtenerListadoLibros(); 
    foreach ($listadoLibros as $libro) { 
      echo "<option value=" . $libro->getIsbn(); 
      if(isset($isbnlibros)){
        foreach($isbnlibros as $isbnlibro){ 
          if($libro->getIsbn() == $isbnlibro['isbn']){
            echo"selected='selected' "; 
          } 
        } 
      } 
      echo ">" . $libro->getTitulo(). "</option>"; 
    } 
    ?>
  </select>
</div>
