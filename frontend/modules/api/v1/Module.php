<?php
/**
 * Created date: 07.11.2017 14:34
 * @author yamilramilev <yamilramilev@gmail.com>
 */
namespace frontend\modules\api\v1;

class Module extends \yii\base\Module
{
    public $defaultRoute = '/posts/index';
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\api\v1\controllers';
}