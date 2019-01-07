<?php

use yii\helpers\html;

?>

<html lang="<?= Yii::$app->language ?>">

<h1><b>Wishlist</b></h1>
<div class="col-lg-12">
    <table class="table">
        <thead>
        <tr>
            <th>Country</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($wishlist as $row) { ?>
        <?php
        foreach ($row->countries as $name) { ?>
        <tr>
            <td><?php echo $name->name ?></td>

            <?php } ?>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>