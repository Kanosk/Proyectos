<div class="form-group">
    <label>Registrado por *</label>
    <br>
    <select class="form-select" name="DNI_personal" aria-label="" required>
        <?php
        include_once "../../modelo/personal.php";
            $empleado = new personal();
            $listapersonal = $empleado->obtenerPersonalAlta();
            echo "<option value='' selected disabled>Selecciona a un personal</option>";
            foreach ($listapersonal as $empleado) {
                echo "<option value=" . $empleado->getDNI_personal();
                if (isset($DNI_personal)) {
                    if ($empleado->getDNI_personal() == $DNI_personal) {
                        echo " selected='selected' ";
                    }
                }
                echo ">" . $empleado->getNombre_per() ."</option>";
            }
        ?>
    </select>
    <h6>*Solo pueden agregar clientes Administrativos o Auxiliares</h6>
</div>