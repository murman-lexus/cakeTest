<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css', ['rel'=>'stylesheet', 'integrity'=>'sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi', 'crossorigin'=>'anonymous']) ?>

</head>
<body>
<?php if ($this->Identity->isLoggedIn()): ?>
    <?= $this->element('navigation') ?>
<?php endif;?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>
    <?= $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js',['integrity'=>'sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3', 'crossorigin'=>'anonymous'])?>
    <?= $this->Html->script('https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js',['integrity'=>'sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3', 'crossorigin'=>'anonymous'])?>
    <?= $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js',['integrity'=>'sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk', 'crossorigin'=>'anonymous'])?>
</body>
</html>
