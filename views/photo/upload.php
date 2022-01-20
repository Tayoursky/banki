<?php
/** @var yii\web\View $this */
/** @var app\models\UploadForm $model */

use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
]) ?>

<?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>