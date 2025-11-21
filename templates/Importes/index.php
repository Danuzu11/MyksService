<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Importe> $importes
 */

?>

<?= $this->Html->css('indexInterfaces.css') ?>

<div class="mainCard column">

    <div class="bienvenida-conteo flex">

        <div class="bienvenida-Admin bg-slate-950 rounded-3xl mx-4 my-8 shadow-md ">
            <h1 style="font-weight: 600;"> Bienvenido al menu de busquedas de importes </h1>
            <p class="mt-5">
                !Bienvenido! en este apartado podras visualizar y editar los importes registrados en la plataforma
            </p>
        </div>
    </div>

    <div class="tabla bg-slate-950 rounded-3xl ">
        <table class="table-fixed">
            <div class="clase-contenedor mb-5">
                <?= $this->Html->link('Agregar Importe nuevo', ['controller' => 'importes', 'action' => 'add'], ['class' => 'buttonAdd ml-4']); ?>
            </div>
            <div class="col-span-1" style="display: flex; flex-direction: row; justify-content: space-between;">

                <div class="header">
                    <h1 class="mx-5" style="font-weight: 600;">Importes</h1>
                </div>
            </div>

            <thead>
                <tr>
                    <th scope="col">
                        <?= $this->Paginator->sort('Distribuidor') ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('Fecha') ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('Precio') ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('Lista de Productos') ?>
                    </th>
                    <th scope="col" class="actions">
                        <?= _('Actions') ?>
                    </th>
                </tr>
            </thead>
            <?php if ($importes != 'null') { ?>
                <tbody>
                    <?php foreach ($importes as $importe): ?>
                        <tr>
                            <td>
                                <?= h($importe->distribuidore->nombre) ?>
                            </td>
                            <td>
                                <?= h($importe->fecha->format('d-m-Y')) ?>
                            </td>

                            <td>
                                <?= h($importe->precio) ?>
                            </td>

                            <td>
                                <?php if ($importe->productos != null) { ?>
                                    <?php $productosImportados = json_decode($importe->productos) ?>
                                    <select style="color: green;" id="select-categoria" name="id_distribuidor"
                                        class="form-control2 rounded shadow-sm select-status" required>
                                        <?php foreach ($productosImportados as $key => $productoImportado): ?>
                                            <option style="color: green;" value="<?php echo $productoImportado ?>">
                                                <?php echo $productoImportado ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php } else { ?>
                                    <?= "[No hay productos]" ?>
                                <?php } ?>
                            </td>

                            <td class="actions">
                                <?= $this->Html->link(__('Ver'), ['action' => 'View', $importe->id]) ?>
                                <?= $this->Html->link(__('Editar'), ['action' => 'Edit', $importe->id], ['class' => 'mx-4']) ?>

                                <button id="btn-delete-doctor" name="<?= $importe->id ?>/<?= $importe->id ?>"
                                    style="color: red;">Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php } ?>
        </table>
    </div>
    <?php if ($importes != 'null') { ?>
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
        <p><?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} registro(s) actuales de {{count}} en total')) ?>
        </p>
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
                const idImporte = nombre_id[1];

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
                        form.action = 'importes/delete/' + idImporte;

                        var inputNombre = document.createElement("input");
                        inputNombre.type = "hidden";
                        inputNombre.name = "nombre";
                        inputNombre.value = nombre;

                        var inputId = document.createElement("input");
                        inputId.type = "hidden";
                        inputId.name = "id";
                        inputId.value = idImporte;

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