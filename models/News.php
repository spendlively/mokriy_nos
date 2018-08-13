<?php
/**
 * Created by PhpStorm.
 * User: spendlively
 * Date: 11.08.18
 * Time: 10:13
 */

namespace app\models;

use yii\db\ActiveRecord;

class News extends ActiveRecord
{

    public static function tableName()
    {
        return 'news';
    }

    public function attributeLabels()
    {
        return [
            'category' => 'Category id',
            'title' => 'Title',
            'short_text' => 'Short text',
            'text' => 'Text',
            'is_active' => 'Is active',
        ];
    }

    public function rules()
    {
        return [
            [['category_id', 'title', 'short_text', 'text'], 'required'],
            ['category_id', 'integer'],
            [['title', 'short_text', 'text'], 'trim'],
            ['is_active', 'boolean'],
            ['title', 'string', 'length' => [3, 255]],
            ['short_text', 'string', 'length' => [1, 511]],
            ['text', 'string', 'length' => [1, 1000]],
            ['category_id', 'categoryValidator'],
            ['title', 'titleValidator'],
            ['alias', 'trim'],
            ['date', 'date', 'format' => 'php:Y-m-d H:i:s'],
        ];
    }

    public function titleValidator()
    {
        $this->alias = $this->translit($this->title);
    }

    public function categoryValidator()
    {
        if (!$model = Category::findOne($this->category_id)) {
            $this->addError('category_id', 'Wrong category number');
        }
    }

    public function translit($s)
    {
        $s = (string)$s;
        $s = strip_tags($s);
        $s = str_replace(array("\n", "\r"), " ", $s);
        $s = preg_replace("/\s+/", ' ', $s);
        $s = trim($s);
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s);
        $s = strtr($s, array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ъ' => '', 'ь' => ''));
        $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s);
        $s = str_replace(" ", "-", $s);
        return $s;
    }
}
