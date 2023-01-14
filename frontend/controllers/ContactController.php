<?php

namespace frontend\controllers;

use Yii;
use shop\Forms\ContactForm;
use shop\Services\Contacts\ContactService;
use yii\web\Controller;

class ContactController extends Controller
{
    private $service;

    public function __construct(
        $id,
        $module,
        ContactService $service,
        $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionContact()
    {
        $form = new ContactForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->send($form);
                Yii::$app->session->setFlash('success', 'Thank you.');
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

            return $this->goHome();
        }

        return $this->render('contact', [
            'model' => $form,
        ]);
    }
}
