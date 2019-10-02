<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use  yii\grid\Column;

/* @var $this yii\web\View */
/* @var $model app\models\Jadwal */
$jadwal;
$this->title = $model->nama_jadwal;
$this->params['breadcrumbs'][] = ['label' => 'Jadwals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="jadwal-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_jadwal], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_jadwal], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'jam',
            [
                'attribute'=>'id_matakuliah',
                'value'=>function($data){
                    return $data->getIdMatkul();
                }
            ],
            [
                'attribute'=>'id_kelas',
                'value'=>function($data){
                    return $data->getIdKelas();
                }
            ],
            [
                'attribute'=>'id_ruangan',
                'value'=>function($data){
                    return $data->getIdRuangan();
                }
            ],
             [
                'attribute'=>'tanggal',
                'value'=>date('Y-m-d'),
            ],
            'status',
            //'id_dosen',
        ],
    ]) ?>

    <?php
            if ($model->status=="Buka") {
                $text = "Tutup";
            }else{
                $text = "Buka";
            }
        ?>

        <?= Html::a($text, ['status', 'id' => $model->id_jadwal,'status'=>$text], ['class' => 'btn btn-success','style'=>'width:100%;']) ?>
        
     <?= GridView::widget([
        'dataProvider' => $jadwal,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_jadwal',
            [
                'attribute'=>'id_mahasiswa',
                'value'=>function($data){
                    return $data->getIdMahasiswa();
                }
            ],
            'tanggal',
            'kehadiran',
            // [
            //         'attribute' => 'foto',
            //         'format' => 'raw',
            //         'value'=> function($data){
            //             if ($data->foto!=''){
            //                 return $data->getFoto(['height'=>'100px']);
            //             }else {
            //                 return 'no image';
            //             }
            //         }
            //     ],

                   [
          'class' => 'yii\grid\ActionColumn',
          'header' => 'Actions',
          'headerOptions' => ['style' => 'color:#337ab7'],
          'template' => '{view}{update}{delete}',
          'buttons' => [
            'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('app', 'lead-view'),
                ]);
            },

            'update' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'lead-update'),
                ]);
            },
            'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('app', 'lead-delete'),
                ]);
            }

          ],
          'urlCreator' => function ($action, $model, $key, $index, $jadwal) {
            if ($action === 'view') {
                $url ='index.php?r=client-login/lead-view&id='.'id_mahasiswa';
                return $url;
            }

            if ($action === 'update') {
                $url ='index.php?r=client-login/lead-update&id='.'id_mahasiswa';
                return $url;
            }
            if ($action === 'delete') {
                $url ='index.php?r=client-login/lead-delete&id='.'id_mahasiswa';
                return $url;
            }

          }
          ],

          ],


          
    ]); ?>



</div>
