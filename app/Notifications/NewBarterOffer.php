<?php

namespace App\Notifications;

use App\Models\Barter; // <-- Penting
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBarterOffer extends Notification
{
    use Queueable;

    protected $barter;

    /**
     * Create a new notification instance.
     */
    public function __construct(Barter $barter) // <-- Diubah untuk menerima data barter
    {
        $this->barter = $barter;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database']; // Diubah dari ['mail'] menjadi ['database']
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'barter_id' => $this->barter->id,
            'offerer_name' => $this->barter->offeredItem->user->name,
            'offered_item_name' => $this->barter->offeredItem->name,
            'requested_item_name' => $this->barter->requestedItem->name,
        ];
    }
}