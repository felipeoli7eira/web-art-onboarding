<?php

    $imageError = isset($image) ? $image : 'img/image-error-default.svg';
    $errorText = isset($text) ? $text : 'Erro';
?>

<div class="page-notification">
    <img src="<?= asset($imageError) ?>" alt="Notificação" />
    <h1><?= $errorText ?></h1>
</div>