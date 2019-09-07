<?php

namespace app\models;

use Yii;

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
            'id_ruangan' => 'Id Ruangan',
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
}
