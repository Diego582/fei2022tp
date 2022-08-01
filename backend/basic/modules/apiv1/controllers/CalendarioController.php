<?php

namespace app\modules\apiv1\controllers;

use app\modules\apiv1\models\Calendario;
use yii\data\ActiveDataProvider;


/**
 * Default controller for the `apiv1` module
 */
class CalendarioController extends BaseController
{
    public $modelClass = Calendario::class;
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }
    public function actionIndex()
    {
        $activeData = new ActiveDataProvider([
            'query' => Calendario::find(),
            'pagination' => false,
        ]);
        return $activeData;
    }
}
