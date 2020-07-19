<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(['action' => ['tom-report/create']]); ?>

    <?= $form->field($model, 'name')->label(Yii::t('app', 'Ime poročila')) ?>
    <?= $form->field($model, 'task_id')->hiddenInput()->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Dodaj'), ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>