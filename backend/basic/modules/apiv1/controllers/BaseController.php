<?php

namespace app\modules\apiv1\controllers;

use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;

class BaseController extends ActiveController
{
    public static function allowedDomains()
    {
        return [
            $_SERVER["REMOTE_ADDR"],
            'http://localhost:8080',

        ];
    }


    function behaviors()
    {
        $behaviors = parent::behaviors();

        return array_merge($behaviors, [
            'corsFilter' => [
                'class' => Cors::class,
                'cors' => [
                    'Origin'                            => static::allowedDomains(),
                    'Access-Control-Request-Method'    => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
                    'Access-Control-Allow-Credentials'  => true,
                    'Access-Control-Max-Age'            => 3600,
                    'Access-Control-Allow-Headers'      => ['authorization', 'X-Requested-With', 'content-type'],
                    'Access-Control-Expose-Headers'     => ['X-Pagination-Current-Page', 'X-Pagination-Page-Count', 'X-Pagination-Total-Count'],
                ],
            ],
        ]);
    }
}
