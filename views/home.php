<?php if (isset($wappers)): ?>

    <ul id="wappers">
        <?php foreach ($wappers as $wapper): ?>
            <li class="wapper-profile">
                <img src="https://via.placeholder.com/150" alt="<?= $wapper->name ?>" />
                <p> <?= mb_convert_case($wapper->name, MB_CASE_TITLE) ?> | <?= $wapper->profession ?> </p>

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

<?php else: ?>

    <div class="no-results">
        <img src="<?= asset('undraw_Taken.svg') ?>" width="200" />
        <h1>Nenhum resultado para listar</h1>
    </div>

<?php endif ?>