<?php

namespace common\models;

use common\defaults\DefaultModel;
use Yii;

/**
 * This is the model class for collection "organisations".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $slug
 * @property mixed $citySlug
 * @property mixed $name
 * @property mixed $category
 * @property mixed $avatar
 * @property mixed $city
 * @property mixed $placeCount
 * @property mixed $status
 */
class Organisations extends DefaultModel
{
    public static $collection = 'organisations';

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'slug',
            'citySlug',
            'name',
            'category',
            'avatar',
            'city',
            'placeCount',
            'status',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug', 'citySlug', 'name', 'category', 'avatar', 'city', 'placeCount', 'status'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'slug' => 'Slug',
            'citySlug' => 'City Slug',
            'name' => 'Name',
            'category' => 'Category',
            'avatar' => 'Avatar',
            'city' => 'City',
            'placeCount' => 'Place Count',
            'status' => 'Status',
        ];
    }
}
