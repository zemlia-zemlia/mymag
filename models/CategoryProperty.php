<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_property".
 *
 * @property int $id
 * @property int $id_category
 * @property int $id_property
 *
 * @property Category $category
 * @property Property $property
 */
class CategoryProperty extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_property';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['id_category', 'id_property'], 'required'],
            [['id_category', 'id_property'], 'integer'],
//            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['id_category' => 'id']],
//            [['id_property'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['id_property' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_category' => 'Id Category',
            'id_property' => 'Id Property',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_category']);
    }

    /**
     * Gets query for [[Property]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'id_property']);
    }
}
