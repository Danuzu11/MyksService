
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

    <title>Carniceria</title>

</head>


<head>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?= $this->Html->css('style_login2.css') ?>

    <body class="bg-cover" style="background-image: url(<?= $this->Url->build('/', ['fullBase' => true]) . 'img/image/carne.jpg' ?>); Background-color: #000">

    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?> 

    <script>
        var mensaje = "<?= $mensaje ?>"

        if (mensaje === "error1") {
            swal("ERROR", "El usuario o contraseña que ingreso estan incorrectos", "error")
        } else if (mensaje === "correcto") {
            swal("Bienvenido", "Su ingreso se completó correctamente.", "success")
        }

    </script>

    <script>
        //script de animacion de logo 
        const welcomeDiv = document.querySelector('.welcome');
        const image = new Image();
        welcomeDiv.classList.add('loaded');
    </script>
</body>

</html>
