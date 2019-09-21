<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $id_role
 * @property string $status
 * @property string $authKey
 *
 * @property Role $role
 */
class User  extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'id_role', 'status'], 'required'],
            [['id_role'], 'integer'],
            [['username'], 'string', 'max' => 50],
            [['password', 'authKey'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 11],
            [['id_role'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['id_role' => 'id_role']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'id_role' => 'Role',
            'status' => 'Status',
            'authKey' => 'Auth Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    // public function getRole()
    // {
    //     return $this->hasOne(Role::className(), ['id_role' => 'id_role']);
    // }

    Public function getIdRole()
    {
        $model = Role::find()
            ->andWhere(['id_role' => $this->id_role])
            ->one();

        if ($model !== null) {
            return $model->nama;
        }
    }

    public static function findIdentity($id)
    {
        //mencari user login berdasarkan IDnya dan hanya dicari 1.
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        //mencari user login berdasarkan accessToken dan hanya dicari 1.
        return static::findOne(['access_token' => $token]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    Public function getStatus()
    {
        if ($this->status == 1) {
            return "Aktif";
        }else{
            return "Non Aktif";
        }
    }
}
