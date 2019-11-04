<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.11.2019
 * Time: 15:03
 */

namespace common\defaults;

use Yii;
use yii\mongodb\ActiveRecord;

/**
 * Избегаем повтора кода и получаем название коллекции как string а не через array ;)
 * Class DefaultModel
 * @package common\defaults
 */
abstract class DefaultModel extends ActiveRecord
{

    public static $collection;

    /**
     * Простая обработка есть ли названия бд и коллекции
     * DefaultModel constructor.
     * @param array $config
     * @throws \Exception
     */
    public function __construct(array $config = [])
    {
        if (!\Yii::$app->params['db_name']) {
            throw new \Exception("Не указано название базы данных");
        }
        if (!self::$collection) {
            throw new \Exception("Не указано название коллекции");
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return [\Yii::$app->params['db_name'], self::$collection];
    }

    /**
     * @return null|object|\yii\mongodb\Connection
     * @throws \yii\base\InvalidConfigException
     */
    public static function getDb()
    {
        return Yii::$app->get('mongodb');
    }

}