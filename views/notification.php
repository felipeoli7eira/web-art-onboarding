<?php

    $imageError = isset($image) ? $image : 'image-error-default.svg';
    $errorText = isset($text) ? $text : 'Erro';

?>

<div class="page-error">
    <img src="<?= asset($imageError) ?>" />
    <h1><?= $errorText ?></h1>
</div>