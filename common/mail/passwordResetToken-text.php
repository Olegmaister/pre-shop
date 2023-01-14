<?php

/* @var $this yii\web\View */
/* @var $user \shop\Entities\Users\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['password/password', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to reset your password:

<?= $resetLink ?>
