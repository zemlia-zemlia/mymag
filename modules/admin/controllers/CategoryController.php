<?php

namespace app\modules\admin\controllers;

use app\models\CategoryProperty;
use app\models\ProductSearch;
use app\models\Property;
use Yii;
use app\models\Category;
use app\models\CategorySearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }



    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
//        \yii\helpers\VarDumper::dump( Yii::$app->request->queryParams['ProductSearch'] == [], 5,true);die;

        $model = $this->findModel($id);
        $searchModel = new ProductSearch();
        if (Yii::$app->request->queryParams['ProductSearch'] == []) {
            $dataProvider = $dataProvider = new ActiveDataProvider([
                'query' => $model->getProducts(),
            ]);
        }
        else {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        $dataProvider->pagination->pageSize = 10;

        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,


        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {


//        \yii\helpers\VarDumper::dump($root, 5,true);die;

        $model = new Category();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post())) {
            $root = Category::find()->where(['id' => $model->parent_id])->one();

            $model->prependTo($root);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        CategoryProperty::deleteAll(['id_category' =>$id]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
