<?php

namespace antonyz89\rbac\models;

use antonyz89\rbac\models\query\RbacActionQuery;
use antonyz89\rbac\models\query\RbacBlockQuery;
use antonyz89\rbac\models\query\RbacBlockRbacActionQuery;
use antonyz89\rbac\models\query\RbacProfileRbacControllerQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "rbac_block".
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 *
 * @property int $id
 * @property int $rbac_profile_id
 * @property int $rbac_controller_id
 * @property string $rule
 * @property string|null $name
 * @property string|null $description
 * @property int $created_at
 * @property int $updated_at
 *
 * @property RbacAction[] $rbacActions
 * @property RbacBlockRbacAction[] $rbacBlockRbacActions
 * @property RbacProfileRbacController $rbacProfileRbacController
 */
class RbacBlock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rbac_block';
    }

    /**
     * @inheritdoc
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
    public function rules()
    {
        return [
            [['rbac_profile_id', 'rbac_controller_id', 'rule'], 'required'],
            [['rbac_profile_id', 'rbac_controller_id', 'created_at', 'updated_at'], 'integer'],
            [['rule', 'name', 'description'], 'string', 'max' => 255],
            [['rbac_profile_id', 'rbac_controller_id', 'rule'], 'unique', 'targetAttribute' => ['rbac_profile_id', 'rbac_controller_id', 'rule']],
            [['rbac_profile_id', 'rbac_controller_id', 'name'], 'unique', 'targetAttribute' => ['rbac_profile_id', 'rbac_controller_id', 'name']],
            [['rbac_profile_id', 'rbac_controller_id'], 'exist', 'skipOnError' => true, 'targetClass' => RbacProfileRbacController::className(), 'targetAttribute' => ['rbac_profile_id' => 'rbac_profile_id', 'rbac_controller_id' => 'rbac_controller_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rbac_profile_id' => Yii::t('app', 'Profile'),
            'rbac_controller_id' => Yii::t('app', 'Controller'),
            'rule' => Yii::t('app', 'Rule'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[RbacActions]].
     *
     * @return ActiveQuery|RbacActionQuery
     */
    public function getRbacActions()
    {
        return $this->hasMany(RbacAction::className(), ['id' => 'rbac_action_id'])->via('rbacBlockRbacActions');
    }

    /**
     * Gets query for [[RbacBlockRbacActions]].
     *
     * @return ActiveQuery|RbacBlockRbacActionQuery
     */
    public function getRbacBlockRbacActions()
    {
        return $this->hasMany(RbacBlockRbacAction::className(), ['rbac_block_id' => 'id']);
    }

    /**
     * Gets query for [[RbacProfile]].
     *
     * @return ActiveQuery|RbacProfileRbacControllerQuery
     */
    public function getRbacProfileRbacController()
    {
        return $this->hasOne(RbacProfileRbacController::className(), ['rbac_profile_id' => 'rbac_profile_id', 'rbac_controller_id' => 'rbac_controller_id']);
    }

    /**
     * {@inheritdoc}
     * @return RbacBlockQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RbacBlockQuery(get_called_class());
    }
}