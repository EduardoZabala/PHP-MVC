<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Icons bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
                    <button type="submit" name="create" class="btn btn-primary" value="Crear"><i class="bi bi-person-add"></i> Crear Carrera</button>
                <?php endif ?>
            </div>
        </form><!--Fin Registrar-->
        <div class="col-8 p-4">
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>