<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTaskNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $task;
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['mail'];
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->subject('Ada Task Baru')
                ->greeting('Hello! ' . $notifiable->first_name)
                ->line('Ada Tugas Baru dengan nama : '. $this->task->title. ', Deadline '.$this->task->deadline)
                // ->action('View Detail', url('tasks/detail/'.$this->task->id))
                ->action('View Detail', route('detail-notification', $this->id))
                ->line('Thanks')
                ->salutation('Regards,')
                ->salutation('Raveloux Surabaya');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'text_title' => 'Ada Task Baru',
            'messages' => 'Ada task baru dg nama'. $this->task->title,
            'route' => 'tasks/detail/'.$this->task->id,
        ];
    }
}
