<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'decsription:ntext',
            'slug',
            'meta_title',
            'meta_desc',
            'meta_keywords',

        ],
    ]) ?>


    <h3>Товары:    <?= Html::a('Create Product', ['/admin/product/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?></h3>
<div class="row">
    <div class="col-lg-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                'article',
                'decsription:ntext',
                'slug',
                //'price',
                //'meta_title',
                //'meta_desc',
                //'meta_keywords',
                //'created_at',
                //'updated_at',
                //'group_id',

                ['class' => 'yii\grid\ActionColumn',
                    'buttons'=>[
                        'view'=>function ($url, $model) {
                            $customurl=Yii::$app->getUrlManager()->createUrl(['/admin/product/view','id'=>$model['id']]); //$model->id для AR
                            return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', $customurl,
                                ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                        }
                        , 'update'=>function ($url, $model) {
                            $customurl=Yii::$app->getUrlManager()->createUrl(['/admin/product/update','id'=>$model['id']]); //$model->id для AR
                            return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', $customurl,
                                ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                        }
                    ],

                ],
            ],
        ]); ?>
    </div>
</div>
</div>
