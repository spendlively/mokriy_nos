<?php
/**
 * Created by PhpStorm.
 * User: spendlively
 * Date: 11.08.18
 * Time: 9:59
 */

namespace app\models;


use yii\db\ActiveRecord;

class Category extends ActiveRecord
{

    public static function tableName()
    {
        return 'category';
    }

    public function attributeLabels()
    {
        return [
            'parent_id' => 'Parent category',
            'name' => 'Category name',
        ];
    }

    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string', 'length' => [3, 255]],
            ['parent_id', 'categoryValidator'],
        ];
    }

    public function categoryValidator()
    {
        if ($this->parent_id !== NULL) {
            if ($this->parent_id === '0') {
                $this->parent_id = NULL;
            } elseif (!$model = Category::findOne($this->parent_id)) {
                $this->addError('category_id', 'Wrong parent id');
            }
        }
    }
}
