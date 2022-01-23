<?php
/** @var yii\web\View $this */
/** @var app\forms\UploadForm $model */

use kartik\file\FileInput;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
]) ?>

<?= $form->field($model, 'imageFiles[]')
    ->label(false)
    ->widget(FileInput::class, [
    'options' => [
        'accept' => 'image/*',
        'multiple' => true,
    ],
    'pluginOptions' => [
        'maxFileCount' => 5,
    ]
]) ?>

<?php ActiveForm::end() ?>