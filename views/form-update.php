<nav class="nav-control">
    <a href="<?= url() ?>">wappers</a>
</nav>

<form enctype="multipart/form-data" name="update-wapper" method="POST" action="<?= url('/edit') ?>">

    <input type="hidden" name="id" value="<?= $wapper->id ?>">

    <div class="input-group">
        <label for="input-photo">Foto de perfil</label>
        <input type="file" id="input-photo" name="photo">
        <p class="photo-info">
            <?php
                if (!is_null($wapper->photo)) {
                    echo <<<MESSAGE
                        Você tem uma foto cadastrada. Se quiser mudar, selecione e envie junto ao formulário.
                        <input type="hidden" name="old_photo" value="{$wapper->photo}">
                    MESSAGE;
                }
                else {
                    echo 'Você não tem foto cadastrada. Caso queira, pode selecionar e enviar junto ao formulário';
                }
            ?>
        </p>
    </div>

    <div class="input-group">
        <label for="input-name">Nome</label>
        <input type="text" id="input-name" name="name" required minlength="3" value="<?= $wapper->name ?>">
    </div>

    <div class="input-group">
        <label for="input-birth">Data de nascimento</label>
        <input type="date" name="birth" id="input-birth" required value="<?= $wapper->birth ?>">
    </div>

    <div class="row-form">
        <div class="input-group">
            <label for="input-city">Cidade onde mora</label>
            <input type="text" name="city" id="input-city" required value="<?= $wapper->city ?>">
        </div>

        <div class="input-group">
            <label for="input-state">Estado</label>
            <input type="text" name="state" id="input-state" required value="<?= $wapper->state ?>">
        </div>
    </div>

    <div class="input-group">
        <label for="input-profession">Profissão</label>
        <input type="text" name="profession" id="input-profession" required value="<?= $wapper->profession ?>">
    </div>

    <div class="input-group">
        <label for="input-email">E-mail</label>
        <input type="email" name="email" id="input-email" required value="<?= $wapper->email ?>">
    </div>

    <div class="input-group">
        <label for="input-phone">Número para contato</label>
        <input type="number" name="phone" id="input-phone" required value="<?= $wapper->phone ?>">
    </div>

    <div class="input-group submit-box">
        <button type="submit">feito</button>
    </div>

</form>