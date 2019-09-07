<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dosen".
 *
 * @property int $id_dosen
 * @property int $NIDN
 * @property string $Nama
 * @property int $id
 *
 * @property User $id0
 * @property Jadwal[] $jadwals
 */
class Dosen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dosen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NIDN', 'Nama', 'id'], 'required'],
            [['NIDN', 'id'], 'integer'],
            [['Nama'], 'string', 'max' => 50],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_dosen' => 'Id Dosen',
            'NIDN' => 'Nidn',
            'Nama' => 'Nama',
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwals()
    {
        return $this->hasMany(Jadwal::className(), ['id_dosen' => 'id_dosen']);
    }
}
