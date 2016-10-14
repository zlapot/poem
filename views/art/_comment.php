<?php 

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$options = 'disabled';



?>


<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'comment')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', $options ]) ?>
    </div>
<?php ActiveForm::end(); ?>


<?php if($comments) foreach ($comments as $comment): ?>
        
        <div class="comment">
            <?= Html::img('/ss/basic/web/img/ava.jpg    ', ['alt' => '...', 'class' => 'comment-img'] );?>
            <?= Html::tag('div', Html::encode($comment['id_user']), ['class'=>'comment-username'])?>
            <?= Html::tag('div', Html::encode($comment['comment']), ['class'=>'comment-text'])?>
            <?= Html::tag('div', Html::encode($comment['date']), ['class'=>'comment-date'])?>
        </div>

<?php endforeach; ?>