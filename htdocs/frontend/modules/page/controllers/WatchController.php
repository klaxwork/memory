<?php

namespace frontend\modules\page\controllers;

use common\models\ar_inherit\Tree;

use common\models\ElSearch;
use common\models\ElSearchFilter;
use common\models\models\EcmProducts;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\components\FrontendController;
use common\models\models\CmsTree;
use common\components\M;
use frontend\components\widgets\CatalogCardWidget\CatalogCardWidget;

class WatchController extends FrontendController
{

    public function actionView($node_id = 200) {
        //M::printr($node_id, '$node_id');
        //M::printr('');

        //M::printr($this->layout, '$this->layout');


        $oNode = CmsTree::find()
            ->onCondition(['id' => $node_id])
            ->one();

        if ($node_id == 110) {
            $oCategory = CmsTree::find()
                ->alias('tree')
                ->joinWith(['content'])
                ->where('tree.id = :id', [':id' => 200])
                ->one();
            $oChs = $oCategory
                ->children(1)
                ->joinWith('content')
                ->onCondition(['is_node_published' => true])
                ->all();
            $this->data['oCategory'] = $oCategory;
            $this->data['oChs'] = $oChs;

            $oBlock = CmsTree::getBlock('catalog');
            $this->data['oBlock'] = $oBlock;

            $this->page_title = 'Каталог';
        }

        if (0) {
            if ($node_id == 100) {
                $this->is_main_page = true;
            }

            if ($node_id == 110) {
                $oCategory = CmsTree::find()
                    ->alias('tree')
                    ->joinWith(['content'])
                    ->where('tree.id = :id', [':id' => 200])
                    ->one();
                $oChs = $oCategory
                    ->children(1)
                    ->with('content')
                    ->all();
                $this->data['oCategory'] = $oCategory;
                $this->data['oChs'] = $oChs;
            }

            if ($node_id == 200) {
                $oCategory = CmsTree::model()->getCategoryByPk($node_id);
                $this->fillSeo($oCategory);
                $this->render('catalog', compact('oCategory'));
                Yii::app()->end();
            }

            if ($node_id == 201) {
                $oCategory = CmsTree::model()->getCategoryByPk($node_id);
                $this->fillSeo($oCategory);
                $this->render('news', compact('oCategory'));
                Yii::app()->end();
            }


            //\CmsTree\Cache\Dependency::instance();
            //$node = \CmsTree\Node::with($node_id);
            //$this->fillSeo($node);
            //$this->page($node->model());
        }


        return $this->page($oNode);
    }

    public function actionMain() {
        //M::printr('STOP!');

        //$oTrees = Tree::find()->orderBy('id ASC')->all();
        //M::printr($oTrees, '$oTrees');

        if (0) {
            $oNode = CmsTree::findOne(100);

            $oQuery = ElSearchFilter::find();
            $oQuery->index = ElSearchFilter::index();
            $oQuery->type = ElSearchFilter::type();
            $oQuery->query(['bool' => ['filter' => [['range' => ['price' => ['gt' => 0]]]]]]);
            $items = $oQuery
                ->asArray()
                ->all();

            $result = [];
            foreach ($items as $item) {
                $category_id = $item['_source']['category_id'];
                if (!isset($result[$category_id])) {
                    $result[$category_id] = $item['_source'];
                }
                if (count($result) >= (10)) break;
            }

            $cards = '';
            foreach ($result as $row) {
                $card = [
                    'catalog' => $row['category_id'],
                    'url' => Url::to(['/route/catalog', 'id' => $row['category_id']]),
                    'imgUrl' => $row['img'],
                    'name' => $row['category_name'],
                    'price' => $row['price'],
                    'count' => $row['count'],
                ];
                $catslogCars = CatalogCardWidget::Widget(['card' => $card]);
                $cards .= $catslogCars;
            }

            $this->data['cards'] = $cards;
            //$this->actionView(100);
            return $this->page($oNode);
        }

        return $this->render('main');

    }
}