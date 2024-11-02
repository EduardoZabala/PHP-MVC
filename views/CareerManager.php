<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Icons bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Pruebas -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
    <h1 class="text-center p-3">CRUD CARRERAS</h1>
    <div class="container-fluid row">
        <form class="col-4" method="POST" action="./CareersController.php">
            <div>
                <h3 class="text-center text-secondary  "><?php echo ($title) ?></h3>
            </div>
            <div class="p-3" style="background-color:#cff4fc;border-radius:2%;">
                <div class="mb-3">
                    <label for="Nombre" class="form-label"><i class="bi bi-person-fill"></i> Nombre </label>
                    <input type="text" class="form-control" name="txtNombre" placeholder="Nombre de la Carrera" value="<?php echo (isset($userData) && $result->status ? $userData->nombre_carrera : '')
                                                                                                                        ?>" required>
                </div><!-- fin label  -->
                <?php if ($title === 'Editar carrera'): ?>
                    <button type="submit" name='userId' class="btn btn-primary" value='<?php echo (isset($userData) && $result->status ? $userData->id : '')
                                                                                        ?>'></i> Editar Carrera</button>
                <?php else: ?>
                    <button type="button" class="btn btn-secondary " id="botonModal" data-toggle="modal" data-target="#materiaModal">
                        Agregar Materia
                    </button>

                    <button type="submit" name="create" class="btn btn-primary" value="Crear"><i class="bi bi-person-add"></i> Crear Carrera</button>
                <?php endif ?>
            </div>
        </form><!--Fin Registrar-->
        <div class="col-8 p-4">
        </div>
    </div>
    <!-- Modal Materia -->
    <div class="modal fade" id="materiaModal" tabindex="-1" role="dialog" aria-labelledby="materiaModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="materiaModal">Materia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2>Datos Materia</h2>
                    <form method="POST" action="./CareersController.php">
                        <!-- Aqui podria colocar el de Profesor -->
                        <div class="mb-3">
                            <label for="Nombre" class="form-label"><i class="bi bi-person-fill"></i> Nombre </label>
                            <input type="text" class="form-control" name="txtNombre" placeholder="Nombre de la Carrera" value="">
                        </div><!-- fin label  -->
                        <div class="mb-3">
                            <label for="Nombre" class="form-label"><i class="bi bi-person-fill"></i> Cantidad Maxima de Alumnos </label>
                            <input type="number" class="form-control" name="txtcantAlmn" placeholder="Cantidad Maxima de Alumnos" value="">
                        </div><!-- fin label  -->
                        <div class="mb-3" style="background-color: #cff4fc;border-radius: 2%;">
                            <label for="userId" class="form-label"><i class="bi bi-person-vcard-fill"></i> Id Profesor</label>
                            <select class="form-select" id="professorId" name="professorId" required>
                                <option value=""> Seleccione el profesor</option>
                                <?php foreach ($Professors as $professor): ?>
                                    <option value="<?php echo ($professor->id) ?>">
                                        <?php echo ($professor->id) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div><!-- fin label  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Devolverse</button>
                            <button type="submit" class="btn btn-primary" name="createMateria">Guardar Materia</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin modal estudiante -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Modales -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>