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

//    public function attributeLabels()
//    {
//        return [
//            'name' => 'Имя',
//            'text' => 'Текст сообщения',
//        ];
//    }
//
//    public function rules()
//    {
//        return [
//            ['name', 'required', 'message' => 'Поле "Имя" обязательно для заполнения'],
//            ['text', 'required', 'message' => 'Поле "Текст сообщения" обязательно для заполнения'],
//            [['name', 'text'], 'trim'],
//            ['name', 'string', 'min' => 3, 'tooShort' => 'Имя должно быть не менее 3 символов'],
//            ['name', 'string', 'max' => 10, 'tooLong' => 'Имя должно быть не более 10 символов'],
//            ['text', 'string', 'max' => 1000, 'tooLong' => 'Текст сообщения должен быть не более 1000 символов'],
//            ['news_id', 'integer'],
//        ];
//    }
}
