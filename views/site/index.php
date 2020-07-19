<?php

/* @var $this yii\web\View */
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use app\helpers\GlobalHelper;
use yii\helpers\Url;

$this->title = 'Project tracker';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row page-container">
            <div class="col-lg-4">
                <?= $this->render( '/partials/_sidebar' ); ?>
            </div>
            <div class="col-lg-4">
                <div class="projects-list">
                    <?php foreach($projects as $project): ?>
                        <?= $this->render('/partials/_project-list.php', ['project' => $project]); ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-4">
             </div>
        </div>
    </div>
</div>
