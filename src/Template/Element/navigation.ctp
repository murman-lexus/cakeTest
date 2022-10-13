<?php if ($this->Identity->isLoggedIn()): ?>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <?= $this->Html->link(__('Tasks'),  ['controller' => 'Tasks', 'action' => 'index'], ['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link(__('Types'), ['controller' => 'Types', 'action' => 'index'], ['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link(__('Statuses'), ['controller' => 'Statuses', 'action' => 'index'], ['class' => 'nav-link']) ?>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?= $this->Html->link($this->Identity->get('fullname'), ['controller' => 'Users', 'action' => 'edit',$this->Identity->get('id')], ['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link']) ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php endif; ?>
