<?php

namespace shop\services\contacts;

use Yii;
use shop\Forms\ContactForm;

class ContactService
{
    public function send(ContactForm $form) : void
    {
        $result =  Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['adminEmail'])
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$form->email => $form->name])
            ->setSubject($form->subject)
            ->setTextBody($form->body)
            ->send();

        if(!$result){
            throw new \DomainException('Sending error.');
        }
    }
}