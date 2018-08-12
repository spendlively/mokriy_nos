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
}
