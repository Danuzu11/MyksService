<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Distribuidore $distribuidores
 */
?>

<?= $this->Html->css('indexInterfaces.css') ?>

<div class="mainCard column">

    <div class="bienvenida-conteo flex">

        <div class="bienvenida-Admin bg-slate-950 rounded-3xl mx-4 my-8 shadow-md ">
            <h1 style="font-weight: 600;"> Bienvenido al menu de busquedas de distribuidores </h1>
            <p class="mt-5">
                !Bienvenido! en este apartado podras visualizar y editar los distribuidores registrados en la plataforma
            </p>
        </div>

    </div>

    <div class="tabla bg-slate-950 rounded-3xl">
        <table class="table-fixed">

            <div class="clase-contenedor mb-5">
                <?= $this->Html->link('Agregar Distribuidor', ['controller' => 'distribuidores', 'action' => 'add'], ['class' => 'p-3 buttonAdd ml-4']); ?>
            </div>

            <div class="col-span-1" style="display: flex; flex-direction: row; justify-content: space-between;">

                <div class="header">
                    <h1 class="mx-5" style="font-weight: 600;">Distribuidores</h1>
                </div>

                <!-- <div class="search my-auto">
                    <?= $this->Form->create(null, ['url' => ['action' => 'index'], 'type' => 'get']) ?>
                    <div class="mx-20" style="display: flex;">

                        <div class="input text mx-5">
                            <?= $this->Form->control('search', ['label' => false, 'class' => 'form-control rounded-md', 'placeholder' => 'Buscar nombre o Codigo']) ?>
                        </div>

                        <div class="input submit">
                            <?= $this->Form->button('Buscar', ['class' => 'w-full buttonSearch']) ?>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div> -->

            </div>

            <thead>
                <tr>
                    <th scope="col">
                        <?= $this->Paginator->sort('Nombre de Distribuidor') ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('Telefono') ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('Descripcion') ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('Direccion') ?>
                    </th>
                    <th scope="col" class="actions">
                        <?= _('Actions') ?>
                    </th>
                </tr>
            </thead>
            <?php if($distribuidores != 'null'){ ?>
                <tbody>
                    <?php foreach ($distribuidores as $distribuidore): ?>
                        <tr>
                            <td>
                                <?= h($distribuidore->nombre) ?>
                            </td>

                            <td>
                                <?= h($distribuidore->tlf) ?>
                            </td>

                            <td>
                                <?= h($distribuidore->descripcion) ?>
                            </td>
                            
                            <td>
                                <?= h($distribuidore->direccion) ?>
                            </td>

                            <td class="actions">
                                <?= $this->Html->link(__('Ver'), ['action' => 'View', $distribuidore->id]) ?>
                                <?= $this->Html->link(__('Editar'), ['action' => 'Edit', $distribuidore->id], ['class' => 'mx-4']) ?>

                                <button id="btn-delete-doctor" name="<?= $distribuidore->nombre ?>/<?= $distribuidore->id ?>"
                                    style="color: red;">Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php } ?>
        </table>
    </div>
    <?php if($distribuidores != 'null'){ ?>
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
                const iddistribuidore = nombre_id[1];

                // Alerta si confirma eliminacion
                swal({
                    title: "Eliminando..",
                    text: "¿Estás seguro de que quieres eliminar el distribuidor " + nombre + " ?",
                    icon: "warning",
                    dangerMode: true,
                    buttons: ["Ok", "Cancel"],
                }).then((logout) => {
                    if (!logout) {
                        // window.location.href = 'medicos/delete/' + id;

                        var form = document.createElement("form");
                        form.method = "POST";
                        form.action = 'distribuidores/delete/' + iddistribuidore;

                        var inputNombre = document.createElement("input");
                        inputNombre.type = "hidden";
                        inputNombre.name = "nombre";
                        inputNombre.value = nombre;

                        var inputId = document.createElement("input");
                        inputId.type = "hidden";
                        inputId.name = "id";
                        inputId.value = iddistribuidore;

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
