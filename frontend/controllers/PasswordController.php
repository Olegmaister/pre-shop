<?php

namespace frontend\controllers;

use shop\Services\Users\PasswordResetService;
use Yii;
use shop\Forms\Users\PasswordResetRequestForm;
use shop\Forms\Users\ResetPasswordForm;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class PasswordController extends Controller
{
    private $service;

    public function __construct(
        $id,
        $module,
        PasswordResetService $service,
        $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequest()
    {
        $form = new PasswordResetRequestForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->request($form);
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', 'Sorry......');
            }

            return $this->goHome();
        }

        return $this->render('request', [
            'model' => $form,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionPassword($token)
    {
        try {
            $user = $this->service->checkToken($token);
            $form = new ResetPasswordForm();
        } catch (InvalidArgumentException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->resetPassword($user,$form);
                Yii::$app->session->setFlash('success', 'New password saved.');
            }catch (\DomainException $e){
                Yii::$app->session->setFlash('success', $e->getMessage());
            }

            return $this->goHome();
        }

        return $this->render('reset', [
            'model' => $form,
        ]);
    }
}