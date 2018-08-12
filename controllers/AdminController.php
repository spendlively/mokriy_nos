<?php
/**
 * Created by PhpStorm.
 * User: spendlively
 * Date: 11.08.18
 * Time: 12:21
 */

namespace app\controllers;

use app\models\Category;
use app\models\News;
use Yii;
use yii\base\Controller;
use yii\filters\AccessControl;

class AdminController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', []);
    }

    public function actionCategory()
    {

        $categories = Category::find()->orderBy(['id' => SORT_ASC])->all();

        return $this->render('category', [
            'categories' => $categories,
        ]);
    }

    public function actionNews()
    {
        $news = News::find()->orderBy(['id' => SORT_ASC])->all();

        return $this->render('news', [
            'news' => $news,
        ]);
    }

    public function actionRemoveNews()
    {
        $categoryId = Yii::$app->getRequest()->getQueryParam('id');
        return "REMOVE NEWS {$categoryId}";
    }

    public function actionRemoveCategory()
    {
        $categoryId = Yii::$app->getRequest()->getQueryParam('id');
        return "REMOVE CATEGORY {$categoryId}";
    }

    public function actionEditNews()
    {
        $newsId = Yii::$app->getRequest()->getQueryParam('id');
        return "EDIT NEWS {$newsId}";
    }

    public function actionEditCategory()
    {
        $newsId = Yii::$app->getRequest()->getQueryParam('id');
        return "EDIT NEWS {$newsId}";
    }
}
