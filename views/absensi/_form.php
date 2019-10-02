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
                      'placeholder' => '- Pilih Mata Kuliah-',              
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
                
    <?= $form->field($model, 'foto')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'], 
         'pluginOptions'=>['allowedFileExtensions'=>['jpg','png'],'showUpload' => false,'initialPreview'=>($model->foto) ?
                Html::img($model->folder."/".$model->foto, ['width'=>'100%']):
            '',
                ]
        ]);
    ?>
   <!-- 
   
            
            <video id="video" width="640" height="480" autoplay></video>
            <button id="snap">Snap Photo</button>
            <canvas id="canvas" width="640" height="480"></canvas>

            <script type="text/javascript">



                function showAndroidToast(res) {

                    Android.dataResponse(res);
                }

           // Grab elements, create settings, etc.
            var video = document.getElementById('video');

            // Get access to the camera!
            if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                // Not adding `{ audio: true }` since we only want video now
                navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
                    //video.src = window.URL.createObjectURL(stream);
                    video.srcObject = stream;
                    video.play();
                });
            }

            /* Legacy code below: getUserMedia 
            else if(navigator.getUserMedia) { // Standard
                navigator.getUserMedia({ video: true }, function(stream) {
                    video.src = stream;
                    video.play();
                }, errBack);
            } else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
                navigator.webkitGetUserMedia({ video: true }, function(stream){
                    video.src = window.webkitURL.createObjectURL(stream);
                    video.play();
                }, errBack);
            } else if(navigator.mozGetUserMedia) { // Mozilla-prefixed
                navigator.mozGetUserMedia({ video: true }, function(stream){
                    video.srcObject = stream;
                    video.play();
                }, errBack);
            }
            */ 

            // Elements for taking the snapshot
            var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            var video = document.getElementById('video');

            // Trigger photo take
            document.getElementById("snap").addEventListener("click", function() {
                context.drawImage(video, 0, 0, 640, 480);
            });
            </script>
            <style type="text/css">
                /* Light mode */
            @media (prefers-color-scheme: light) {
                html {
                    background: white;
                    color: black;
                }
            }

            /* Dark mode */
            @media (prefers-color-scheme: dark) {
                html {
                    background: black;
                    color: white;
                }
            }

            /* Defaults */
            :root {
                --color-scheme-background: pink;
                --color-scheme-text-color: red;
            }

            /* Light mode */
            @media (prefers-color-scheme: light) {
                :root {
                    --color-scheme-background: white;
                    --color-scheme-text-color: black;
                }
            }

         /* Dark mode */
            @media (prefers-color-scheme: dark) {
                :root {
                    --color-scheme-background: black;
                    --color-scheme-text-color: white;
                }
            }

            /* Usage */
            html {
                background: var(--color-scheme-background);
                color: var(--color-scheme-text-color);
            }

            html {
                content: ""; /* (ab)using the content property */
            }

            /* Light mode */
            @media (prefers-color-scheme: light) {
                html {
                    content: "light"; /* (ab)using the content property */
                }
            }

            /* Dark mode */
            @media (prefers-color-scheme: dark) {
                html {
                    content: "dark"; /* (ab)using the content property */
                }
            }
            const mode = getComputedStyle(document.documentElement).getPropertyValue('content');

            // mode: "dark"   
           </style> -->
            
    <?= $form->field($model, 'kehadiran')->dropDownList([ 'Hadir' => 'Hadir', 'Sakit' => 'Sakit', 'Izin' => 'Izin', 'Tanpa Keterangan' => 'Tanpa Keterangan', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
