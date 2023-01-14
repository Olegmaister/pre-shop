<?php

namespace common\core;

use Yii;

/**
 * @property-read \yii2custom\common\components\Dev $dev
 * @property-read \common\components\GGAComponent $gga
 * @property-read \common\components\BillingComponent $billing
 * @property-read \common\components\TelegramComponent $telegram
 * @property-read \common\components\MailTrackerComponent $mailTracker
 * @property-read \common\components\MediaComponent $media
 * @property-read \common\components\NotificationComponent $notification
 * @property-read \common\components\ReportComponent $report
 * @property-read \yii2custom\common\core\Formatter $formatter
 * @property-read \yii\queue\redis\Queue $queue
 * @property-read \yii\queue\redis\Queue $reportQueue
 * @property-read \yii\queue\redis\Queue $mailQueue
 * @property-read User $user
 */
class Application extends \yii2custom\common\core\Application
{
}