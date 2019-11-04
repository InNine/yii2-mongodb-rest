<?php

namespace common\models;

use common\defaults\DefaultModel;
use Yii;

/**
 * This is the model class for collection "posts".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $placeSlug
 * @property mixed $userSlug
 * @property mixed $citySlug
 * @property mixed $placeId
 * @property mixed $userId
 * @property mixed $type
 * @property mixed $text
 * @property mixed $rating
 * @property mixed $imageSets
 * @property mixed $galleries
 * @property mixed $comments
 * @property mixed $commentCount
 * @property mixed $likes
 * @property mixed $hasOutletLike
 * @property mixed $likeCount
 * @property mixed $status
 * @property mixed $isEdited
 * @property mixed $createdAt
 */
class Posts extends DefaultModel
{

    const STATUS_PUBLISHED = 'published';
    const STATUS_DELETED = 'deleted';

    public static $collection = 'posts';


    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'placeSlug',
            'userSlug',
            'citySlug',
            'placeId',
            'userId',
            'type',
            'text',
            'rating',
            'imageSets',
            'galleries',
            'comments',
            'commentCount',
            'likes',
            'hasOutletLike',
            'likeCount',
            'status',
            'isEdited',
            'createdAt',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['placeSlug', 'userSlug', 'citySlug', 'placeId', 'userId', 'type', 'text', 'rating', 'imageSets', 'galleries', 'comments', 'commentCount', 'likes', 'hasOutletLike', 'likeCount', 'status', 'isEdited', 'createdAt'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'placeSlug' => 'Place Slug',
            'userSlug' => 'User Slug',
            'citySlug' => 'City Slug',
            'placeId' => 'Place ID',
            'userId' => 'User ID',
            'type' => 'Type',
            'text' => 'Text',
            'rating' => 'Rating',
            'imageSets' => 'Image Sets',
            'galleries' => 'Galleries',
            'comments' => 'Comments',
            'commentCount' => 'Comment Count',
            'likes' => 'Likes',
            'hasOutletLike' => 'Has Outlet Like',
            'likeCount' => 'Like Count',
            'status' => 'Status',
            'isEdited' => 'Is Edited',
            'createdAt' => 'Created At',
        ];
    }
}
