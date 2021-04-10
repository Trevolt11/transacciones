<?php
require_once 'transas/hero.php';
require_once 'FileHandler/IFileHandler.php';
require_once 'FileHandler/FileHandlerBase.php';
require_once 'FileHandler/SerializationFileHandler.php';
require_once 'FileHandler/JsonFileHandler.php';
require_once 'helpers/utilities.php';
require_once 'transas/serviceSession.php';
require_once 'transas/ServiceCookies.php';
require_once 'transas/ServiceFile.php';
require_once 'layout/layout.php';

$layout = new Layout(true);
$service = new ServiceFile(true);
$utilities = new Utilities();

$transas = $service->GetList();


?>

<?php echo $layout->printHeader(); ?>

<div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-2">

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevo-transa-modal">
            Nuevo transa
        </button>

    </div>
</div>
<!--
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Datos</th>
                    <th scope="col">monto</th>
                    <th scope="col">fecha</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">edit</th>
                    <th scope="col">delete</th>
                </tr>
            </thead>-->
          
<div class="row">

    <?php if (count($transas) == 0) : ?>

    <h2>No hay transas registrados</h2>

    <?php else : ?>

    <?php foreach ($transas as $key => $hero) : ?>


    
    <div class="card-body">

                <table class="table">
                            
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Datos</th>
                    <th scope="col">monto</th>
                    <th scope="col">fecha</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">edit</th>
                    <th scope="col">delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><?= $hero->Id?></th>
                    <td><?= $hero->Name ?></td>
                    <td><?= $hero->Apellido ?></td>
                    <td>
                    <?php
$fecha = new DateTime(); echo $fecha->getTimestamp();
?>
</td>
                    <td><?= $hero->Description ?></td>


                    <td><a href="transas/edit.php?id=<?= $hero->Id ?>" class="btn btn-primary">Editar</a></td>

                    <td><a href="#" data-id="<?= $hero->Id ?>" class="btn btn-danger btn-delete">Eliminar</a></td>
                </tr>
            </tbody>
        </table>

        <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>

<div class="modal fade" id="nuevo-transa-modal" tabindex="-1" aria-labelledby="nuevotransaLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevotransaLabel">Nuevo transa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="transas/add.php" method="POST">


                   <div class="mb-3">
                        <label for="hero-name" class="form-label">Datos de la transaccion</label>
                        <input name="HeroName" type="text" class="form-control" id="hero-name">
                    </div>

                    <div class="mb-3">
                        <label for="hero-apellido" class="form-label">monto</label>
                        <input name="HeroApellido" type="text" class="form-control" id="hero-Apellido">
                    </div>


                    <div class="mb-3">
                        <label for="hero-description" class="form-label">Descripcion</label>
                        <input name="HeroDescription" type="text" class="form-control" id="hero-description">
                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $layout->printFooter(); ?>

<script src="assets/js/site/index/index.js"></script>