<?php 
use yii\helpers\Url;
use yii\helpers\Html;
?>

<div class="admin-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>

    <?= Html::a('Пользователи', Url::to(['/admin/user']), ['class' => 'btn btn-default', 'role' => 'button']) ?>
    <?= Html::a('Стихи', Url::to(['/admin/poems']), ['class' => 'btn btn-default', 'role' => 'button']) ?>
    <?= Html::a('Анекдоты', Url::to(['/admin/anekdots']), ['class' => 'btn btn-default', 'role' => 'button']) ?>
    <?= Html::a('Хокку', Url::to(['/admin/hokkys']), ['class' => 'btn btn-default', 'role' => 'button']) ?>
    <?= Html::a('Комментарии к стихам', Url::to(['/admin/comments-poem']), ['class' => 'btn btn-default', 'role' => 'button']) ?>
    <?= Html::a('Комментарии к анекдотам', Url::to(['/admin/comments-anekdot']), ['class' => 'btn btn-default', 'role' => 'button']) ?>
    <?= Html::a('Комментарии к хокку', Url::to(['/admin/comments-hokky']), ['class' => 'btn btn-default', 'role' => 'button']) ?>
</div>
