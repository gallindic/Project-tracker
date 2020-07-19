<?php
    use yii\helpers\Html;
    
?>

<div class="sidebar-menu">
    <div class="sidebar-menu-header">
        <?= Yii::t('app', 'MENI') ?>
    </div>
    <div class="sidebar-menu-body">
        <div class="sidebar-menu-item">
            <?php echo Html::a(Html::encode(Yii::t('app', 'Pregled')), ['site/index'], [
                'class' => 'sidebar-menu-item-link',
            ]) ?>
        </div>
        <div class="sidebar-menu-item">
            <?php echo Html::a(Html::encode(Yii::t('app', 'Dodaj projekt')), ['tom-project/create'], [
                'class' => 'sidebar-menu-item-link',
            ]) ?>
        </div>
    </div>
</div>