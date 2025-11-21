<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<div class="container-form sign-in">
    <div class="opacity-90 w-96 bg-slate-800 rounded-lg px-6 py-36 ring-1 ring-slate-900/5 shadow-xl/30 items-center text-center border-2 border-x-indigo-200 "
        id="fix-width"
    >

        <div class="w-1/2">
            <img class="rounded-md h-auto rounded-full" src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/image/logoMks.png' ?>" alt="ImagenPerfil">
        </div>

        <h1 class="p-2 mb-5 font-bold text-3xl text-rose-600  md:text-center">
            Iniciar Sesion 
        </h1>

        <?= $this->Form->create(null, ['name' => 'formulario', 'class' => 'p-3 formulario', 'id' => 'formulario', 'url' => ['controller' => 'users', 'action' => 'login/'.$rol]]) ?>

        <div class="formulario__grupo-input">
            <?= $this->Form->control('Usuario', ['id' => "username", 'class' => 'rounded-lg p-3 formulario__grupo-input w-full py-2 bg-gray-100 text-gray-500 px-1 outline-none mb-4', 'name' => 'username', 'value' => '']) ?>
        </div>  

        <div class="formulario__grupo-input">
            <?= $this->Form->control('Contraseña', ['id' => "password", 'class' => 'rounded-lg p-3 formulario__grupo-input w-full py-2 bg-gray-100 text-gray-500 px-1 outline-none mb-4', 'type' => 'password', 'name' => 'password', 'value' => '']) ?>
        </div>

        <?= $this->Form->button('Iniciar Sesion', ['class' => 'font-bold bg-blue-500 w-full text-gray-100 py-2 rounded-lg hover:bg-blue-600 transition-colors mt-4', 'type' => 'submit', 'onclick' => 'validar();']) ?>

        <?= $this->Form->end() ?>

    </div>
</div>


<script>
    // Verificar la versión del navegador al cargar la página
    window.onload = function () {
        const userAgent = navigator.userAgent.toLowerCase();
        var isChrome = /chrome/.test(userAgent);
        var isFirefox = /firefox/.test(userAgent);
        var isSafari = /safari/.test(userAgent);
        var isOpera = /opr/.test(userAgent);
        var isIE = /msie|trident/.test(userAgent);
        var isBrave = /brave/.test(userAgent);
        var isEdg = /edg/.test(userAgent);

        // manejar las versiones minimas permitidas
        var minChrome = 80;
        // var minFirefox = 70;
        var minFirefox = 200;
        var minSafari = 12;
        var minOpera = 60;
        var minIE = 11;
        var minBrave = 1.1;
        var minEdg = 2;
        var redirigir = "../users/actualizacion"; // link de la pagina para que cambie de nav

        // desactivar navegadores
        var offChrome = false;
        var offFirefox = false; // apagamos firefox 
        var offSafari = false;
        var offOpera = false;
        var offIE = false;
        var offBrave = false;
        var offEdg = false;
        var off_navegador_desconocido = false;


        // condicional para filtrar las declaraciones erradas de Opera y Microsofot Edge
        if (isEdg) {
            isChrome = false;
            isSafari = false;
        } else if (isOpera) {
            isChrome = false;
            isSafari = false;
        }



        if (isChrome) {
            const chromeVersion = userAgent.match(/chrome\/(\d+)/)[1];


            if ((chromeVersion < minChrome) || offChrome) {

                alert('Su versión de Chrome es demasiado antigua. Por favor, actualice su navegador.');
                window.location.href = redirigir; // Redirigir a la pagina de cambio de nav
            }
        } else if (isFirefox) {

            const firefoxVersion = userAgent.match(/firefox\/(\d+)/)[1];

            if ((firefoxVersion < minFirefox) || offFirefox) {
                alert('Su versión de Firefox es demasiado antigua. Por favor, actualice su navegador.');
                window.location.href = redirigir; // Redirigir a la pagina de cambio de nav
            }
        } else if (isSafari) {

            const safariVersion = userAgent.match(/version\/(\d+)/)[1];
            if ((safariVersion < minSafari) || offSafari) {
                alert('Su versión de Safari es demasiado antigua. Por favor, actualice su navegador.');
                window.location.href = redirigir; // Redirigir a la pagina de cambio de nav
            }
        } else if (isOpera) {

            const operaVersion = userAgent.match(/opr\/(\d+)/)[1];
            if ((operaVersion < minOpera) || offOpera) {
                alert('Su versión de Opera es demasiado antigua. Por favor, actualice su navegador.');
                window.location.href = redirigir; // Redirigir a la pagina de cambio de nav
            }
        } else if (isIE) {
            const ieVersion = userAgent.match(/(msie|rv:)\s?([\d\.]+)/)[2];
            if ((ieVersion < minIE) || offIE) {
                alert('Su versión de Internet Explorer es demasiado antigua. Por favor, actualice su navegador.');
                window.location.href = redirigir; // Redirigir a la pagina de cambio de nav
            }
        } else if (isEdg) {

            EdgVersion = userAgent.match(/edg\/(\d+(\.\d+)?)/)[1];

            if ((EdgVersion < minEdg) || offEdg) {
                alert('Su versión de Micrsoft Edge es demasiado antigua. Por favor, actualice su navegador.');
                window.location.href = redirigir; // Redirigir a la pagina de cambio de nav
            }
        } else if (isBrave) {
            const braveVersion = userAgent.match(/brave\/(\d+(\.\d+)?)/)[1];
            if ((parseFloat(braveVersion) < minBrave) || offBrave) {
                alert('Su versión de Brave es demasiado antigua. Por favor, actualice su navegador.');
                window.location.href = redirigir; // Redirigir a la pagina de cambio de nav
            }
        } else if (off_navegador_desconocido) {
            alert('No se pudo detectar su navegador. Por favor, utilice uno de los siguientes navegadores: Chrome, Firefox, Safari, Opera o una versión compatible de Internet Explorer.');
            window.location.href = redirigir; // Redirigir a la pagina de cambio de nav
        }
    };
</script>