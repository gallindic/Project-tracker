<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->label(Yii::t('app', 'Ime projekta')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Dodaj'), ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

