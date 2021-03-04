<nav class="create-wapper-nav">
    <a href="<?= url('/novo-wapper') ?>">novo wapper</a>
</nav>

<?php if (! empty($wappers)): ?>

    <ul id="wappers">
        <?php foreach ($wappers as $wapper): ?>
            <li class="wapper-profile">

                <?php if ($wapper->photo): ?>

                    <img src="<?= url("storage/{$wapper->photo}") ?>" alt="Foto de perfil do(a) <?= $wapper->name ?>" />
                <?php else: ?>

                    <img src="https://via.placeholder.com/1080" alt="Foto de perfil do(a) <?= $wapper->name ?>" />
                <?php endif ?>

                <p class="name"> <?= filter_var($wapper->name, FILTER_SANITIZE_SPECIAL_CHARS) ?> </p>

                <p> 📚 <?= $wapper->profession ?> </p>

                <p class="contacts"> 📧 <?= $wapper->email ?> 📱 <?= $wapper->phone ?> </p>

                <p> 👶 <?= date('d/m/Y', strtotime($wapper->birth)) ?> </p>

                <p> 🌄<?= $wapper->city . '/' . $wapper->state ?></p>

                <nav>
                    <a href="#">atualizar</a>
                    <a href="#">deletar</a>
                </nav>
            </li>
        <?php endforeach ?>
    </ul>

<?php else: view('notification', ['text' => 'Tudo calmo por aqui...']); endif ?>