<aside class="main-sidebar">

    <section class="sidebar">
    <?php
       if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Registrarse', 'icon' => 'file-o', 'url' => ['../../backend/web/site/register']];
            $menuItems[] = ['label' => 'Login', 'icon' => 'circle-o', 'url' => ['../../backend/web/site/login']];
            $menuItems[] = ['label' => 'Recuperar Usuario', 'icon' => 'unlock', 'url' => ['../../backend/web/site/recuperar']];
        } else {
            $menuItems[] = ['label' => 'Configuración', 'icon' => 'circle-o', 'url' => '#',
                                'items' => [
                                    ['label' => 'Accion', 'icon' => 'check', 'url' => ['../../backend/web/accion']],
                                    ['label' => 'Rol', 'icon' => 'check', 'url' => ['../../backend/web/rol']],
                                    ['label' => 'Rol - Accion', 'icon' => 'check', 'url' => ['../../backend/web/rol-accion']],
                                    ['label' => 'Recuperar Usuario', 'icon' => 'check', 'url' => ['../../backend/web/site/recuperar']],
                                    ['label' => 'Activar Usuario', 'icon' => 'check', 'url' => ['../../backend/web/site/activar']],
                                    ['label' => 'Cambiar Clave', 'icon' => 'check', 'url' => ['../../backend/web/site/cambiar']],
                            ],];
            $menuItems[] = ['label' => 'Tablas Básicas', 'icon' => 'folder-o', 'url' => '#',
                                'items' => [
                                    ['label' => 'Marca', 'icon' => 'check', 'url' => ['../../frontend/web/marca']],
                                    ['label' => 'Modelo', 'icon' => 'check', 'url' => ['../../frontend/web/modelo']],
                                    ['label' => 'Tipo de Vehículo', 'icon' => 'check', 'url' => ['../../frontend/web/tipo-vehiculo']],
                                    ['label' => 'Cliente', 'icon' => 'check', 'url' => ['../../frontend/web/cliente']],
                                    ['label' => 'Proveedor', 'icon' => 'check', 'url' => ['../../frontend/web/proveedor']],
                                    ['label' => 'Alianza', 'icon' => 'check', 'url' => ['../../frontend/web/alianza']],
                                    ['label' => 'Productos', 'icon' => 'check', 'url' => ['../../frontend/web/producto']],
                                    ['label' => 'Servicios', 'icon' => 'check', 'url' => ['../../frontend/web/servicio']],
                            ],];
            $menuItems[] = ['label' => 'Vehículo', 'icon' => 'car', 'url' => ['../../frontend/web/vehiculo']];
            $menuItems[] = ['label' => 'Generar Orden', 'icon' => 'gear', 'url' => ['../../frontend/web/transaccion']];
            $menuItems[] = ['label' => 'Almacen', 'icon' => 'inbox', 'url' => ['../../frontend/web/transaccion/solicitud']];
            $menuItems[] = ['label' => 'Factura de Alianza', 'icon' => 'pencil', 'url' => ['../../frontend/web/alianza-transaccion']];
            $menuItems[] = ['label' => 'Taller', 'icon' => 'wrench', 'url' => ['../../frontend/web/transaccion/taller']];
            $menuItems[] = ['label' => 'Cerrar Orden', 'icon' => 'folder', 'url' => ['../../frontend/web/transaccion/cerrar']];
            $menuItems[] = ['label' => 'Reabrir Orden', 'icon' => 'folder-open', 'url' => ['../../frontend/web/transaccion/abrir']];
            $menuItems[] = ['label' => 'Reportes', 'icon' => 'book', 'url' => '#',
                                'items' => [
                                    ['label' => 'Ordenes', 'icon' => 'check', 'url' => ['../../frontend/web/marca']],
                                    ['label' => 'Solicitudes', 'icon' => 'check', 'url' => ['../../frontend/web/modelo']],
                                    ['label' => 'Facturas de Alianza', 'icon' => 'check', 'url' => ['../../frontend/web/modelo']],
                            ],];
        }
    ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => $menuItems,
            ]
        ) ?>

    </section>

</aside>
