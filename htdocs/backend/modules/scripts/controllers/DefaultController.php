<?php

namespace backend\modules\scripts\controllers;

use common\components\M;
use common\models\ElSearch;
use common\models\ElSearchFilter;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\BackendController;

/**
 * Default controller for the `scripts` module
 */
class DefaultController extends BackendController
{
    //*/
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['*'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    //*/

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionDeleteIndex() {
        M::printr('DELETE');
        ElSearch::deleteIndex();
    }

    public function actionCreateIndex() {
        M::printr('CREATE');
        ElSearch::createIndex();
    }

    public function actionFillElastic() {
        M::printr('FILL');
        //взять по очереди все статьи
        //добавить их в ElasticSearch

    }

}
