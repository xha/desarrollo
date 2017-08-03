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
                                    ['label' => 'Recuperar Usuario', 'icon' => 'unlock', 'url' => ['../../backend/web/site/recuperar']],
                                    ['label' => 'Activar Usuario', 'icon' => 'clock-o', 'url' => ['../../backend/web/site/activar']],
                            ],];
            $menuItems[] = ['label' => 'Pisos', 'icon' => 'folder', 'url' => ['../../frontend/web/piso']];
            $menuItems[] = ['label' => 'Ubicaciones', 'icon' => 'gear', 'url' => ['../../frontend/web/ubicacion']];
            $menuItems[] = ['label' => 'Alicuota', 'icon' => 'star', 'url' => ['../../frontend/web/alicuota']];
            $menuItems[] = ['label' => 'Presupuesto', 'icon' => 'clock-o', 'url' => ['../../frontend/web/presupuesto']];
            $menuItems[] = ['label' => 'Condominio', 'icon' => 'folder-o', 'url' => ['../../frontend/web/presupuesto/procesar']];
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
