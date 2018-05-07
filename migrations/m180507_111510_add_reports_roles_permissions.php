<?php

use yii\db\Migration;

/**
 * Class m180507_111510_add_reports_roles_permissions
 */
class m180507_111510_add_reports_roles_permissions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $authManager = Yii::$app->authManager;
        $reportsRole = $authManager->createRole('reportsManager');
        $superAdmin = $authManager->getRole('superAdmin');

        $authManager->add($reportsRole);
        $authManager->addChild($superAdmin, $reportsRole);

        $permissions = [
            'manageReport' => 'Manage reports',
            'createReport' => 'Create a report',
            'exportReport' => 'Export a report'
        ];

        foreach ($permissions as $name => $desc) {
            $perm = $authManager->createPermission($name);
            $perm->description = $desc;

            $authManager->add($perm);
            $authManager->addChild($reportsRole, $perm);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $authManager = Yii::$app->authManager;
        $reportsRole = $authManager->getRole('reportsManager');
        $superAdmin = $authManager->getRole('superAdmin');

        $authManager->removeChild($superAdmin, $reportsRole);

        foreach ($authManager->getPermissionsByRole('reportsManager') as $role) {
            $authManager->remove($role);
        }

        $authManager->remove($reportsRole);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180507_111510_add_reports_roles_permissions cannot be reverted.\n";

        return false;
    }
    */
}
