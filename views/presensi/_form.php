<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Presensi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presensi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($+m+odel, 'id_mahasiswa')->textInput() ?>

    <?= $form->field($model, 'id_dosen')->textInput() ?>

    <?= $form->field($model, 'id_matakuliah')->textInput() ?>

    <?= $form->field($model, 'Tgl_presensi')->date() ?>

    <?= $form->field($model, 'hasil_presensi')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
