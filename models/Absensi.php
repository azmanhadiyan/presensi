<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "absensi".
 *
 * @property int $id_presensi
 * @property int $id_jadwal
 * @property int $id_mahasiswa
 * @property string $tanggal
 * @property string $foto
 * @property string $kehadiran
 *
 * @property Jadwal $jadwal
 * @property Mahasiswa $mahasiswa
 */
class Absensi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'absensi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_jadwal', 'id_mahasiswa', 'tanggal', 'foto', 'kehadiran'], 'required'],
            [['id_jadwal', 'id_mahasiswa'], 'integer'],
            [['tanggal'], 'safe'],
            [['kehadiran'], 'string'],
            [['foto'], 'string', 'max' => 255],
            [['id_jadwal'], 'exist', 'skipOnError' => true, 'targetClass' => Jadwal::className(), 'targetAttribute' => ['id_jadwal' => 'id_jadwal']],
            [['id_mahasiswa'], 'exist', 'skipOnError' => true, 'targetClass' => Mahasiswa::className(), 'targetAttribute' => ['id_mahasiswa' => 'id_mahasiswa']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_presensi' => 'Presensi',
            'id_jadwal' => 'Jadwal',
            'id_mahasiswa' => 'Mahasiswa',
            'tanggal' => 'Tanggal',
            'foto' => 'Foto',
            'kehadiran' => 'Kehadiran',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwal()
    {
        return $this->hasOne(Jadwal::className(), ['id_jadwal' => 'id_jadwal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMahasiswa()
    {
        return $this->hasOne(Mahasiswa::className(), ['id_mahasiswa' => 'id_mahasiswa']);
    }

    Public function getIdMahasiswa()
    {
        $model = Mahasiswa::find()
            ->andWhere(['id_mahasiswa' => $this->id_mahasiswa])
            ->one();

        if ($model !== null) {
            return $model->nama;
        }
    }

    Public function getNamaJadwal()
    {
        $model = Jadwal::find()
            ->andWhere(['id_jadwal' => $this->id_jadwal])
            ->one();

        if ($model !== null) {
            return $model->nama_jadwal;
        }
    }

    public function getFoto($htmlOptions=[])
    {
        return Html::img($this->folder."/".$this->foto,$htmlOptions);
    }
}
