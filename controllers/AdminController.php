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
use yii\web\Controller;
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
        $newsId = (int)Yii::$app->getRequest()->getQueryParam('id');

        if (!$model = News::findOne($newsId)) {
            Yii::$app->session->setFlash('error', 'News is not found!');
            return $this->redirect(Yii::$app->request->referrer);
        }

        if (!$model->delete()) {
            Yii::$app->session->setFlash('error', 'Deleting error');
            return $this->redirect(Yii::$app->request->referrer);
        }

        Yii::$app->session->setFlash('success', 'News has been removed');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionRemoveCategory()
    {
        $categoryId = (int)Yii::$app->getRequest()->getQueryParam('id');

        if (!$model = Category::findOne($categoryId)) {
            Yii::$app->session->setFlash('error', 'Category is not found!');
            return $this->redirect(Yii::$app->request->referrer);
        }

        if (News::findOne(['category_id' => $model->id])) {
            Yii::$app->session->setFlash('error', 'Category is not empty, therefore can\'t be removed');
            return $this->redirect(Yii::$app->request->referrer);
        }

        if (!$model->delete()) {
            Yii::$app->session->setFlash('error', 'Deleting error');
            return $this->redirect(Yii::$app->request->referrer);
        }

        Yii::$app->session->setFlash('success', 'Category has been removed');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionAddNews()
    {
        $model = new News();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'News is created');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Creating Error');
            }
        }

        $categoriesList = [];
        if ($categories = Category::find()->all()) {
            foreach ($categories as $category) {
                $categoriesList[$category->id] = $category->name;
            }
        }

        return $this->render('save-news', [
            'model' => $model,
            'categoriesList' => $categoriesList,
        ]);
    }

    public function actionEditNews()
    {
        $newsId = Yii::$app->getRequest()->getQueryParam('id');
        $model = News::findOne($newsId);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'News is saved');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Creating Error');
            }
        }

        $categoriesList = [];
        if ($categories = Category::find()->all()) {
            foreach ($categories as $category) {
                $categoriesList[$category->id] = $category->name;
            }
        }

        return $this->render('save-news', [
            'model' => $model,
            'categoriesList' => $categoriesList,
        ]);
    }

    public function actionAddCategory()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Category is created');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Creating Error');
            }
        }

        $categoriesList = ['0' => 'NULL'];
        if ($categories = Category::find()->all()) {
            foreach ($categories as $category) {
                $categoriesList[$category->id] = $category->name;
            }
        }

        return $this->render('save-category', [
            'model' => $model,
            'categoriesList' => $categoriesList,
        ]);
    }

    public function actionEditCategory()
    {
        $categoryId = Yii::$app->getRequest()->getQueryParam('id');
        $model = Category::findOne($categoryId);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Category is saved');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Saving Error');
            }
        }

        $categoriesList = ['0' => 'NULL'];
        if ($categories = Category::find()->all()) {
            foreach ($categories as $category) {
                $categoriesList[$category->id] = $category->name;
            }
        }

        return $this->render('save-category', [
            'model' => $model,
            'categoriesList' => $categoriesList,
        ]);
    }
}
