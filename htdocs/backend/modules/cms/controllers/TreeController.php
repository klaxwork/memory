<?php

namespace backend\modules\cms\controllers;

use common\models\Map;
use common\models\models\AppProducts;
use common\models\models\CmsNodeGallery;
use common\models\models\EcmProducts;
use common\models\models\EdiBootstrap;
use Yii;
use common\models\models\CmsNodeContent;
use common\models\CMSTreeManagement;
use backend\models\NodeForm;
use common\models\Translit;
use yii\db\Connection;
use yii\db\Exception;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use common\components\M;
use common\models\models\CmsTree;
use backend\components\BackendController;
use yii\web\Response;

class TreeController extends BackendController
{
    //public $layout = '//layouts/ct-default';

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

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

    public function init() {
        /*/
        if (Yii::app()->request->isAjaxRequest) {
            $this->layout = '//layouts/ajax-popup';
        }
        $cs = Yii::app()->clientScript;
        $themePath = Yii::app()->theme->baseUrl;
        $cs->registerScriptFile($themePath . '/assets/js/keymaster-master/keymaster.js', CClientScript::POS_END);
        //*/
    }

    public function actionIndex() {
        $roots = CmsTree::find()->roots()->orderBy(['id' => 'ASC'])->all();
        $id = 0;
        return $this->render('index', compact('roots'));
    }

    public function actionWatch($id = 200) {
        $root = CmsTree::find()->where(['id' => $id])->one();
        //M::printr($root, '$root');
        $oTree = CMSTreeManagement::getTree($id);
        //M::printr($oTree, '$oTree');

        $tree = array();
        foreach ($oTree as $oNode) {
            if ($oNode->is_trash === true) {
                continue;
            }
            $node = $oNode->attributes;
            $node['key'] = $oNode->id;
            $node['title'] = $oNode->node_name;
            $tree[] = $node;
        }
        //M::printr($tree, '$tree');

        $res = array_values(CMSTreeManagement::createTree($tree));
        //M::printr($res, '$res');
        //$JS = CJSON::encode($res);


        return $this->render('watch', compact('id', 'root', 'res'));
    }

    public function actionNews() {
        $root = CmsTree::model()->findByAttributes(['url_alias' => 'news', 'ns_level' => 1]);
        //M::printr($root, '$root');
        $criteria = new CDbCriteria();
        $criteria->addCondition('is_trash IS FALSE');
        $criteria->order = 'dt_created DESC';
        $oNews = $root->descendants()->findAll($criteria);
        //M::printr($oNews, '$oNews');

        $this->render('news', compact('id', 'root', 'oNews'));
    }

    public function actionCreateNode($parent = 200) {
        $formName = 'CreateNode';
        $oNode = new CmsTree();

        if (!empty($_POST)) {
            $JS = array();
            $JS['success'] = true;
            $JS['messages'] = [];
            $db = \Yii::$app->db;
            $transaction = $db->beginTransaction();
            try {
                //?????????????? ????????.
                $oParent = CmsTree::findOne($parent);
                $oNode->node_name = $_POST[$formName]['page_title'];
                if (!$oNode->appendTo($oParent)) {
                    $JS['messages'] = array_merge([], $oNode->getErrors());
                }

                //?????????????? content
                $oContent = new CmsNodeContent();
                $oContent->page_title = $_POST[$formName]['page_title'];
                $oContent->cms_tree_ref = $oNode->id;
                $oContent->cms_templates_ref = 1;
                $oContent->url_alias = Translit::text($_POST[$formName]['page_title']);
                $oContent->vcs_revision = 1;
                if (!$oContent->save()) {
                    $JS['messages'] = array_merge([], $JS['messages'], $oContent->getErrors());
                }
                //?????????????? url_alias--id
                $oContent->url_alias = Translit::text($_POST[$formName]['page_title']) . '--' . $oContent->id;
                if (!$oContent->save()) {
                    $JS['messages'] = array_merge([], $JS['messages'], $oContent->getErrors());
                }
                //$transaction->rollBack();
                $transaction->commit();
            } catch (\Exception $e) {
                $JS['messages'] = $e->getMessage();
                $JS['success'] = false;
                $transaction->rollBack();
            }
            return Json::encode($JS);
        }

        return $this->renderPartial('createNode', compact('formName', 'oNode', 'parent'));
    }

    public function actionCreateNews($id = false) {
        $formName = 'CreateNews';
        $model = new NewsForm();
        //$model->is_seo_noindexing = true;

        if (!empty($_POST)) {
            $JS = array();
            $JS['errors'] = false;
            $root = CmsTree::model()->find('url_alias = :alias', ['alias' => 'news']);
            $model->fromArray($_POST[$formName]);
            $model->root_id = $root->id;
            if (!$model->save()) {
                $JS['errors'] = true;
                $JS['error'] = $model->getErrors();
            }
            //?????????????? ?????????? ??????????
            (new CmsTree\Site('qw'))->map();

            print CJSON::encode($JS);
            Yii::app()->end();
        }
        $this->render('createNews', compact('formName', 'model', 'id'));
    }

    public function actionEditNode($id) {
        $formName = 'EditNode';
        $oQuery = CmsTree::find()->alias('node');
        $oQuery->onCondition(['node.id' => $id]);
        $oQuery->joinWith(
            [
                'content.hasGalleries.storage', //.hasGallery.gallery.category',
                //'appNomenclature.ecmNomenclature.fields.customField',
                'properties',
            ]
        );
        //$oQuery->orderBy(['customField.field_name' => 'ASC']);
        $oNode = $oQuery->one();
        $oContent = $oNode->content;
        $nodeImages = $oContent->hasGalleries;
        $oImages = [];
        foreach ($nodeImages as $nodeImage) {
            $item = $nodeImage->storage->attributes;
            $data = $nodeImage->storage->data;
            $data = Json::decode($data);
            $meta = $data['meta'];
            $item['meta'] = $meta;
            $oImages[] = $item;
        }
        $oImages = Json::encode($oImages);
        //M::printr($oNode, '$oNode');
        $oFields = $oNode->properties;
        //M::printr($oFields, '$oFields');
        //$oImages = $oNode->content->getImages();

        if (!empty(Yii::$app->request->post())) {
            $JS = [
                'success' => true,
                'message' => null,
                'messages' => [],
            ];
            $transaction = Yii::$app->db->beginTransaction();
            try {

                $post = Yii::$app->request->post();
                //M::printr($post, '$post');

                if (isset($post[$formName]['do_delete'])) {
                    if ($oNode->is_node_protected == false) {
                        $oNode->is_trash = true;
                        if (!$oNode->save()) {
                            $JS['messages'][] = $oNode->getErrors();
                            throw new Exception('Can`t delete Node');
                        }
                        $oNode->deleteWithChildren();
                        $transaction->commit();
                        return Json::encode($JS);
                    } else {
                        throw new Exception('Node is protected!');
                    }
                }

                //?????????????????? ???????????? ?? ??????????????????
                //M::printr($post, '$post');
                $oNode->setAttributes($post[$formName]);
                //M::printr($oNode, '$oNode');

                //???????????? ???????? ????????
                if (1) {
                    $oNode['is_menu_visible'] = !empty($post[$formName]['is_menu_visible']);
                    $oNode['is_node_published'] = !empty($post[$formName]['is_node_published']);
                    $oNode['is_trash'] = !empty($post[$formName]['is_trash']);
                    $oNode['is_node_protected'] = !empty($post[$formName]['is_node_protected']);
                }
                //M::printr($oNode, '$oNode');

                //M::printr($oNode->attributes, '$oNode->attributes');
                if (!$oNode->save()) {
                    $JS['messages'] = $oNode->getErrors();
                    throw new Exception('Can`t save oNode');
                }

                $oContent->setAttributes($post[$formName]);
                $oContent->cms_tree_ref = $oNode->id;
                //???????????? ???????? ????????????????
                if (1) {
                    $oContent['is_seo_noindexing'] = !empty($post[$formName]['is_seo_noindexing']);
                    $oContent['is_published'] = !empty($post[$formName]['is_published']);
                    $oContent['is_in_markets'] = !empty($post[$formName]['is_in_markets']);
                    $oContent['is_in_google'] = !empty($post[$formName]['is_in_google']);
                }
                //M::printr($oContent->attributes, '$oContent->attributes');
                if (!$oContent->save()) {
                    $JS['messages'] = $oContent->getErrors();
                    throw new Exception('Can`t save oContent');
                }

                //???????????????????? ????????????????

                //???????????? ?????????????? ?? ???????? ????????????????
                foreach ($nodeImages as $nodeImage) {
                    $nodeImage->on_view_position = 0;
                    $nodeImage->save();
                }

                $illustrations = !empty($post[$formName]['images_illustrations']) ? $post[$formName]['images_illustrations'] : [];
                $newIllustrations = $illustrations;

                if (!empty($illustrations)) {
                    $position = 100;

                    //???????????? ???? ?????????????????? ???? ????????????????????
                    foreach ($illustrations as $key => $illustration) {
                        //M::printr($key, '$key');
                        //M::printr($illustration, '$illustration');
                        $key = $illustration['id'];
                        //M::printr($key, '$key');

                        //?????????? ???????????????? ?? ????????
                        $oNodeGallery = CmsNodeGallery::findOne(['cms_node_content_ref' => $oContent->id, 'cms_media_storage_ref' => $illustration['id']]);
                        if (empty($oImg)) {
                            //???????? ??????, ???? ???????????????? ????????????
                            $oNodeGallery = new CmsNodeGallery();
                            $oNodeGallery->cms_node_content_ref = $oContent->id;
                            $oNodeGallery->cms_media_storage_ref = $illustration['id'];
                        }

                        if ($oNodeGallery->on_view_position != $position) {
                            $oNodeGallery->on_view_position = $position;
                            if (!$oNodeGallery->save()) {
                                $JS['messages'] = $oNodeGallery->getErrors();
                                throw new Exception('Can`t save CmsNodeGallery');
                            }
                        }
                        //M::printr($oNodeGallery, '$oNodeGallery');
                        unset($newIllustrations[$key]);
                        $position += 100;
                    }
                    //?????????????? ??????, ?? ???????? ?????????????? 0
                    CmsNodeGallery::deleteAll(['cms_node_content_ref' => $oContent->id, 'on_view_position' => 0]);
                }

                $transaction->commit();
            } catch (Exception $e) {
                $JS['message'] = $e->getMessage();
                $JS['success'] = false;
                $transaction->rollBack();
            }
            (new Map())->checkNode($oNode, ['is_gen_children' => true, 'is_full_path' => true]);
            return Json::encode($JS);
        }

        return $this->render(
            'editNode',
            [
                'id' => $id,
                'formName' => $formName,
                'oNode' => $oNode,
                'oImages' => $oImages,
                'oFields' => $oFields,
                //'descendants' => $descendants,
            ]
        );

        if (0) {
            /*/
            $criteria = new CDbCriteria();
            $criteria->addCondition('t.id = ' . $id);
            $criteria->order = '"customField"."field_name" ASC';
            $oNode = CmsTree::model()->with(['content.hasGallery.gallery.category', 'appNomenclature.ecmNomenclature.fields.customField', 'properties'])->find($criteria);
            //*/
            //M::printr($oNode, '$oNode');
            $descendants = [];
            if ($oNode->ns_root_ref == 200) {
                $descendants = CMSTreeManagement::getTree($id);
            }
            //M::printr($descendants, '$descendants');
            $model = new NodeForm();
            $model->id = $id;
            $model->fields = [];
            if (0) { //(!empty($oNode->appNomenclature)) {
                $model->ecm_nomenclature_ref = $oNode->appNomenclature->ecmNomenclature->id;
                $model->fields = !empty($oNode->appNomenclature->ecmNomenclature->fields) ? $oNode->appNomenclature->ecmNomenclature->fields : [];
            }
            //M::printr($model, 'BEFORE BEFORE $model');
            $model->fromArray($oNode->attributes);
            $model->dt_created = $oNode->dt_created;
            $model->dt_updated = $oNode->dt_updated;
            $model->page_longtitle = !empty($oNode->content) ? $oNode->content->page_longtitle : '';
            $model->page_body = !empty($oNode->content) ? $oNode->content->page_body : '';
            $model->page_teaser = !empty($oNode->content) ? $oNode->content->page_teaser : '';
            $model->page_description = !empty($oNode->content) ? $oNode->content->page_description : '';
            $model->key = "";
            if (!empty($oNode->properties)) {
                foreach ($oNode->properties as $property) {
                    if ($property->cms_node_properties_fields_ref == 4) {
                        $model->key = $property->property_value;
                        break;
                    }
                }
            }

            //???????????????? ???????????????? ????????????????
            if (1) {
                $oContent = $oNode->content;
                $x = '1';
                foreach ($oContent->hasGallery as $oImage) {
                    if ($oImage
                            ->gallery
                            ->category
                            ->dev_key == 'ecm:illustrations') {
                        $model->images_illustrations['x' . $x] = $oImage->gallery->storage->id;
                    }
                    $x++;
                }
            }

            //M::printr($model, '$model');
            if (!empty($_POST)) {
                $transaction = Yii::app()->db->beginTransaction();
                $JS = [];
                $JS['errors'] = false;
                try {
                    if (isset($_POST[$formName]['do_delete'])) {
                        if ($oNode->is_node_protected == false) {
                            $oNode->is_trash = true;
                            if (!$oNode->saveNode()) {
                                $JS['messages'][] = $oNode->getErrors();
                                throw new Exception('Can`t save Node');
                            }
                            $oNode->deleteNode();
                            $transaction->commit();
                            print CJSON::encode($JS);
                            Yii::app()->end();
                        }
                    }

                    //M::printr($model, 'BEFORE $model');
                    $model->fromArray($_POST[$formName]);
                    $model->is_menu_visible = isset($_POST[$formName]['is_menu_visible']) ? true : false;
                    //$model->is_seo_noindexing = isset($_POST[$formName]['is_seo_noindexing']) ? true : false;
                    $model->is_node_published = isset($_POST[$formName]['is_node_published']) ? true : false;
                    $model->is_in_markets = isset($_POST[$formName]['is_in_markets']) ? true : false;
                    $model->is_in_google = isset($_POST[$formName]['is_in_google']) ? true : false;
                    //M::printr($model, 'AFTER $model');
                    $model->id = $id;
                    //?????????????????? ????????
                    if (!$model->save()) {
                        $JS['error'] = $model->getErrors();
                    }
                    $transaction->commit();
                    //$transaction->rollback();
                } catch (Exception $e) {
                    $JS['errors'] = true;
                    $JS['messages'] = 'Messages1:' . $e->getMessage();
                    $JS['error'] = $model->getErrors();
                    //M::printr($e->getMessage(), '$e');
                    $transaction->rollback();
                }

                if (Yii::app()->request->isAjaxRequest) {
                    print CJSON::encode($JS);
                }
                Yii::app()->end();
            } else {
                $this->render('editNode', compact('formName', 'model', 'id', 'descendants'));
            }
        }
    }

    public function actionEditNews($id) {
        $formName = 'EditNode';
        $oNode = CmsTree::model()->with(
            [
                'content.hasGallery.gallery.category',
                'content.hasGallery.gallery.storage.croppeds.cropped',
            ]
        )->findByPk($id);
        //M::printr($oNode, '$oNode');

        $model = new NewsForm();
        $model->id = $id;
        $model->fromArray($oNode->attributes);
        $model->page_longtitle = !empty($oNode->content) ? $oNode->content->page_longtitle : '';
        $model->page_body = !empty($oNode->content) ? $oNode->content->page_body : '';
        $model->page_teaser = !empty($oNode->content) ? $oNode->content->page_teaser : '';
        //M::printr($model->page_body, '$model->page_body');

        $oGalleryCategory = AppGalleryCategories::model()->getGalleryCategory('ecm:teaser_news');
        //???????????????? ??????????????
        if (!empty($oNode->content->hasGallery)) {
            $oOrigin = $oNode->content->hasGallery->gallery->storage;
            $model->image_teaser_news = $oOrigin->id;
        }

        //M::printr($model, '$model');
        if (!empty($_POST)) {
            //M::printr($_POST, '$_POST');
            $transaction = Yii::app()->db->beginTransaction();
            $JS = [];
            $JS['errors'] = false;
            try {
                if (isset($_POST[$formName]['do_delete'])) {
                    if ($oNode->is_node_protected == false) {
                        $oNode->is_trash = true;
                        if (!$oNode->saveNode()) {
                            $JS['messages'][] = $oNode->getErrors();
                            throw new Exception('Can`t save Node');
                        }
                        $transaction->commit();
                        print CJSON::encode($JS);
                        Yii::app()->end();
                    }
                }
                //M::printr($model, 'BEFORE $model');
                $model->fromArray($_POST[$formName]);
                $model->is_menu_visible = isset($_POST[$formName]['is_menu_visible']) ? true : false;
                //$model->is_seo_noindexing = isset($_POST[$formName]['is_seo_noindexing']) ? true : false;
                $model->is_node_published = isset($_POST[$formName]['is_node_published']) ? true : false;
                //M::printr($model, 'AFTER $model');
                $model->id = $id;
                //?????????????????? ????????
                if (!$model->save()) {
                    $JS['error'] = $model->getErrors();
                }
                $JS['response']['tree'] = $model->tree;
                $JS['response']['node_content'] = $model->node_content;
                $transaction->commit();
                //$transaction->rollback();

                //?????????????? ?????????? ??????????
                (new CmsTree\Site('qw'))->map();
            } catch (Exception $e) {
                $JS['errors'] = true;
                $JS['error'][] = $e->getMessage();
                //M::printr($e->getMessage(), '$e');

                $transaction->rollback();
            }

            if (Yii::app()->request->isAjaxRequest) {
                print CJSON::encode($JS);
            }
            Yii::app()->end();
        }

        $this->render('editNews', compact('formName', 'model', 'id'));
    }

    public function actionMoveNode() {
        $data = array();
        $oCategory = new CmsTree();
        $post = Yii::$app->request->post();

        $move = Json::decode($post['move']);
        $to = Json::decode($post['to']);
        $hit = $post['hit'];
        //M::printr($move, '$move');
        //M::printr($to, '$to');
        //M::printr($hit, '$hit');

        $id = 3;
        $src = CmsTree::findOne(['id' => $move['data']['id']]);
        $dst = CmsTree::findOne(['id' => $to['data']['id']]);
        //M::printr($src, '$src');
        //M::printr($dst, '$dst');
        if ($hit == 'over') {
            $src->appendTo($dst);
        }

        if ($hit == 'before') {
            $src->insertBefore($dst);
        }

        if ($hit == 'after') {
            $src->insertAfter($dst);
        }
        $src->dt_updated = new Expression('NOW()');
        $src->save();

        (new Map())->checkNode($src);
        //M::printr($src, '$src');
        //M::printr($dst, '$dst');
        //$this->render('create', array('model' => $oCategory));
    }

    public function actionGwDataTree($id = 200) {
        //$root = CmsTree::model()->findByPk($id);
        $root = CmsTree::findOne(['id' => $id]);

        $oTree = CMSTreeManagement::getTree($id);
        //M::printr($oTree, '$oTree');
        $tree = array();
        foreach ($oTree as $oNode) {
            $node = $oNode->attributes;
            $node['key'] = $oNode->id;
            $node['title'] = $oNode->node_name;
            if ($node['is_trash']) {
                $node['title'] .= ' <span class="fa fa-trash-o"></span>';
            }
            if (0) { //($node['is_seo_noindexing']) {
                $node['title'] .= ' <span class="fa fa-pencil-square"></span>';
            }
            if (!$node['is_node_published']) {
                $node['title'] .= ' <span class="fa fa-eye-slash"></span>';
            }
            if (0) { //($node['is_in_markets']) {
                $node['title'] .= ' <span title="YandexMarket" class="icon-basket"></span>';
            }

            $node['expanded'] = false;
            $tree[] = $node;
        }

        $result = array_values(CMSTreeManagement::createTree($tree));
        //M::printr($result, '$result');
        return Json::encode($result);
    }

    public function actionDeleteNode($id) {
        $oNode = CmsTree::model()->findByPk($id);
        if (!empty($oNode) && $oNode->is_node_protected == false) {
            $oNode->deleteNode();
        }
        $this->redirect($this->createUrl('/cms/tree'));
    }

    public function actionGetRegionProps() {
        if (!empty($_POST)) {
            //M::printr($_POST, '$_POST');
            //???????????????? ?????? props ???? ??????????????
            $oProps = AppRegionNodeOverrides::model()->with('property')->findAllByAttributes(
                array(
                    'cms_tree_ref' => $_POST['node_id'],
                    'app_regions_ref' => $_POST['region_id'],
                ),
                array(
                    'order' => '"property"."id" ASC',
                )
            );
            //M::printr($oProps, '$oProps');
            $props = array();
            foreach ($oProps as $oProp) {
                //M::printr($oProp, '$oProp');
                $prop = $oProp->attributes;
                $prop['prop'] = $oProp->property->attributes;
                $props[] = $prop;
            }
            //M::printr($props, '$props');
            $JS = ['success' => true, 'regionProps' => $props];
            if (Yii::app()->request->isAjaxRequest) {
                print CJSON::encode($JS);
            }
            Yii::app()->end();
        }
    }

    public function actionSaveRegionProps() {
        if (!empty($_POST)) {
            //M::printr($_POST, '$_POST');
            $JS = ['success' => true];

            $transaction = Yii::app()->db->beginTransaction();
            try {
                $cms_tree_ref = $_POST['node_id'];
                $app_regions_ref = $_POST['region_id'];
                foreach ($_POST['fields'] as $prop) {
                    $app_region_properties_ref = $prop['id'];
                    //???????? ??????????, ???? ?????????????? ???????? ???? ????????
                    if (empty($prop['value'])) {
                        AppRegionNodeOverrides::model()->deleteAllByAttributes(
                            [
                                'cms_tree_ref' => $cms_tree_ref,
                                'app_regions_ref' => $app_regions_ref,
                                'app_region_properties_ref' => $app_region_properties_ref,
                            ]
                        );
                    } else {
                        //?????????? ???????? ?? ????
                        $oProp = AppRegionNodeOverrides::model()->findByAttributes(
                            [
                                'cms_tree_ref' => $cms_tree_ref,
                                'app_regions_ref' => $app_regions_ref,
                                'app_region_properties_ref' => $app_region_properties_ref,
                            ]
                        );
                        //???????? ???????????? ??????, ???? ??????????????
                        if (empty($oProp)) {
                            $oProp = new AppRegionNodeOverrides();
                            $oProp->cms_tree_ref = $cms_tree_ref;
                            $oProp->app_regions_ref = $app_regions_ref;
                            $oProp->app_region_properties_ref = $app_region_properties_ref;
                        }
                        //???????????????? ?? ????
                        $oProp->property_value = $prop['value'];
                        if (!$oProp->save()) {
                            throw new Exception('Can`t save data in AppRegionNodeOverrides');
                        }
                    }
                }
                $transaction->commit();
            } catch (Exception $e) {
                $JS['success'] = false;
                $JS['message'] = $e->getMessage();
                $transaction->rollback();
            }

            if (Yii::app()->request->isAjaxRequest) {
                print CJSON::encode($JS);
            }
            Yii::app()->end();
        }
    }

    public function actionLazyDataTree($id = 200) {
        $page = !empty($_GET['page']) ? $_GET['page'] : '';
        //???????????????? ?????????????????????????? ??????????
        $oRoot = CmsTree::find()
            ->with('content')
            ->where('id = :id', [':id' => $id])
            ->one();

        $oTree = $oRoot->children(1)->with('content')->all();

        $tree = array();
        foreach ($oTree as $oNode) {
            //M::printr($oNode, '$oNode');
            $content = $oNode->content;
            if (empty($content)) {
                $content = new CmsNodeContent();
                //M::printr($content->attributes, '$content->attributes');
                //exit;
            }
            $node = array_merge(
                [],
                $content->attributes,
                $oNode->attributes
            );
            $oChs = $oNode->children(1)->all();
            $isChs = !empty($oChs);
            $node['key'] = $oNode->id;
            $node['title'] = $content->page_title;
            if ($node['is_trash']) {
                $node['title'] .= ' <span title="??????????????" class="fa fa-trash-o"></span> <span title="??????????????" class="icon-trash"></span>';
            }
            if (0) { //($node['is_seo_noindexing'] && $page == 'seo') {
                $node['title'] .= ' <span title="???? ??????????????????????????" class="icon-blocked"></span>';
            }
            if (0) { //($node['is_in_markets']) {
                $node['title'] .= ' <span title="YandexMarket" class="icon-basket"></span>';
            }
            if (0) { //(count($oNode->products) > 0) {
                $node['title'] .= ' <span title="???????? ????????????" class="icon-price-tag3"></span>';
            }
            if ($node['is_in_google']) {
                $node['title'] .= ' <span title="Google & eLama" class="icon-google"></span>';
            }

            $node['expanded'] = false;
            $node['lazy'] = $isChs;
            $tree[] = $node;
        }

        $nodes = Json::encode($tree);
        return $nodes;
    }

    public function actionFreeNoms() {
        return $this->render('freeNoms');
    }

    public function actionMoveNoms() {
        //$oPartner = AppPartners::model()->findByPk($this->partner_id);
        //?????????????????? ???????????????????????? ?? ??????????????
        //M::printr($_POST, '$_POST');
        //M::printr(Yii::$app->request->post(), 'Yii::$app->request->post()');
        if (!empty(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            $post = Yii::$app->request->post();
            try {
                $JS = [
                    'success' => true,
                    'message' => false,
                    'messages' => [],
                ];
                $category_id = $post['dstCategoryId'];
                $oNode = CmsTree::findOne(['id' => $category_id]);

                $noms_ids = $post['ids'];
                $oProducts = EcmProducts::find()->alias('product')
                    ->joinWith(['appProduct.tree'])
                    ->where(['IN', 'product.id', $noms_ids])
                    ->all();
                foreach ($oProducts as $oProduct) {
                    $oAppProduct = $oProduct->appProduct;
                    if (empty($oAppProduct)) {
                        $oAppProduct = new AppProducts();
                        $oAppProduct->edi_bootstrap_ref = EdiBootstrap::getDefaultBootstrap()->id;
                        $oAppProduct->ecm_products_ref = $oProduct->id;
                    }
                    $oAppProduct->cms_tree_ref = $category_id;
                    if (!$oAppProduct->save()) {
                        $JS['messages'] += $oAppProduct->getErrors();
                        throw new Exception('???? ???????? ?????????????????? ????????????????????????.');
                    }

                    $oNode->dt_updated = new Expression('NOW()');
                    $oNode->save();
                }

                (new Map())->checkNode($oNode);
                $transaction->commit();
            } catch (Exception $e) {
                $JS['success'] = false;
                $JS['message'] = $e->getMessage();
                $transaction->rollback();
            }

            if (Yii::$app->request->isAjax) {
                return Json::encode($JS);
            }

        }
    }

    //???????????????? ?????????? ???? ??????????????????
    public function actionUnbindNoms() {
        //$oPartner = AppPartners::model()->findByPk($this->partner_id);
        //?????????????????? ???????????????????????? ?? ??????????????
        //M::printr($_POST, '$_POST');
        //M::printr(Yii::$app->request->post(), 'Yii::$app->request->post()');
        if (!empty(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            $post = Yii::$app->request->post();
            try {
                $JS = [
                    'success' => true,
                    'message' => false,
                    'messages' => [],
                    '_POST' => $post,
                ];
                $category_id = $post['categoryId'];
                $ids = $post['ids'];


                exit;
                $oNode = CmsTree::findOne(['id' => $category_id]);

                $noms_ids = $post['ids'];
                $oProducts = EcmProducts::find()->alias('product')
                    ->joinWith(['appProduct.tree'])
                    ->where(['IN', 'product.id', $noms_ids])
                    ->all();
                foreach ($oProducts as $oProduct) {
                    $oAppProduct = $oProduct->appProduct;
                    if (empty($oAppProduct)) {
                        $oAppProduct = new AppProducts();
                        $oAppProduct->edi_bootstrap_ref = EdiBootstrap::getDefaultBootstrap()->id;
                        $oAppProduct->ecm_products_ref = $oProduct->id;
                    }
                    $oAppProduct->cms_tree_ref = $category_id;
                    if (!$oAppProduct->save()) {
                        $JS['messages'] += $oAppProduct->getErrors();
                        throw new Exception('???? ???????? ?????????????????? ????????????????????????.');
                    }

                    $oNode->dt_updated = new Expression('NOW()');
                    $oNode->save();
                }

                (new Map())->checkNode($oNode);
                $transaction->commit();
            } catch (Exception $e) {
                $JS['success'] = false;
                $JS['message'] = $e->getMessage();
                $transaction->rollback();
            }

            if (Yii::$app->request->isAjax) {
                return Json::encode($JS);
            }

        }
    }

    public function actionSeo() {
        //$this->pageTitle = 'SEO ?????????????? ??????????????';

        /*
        $cs = Yii::app()->clientScript;
        $themePath = Yii::app()->theme->baseUrl;

        $cs->registerScriptFile($themePath . '/vendor/plugins/fancytree/jquery.fancytree-all.min.js', CClientScript::POS_END);
        $cs->registerScriptFile($themePath . '/vendor/plugins/fancytree/extensions/jquery.fancytree.childcounter.js', CClientScript::POS_END);
        $cs->registerScriptFile($themePath . '/vendor/plugins/fancytree/extensions/jquery.fancytree.columnview.js', CClientScript::POS_END);
        $cs->registerScriptFile($themePath . '/vendor/plugins/fancytree/extensions/jquery.fancytree.dnd.js', CClientScript::POS_END);
        $cs->registerScriptFile($themePath . '/vendor/plugins/fancytree/extensions/jquery.fancytree.edit.js', CClientScript::POS_END);
        $cs->registerScriptFile($themePath . '/vendor/plugins/fancytree/extensions/jquery.fancytree.filter.js', CClientScript::POS_END);
        */
        return $this->render('seo');
    }

    public function actionLoadSeo() {
        $id = !empty($_POST['id']) ? $_POST['id'] : null;
        if (empty($id)) {
            $id = !empty($_GET['id']) ? $_GET['id'] : null;
        }
        if (!empty($id)) {
            $oNode = CmsTree::findOne(['id' => $id]);
            $JS = [
                'success' => true,
                'message' => null,
                'response_data' => [],
            ];

            $item = $oNode->attributes;
            $item['url_alias'] = $oNode->url_alias;
            $item['page_title'] = $oNode->node_name;
            $item['page_title'] = $oNode->content->page_title;
            $item['page_longtitle'] = $oNode->content->page_longtitle;
            $item['page_teaser'] = $oNode->content->page_teaser;
            $item['seo_title'] = $oNode->content->seo_title;
            $item['seo_keywords'] = $oNode->content->seo_keywords;
            $item['seo_description'] = $oNode->content->seo_description;

            $item = array_merge([], $oNode->content->attributes, $oNode->attributes);
            /*/
            $regionsSeo = [];
            foreach ($oNode->regionSeo as $oSeo) {
                $regionsSeo["{$oSeo->app_regions_ref}"]["{$oSeo->app_region_properties_ref}"] = $oSeo->attributes;
            }
            $item['regions'] = $regionsSeo;
            //*/
            $JS['response_data'] = $item;

            if (Yii::$app->request->isAjax) {
                return Json::encode($JS);
            }
            M::printr($JS, '$JS');
        }
        return true;
    }

    public function actionSaveSeo() {
        $JS = [
            'success' => true,
            'message' => null,
            '_POST' => Yii::$app->request->post(),
        ];
        if (!empty(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            $transaction = Yii::$app->db->beginTransaction();
            try {
                //???????????????? ????????
                $oNode = CmsTree::find()->alias('node')
                    ->joinWith(['content'])
                    ->where(['node.id' => $post['id']])
                    ->one();
                if (empty($oNode)) {
                    throw new Exception("Can`t find {$post['id']}...");
                }
                $oContent = $oNode->content;

                //???????????????? ????????
                $oNode->node_name = $post['page_title'];
                $oNode->setAttributes($post);
                //$oNode->is_seo_noindexing = !empty($_POST['is_seo_noindexing']);
                //$oNode->is_node_published = !empty($_POST['is_node_published']);
                //$oNode->is_in_markets = !empty($_POST['is_in_markets']);
                //$oNode->is_in_google = !empty($_POST['is_in_google']);
                //?????????????????? ????????
                if (!$oNode->save()) {
                    $JS['messages'] .= $oNode->getErrors();
                    throw new Exception("Can`t save node...");
                }
                $oNode->dt_updated = new Expression('NOW()');
                $oNode->save();
                $JS['oNode'] = $oNode;

                //???????????????? content ????????
                //???????????????? content ????????
                $oContent->setAttributes($post);
                $JS['oContent'] = $oContent;
                //?????????????????? content ????????
                if (!$oContent->save()) {
                    $JS['messages'] .= $oContent->getErrors();
                    throw new Exception("Can`t save content...");
                }

                //???????????????? ??????????????
                if (0) { //(!empty($_POST['RegionSeo'])) {
                    foreach ($_POST['RegionSeo'] as $region_id => $props) {
                        if (empty($props['is_seo_on'])) {
                            //??????????????
                            $arr = [
                                'app_regions_ref' => $region_id,
                                'cms_tree_ref' => $oNode->id,
                            ];
                            $oNodeProps = AppRegionNodeOverrides::model()->findAllByAttributes($arr);
                            foreach ($oNodeProps as $oNodeProp) {
                                $oNodeProp->delete();
                            }
                        } else {
                            //??????????????????
                            foreach ($props as $prop_id => $value) {
                                if ($prop_id == 0) continue;
                                $oAppRegionNodeProp = AppRegionNodeOverrides::model()
                                    ->findByAttributes(
                                        [
                                            'app_regions_ref' => $region_id,
                                            'app_region_properties_ref' => $prop_id,
                                            'cms_tree_ref' => $oNode->id,
                                        ]
                                    );
                                if (empty($oAppRegionNodeProp)) {
                                    $oAppRegionNodeProp = new AppRegionNodeOverrides();
                                }
                                $oAppRegionNodeProp->app_regions_ref = $region_id;
                                $oAppRegionNodeProp->app_region_properties_ref = $prop_id;
                                $oAppRegionNodeProp->cms_tree_ref = $oNode->id;
                                $oAppRegionNodeProp->property_value = $value;
                                if (!$oAppRegionNodeProp->save()) {
                                    $JS['messages'] .= $oAppRegionNodeProp->getErrors();
                                    throw new Exception("Can`t save region_seo_value...");
                                }
                            }
                        }

                    }
                }

                (new Map())->checkNode($oNode);

                //$transaction->rollback();
                $transaction->commit();
            } catch (Exception $e) {
                $JS['success'] = false;
                $JS['message'] = $e->getMessage();
                $transaction->rollback();
            }

            if (Yii::$app->request->isAjax) {
                return Json::encode($JS);
            }
            M::printr($JS, '$JS');
        }
        return true;
    }

}


