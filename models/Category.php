<?php

namespace app\models;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsTrait;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string|null $decsription
 * @property string $slug
 * @property string $meta_title
 * @property string $meta_desc
 * @property string $meta_keywords
 *
 * @property CategoryProduct[] $categoryProducts
 * @property CategoryProperty[] $categoryProperties
 */
class Category extends \yii\db\ActiveRecord
{
    use SaveRelationsTrait; // Optional
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }
    public function behaviors()
    {
        return [

            'saveRelations' => [
                'class'     => SaveRelationsBehavior::class,
                'relations' => [
                    'properties',
                ],
            ],
        ];
    }
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['decsription'], 'string'],
            ['slug', 'unique', 'on' => 'create'],
            [['properties'], 'safe'],
            [['name', 'slug', 'meta_title', 'meta_desc', 'meta_keywords'], 'string', 'max' => 255],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [

            'name' => 'Name',
            'decsription' => 'Decsription',
            'slug' => 'Slug',
            'meta_title' => 'Meta Title',
            'meta_desc' => 'Meta Desc',
            'meta_keywords' => 'Meta Keywords',
        ];
    }

    /**
     * Gets query for [[CategoryProducts]].
     *
     * @return \yii\db\ActiveQuery
     */

    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'id_product'])->viaTable('category_product', ['id_category' => 'id']);
    }

    /**
     * Gets query for [[CategoryProperties]].
     *
     * @return \yii\db\ActiveQuery
     */
//    public function getCategoryProperties()
//    {
//        return $this->hasMany(CategoryProperty::className(), ['id_category' => 'id']);
//    }
    public function getProperties()
    {
        return $this->hasMany(Property::class, ['id' => 'id_property'])->viaTable('category_property', ['id_category' => 'id']);
    }

    public function getPropertyList()
    {
        return ArrayHelper::map(Property::find()->all(), 'id', 'name');
    }



    public function beforeSave($insert)
    {
        foreach (array_keys($this->attributeLabels()) as $attr) {

            if ($attr == 'slug')
                $this->$attr = $this->$attr ? $this->$attr : Inflector::slug($this->name);

            else $this->$attr = $this->$attr ? $this->$attr : $this->name;

        }

        if ($this->validate('slug'))
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }


}
