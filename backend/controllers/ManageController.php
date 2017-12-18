<?php
namespace modules\menu\backend\controllers;

use Yii;
use yii\filters\AccessControl;
use modules\menu\backend\models\Menu;
use modules\menu\backend\models\MenuSearch;
use modules\menu\backend\models\LinkMenuItem;

class ManageController extends \yii\web\Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                [
                    'class' => \yii\filters\VerbFilter::className(),
                    'actions' => [
                        'save-json-tree' => ['post'],
                    ],
                ],
                [
                    'class' => \yii\filters\ContentNegotiator::className(),
                    'only' => ['get-json-tree', 'save-json-tree'],
                    'formats' => [
                        'application/json' => \yii\web\Response::FORMAT_JSON,
                    ]
                ],
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['menu.manage'],
                        ],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new MenuSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Menu();
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post())) {
            $model->type = 'root';
            if ($model->makeRoot()) {
                Yii::$app->session->addFlash(
                    'success',
                    'منو جدید با موفقیت ساخته شد.'
                );
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->addFlash(
                    'success',
                    'ویژگی های منو با موفقیت ذخیره شد.'
                );
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model
        ]);
    }

    public function actionDelete($id)
    {
        if (isset($_GET['kalpok'])) {
            $this->findModel($id)->deleteWithChildren();
            Yii::$app->session->addFlash(
                'success',
                'منوی مورد نظر با موفقیت از سیستم حذف شد.'
            );
        }
        return $this->redirect(['index']);
    }

    public function actionTree($id)
    {
        $root = $this->findModel($id);
        return $this->render('tree', [
            'root' => $root,
            'linkItem' => new LinkMenuItem
        ]);
    }

    public function actionGetJsonTree($id)
    {
        $root = $this->findModel($id);
        // return $root->getFamilyTree();
        return [
            [
                'name' => 'node1',
                'id' => 123,
                'children' => [
                    [
                        'name' => 'child1',
                        'id' => 13,
                    ],
                    [
                        'name' => 'child2',
                        'id' => 23,
                    ]
                ]
            ],
            [
                'name' => 'node2',
                'id' => 12,
                'children' => [
                    [
                        'name' => 'child3',
                        'id' => 2,
                    ],
                ]
            ]
        ];
    }

    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
        }
    }
}
