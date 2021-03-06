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
            [['nama_kelas'], 'string', 'max' => 200],
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
            'id_kelas' => 'Kelas',
            'id_jurusan' => 'Jurusan',
            'angkatan' => 'Angkatan',
            'nama_kelas' => 'Nama Kelas'

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
    
    Public function getIdJurusan()
    {
        $model = Jurusan::find()
            ->andWhere(['id_jurusan' => $this->id_jurusan])
            ->one();

        if ($model !== null) {
            return $model->nama_jurusan;
        }
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

     public static function getListKelas()
    {
        return ArrayHelper::map(self::find()->all(), 'id_kelas', 'nama_kelas');
    }
}
