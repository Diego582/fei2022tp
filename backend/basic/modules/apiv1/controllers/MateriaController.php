<?php

namespace app\modules\apiv1\controllers;

use app\modules\apiv1\models\Materia;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

/**
 * Default controller for the `apiv1` module
 */
class MateriaController extends BaseController
{
    public $modelClass = 'app\modules\apiv1\models\Materia';
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }
    public function actionIndex()
    {
        $activeData = new ActiveDataProvider([
            'query' => Materia::find(),
            'pagination' => false,
        ]);
        return $activeData;
    }
}
