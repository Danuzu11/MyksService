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

?>

<!DOCTYPE html>
<html lang="en" class="mainView h-full bg-slate-900">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Dashboard</title>

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
                    <a href="<?= $this->Url->build('/', ['fullBase' => true]) . 'users/login/1' ?>">
                        <img class="img-aling"
                            src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/icons-usuarios-registrados.png' ?>"
                            alt="Imagen">
                        Administrador
                    </a>
                </li>

                <li>
                    <a href="<?= $this->Url->build('/', ['fullBase' => true]) . 'users/login/2' ?>">
                        <img class="img-aling"
                            src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/icons-usuario_1.png' ?>"
                            alt="Imagen">
                        Cajero
                    </a>
                </li>

                <!-- <li>
                    <a href="<?= $this->Url->build('/', ['fullBase' => true]) . 'users/login/3' ?>">
                        <img class="img-aling"
                            src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/icons-usuario_1.png' ?>"
                            alt="Imagen">
                        Carnicero
                    </a>
                </li> -->
            </nav>
        </ul>
    </div>
    <?= $this->Flash->render("index") ?>
    <?= $this->fetch('content') ?>

</body>


</html>


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