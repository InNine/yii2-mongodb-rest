<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.11.2019
 * Time: 13:47
 */

namespace common\repositories;


use common\models\Organisations;
use common\models\Places;
use common\models\Users;
use yii\mongodb\Collection;

class PostsRepository
{


    /**
     * @param null $userId
     * @param int $offset
     * @param int $limit
     * @return array
     * @throws \yii\mongodb\Exception
     */
    public function getAllForSearch($userId = null, $offset = 0, $limit = 20): array
    {
        /** @var Collection $collection */
        $collection = \Yii::$app->mongodb->getCollection('posts');
        $result = $collection->aggregate([
                //Check if only user posts
                [
                    '$match' => [
                        'userId' => ['$eq' => $userId]
                    ]
                ],
                // connect places
                [
                    '$lookup' =>
                        [
                            'from' => Places::$collection,
                            'localField' => 'placeSlug',
                            'foreignField' => 'slug',
                            'as' => 'place'
                        ]
                ],
                [
                    '$unwind' => [
                        'path' => '$place',
                        'preserveNullAndEmptyArrays' => true
                    ]
                ],
                // connect organisations
                [
                    '$lookup' =>
                        [
                            'from' => Organisations::$collection,
                            'localField' => 'organisationSlug',
                            'foreignField' => 'slug',
                            'as' => 'organisation'
                        ]
                ],
                [
                    '$unwind' => [
                        'path' => '$organisation',
                        'preserveNullAndEmptyArrays' => true
                    ]
                ],
                // connect users
                [
                    '$lookup' =>
                        [
                            'from' => Users::$collection,
                            'localField' => 'userSlug',
                            'foreignField' => 'slug',
                            'as' => 'user'
                        ]
                ],
                [
                    '$unwind' => [
                        'path' => '$user',
                        'preserveNullAndEmptyArrays' => true
                    ]
                ],
                //limits and offsets
                [
                    '$limit' => (int)$limit,
                ],
                [
                    '$skip' => (int)$offset
                ],
                // data return
                [
                    '$project' => [
                        //post
                        '_id' => true,
                        'text' => true,
                        //user
                        'user._id' => true,
                        'user.firstName' => true,
                        'user.secondName' => true,
                        //place
                        'place._id' => true,
                        'place.name' => true,
                        'place.city' => true,
                        'place.street' => true,
                        'place.category' => true,
                        //organisation
                        'organisation._id' => true,
                        'organisation.name' => true,
                        'organisation.category' => true,
                        'organisation.city' => true,
                    ]
                ]
            ]
        );
        return $result;
    }
}