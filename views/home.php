<nav class="create-wapper-nav">
    <a href="<?= url('/novo-wapper') ?>">novo wapper</a>
</nav>

<?php if (! empty($wappers)): ?>

    <ul id="wappers">
        <?php foreach ($wappers as $wapper): ?>
            <li class="wapper-profile">
                <img src="https://via.placeholder.com/150" alt="<?= $wapper->name ?>" />

                <p> <?= filter_var($wapper->name, FILTER_SANITIZE_SPECIAL_CHARS) ?> | <?= $wapper->profession ?> </p>

                <p> <?= $wapper->email ?> | <?= $wapper->phone ?> </p>

                <p> Idade: <?= $wapper->birth ?> </p>

                <p> Mora em <?= $wapper->city ?> / <?= $wapper->state ?> </p>

                <nav>
                    <a href="#">atualizar</a>
                    <a href="#">deletar</a>
                </nav>
            </li>
        <?php endforeach ?>
    </ul>

<?php else: view('notification', ['text' => 'Tudo calmo por aqui...']); endif ?>