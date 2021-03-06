<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ruangan".
 *
 * @property int $id_ruangan
 * @property string $nama_ruangan
 *
 * @property Jadwal[] $jadwals
 */
class Ruangan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ruangan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_ruangan'], 'required'],
            [['nama_ruangan'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ruangan' => 'Ruangan',
            'nama_ruangan' => 'Nama Ruangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwals()
    {
        return $this->hasMany(Jadwal::className(), ['id_ruangan' => 'id_ruangan']);
    }

    public static function getListRuangan()
    {
        return ArrayHelper::map(self::find()->all(), 'id_ruangan', 'nama_ruangan');
    }

}
