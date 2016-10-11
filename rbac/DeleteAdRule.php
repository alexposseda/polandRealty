<?php

    namespace rbac;

    use yii\rbac\Rule;

    class DeleteAdRule extends Rule{
        /**
         * @param string|integer $user   the user ID.
         * @param Item           $item   the role or permission that this rule is associated width.
         * @param array          $params parameters passed to ManagerInterface::checkAccess().
         *
         * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
         */
        public function execute($user, $item, $params){
            // TODO: Implement execute() method.
        }
    }