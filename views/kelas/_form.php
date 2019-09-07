<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
use app\models\Jurusan;


/* @var $this yii\web\View */
/* @var $model app\models\Kelas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kelas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_jurusan')->widget(Select2::classname(), [
                    'data' =>  Jurusan::getListJurusan(),
                    'options' => [
                      'placeholder' => '- Pilih Jurusan -',              
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]); ?>

    <?= $form->field($model, 'angkatan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
