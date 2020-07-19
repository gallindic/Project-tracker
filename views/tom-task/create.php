<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(['action' => ['tom-task/create']]); ?>

    <?= $form->field($model, 'name')->label(false) ?>
    <?= $form->field($model, 'project_id')->hiddenInput(['value' => $project_id])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Dodaj'), ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>