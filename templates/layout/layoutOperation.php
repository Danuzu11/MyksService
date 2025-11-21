<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

// $user = $_SESSION['Auth'];
// $user = $user['User'];

?>

<!DOCTYPE html>
<html lang="en" class="mainView h-full bg-slate-900">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Carniceria</title>

</head>



<body class="h-full flex">

    <div class="menu-lateral bg-slate-950 h-full">
        <ul>
            <nav>

                <li class="image-and-text mx-5">
                    <img class="rounded-md" id="logo"
                        src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/image/logoMks.png' ?>" alt="Imagen" style="display:none">
                    <h1 class="mx-3">MKSProductions</h1>
                </li>
                <br>

                <p class="image-and-text mx-5">Menu</p>

                <li>
                    <a href="<?= $this->Url->build('/', ['fullBase' => true]) . 'users/logout' ?>" id="btn-logout">
                        <img class="img-aling"
                            src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/icons-logout_3.png' ?>"
                            alt="Imagen">
                        Salir
                    </a>
                </li>

                <li>
                    <a href="#" id="btn-back" style="b">
                        <img class="img-aling"
                            src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/flecha-izquieda.png' ?>"
                            alt="Imagen">
                        Atras
                    </a>
                </li>
                
            </nav>
        </ul>
    </div>
    <?= $this->Flash->render("index") ?>
    <?= $this->fetch('content') ?>

</body>


</html>


<script>

    if (document.getElementById('btn-logout')) {
        document.getElementById("btn-back").addEventListener("click", function(event) {
            event.preventDefault(); // Prevent default form submission behavior
            window.history.back(); // Navigate to the previous page in history
        });
    }

    if (document.getElementById('btn-logout')) {
        const btnLogout = document.getElementById('btn-logout');

        // Agregar un evento click al botón
        btnLogout.addEventListener('click', (event) => {

            // Detener el comportamiento normal del botón
            event.preventDefault();

            // Alerta si confirma deslogeo
            swal({
                title: "Deslogeando..",
                text: "¿Estás seguro de que quieres cerrar sesión?",
                icon: "warning",
                dangerMode: true,
                buttons: ["Cancel", "Ok"],
            }).then((logout) => {
                if (logout) {
                    swal("Se ha deslogeado exitosamente", {
                        icon: "success",
                    }).then((success) => {
                        window.location.href = "<?= $this->Url->build('/', ['fullBase' => true]) . 'Users/logout' ?>";
                    });
                } else {
                    swal("No se ha deslogeado");
                }
            });

        });
    }
</script>

<style>
    body {
        height: 100%;
        width: 100%;
    }

     .menu-lateral {
        color: white;
        position: relative;
        padding-top: 20px;
        padding-bottom: 20px;
        width: 100%;
        height: 100%;
        max-width: 350px;
        margin-right: 10px;
        left: 0;
        top: 0;
    }

    .menu-lateral nav {
        padding-top: 30px;
    }

    .menu-lateral li {
        font-size: 14px;
    }

    .menu-lateral nav a {
        display: block;
        text-decoration: none;
        padding: 20px;
    }

    .menu-lateral nav a:hover {
        border-left: 5px solid #F58787;
        background: #B82121;
    }

    .image-and-text {
        display: flex;
        align-items: center;
    }

    .image-and-text img {
        max-width: 70px;
        max-height: 70px;
    }

    .img-aling {
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-right: 3px;
    }
</style>

<script>
    window.addEventListener('load', function () {
        var logo = document.getElementById('logo');
        logo.style.display = 'block';
    });
</script>