<?php

$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['/admin']];
$this->params['breadcrumbs']['Admin'] = 'Category';
?>

<?php if(count($categories)): ?>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Categories</strong></div>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>PARENT_ID</th>
                <th>NAME</th>
                <th>EDIT</th>
                <th>REMOVE</th>
            </tr>
            <?php foreach($categories as $category): ?>
                <tr>
                    <td><?= $category['id'] ?></td>
                    <td><?= $category['parent_id'] ? $category['parent_id'] : 'NULL' ?></td>
                    <td><?= $category['name'] ?></td>
                    <td><a href="#"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
                    <td><a href="#"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

<?php endif; ?>
