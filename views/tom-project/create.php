<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Project tracker';
?>

<div class="site-index">
    <div class="body-content">
        <div class="row page-container">
            <div class="col-lg-4">
                <?= $this->render( '/partials/_sidebar' ); ?>
            </div>
            <div class="col-lg-4">
                <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'name')->label(Yii::t('app', 'Ime projekta')) ?>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Dodaj'), ['class' => 'btn btn-primary']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-lg-4">
                
             </div>
        </div>
    </div>
</div>