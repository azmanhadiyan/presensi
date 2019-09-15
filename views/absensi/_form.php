<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Mahasiswa;
use app\models\Jadwal;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model app\models\Absensi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="absensi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_jadwal')->widget(Select2::classname(), [
                    'data' =>  Jadwal::getListJadwal(),
                    'options' => [
                      'placeholder' => '- Pilih Jadwal-',              
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]); ?>

    <?= $form->field($model, 'id_mahasiswa')->widget(Select2::classname(), [
                    'data' =>  Mahasiswa::getListMahasiswa(),
                    'options' => [
                      'placeholder' => '- Pilih Mahasiswa-',              
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]); ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

   
     <?= $form->field($model, 'foto')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
         'pluginOptions'=>['allowedFileExtensions'=>['jpg','png'],'showUpload' => false,'initialPreview'=>($model->foto) ?
                Html::img($model->folder."/".$model->foto, ['width'=>'100%']):
            '',
                ]
        ]);   
    ?>


    <?= $form->field($model, 'kehadiran')->dropDownList([ 'Hadir' => 'Hadir', 'Sakit' => 'Sakit', 'Izin' => 'Izin', 'Tanpa Keterangan' => 'Tanpa Keterangan', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
