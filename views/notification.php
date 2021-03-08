<?php

    $imageError = isset($image) ? $image : 'img/image-error-default.svg';
    $errorText = isset($text) ? $text : 'Erro';
?>

<div class="page-error">
    <img src="<?= asset($imageError) ?>" alt="Erro" />
    <h1><?= $errorText ?></h1>
</div>