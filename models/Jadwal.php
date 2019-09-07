<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jadwal".
 *
 * @property int $id_jadwal
 * @property string $jam
 * @property int $id_matakuliah
 * @property int $id_kelas
 * @property int $id_ruangan
 * @property string $status
 * @property int $id_dosen
 *
 * @property Absensi[] $absensis
 * @property Dosen $dosen
 * @property Matakuliah $matakuliah
 * @property Ruangan $ruangan
 * @property Kelas $kelas
 * @property Kelas $kelas0
 */
class Jadwal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jadwal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jam', 'id_matakuliah', 'id_kelas', 'id_ruangan', 'status', 'id_dosen'], 'required'],
            [['jam'], 'safe'],
            [['id_matakuliah', 'id_kelas', 'id_ruangan', 'id_dosen'], 'integer'],
            [['status'], 'string'],
            [['id_dosen'], 'exist', 'skipOnError' => true, 'targetClass' => Dosen::className(), 'targetAttribute' => ['id_dosen' => 'id_dosen']],
            [['id_matakuliah'], 'exist', 'skipOnError' => true, 'targetClass' => Matakuliah::className(), 'targetAttribute' => ['id_matakuliah' => 'id_matakuliah']],
            [['id_ruangan'], 'exist', 'skipOnError' => true, 'targetClass' => Ruangan::className(), 'targetAttribute' => ['id_ruangan' => 'id_ruangan']],
            [['id_kelas'], 'exist', 'skipOnError' => true, 'targetClass' => Kelas::className(), 'targetAttribute' => ['id_kelas' => 'id_kelas']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_jadwal' => 'Id Jadwal',
            'jam' => 'Jam',
            'id_matakuliah' => 'Id Matakuliah',
            'id_kelas' => 'Id Kelas',
            'id_ruangan' => 'Id Ruangan',
            'status' => 'Status',
            'id_dosen' => 'Id Dosen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbsensis()
    {
        return $this->hasMany(Absensi::className(), ['id_jadwal' => 'id_jadwal']);
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
    public function getMatakuliah()
    {
        return $this->hasOne(Matakuliah::className(), ['id_matakuliah' => 'id_matakuliah']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuangan()
    {
        return $this->hasOne(Ruangan::className(), ['id_ruangan' => 'id_ruangan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasOne(Kelas::className(), ['id_kelas' => 'id_kelas']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas0()
    {
        return $this->hasOne(Kelas::className(), ['id_kelas' => 'id_kelas']);
    }
}
