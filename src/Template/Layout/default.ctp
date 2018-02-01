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
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
    <!DOCTYPE html>
    <html>

    <head>
        <?= $this->Html->charset() ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>
                Dashboard:
                <?= $this->fetch('title') ?>
            </title>
            <?= $this->Html->meta('icon') ?>



                <?= $this->fetch('meta') ?>
                    <?= $this->fetch('css') ?>
                        <?= $this->fetch('script') ?>
                            <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap/dist/css/bootstrap.min.css" />
                            <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css" />
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/vue"></script>
                            <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.5"></script>
                            <script src="//unpkg.com/babel-polyfill@latest/dist/polyfill.min.js"></script>
                            <script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.js"></script>
                            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
                            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
                            <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
                            <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dialog-polyfill/0.4.9/dialog-polyfill.min.css">
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/dialog-polyfill/0.4.9/dialog-polyfill.min.js"></script>
    </head>

    <body>
        <?php //debug($user); ?>
        <?= $this->Flash->render() ?>
            <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
                <header class="mdl-layout__header">
                    <div class="mdl-layout__header-row">
                        <!-- Title -->
                        <span class="mdl-layout-title">
                            <?= $this->fetch('title') ?>
                        </span>
                        <!-- Add spacer, to align navigation to the right -->
                        <div class="mdl-layout-spacer"></div>
                        <!-- Navigation. We hide it in small screens. -->
                        <nav class="mdl-navigation mdl-layout--large-screen-only">
                            <a class="mdl-navigation__link" href="">
                                <?= $user['username'] ?>
                            </a>

                        </nav>
                    </div>
                </header>
                <div class="mdl-layout__drawer">
                    <span class="mdl-layout-title">
                        Panel de control
                    </span>
                    <nav class="mdl-navigation">
                        <?=
                            $this->Html->link(
                                'Perfil',
                                '/profile/edit',
                                ['class' => 'mdl-navigation__link']
                            );
                        ?>

                            <?=
                            $this->Html->link(
                                'Reservas',
                                '/reservation',
                                ['class' => 'mdl-navigation__link']
                            );
                        ?>

                                <?=
                            $this->Html->link(
                                'Llave de acceso',
                                '/apikey',
                                ['class' => 'mdl-navigation__link']
                            );
                        ?>

<?=
                            $this->Html->link(
                                'Mensajes',
                                '/mesage',
                                ['class' => 'mdl-navigation__link']
                            );
                        ?>


                                    <?=
                            $this->Html->link(
                                'Desconectar',
                                '/users/logout',
                                ['class' => 'mdl-navigation__link']
                            );
                        ?>

                        
                    </nav>
                </div>
                <main class="mdl-layout__content">
                    <div class="page-content container clearfix">
                        <?= $this->fetch('content') ?>
                    </div>

                </main>
            </div>

            <footer>
            </footer>
    </body>

    </html>
