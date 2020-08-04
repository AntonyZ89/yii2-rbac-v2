<?php

namespace antonyz89\rbac\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "rbac_functionality_rbac_action".
 *
 * @property int $rbac_functionality_id
 * @property int $rbac_action_id
 * @property int $created_at
 *
 * @property RbacAction $rbacAction
 * @property RbacFunctionality $rbacFunctionality
 */
class RbacFunctionalityRbacAction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rbac_functionality_rbac_action';
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
            [['rbac_functionality_id', 'rbac_action_id'], 'required'],
            [['rbac_functionality_id', 'rbac_action_id', 'created_at'], 'integer'],
            [['rbac_functionality_id', 'rbac_action_id'], 'unique', 'targetAttribute' => ['rbac_functionality_id', 'rbac_action_id']],
            [['rbac_action_id'], 'exist', 'skipOnError' => true, 'targetClass' => RbacAction::className(), 'targetAttribute' => ['rbac_action_id' => 'id']],
            [['rbac_functionality_id'], 'exist', 'skipOnError' => true, 'targetClass' => RbacFunctionality::className(), 'targetAttribute' => ['rbac_functionality_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rbac_functionality_id' => Yii::t('app', 'Rbac Functionality ID'),
            'rbac_action_id' => Yii::t('app', 'Rbac Action ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[RbacAction]].
     *
     * @return \yii\db\ActiveQuery|RbacActionQuery
     */
    public function getRbacAction()
    {
        return $this->hasOne(RbacAction::className(), ['id' => 'rbac_action_id']);
    }

    /**
     * Gets query for [[RbacFunctionality]].
     *
     * @return \yii\db\ActiveQuery|RbacFunctionalityQuery
     */
    public function getRbacFunctionality()
    {
        return $this->hasOne(RbacFunctionality::className(), ['id' => 'rbac_functionality_id']);
    }

    /**
     * {@inheritdoc}
     * @return RbacFunctionalityRbacActionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RbacFunctionalityRbacActionQuery(get_called_class());
    }
}