<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use App\Services\SmsService;

class SmsChannel
{
  protected $smsService;

  public function __construct(SmsService $smsService)
  {
    $this->smsService = $smsService;
  }

  public function send($notifiable, Notification $notification)
  {
    if (!method_exists($notification, 'toSms')) {
      return;
    }

    $phone = $notifiable instanceof \Illuminate\Notifications\AnonymousNotifiable
      ? $notifiable->routes[SmsChannel::class] ?? null
      : $notifiable->routeNotificationFor('sms');

    if (!$phone) {
      \Log::error('SmsChannel: Phone number is null');
      return;
    }

    $message = $notification->toSms($notifiable);

    $this->smsService->send($message, $phone);
  }
}
