<?php

$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = 'News';
?>

<?php if(count($news)): ?>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>News</strong></div>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>CATEGORY</th>
                <th>TITLE</th>
                <th>TEXT</th>
                <th>EDIT</th>
                <th>REMOVE</th>
            </tr>
            <?php foreach($news as $new): ?>
                <tr>
                    <td><?= $new['id'] ?></td>
                    <td><?= $new['category_id'] ?></td>
                    <td><?= $new['title'] ?></td>
                    <td><?= $new['text'] ?></td>
                    <td><a href="#"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
                    <td><a href="#"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

<?php endif; ?>

