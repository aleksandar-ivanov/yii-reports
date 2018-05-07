<?php

namespace app\modules\reports;

/**
 * reports module definition class
 */
class ReportsManagement extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\reports\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function canBeManaged()
    {
        return !\Yii::$app->user->isGuest && \Yii::$app->user->can('manageReport');
    }

    public function getIcon()
    {
        return 'bar-chart';
    }
}
