<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Documentos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>.form-group{margin:auto;}</style>
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <h2>Formulario de Documentos</h2>
            <form action="procesar_documento.php" method="post" enctype="multipart/form-data">
                
            <div class="form-group">
                <label for="autores">Autor/es:</label>
                <input type="text" id="autores" class="form-control" name="autores" required>
            </div>
                
            <div class="form-group">
                <label for="nombre">Nombre de documento:</label>
            </div>

            <div class="form-group">
                <input type="text" id="nombre" class="form-control" name="nombre" required>
            </div>
                
            <div class="form-group">
                <label for="descripcion">Descripción de documento:</label>
            </div>

            <div class="form-group">
                <textarea id="descripcion" class="form-control" name="descripcion" required></textarea>
            </div>
                
            <div class="form-group">
                <label for="tipo">Tipo de documento:</label>
                <select id="tipo" class="form-control" name="tipo" required>
                    <option value="Documento">Documento</option>
                    <option value="Informe">Informe</option>
                    <option value="Presentación">Presentación</option>
                    <option value="Variados">Variados</option>
                </select>
            </div>

            <div class="form-group" style="margin:auto">
                <label>Extensión de archivo:</label><br>
                <input type="checkbox" class="form-check " name="extension[]" value="txt"> txt&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <input type="checkbox" class="form-check " name="extension[]" value="pdf"> pdf  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <input type="checkbox" class="form-check " name="extension[]" value="docx"> docx&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <input type="checkbox" class="form-check " name="extension[]" value="xlsx"> xlsx&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <input type="checkbox" class="form-check " name="extension[]" value="pptx"> pptx&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <input type="checkbox" class="form-check " name="extension[]" value="odt"> odt  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            </div><br>

            <div class="form-group">
                <label for="palabrasclave">Palabras Clave:</label>
                <input type="text" id="palabrasclave" class="form-control" name="palabrasclave">
            </div>

            <div class="form-group">
                <label for="idioma">Idioma:</label>
                <select id="idioma" class="form-control" name="idioma">
                    <option value="Español">Español</option>
                    <option value="Inglés">Inglés</option>
                    <option value="Otros">Otros</option>
                </select>
            </div>

            <div class="form-group">
                <label>Visibilidad:</label>
                <input type="radio" class="form-control" name="visibilidad" value="Público"> Público
                <input type="radio" class="form-control" name="visibilidad" value="Privado"> Privado
            </div>

            <div class="form-group">
                <label>Temática:</label><br>
                <input type="checkbox" class="form-check" name="tematica[]" value="Administración"> Administración &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <input type="checkbox" class="form-check" name="tematica[]" value="Finanzas"> Finanzas &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <input type="checkbox" class="form-check" name="tematica[]" value="Negocio"> Negocio &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <input type="checkbox" class="form-check" name="tematica[]" value="Informática"> Informática &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <input type="checkbox" class="form-check" name="tematica[]" value="Otros"> Otros &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            </div><br>

            <div class="form-group">
                <label for="documentos">Subir documentos:</label>
                <input type="file" class="form-control" name="documentos[]" accept=".txt, .pdf, .docx, .xlsx, .pptx, .odt" multiple required>
            </div><br>
            
            <div class="form-group" align="center">
                <input type="submit" class="btn btn-success" value="Registrar Documentos">
            </div>
        </form>
    </div>
</div>
</body>
</html>
