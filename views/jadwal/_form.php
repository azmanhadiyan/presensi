<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Jadwal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jadwal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jam')->textInput() ?>

    <?= $form->field($model, 'id_matakuliah')->textInput() ?>

    <?= $form->field($model, 'id_kelas')->textInput() ?>

    <?= $form->field($model, 'id_ruangan')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Buka' => 'Buka', 'Tutup' => 'Tutup', '' => '', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'id_dosen')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
