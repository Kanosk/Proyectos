<html>

<head>
    <title>UT02 - Supuesto Práctico - Ejercicio 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <h1>Formulario de Alta de Empleado</h1>
    <div class="container-fluid">
        <form action="comprobacion.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-4">
                    Código de Empleado:
                    <input class="form-control" type="number" name="codigo" />
                    Nombre Empleado:
                    <input class="form-control" type="text" name="nombre" />
                    Apellidos Empleado:
                    <input class="form-control" type="text" name="apellidos" size="40" />
                    Dirección Empleado:
                    <input class="form-control" type="text" name="direccion" size="255" />
                    Email:
                    <input class="form-control" type="text" name="email" size="35" />
                    Password Temporal:
                    <input class="form-control" type="password" name="contras" />
                </div>
            </div>
            <div class="form-row">
                <br>Sexo:
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" value="H">
                    <label class="form-check-label">
                        Hombre
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" value="M">
                    <label class="form-check-label">
                        Mujer
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" value="N">
                    <label class="form-check-label">
                        No Binario
                    </label>
                </div>
            </div>

            <div class="form-row">
                <br>Nivel de estudios:
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estudios" value="Elemental">
                    <label class="form-check-label">
                        Certificado escolar
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estudios" value="Basico">
                    <label class="form-check-label">
                        Graduado en E.S.O
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estudios" value="Bachillerato">
                    <label class="form-check-label">
                        Bachillerato - Formación Profesional
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estudios" value="Diplomado">
                    <label class="form-check-label">
                        Diplomado
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estudios" value="Licenciado">
                    <label class="form-check-label">
                        Licenciado o Doctorado
                    </label>
                </div>
            </div>

            <div class="form-row">
                <br>Asignación de acceso a Departamentos:

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="administracion" />Administración<br />
                    <input class="form-check-input" type="checkbox" name="programacion" />Programación<br />
                    <input class="form-check-input" type="checkbox" name="sistemas" />Sistemas<br />
                    <input class="form-check-input" type="checkbox" name="rrhh" />Recursos Humanos<br />
                    <input class="form-check-input" type="checkbox" name="marketing" />Marketing</br>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <br>Asignación de Contrato
                    <select class="form-select mb-1" name="tipocontrato">
                        <option></option>
                        <option value="indefinido">Indefinidio</option>
                        <option value="temporal">Temporal</option>
                        <option value="servicio">Servicio</option>
                        <option value="eventual">Eventual</option>
                        <option value="practicas">Prácticas</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <br>
                    <p>Comentarios: <br />
                        <textarea name="comentario" rows="5" cols="50"></textarea>
                </div>
            </div>

            <p><input type="submit" value="Comprobar el formulario">
                <input type="reset" value="borrar todo">
            </p>

        </form>
    </div>

</body>

</html>