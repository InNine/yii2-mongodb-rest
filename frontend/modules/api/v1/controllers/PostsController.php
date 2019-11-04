<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.11.2019
 * Time: 13:58
 */

namespace frontend\modules\api\v1\controllers;

use common\repositories\PostsRepository;
use yii\rest\Controller;

class PostsController extends Controller
{



    public function actionIndex($userId, $offset = 0, $limit = 10)
    {
        try {
            $posts =  (new PostsRepository())->getAllForSearch($userId, $offset, $limit);
        } catch (\Exception $exception) {
            throw new \Exception();
        }

        return $posts;
    }
}