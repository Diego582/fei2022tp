<?php

namespace app\modules\apiv1\controllers;

use app\modules\apiv1\models\Profesor;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

/**
 * Default controller for the `apiv1` module
 */
class ProfesorController extends BaseController
{
    public $modelClass = 'app\modules\apiv1\models\Profesor';
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }
    public function actionIndex()
    {
        $activeData = new ActiveDataProvider([
            'query' => Profesor::find(),
            'pagination' => false,
        ]);
        return $activeData;
    }
}
