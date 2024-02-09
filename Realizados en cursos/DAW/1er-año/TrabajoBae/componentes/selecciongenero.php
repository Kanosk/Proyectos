<div class="form-group">
    <label>Género</label>
    <br>

    <select class="custom-select" name="genero" value="
    <?php
        if (!is_null($libro) && !is_null($libro->getGenero())){
            echo $libro->getGenero();
        }
    ?>
    " required>
        <option>Elegir Género...</option>
        <?php

        $generos = new Genero();
        $listadoGeneros = $generos->obtenerListadoGeneros();

        foreach ($listadoGeneros as $genero) {
            echo "<option value=" . $genero->getCod();
            if (isset($libro) && $genero->getCod() == $libro->getGenero()){
                echo " selected='selected'";
            }
            echo ">" . $genero->getNombre() . "</option>";
        }

        ?>
    </select>
</div>