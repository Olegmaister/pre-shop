<?php

namespace shop\entities\users;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "networks".
 *
 * @property int $id
 * @property int $user_id
 * @property int $network_id
 * @property string $network_name
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class Network extends \yii\db\ActiveRecord
{

    public static function create(int $networkId, string $networkName) : self
    {
        $network = new self();
        $network->network_id = $networkId;
        $network->network_name = $networkName;

        return $network;
    }

    public function recordExists($networkId, $networkName)
    {
        return $this->network_id === $networkId && $networkName === $networkName;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'networks';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'network_id' => Yii::t('app', 'Network ID'),
            'network_name' => Yii::t('app', 'Network Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
