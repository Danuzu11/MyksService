<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Producto> $productos
 */
?>

<?= $this->Html->css('indexInterfaces.css') ?>

<div class="mainCard column">

    <div class="bienvenida-conteo flex">

        <div class="bienvenida-Admin bg-slate-950 rounded-3xl mx-4 my-8 shadow-md ">
            <h1 style="font-weight: 600;"> Bienvenido al menu de busquedas de inventario </h1>
            <p class="mt-5">
                !Bienvenido! en este apartado podras buscar los productos registrados en la plataforma
            </p>
        </div>

    </div>

    <div class="tabla bg-slate-950 rounded-3xl">
        <table class="table-fixed">
            <div class="clase-contenedor mb-5">
                <?= $this->Html->link('Agregar Producto nuevo', ['controller' => 'productos', 'action' => 'add'], ['class' => 'buttonAdd ml-4']); ?>
            </div>
            <div class="col-span-1" style="display: flex; flex-direction: row; justify-content: space-between;">

                <div class="header">
                    <h1 class="mx-5" style="font-weight: 600;">Productos</h1>
                </div>


            </div>

            <thead>
                <tr>
                    <th scope="col">
                        <?= $this->Paginator->sort('nombre') ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('Descripcion') ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('Categoria') ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('Precio') ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('Stock') ?>
                    </th>
                    <th scope="col" class="actions">
                        <?= _('Actions') ?>
                    </th>
                </tr>
            </thead> 
            <?php if($productos != 'null'){ ?>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td>
                                <?= h($producto->nombre) ?>
                            </td>

                            <td>
                                <?= h($producto->descripcion) ?>
                            </td>
                            <td>
                                <?= h($producto->categoria->tipo_producto) ?>
                            </td>
                            <td>
                                <?= h($producto->precio) ?>
                            </td>
                            <td>
                                <?= h($producto->stock) ?>
                            </td>
                            <td class="actions">
                                <?= $this->Html->link(__('Ver'), ['action' => 'View', $producto->id]) ?>
                                <?= $this->Html->link(__('Editar'), ['action' => 'Edit', $producto->id], ['class' => 'mx-4']) ?>

                                <button id="btn-delete-doctor" name="<?= $producto->nombre ?>/<?= $producto->id ?>"
                                    style="color: red;">Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php } ?>
        </table>
    </div>
    <?php if($productos != 'null'){ ?>
    <div class="paginators">

        <ul class="paginationDoctor">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>

    </div>

    <p class="text-paginator">
        <p><?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} registro(s) actuales de {{count}} en total')) ?></p>
    </p>
    <?php } ?>
</div>



<script>
    const botones = document.querySelectorAll("#btn-delete-doctor");

    if (botones) {
        for (const boton of botones) {

            boton.addEventListener('click', (event) => {

                // Detiene el comportamiento normal del botón
                event.preventDefault();

                // Asigno las variables nombre y id y las pico para usarlas
                const nombre_id = boton.name.split("/");
                const nombre = nombre_id[0];
                const idProductos = nombre_id[1];

                // Alerta si confirma eliminacion
                swal({
                    title: "Eliminando..",
                    text: "¿Estás seguro de que quieres eliminar el registro " + nombre + " ?",
                    icon: "warning",
                    dangerMode: true,
                    buttons: ["Ok", "Cancel"],
                }).then((logout) => {
                    if (!logout) {
                        // window.location.href = 'medicos/delete/' + id;

                        var form = document.createElement("form");
                        form.method = "POST";
                        form.action = 'productos/delete/' + idProductos;

                        var inputNombre = document.createElement("input");
                        inputNombre.type = "hidden";
                        inputNombre.name = "nombre";
                        inputNombre.value = nombre;

                        var inputId = document.createElement("input");
                        inputId.type = "hidden";
                        inputId.name = "id";
                        inputId.value = idProductos;

                        form.appendChild(inputNombre);
                        form.appendChild(inputId);

                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        }
    }

</script>
