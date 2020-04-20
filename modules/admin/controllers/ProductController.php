<?php

namespace app\modules\admin\controllers;

use app\models\PropertyValue;
use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 10;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Product();
//        \yii\helpers\VarDumper::dump($model, 5,true);die;
        $model->category = [$id];
//        \yii\helpers\VarDumper::dump($model->category[0]->properties, 5,true);die;


        if ($model->load(Yii::$app->request->post())) {
            $values = Yii::$app->request->post('propertyValues');



            $model->save();
            foreach ($values as $key => $value){
                $val = new PropertyValue();
                $val->value = $value;
                $val->id_property = $key;
                $val->id_product =  $model->id;
                $val->save();

            }
            Yii::$app->session->setFlash('success', 'Товар добавлен');
            return $this->redirect(['/admin/category/view', 'id' => $id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
//        \yii\helpers\VarDumper::dump($model->propertyValues, 5,true);die;

        if ($model->load(Yii::$app->request->post())) {
            $values = Yii::$app->request->post('propertyValues');


            foreach ($values as $key => $value){
                $val = PropertyValue::find()->where(['id_property' => $key])->andWhere(['id_product' => $model->id])->one();
                if (!$val) {
                    $val = new PropertyValue();
                    $val->id_property = $key;
                    $val->id_product =  $model->id;
                }

                $val->value = $value;
                $val->save();

            }


           $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        PropertyValue::deleteAll(['id_product' =>$id]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
