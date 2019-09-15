<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'password',
            [
                'attribute'=>'id_role',
                'value'=>function($data){
                    return $data->getIdRole();
                }
            ],
            [
                    'attribute'=>'status',
                    'value'=>function($data){
                        return $data->getStatus();
                    },
                   
                ],
            //'authKey',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
