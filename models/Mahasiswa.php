<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "mahasiswa".
 *
 * @property int $id_mahasiswa
 * @property int $nim
 * @property string $nama
 * @property int $id_kelas
 * @property int $id
 *
 * @property Absensi[] $absensis
 * @property User $id0
 * @property Kelas $kelas
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
            [['nim', 'nama', 'id_kelas', 'id'], 'required'],
            [['nim', 'id_kelas', 'id'], 'integer'],
            [['nama'], 'string', 'max' => 50],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_mahasiswa' => 'Id Mahasiswa',
            'nim' => 'Nim',
            'nama' => 'Nama',
            'id_kelas' => 'Kelas',
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbsensis()
    {
        return $this->hasMany(Absensi::className(), ['id_mahasiswa' => 'id_mahasiswa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasOne(Kelas::className(), ['id_kelas' => 'id_kelas']);
    }

    Public function getNamaKelas()
    {
        $model = Kelas::find()
            ->andWhere(['id_kelas' => $this->id_kelas])
            ->one();

        if ($model !== null) {
            return $model->nama_kelas;
        }
    }

    public static function getListMahasiswa()
    {
        return ArrayHelper::map(self::find()->all(), 'id_mahasiswa', 'nama');
    }

}
