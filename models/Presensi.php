<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "presensi".
 *
 * @property int $id_presensi
 * @property int $id_mahasiswa
 * @property int $id_dosen
 * @property int $id_matakuliah
 * @property string $Tgl_presensi
 * @property string $hasil_presensi
 *
 * @property Mahasiswa $mahasiswa
 * @property Dosen $dosen
 * @property Mahasiswa $mahasiswa0
 * @property Matakuliah $matakuliah
 */
class Presensi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'presensi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_mahasiswa', 'id_dosen', 'id_matakuliah', 'Tgl_presensi', 'hasil_presensi'], 'required'],
            [['id_mahasiswa', 'id_dosen', 'id_matakuliah'], 'integer'],
            [['Tgl_presensi'], 'safe'],
            [['hasil_presensi'], 'string', 'max' => 55],
            [['id_dosen'], 'exist', 'skipOnError' => true, 'targetClass' => Dosen::className(), 'targetAttribute' => ['id_dosen' => 'id_dosen']],
            [['id_mahasiswa'], 'exist', 'skipOnError' => true, 'targetClass' => Mahasiswa::className(), 'targetAttribute' => ['id_mahasiswa' => 'Id_mahasiswa']],
            [['id_matakuliah'], 'exist', 'skipOnError' => true, 'targetClass' => Matakuliah::className(), 'targetAttribute' => ['id_matakuliah' => 'id_matakuliah']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_presensi' => 'Id Presensi',
            'id_mahasiswa' => 'Id Mahasiswa',
            'id_dosen' => 'Id Dosen',
            'id_matakuliah' => 'Id Matakuliah',
            'Tgl_presensi' => 'Tgl Presensi',
            'hasil_presensi' => 'Hasil Presensi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMahasiswa()
    {
        return $this->hasOne(Mahasiswa::className(), ['id_mahasiswa' => 'id_matakuliah']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDosen()
    {
        return $this->hasOne(Dosen::className(), ['id_dosen' => 'id_dosen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMahasiswa0()
    {
        return $this->hasOne(Mahasiswa::className(), ['Id_mahasiswa' => 'id_mahasiswa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatakuliah()
    {
        return $this->hasOne(Matakuliah::className(), ['id_matakuliah' => 'id_matakuliah']);
    }
}
