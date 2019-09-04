<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mahasiswa".
 *
 * @property int $id_mahasiswa
 * @property int $Nim
 * @property string $Nama
 * @property string $Jurusan
 *
 * @property Presensi $mahasiswa
 * @property Presensi[] $presensis
 */
class Mahasiswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mahasiswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Nim', 'Nama', 'Jurusan'], 'required'],
            [['Nim'], 'integer'],
            [['Nama', 'Jurusan'], 'string', 'max' => 50],
            [['id_mahasiswa'], 'exist', 'skipOnError' => true, 'targetClass' => Presensi::className(), 'targetAttribute' => ['id_mahasiswa' => 'id_matakuliah']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_mahasiswa' => 'Id Mahasiswa',
            'Nim' => 'Nim',
            'Nama' => 'Nama',
            'Jurusan' => 'Jurusan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMahasiswa()
    {
        return $this->hasOne(Presensi::className(), ['id_matakuliah' => 'id_mahasiswa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresensis()
    {
        return $this->hasMany(Presensi::className(), ['id_mahasiswa' => 'Id_mahasiswa']);
    }
}
