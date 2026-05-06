<?php

namespace App\Notifications;

use App\Models\emergencyRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmergencyNotification extends Notification
{
    use Queueable;

    protected $emergencyRequest;

    public function __construct(emergencyRequest $emergencyRequest)
    {
        $this->emergencyRequest = $emergencyRequest;
    }

    public function via($notifiable)
    {
        return ['database']; // أو mail حسب الطريقة اللي تفضلها
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'طلب عاجل جديد',
            'type' => $this->emergencyRequest->type,
            'description' => $this->emergencyRequest->description,
            'location' => $this->emergencyRequest->location,
            'whatsapp' => $this->emergencyRequest->whatsapp,
            'link' => "/emergancyRequest/{$this->emergencyRequest->id}",  // استخدم الـ ID هنا
            'emergency_request_id' => $this->emergencyRequest->id,  // يتم تضمين الـ ID في البيانات

        ];
    }
}
