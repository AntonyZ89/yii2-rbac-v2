<?php

namespace antonyz89\rbac\models\query;

use antonyz89\rbac\models\RbacAction;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[RbacAction]].
 *
 * @see RbacAction
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 */
class RbacActionQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return RbacAction[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RbacAction|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param integer $id
     * @param string $operator
     * @return RbacActionQuery
     */
    public function whereId($id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.id', RbacAction::tableName()), $id
        ]);
    }

    /**
     * @param integer $rbac_controller_id
     * @param string $operator
     * @return RbacActionQuery
     */
    public function whereRbacController($rbac_controller_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rbac_controller_id', RbacAction::tableName()), $rbac_controller_id
        ]);
    }

    /**
     * @param string $name
     * @param string $operator
     * @return RbacActionQuery
     */
    public function whereName($name, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.name', RbacAction::tableName()), $name
        ]);
    }
}
