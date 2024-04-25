<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class SubscriptionNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $subscriptionType;

    public function __construct($user, $subscriptionType)
    {
        $this->user = $user;
        $this->subscriptionType = $subscriptionType;
    }

    public function via($notifiable)
    {
        return ['mail']; // Уведомление будет отправлено по электронной почте
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Уведомление о подписке')
            ->from('sasha_kushneruk@mail.ru', 'Отправитель')
            ->greeting('Уважаемый ' . $this->user->name . ',')
            ->line('Благодарим вас за выбор нашей информационной системы для чтения книг! Мы рады сообщить вам, что ваш запрос на приобретение подписки успешно обработан.')
            ->line('Детали подписки:')
            ->line('Срок действия: ' . $this->subscriptionType->duration)
            ->line('Цена: ' . $this->subscriptionType->price)
            ->line('Ваша подписка дает вам возможность:')
            ->line('- Читать платные книги нашей коллекции.')
            ->line('- Получать доступ к эксклюзивным материалам и событиям.')
            ->line('Способы оплаты: ' . $this->subscriptionType->payment_methods)
            ->line('Мы ценим ваш выбор нашей платформы и надеемся, что ваше чтение станет еще более удобным и захватывающим с нашей подпиской.')
            ->line('Если у вас возникнут вопросы или вам потребуется дополнительная информация, не стесняйтесь обращаться к нашей службе поддержки по адресу [контактная информация службы поддержки].')
            ->line('Благодарим вас за вашу поддержку!')
            ->salutation('С наилучшими пожеланиями,')
            ->salutation('[Ваше имя] [Ваша должность] [Контактная информация]');
    }

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
