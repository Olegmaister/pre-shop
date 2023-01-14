<?php

namespace frontend\controllers;
use shop\Services\Users\AuthService;
use Yii;
use shop\Forms\Users\LoginForm;
use yii\web\Controller;

class AuthController extends Controller
{
    private $service;

    public function __construct(
        $id,
        $module,
        AuthService $service,
        $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new LoginForm();
        if ($form->load(Yii::$app->request->post())&& $form->validate()) {
            try {
                $user = $this->service->auth($form);
                Yii::$app->user->login($user,3600 * 24 * 30);
            }catch (\DomainException $e){
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
            return $this->refresh();
        }

        return $this->render('login', [
            'model' => $form,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}