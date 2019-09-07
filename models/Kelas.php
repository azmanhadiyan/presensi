<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "kelas".
 *
 * @property int $id_kelas
 * @property int $id_jurusan
 * @property string $angkatan
 *
 * @property Jadwal[] $jadwals
 * @property Jurusan $jurusan
 * @property Jadwal $kelas
 * @property Mahasiswa[] $mahasiswas
 */
class Kelas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kelas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_jurusan', 'angkatan'], 'required'],
            [['id_jurusan'], 'integer'],
            [['angkatan'], 'string', 'max' => 4],
            [['id_jurusan'], 'exist', 'skipOnError' => true, 'targetClass' => Jurusan::className(), 'targetAttribute' => ['id_jurusan' => 'id_jurusan']],
            [['id_kelas'], 'exist', 'skipOnError' => true, 'targetClass' => Jadwal::className(), 'targetAttribute' => ['id_kelas' => 'id_kelas']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kelas' => 'Id Kelas',
            'id_jurusan' => 'Id Jurusan',
            'angkatan' => 'Angkatan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwals()
    {
        return $this->hasMany(Jadwal::className(), ['id_kelas' => 'id_kelas']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJurusan()
    {
        return $this->hasOne(Jurusan::className(), ['id_jurusan' => 'id_jurusan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasOne(Jadwal::className(), ['id_kelas' => 'id_kelas']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMahasiswas()
    {
        return $this->hasMany(Mahasiswa::className(), ['id_kelas' => 'id_kelas']);
    }

     public static function getListkelas()
    {
        return ArrayHelper::map(self::find()->all(), 'id_kelas', 'id_jurusan');
    }
}
