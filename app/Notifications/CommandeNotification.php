<?php
// filepath: /app/Notifications/CommandeNotification.php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommandeNotification extends Notification
{
    use Queueable;

    private $commande;

    public function __construct($commande)
    {
        $this->commande = $commande;
    }

    public function via($notifiable)
    {
        // Envoyer la notification immédiatement sans passer par la file d'attente
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'commande_id' => $this->commande->id,
            'message' => 'Votre commande a été mise à jour.',
        ];
    }
}
