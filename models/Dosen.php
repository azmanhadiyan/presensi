<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dosen".
 *
 * @property int $id_dosen
 * @property int $NIDN
 * @property string $Nama
 *
 * @property Presensi[] $presensis
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
            [['NIDN', 'Nama'], 'required'],
            [['NIDN'], 'integer'],
            [['Nama'], 'string', 'max' => 50],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresensis()
    {
        return $this->hasMany(Presensi::className(), ['id_dosen' => 'id_dosen']);
    }
}
