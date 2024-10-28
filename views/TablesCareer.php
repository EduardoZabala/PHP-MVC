<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Carrera</title>
    <!-- Icons bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand pl-2" href="./ClientsController.php"> Universidad</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="./CareersController.php">CRUD CARRERAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                </ul>

            </div>
        </nav>
        <h2 class="mt-1">Lista de Carrera</h2>
        <!-- Filtros -->
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" class="form-control" id="search-input"
                    placeholder="Buscar usuario por nombre o cédula">
            </div>
            <div class="col-md-4">
                <select class="form-select" id="role-filter">
                    <option value="">Filtrar por rol</option>
                    <option value="1">Administrador</option>
                    <option value="2">Usuario</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-secondary" id="clear-filters">Limpiar Filtros</button>
            </div>
        </div>

        <a href="./CareersController.php?create=true">
            <button class="btn btn-success">
                Crear carrera
            </button>
        </a>

        <!-- Tabla -->
        <table class="table table-bordered my-3">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="user-table-body">
                <!-- Los usuarios se generarán dinámicamente aquí -->
                <?php foreach ($results->registers as $user): ?>
                <tr>
                    <td><?php echo ($user->nombre_carrera) ?></td>
                    <td>
                        <a href="http://localhost/CRUD-php/controllers/CareersController.php?userId=<?php echo ($user->id) ?>" class="btn btn-warning btn-sm edit-user" data-id="1">Editar</a>
                        <a href="http://localhost/CRUD-php/controllers/CareersController.php?deleteId=<?php echo ($user->id) ?>" class="btn btn-danger btn-sm delete-user">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach?>
            </tbody>
        </table>

        <!-- Paginación -->
        <nav aria-label="Page navigation example">
        <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="http://localhost/CRUD-php/controllers/CareersController.php?page=<?php echo (($results->currentPage - 1 == 0) ? 1 : $results->currentPage - 1) ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php $count = 0 ?>
                <li class="page-item"><a class="page-link" href="http://localhost/CRUD-php/controllers/CareersController.php?page=<?php echo ($results->currentPage) ?>"><?php echo ($results->currentPage) ?></a></li>

                <?php for ($i = $results->currentPage; $i <= $results->totalPages; $i++): ?>
                    <?php
                    if ($i == $results->currentPage) {
                        continue;
                    }
                    if ($count == 5) {
                        break;
                    }
                    ?>
                    <li class="page-item"><a class="page-link" href="http://localhost/CRUD-php/controllers/CareersController.php?page=<?php echo ($i) ?>"><?php echo ($i) ?></a></li>
                    <?php $count++ ?>
                <?php endfor ?>
                <li class="page-item">
                    <a class="page-link" href="http://localhost/CRUD-php/controllers/CareersController.php?page=<?php echo (($results->currentPage + 1 < $results->totalPages) ? $results->currentPage + 1 : $results->totalPages) ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


</body>

</html>