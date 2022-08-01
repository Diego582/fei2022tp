<?php

namespace app\modules\apiv1\controllers;

use app\modules\apiv1\models\CalendarioReserva;

use yii\data\ActiveDataProvider;


/**
 * Default controller for the `apiv1` module
 */
class CalendarioreservaController extends BaseController
{
    public $modelClass = CalendarioReserva::class;
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }
    public function actionIndex()
    {
        $activeData = new ActiveDataProvider([
            'query' => CalendarioReserva::find(),
            'pagination' => false,
        ]);
        return $activeData;
    }
}
