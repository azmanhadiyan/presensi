<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "matakuliah".
 *
 * @property int $id_matakuliah
 * @property string $matkul
 *
 * @property Jadwal[] $jadwals
 */
class Matakuliah extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'matakuliah';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matkul'], 'required'],
            [['matkul'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_matakuliah' => 'Id Matakuliah',
            'matkul' => 'Matkul',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwals()
    {
        return $this->hasMany(Jadwal::className(), ['id_matakuliah' => 'id_matakuliah']);
    }

     public static function getListMatkul()
    {
        return ArrayHelper::map(self::find()->all(), 'id_matakuliah', 'matkul');
    }

    
}


