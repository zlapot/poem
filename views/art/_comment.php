<?php 


use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;    
use app\models\User;

if(Yii::$app->user->isGuest)
    $options = ['disabled' => 'disabled', 'class' => 'btn btn-primary'];
else
    $options = ['class' => 'btn btn-primary', 'id' => 'commentBtn'];

$optionsBtn =['id' => 'btn-comment', 'class' => 'btn btn-default btn-lg center-block' ];
if($count['current'] == $count['all'])
    $optionsBtn =['id' => 'btn-comment', 'class' => 'btn btn-default btn-lg center-block', 'disabled' => 'disabled'];
?>




<?php $form = ActiveForm::begin([
    'id' => 'comment-form', 
    'options' => ['data-id' => $id_post],
    ]); ?>

    <?= $form->field($model, 'idpost')->hiddenInput(['value'=> $id_post])->label(false) ?>
    <?= $form->field($model, 'comment')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить',  $options ) ?>
    </div>
<?php ActiveForm::end(); ?>

<div class="msg"></div>
<div id='insert'></div>


<?php if($comments) foreach ($comments as $comment): ?>
        
        <?php echo '<article class="comment" id="'.$comment['id'].'">'; ?>
            <header>
                <div class="comment-img">
                    <?php 
                        $img = $comment['img'];
                        if(!isset($img)) $img = 'img/ava.jpg';
                    ?>
                    <?= Html::img(Url::home().$img, ['alt' => '...'] );?>
                </div>
            </header>
            <div class="comment-body">
                <div class="comment-title">
                    <?= Html::tag('div',"<span>Написал: </span>". Html::encode($comment['username']), ['class'=>'comment-username'])?>
                    <?= Html::tag('div', "<span>Дата: </span>". Html::encode($comment['date']), ['class'=>'comment-date'])?>
                    <?= Html::button('X', ['class' => 'daeleteBtn', 'data-id' => $comment['id'], ]) ?>
                </div>
                <?= Html::tag('div', Html::encode($comment['comment']), ['class'=>'comment-text'])?>
            </div>
            
        </article>

<?php endforeach; ?>


<?= Html::tag('div',
        Html::button('<span class="current">'.$count['current'].'</span> из <span class="count-all">'.$count['all'].'</span> комметариев', $optionsBtn ),
    ['id' => 'insertComment'])
?>

