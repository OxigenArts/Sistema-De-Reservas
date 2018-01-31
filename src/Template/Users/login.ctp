<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <?= $this->Html->css('login'); ?>
</head>

<body>
    <div class="logincontainer">
        <?= $this->Form->create() ?>
            <div>
                <div class="mdl-textfield mdl-js-textfield">
                    <?= $this->Form->control('username', ['class' => 'mdl-textfield__input', 'type' => 'text', 'label' => false]) ?>
                        <label class="mdl-textfield__label" for="username">Usuario</label>
                </div>
            </div>
            <div>
                <div class="mdl-textfield mdl-js-textfield">
                    <?= $this->Form->control('password', ['class' => 'mdl-textfield__input', 'type' => 'password', 'label' => false]) ?>
                        <label class="mdl-textfield__label" for="password">Contraseña</label>
                </div>
            </div>
            <div>
                <?= $this->Form->button('Ingresar', ['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect']) ?>
            </div>


            <?= $this->Form->end() ?>
            

            <?= $this->Flash->render() ?>
    </div>


</body>