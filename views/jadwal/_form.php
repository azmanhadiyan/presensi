<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Kelas;
use app\models\Matakuliah;
use app\models\Ruangan;
use app\models\Dosen;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Jadwal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jadwal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jam')->textInput() ?>

    <?= $form->field($model, 'id_matakuliah')->widget(Select2::classname(), [
                    'data' =>  Matakuliah::getListMatkul(),
                    'options' => [
                      'placeholder' => '- Pilih Matakuliah-',              
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]); ?>

    <?= $form->field($model, 'id_kelas')->widget(Select2::classname(), [
                    'data' =>  Kelas::getListKelas(),
                    'options' => [
                      'placeholder' => '- Pilih Kelas-',              
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]); ?>

    <?= $form->field($model, 'id_ruangan')->widget(Select2::classname(), [
                    'data' =>  Ruangan::getListRuangan(),
                    'options' => [
                      'placeholder' => '- Pilih Ruangan-',              
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]); ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Buka' => 'Buka', 'Tutup' => 'Tutup', '' => '', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'id_dosen')->widget(Select2::classname(), [
                    'data' =>  Dosen::getListDosen(),
                    'options' => [
                      'placeholder' => '- Pilih Dosen-',              
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
