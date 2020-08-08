<?php

namespace antonyz89\rbac\models\query;

use antonyz89\rbac\models\RbacFunctionality;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[RbacFunctionality]].
 *
 * @see RbacFunctionality
 */
class RbacFunctionalityQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return RbacFunctionality[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RbacFunctionality|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param integer $id
     * @param string $operator
     * @return RbacFunctionalityQuery
     */
    public function whereId($id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.id', RbacFunctionality::tableName()), $id
        ]);
    }

    /**
     * @param integer $rbac_profile_id
     * @param string $operator
     * @return RbacFunctionalityQuery
     */
    public function whereRbacProfile($rbac_profile_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rbac_profile_id', RbacFunctionality::tableName()), $rbac_profile_id
        ]);
    }

    /**
     * @param integer $rbac_controller_id
     * @param string $operator
     * @return RbacFunctionalityQuery
     */
    public function whereRbacController($rbac_controller_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rbac_controller_id', RbacFunctionality::tableName()), $rbac_controller_id
        ]);
    }

    /**
     * @param string $rule
     * @param string $operator
     * @return RbacFunctionalityQuery
     */
    public function whereRule($rule, $operator = 'LIKE')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rule', RbacFunctionality::tableName()), $rule
        ]);
    }

    /**
     * @param string $name
     * @param string $operator
     * @return RbacFunctionalityQuery
     */
    public function whereName($name, $operator = 'LIKE')
    {
        return $this->andWhere([
            $operator, sprintf('%s.name', RbacFunctionality::tableName()), $name
        ]);
    }

    /**
     * @param string $description
     * @param string $operator
     * @return RbacFunctionalityQuery
     */
    public function whereDescription($description, $operator = 'LIKE')
    {
        return $this->andWhere([
            $operator, sprintf('%s.description', RbacFunctionality::tableName()), $description
        ]);
    }
}