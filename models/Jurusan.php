<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "jurusan".
 *
 * @property int $id_jurusan
 * @property string $nama_jurusan
 *
 * @property Kelas[] $kelas
 */
class Jurusan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jurusan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_jurusan'], 'required'],
            [['nama_jurusan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_jurusan' => 'Id Jurusan',
            'nama_jurusan' => 'Nama Jurusan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasMany(Kelas::className(), ['id_jurusan' => 'id_jurusan']);
    }

    public static function getListJurusan()
    {
        return ArrayHelper::map(self::find()->all(), 'id_jurusan', 'nama_jurusan');
    }
}
