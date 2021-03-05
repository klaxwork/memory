<?php

namespace frontend\modules\product\controllers;

use common\models\ar_inherit\MediaStorage;
use common\models\ar_inherit\Product;
use common\models\ElSearch;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\components\FrontendController;
use common\models\models\CmsTree;
use common\components\M;

/**
 * Default controller for the `cms` module
 */
class DefaultController extends FrontendController
{
    public function actionIndex() {
        return $this->render('index');
    }

    //высчитывает, какой процент имеет $dig от $max
    public function percent($dig, $max) {

    }

    public function actionSearch($request = null) {
        //M::printr($request, '$request');
        $JS = [
            'success' => true,
            'message' => '',
            'messages' => [],
        ];

        try {
            $query = ElSearch::find();
            $query->index = ElSearch::index();
            $query->type = ElSearch::type();
            //M::printr($query, '$query');
            //$query->limit(100);
            //$query->with(['category.content']);
            $query->query([
                    'bool' => [
                        'must' => [
                            'multi_match' => [
                                'query' => $request,
                                'fields' => [
                                    'title',
                                    'description^2',
                                    //'id^3',
                                    //'product_id^4',
                                ],
                            ],
                        ],
                    ],
                ]
            );
            //M::printr($query, '$query');
            $JS['query'] = $query;

            $oItems = $query->all();
            //M::printr($oItems, '$oItems');

            if (1) {
                $products = [];
                $maxScore = 0;
                $limitPercent = 50;
                foreach ($oItems as $oItem) {
                    if (empty($maxScore)) $maxScore = $oItem->score;
                    $percent = 100 * $oItem / $maxScore;
                    if ($percent > $limitPercent) break;
                    $oProduct = $oItem->product;
                    //M::printr($oProduct, '$oProduct');
                    $product = ArrayHelper::merge($oProduct->attributes, $oItem->attributes);
                    $product['score'] = $oItem->score;
                    $product['percent'] = 100 * $oItem / $maxScore;
                    $product['is_fotos'] = !empty($oProduct->hasStorages) ? 1 : 0;
                    //$product['description'] = htmlspecialchars_decode($oProduct->description);

                    $oStores = $oProduct->getImages();
                    //M::printr($oStores, '$oStores');
                    $crops = [];
                    if (1) {
                        foreach ($oStores as $oStore) {
                            //M::printr($oStore->id, '$oStore->id');
                            $oCrop = $oStore->getCropped('dev:search');
                            //M::printr($oCrop, '$oCrop');
                            //M::printr($oCrop->id, '$oCrop->id');
                            //M::printr($oCrop->fs_alias, '$oCrop->fs_alias');
                            $crops[] = $oCrop->attributes;
                            //M::printr($cropped, '$cropped');
                        }
                        //M::printr($crops, '$crops');
                    }
                    $product['crops'] = $crops;
                    $products[] = $product;
                }
                $JS['products'] = $products;
            }
            $JS['oItems'] = $oItems;

        } catch (Exception $e) {
            //M::printr($e, '$e');
            $JS['success'] = false;
            $JS['message'] = $e->getMessage();
        }
        //$oProducts = Product::find()->orderBy('dt_created ASC')->all();
        //$JS['result'] = $oProducts;
        if (!\Yii::$app->request->isAjax) {
            M::printr($JS, '$JS');
            exit;
        }
        return Json::encode($JS);
    }

    public function actionView($id) {

        $oProduct = Product::find()
            //->alias('product')
            //->joinWith(['productHasStorage.storage.croppeds.cropped'])
            ->where(['id' => $id])
            ->one();
        $oStores = $oProduct->images;
        //M::printr($oStores, '$oStores');
        return $this->render('view', ['oProduct' => $oProduct, 'oStores' => $oStores]);
    }

    public function actionCreate($node_id = false) {
        if (1) {
            $oProduct = new Product();
            //M::printr($oProduct, '$oProduct');
            $oStores = [];
            M::printr($oStores, '$oStores');
            return $this->render('create', ['oProduct' => $oProduct, 'oStores' => $oStores]);
        }
    }

    public function actionEdit($product_id) {
        if (1) {
            $oProduct = Product::find()->where(['id' => $product_id])->one();
            //M::printr($oProduct, '$oProduct');

            return $this->render('edit', ['oProduct' => $oProduct]);
        }
    }

    public function actionSave() {
        //M::printr($_GET, '$_GET');
        //M::printr($_POST, '$_POST');
        return ['$_GET' => $_GET, '$_POST' => $_POST];
    }

    public function actionIndexing($product_id) {

    }
}
