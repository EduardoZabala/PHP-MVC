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
    <h1 class="text-center p-3">CRUD PHP</h1>
    <div class="container-fluid row">
        <form class="col-4" method="POST" action="./ClientsController.php">
            <div>
                <h3 class="text-center text-secondary  "><?php echo ($title) ?></h3>
            </div>
            <div class="p-3" style="background-color:#cff4fc;border-radius:2%;">
                <div class="mb-3" style="background-color: #cff4fc;border-radius: 2%;">
                    <label for="Cedula" class="form-label"><i class="bi bi-person-vcard-fill"></i> Cedula</label>
                    <input type="text" class="form-control" name="txtCedula" placeholder="Cedula del Usuario" value="<?php echo (isset($userData) && $result->status ? $userData->cedula : '') ?>" required>
                </div><!-- fin label  -->
                <div class="mb-3">
                    <label for="Nombre" class="form-label"><i class="bi bi-person-fill"></i> Nombre </label>
                    <input type="text" class="form-control" name="txtNombre" placeholder="Nombre del Usuario" value="<?php echo (isset($userData) && $result->status ? $userData->nombre_completo : '') ?>" required>
                </div><!-- fin label  -->
                <div class="mb-3">
                    <label for="role" class="form-label"><i class="bi bi-person-vcard-fill"></i> Role</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="" <?php if (isset($userData) && $result->status): ?>selected <?php endif ?>> Seleccione el rol</option>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?php echo ($role->role_id) ?>" <?php if (((isset($userData) && $result->status)) && $userData->role_id === $role->role_id): ?> selected <?php endif ?>>
                                <?php echo ($role->nombre) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div><!-- fin label  -->
                <div class="mb-3">
                    <label for="Celular" class="form-label"><i class="bi bi-telephone-fill"></i> Celular </label>
                    <input type="text" class="form-control" name="txtCelular" placeholder="Celular del cliente" value="<?php echo (isset($userData) && $result->status ? $userData->celular : '') ?>" required>
                </div><!-- fin label  -->
                <div class="mb-3">
                    <label for="Contraseña" class="form-label"><i class="bi bi-key-fill"></i> Contraseña</label>
                    <input type="text" class="form-control" name="txtContraseña" placeholder="Contraseña del Cliente">
                </div><!-- fin label  -->
                <?php if ($title === 'Editar usuario'): ?>
                    <label for="tipoUser" class="form-label"><i class="bi bi-person-fill"></i> Tipo de Usuario </label>

                    <select class="form-select" id="tipoUser" name="tipoUser" required onchange="updateModalTarget()">

                        <option value="0"> Seleccione el Tipo de usuario</option>
                        <option value="1">Estudiante</option>
                        <option value="2">Profesor</option>
                    </select>
                    <button type="button" class="btn btn-secondary mt-2" id="modalButton" data-toggle="modal" data-target="#default" style="display: none;">
                        Agregar tipo Usuario
                    </button>
                    <button type="submit" name='userId' class="btn btn-primary mt-2" value='<?php echo (isset($userData) && $result->status ? $userData->id : '') ?>'></i> Editar Usuario</button>
                <?php else: ?>
                    <button type="submit" name="create" class="btn btn-primary mt-2" value="Crear"><i class="bi bi-person-add"></i> Crear usuario</button>
                <?php endif ?>
            </div>
        </form><!--Fin Registrar-->
        <!-- Modal Estudiante -->
        <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="studentModal">Estudiante</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h2>Datos Estudiante</h2>
                        <form  method="POST" action="./ClientsController.php">
                            <!-- Podria colocarl el action del StudentsController  -->
                            <div class="mb-3" style="background-color: #cff4fc;border-radius: 2%;">
                                <label for="userId" class="form-label"><i class="bi bi-person-vcard-fill"></i> Id del Usuario</label>
                                <select class="form-select" id="usuarioId" name="usuarioId" required>
                                    <option value="" <?php if (isset($userId) && $result->status): ?>selected <?php endif ?>> Seleccione el Usuario</option>

                                    <?php foreach ($users as $user): ?>
                                        <option value="<?php echo ($user->id) ?>" <?php if (((isset($userData) && $result->status)) && $userData->id === $user->id): ?> selected <?php endif ?>>
                                            <?php echo ($user->id) ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div><!-- fin label  -->

                            <div class="mb-3">
                                <label for="careerId" class="form-label"><i class="bi bi-person-vcard-fill"></i> Nombre de la Carrera</label>
                                <select class="form-select" id="career" name="careerId" required>
                                    <option value="" <?php if (isset($userData) && $result->status): ?>selected <?php endif ?>> Seleccione la carrera</option>

                                    <?php foreach ($careers as $career): ?>

                                        <option value="<?php echo ($career->id) ?>">
                                            <?php echo ($career->nombre_carrera) ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Devolverse</button>
                                <button type="submit" class="btn btn-primary" name="createStudent">Guardar Estudiante</button>
                            </div>
                        </form>
                    </div>

                    
                </div>
            </div>
        </div>
        <!-- Fin modal estudiante -->

        <!-- Modal Profesor -->
        <div class="modal fade" id="profesorModal" tabindex="-1" role="dialog" aria-labelledby="profesorModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="profesorModal">Profesor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h2>Datos Profesor</h2>
                        <form  method="POST" action="./ClientsController.php">
                            <!-- Podria colocarl el action del StudentsController  -->
                            <div class="mb-3" style="background-color: #cff4fc;border-radius: 2%;">
                                <label for="userId" class="form-label"><i class="bi bi-person-vcard-fill"></i> Id del Usuario</label>
                                <select class="form-select" id="usuarioId" name="usuarioId" required>
                                    <option value="" <?php if (isset($userId) && $result->status): ?>selected <?php endif ?>> Seleccione el Usuario</option>

                                    <?php foreach ($users as $user): ?>
                                        <option value="<?php echo ($user->id) ?>" <?php if (((isset($userData) && $result->status)) && $userData->id === $user->id): ?> selected <?php endif ?>>
                                            <?php echo ($user->id) ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div><!-- fin label  -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Devolverse</button>
                                <button type="submit" class="btn btn-primary" name="createProfesor">Guardar Profesor</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin modal estudiante -->





    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Js pra la modales -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Js personalizado -->
    <script src="../assets/js/ClientManager.js"></script>
    <script src="sweetalert2.all.min.js"></script>
</body>

</html>