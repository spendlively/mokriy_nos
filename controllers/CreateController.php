<?php
/**
 * Created by PhpStorm.
 * User: spendlively
 * Date: 11.08.18
 * Time: 9:58
 */

namespace app\controllers;

use app\models\Category;
use app\models\Comment;
use app\models\News;
use Yii;
use yii\base\Controller;

class CreateController extends Controller
{

    public $categories = [
        //id, parent_id, name
        [1, null, 'Category 1'],
        [2, null, 'Category 2'],
        [3, null, 'Category 3'],

        [4, 1, 'Category 11'],
        [5, 2, 'Category 22'],
        [6, 3, 'Category 33'],

        [7, 4, 'Category 111'],
        [8, 5, 'Category 222'],
        [9, 6, 'Category 333'],
    ];

    public $news = [
        //id, category_id
        [null, 1],
        [null, 1],
        [null, 1],
        [null, 1],

        [null, 2],
        [null, 2],
        [null, 2],
        [null, 2],

        [null, 3],
        [null, 3],
        [null, 3],
        [null, 3],

        [null, 4],
        [null, 4],
        [null, 4],
        [null, 4],

        [null, 5],
        [null, 5],
        [null, 5],
        [null, 5],

        [null, 6],
        [null, 6],
        [null, 6],
        [null, 6],

        [null, 7],
        [null, 7],
        [null, 7],
        [null, 7],

        [null, 8],
        [null, 8],
        [null, 8],
        [null, 8],

        [null, 9],
        [null, 9],
        [null, 9],
        [null, 9],
    ];

    public $newsTitleTemplate = 'Header';
    public $newsShortTextTemplate = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
    public $newsTextTemplate = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.';
    public $newsAliasTemplate = 'alias';

    public $commentNameTemplate = 'Guest';
    public $commentTextTemplate = 'Comment\'s text';

    public function trancateTable($tableName)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("DELETE FROM {$tableName};");
        return $command->query();
    }

    public function actionCategories()
    {

        $this->trancateTable(Category::tableName());

        foreach($this->categories as $category){

            $model = new Category();

            $model->id = $category[0];
            $model->parent_id = $category[1];
            $model->name = $category[2];

            $model->save();
        }

        return sprintf("%s categories created", count($this->categories));
    }

    public function actionNews()
    {

        $this->trancateTable(News::tableName());

        $increment = 1;

        $date = new \DateTime('-1 year');
        $dateInterval = \DateInterval::createFromDateString('1 day');

        foreach($this->news as $news){

            $model = new News();

            $model->id = $news[0];
            $model->category_id = $news[1];
            $model->title = sprintf("%s %s", $this->newsTitleTemplate, $increment);
            $model->short_text = sprintf("%s", $this->newsShortTextTemplate);;
            $model->text = sprintf("%s", $this->newsTextTemplate);
            $model->is_active = true;
            $model->alias = sprintf("%s_%s", $this->newsAliasTemplate, $increment);

            $model->date = $date->format('Y-m-d H:i:s');
            $date->add($dateInterval);

            $model->save();

            $increment++;
        }

        return sprintf("%s news created", count($this->news));
    }

    public function actionComments()
    {
        $this->trancateTable(Comment::tableName());

        $firstNew = News::find()->orderBy(['id' => SORT_ASC])->one();
        $firstNewId = (int)$firstNew->id;
        $count = count($this->news);

        for($i = 0; $i < $count; $i++){

            $model = new Comment();

            $model->id = null;
            $model->news_id = $firstNewId;
            $model->name = $this->commentNameTemplate;
            $model->text = sprintf("%s №%s", $this->commentTextTemplate, $firstNewId);

            $model->save();
            $firstNewId++;
        }

        return sprintf("%s comments created", $count);
    }

    public function actionAll()
    {

        $result = '';

        $result .= $this->actionCategories() . "<br />";
        $result .= $this->actionNews() . "<br />";
        $result .= $this->actionComments() . "<br />";

        return $this->render('all', [
            'result' => $result,
        ]);
    }
}
