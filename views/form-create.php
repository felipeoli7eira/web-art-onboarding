<nav class="create-wapper-nav">
    <a href="<?= url() ?>">wappers</a>
</nav>

<form name="create-wapper" method="POST" action="<?= url('/wapper') ?>">

    <div class="input-group">
        <label for="input-name">Nome</label>
        <div>
            <!-- img -->
            <input type="text" id="input-name" name="name" required minlength="3">
        </div>
    </div>

    <div class="input-group">
        <label for="input-birth">Data de nascimento</label>
        <div>
            <!-- img -->
            <input type="date" name="birth" id="input-birth" required>
        </div>
    </div>

    <div class="row-form">
        <div class="input-group">
            <label for="input-city">Cidade onde mora</label>
            <div>
                <!-- img -->
                <input type="text" name="city" id="input-city" required>
            </div>
        </div>

        <div class="input-group">
            <label for="input-state">Estado</label>
            <div>
                <!-- img -->
                <input type="text" name="state" id="input-state" required>
            </div>
        </div>
    </div>

    <div class="input-group">
        <label for="input-profession">Profissão</label>
        <div>
            <!-- img -->
            <input type="text" name="profession" id="input-profession" required>
        </div>
    </div>

    <div class="input-group">
        <label for="input-email">E-mail</label>
        <div>
            <!-- img -->
            <input type="email" name="email" id="input-email" required>
        </div>
    </div>

    <div class="input-group">
        <label for="input-phone">Número para contato</label>
        <div>
            <!-- img -->
            <input type="number" name="phone" id="input-phone" required>
        </div>
    </div>

    <button type="submit" name="submit">pronto</button>

</form>