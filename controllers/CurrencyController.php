<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;

class CurrencyController extends ActiveController
{

	public $modelClass = 'app\models\Currency';

	public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class'] = HttpBearerAuth::className();
        // $behaviors['authenticator']['except'] = ['view'];
        return $behaviors;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
