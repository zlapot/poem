<?php 
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\RegForm;
use app\models\User;
use app\models\SendEmailForm;
use app\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\AccountActivation;
use app\models\ChangePasswordForm;
use app\models\UploadForm;
use yii\web\UploadedFile;

class UserController extends Controller
{


    public function actionReg()
    {
        $emailActivation = Yii::$app->params['emailActivation'];
        $model = $emailActivation ? new RegForm(['scenario' => 'emailActivation']) : new RegForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()):
            if ($user = $model->reg()):
                if ($user->status === User::STATUS_ACTIVE):
                    if (Yii::$app->getUser()->login($user)):
                        return $this->goHome();
                    endif;
                else:
                    if($model->sendActivationEmail($user)):
                        Yii::$app->session->setFlash('success', 'Письмо с активацией отправлено на емайл <strong>'.Html::encode($user->email).'</strong> (проверьте папку спам).');
                    else:
                        Yii::$app->session->setFlash('error', 'Ошибка. Письмо не отправлено.');
                        Yii::error('Ошибка отправки письма.');
                    endif;
                    return $this->refresh();
                endif;
            else:
                Yii::$app->session->setFlash('error', 'Возникла ошибка при регистрации.');
                Yii::error('Ошибка при регистрации');
                return $this->refresh();
            endif;
        endif;
        return $this->render(
            'reg',
            [
                'model' => $model
            ]
        );
    }


    public function actionActivateAccount($key)
    {
        try {
            $user = new AccountActivation($key);
        }
        catch(InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if($user->activateAccount()):
            Yii::$app->session->setFlash('success', 'Активация прошла успешно. <strong>'.Html::encode($user->username).'</strong> вы теперь с phpNT!!!');
        else:
            Yii::$app->session->setFlash('error', 'Ошибка активации.');
            Yii::error('Ошибка при активации.');
        endif;
        return $this->redirect(Url::to(['/main/login']));
    }



    public function actionSendEmail()
    {        
        $model = new SendEmailForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if($model->sendEmail()):
                    Yii::$app->getSession()->setFlash('warning', 'Проверьте емайл.');
                    return $this->goHome();
                else:
                    Yii::$app->getSession()->setFlash('error', 'Нельзя сбросить пароль.');
                endif;
            }
        }

        return $this->render('sendEmail', [
            'model' => $model,
        ]);
    }

    public function actionSendEmailAjax()
    {        
        $model = new SendEmailForm();
        if ((Yii::$app->request->post())) {
                $post = Yii::$app->request->post('SendEmailForm');
                $model->email = $post['email'];            
                if($model->sendEmail()):
                    echo "Проверьте свой электронный ящик";
                else:
                    echo "Что-то пошло не так";
                endif;
            
        }else{
            echo "Кого вы пытаетесь обмануть?";
        }
    }



    public function actionResetPassword($key)
    {
        try {
            $model = new ResetPasswordForm($key);
        }
        catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->resetPassword()) {
                Yii::$app->getSession()->setFlash('warning', 'Пароль изменен.');
                return $this->redirect(['/main/login']);
            }
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionProfile(){

        $changePassword = new ChangePasswordForm();
        $load = new UploadForm();

        if ($changePassword->load(Yii::$app->request->post()) && $changePassword->validate())
        {
            $$change = $changePassword->cahangePassword();
            if (!$change)
            {
                Yii::$app->session->setFlash('error', 'Ошибка при валидации');
                Yii::error('Ошибка при валидации');
                return $this->goHome();
            }
        }

        if (Yii::$app->request->isPost)
        {
            $load->imageFile = UploadedFile::getInstance($load, 'imageFile');
           
            if (!$load->upload())
            {
                Yii::$app->session->setFlash('error', 'Ошибка при валидации');
                Yii::error('Ошибка при валидации');
                return $this->goHome();
            }
        }

        return $this->render('profile', [
            'password' => $changePassword,
            'load' =>$load,
        ]);
    }



}