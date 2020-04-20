<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 19.04.2020
 * Time: 13:19
 */

namespace app\models;

use creocoder\nestedsets\NestedSetsQueryBehavior;

class CategoryQuery extends \yii\db\ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
}