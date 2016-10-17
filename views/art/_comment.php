<?php 

use yii\widgets\ActiveForm;
use yii\helpers\Html;

if(Yii::$app->user->isGuest)
    $options = ['disabled' => 'disabled', 'class' => 'btn btn-primary'];
else
     $options = ['class' => 'btn btn-primary'];


?>


<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'comment')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить',  $options ) ?>
    </div>
<?php ActiveForm::end(); ?>

<?php if($comments) foreach ($comments as $comment): ?>
        
        <div class="comment">
            <div class="comment-img">
                <?= Html::img('/poem/web/img/ava.jpg    ', ['alt' => '...'] );?>
            </div>
            <div class="comment-body">
                <div class="comment-title">
                    <?= Html::tag('div',"<span>Написал: </span>". Html::encode($comment['username']), ['class'=>'comment-username'])?>
                    <?= Html::tag('div', "<span>Дата: </span>". Html::encode($comment['date']), ['class'=>'comment-date'])?>
                </div>
                <?= Html::tag('div', Html::encode($comment['comment']), ['class'=>'comment-text'])?>
            </div>
            
        </div>

<?php endforeach; ?>