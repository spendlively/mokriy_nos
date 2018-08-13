<?php
/**
 * Created by PhpStorm.
 * User: spendlively
 * Date: 11.08.18
 * Time: 10:32
 */

namespace app\models;

use yii\db\ActiveRecord;

class Comment extends ActiveRecord
{

    public static function tableName()
    {
        return 'comment';
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'text' => 'Comment',
        ];
    }

    public function rules()
    {
        return [
            ['name', 'required', 'message' => 'Field "Name" is required'],
            ['text', 'required', 'message' => 'Field "Text" is required'],
            [['name', 'text'], 'trim'],
            ['name', 'string', 'min' => 3, 'tooShort' => 'Name must not be shorter then 3 characters'],
            ['name', 'string', 'max' => 10, 'tooLong' => 'Name must not be longer then 10 characters'],
            ['text', 'string', 'max' => 1000, 'tooLong' => 'Text must not be longer then 1000 characters'],
            ['news_id', 'integer'],
        ];
    }
}
