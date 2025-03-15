<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Brevo\Client;
use Brevo\Api\TransactionalEmailsApi;
use Illuminate\Mail\Transport\Transport;
use Swift_Mime_SimpleMessage;
use Exception;

class BrevoTransport extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        dd('BrevoTransport constructor is called.'); // For debugging
        // Create a Brevo client using the API key
        $this->client = new TransactionalEmailsApi(
            new Client([
                'apiKey' => $apiKey
            ])
        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.name');
    }

    /**
     * Send the email.
     *
     * @param  Swift_Mime_SimpleMessage  $message
     * @param  array|null  $failedRecipients
     * @return void
     */
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        // Prepare the email data for Brevo API
        $emailData = [
            'sender' => [
                'email' => key($message->getFrom()), 
                'name' => current($message->getFrom())
            ],
            'to' => array_map(function ($email, $name) {
                return ['email' => $email, 'name' => $name];
            }, array_keys($message->getTo()), $message->getTo()),
            'subject' => $message->getSubject(),
            'htmlContent' => $message->getBody(),
            'textContent' => strip_tags($message->getBody())
        ];

        // Attempt to send the email via Brevo API
        try {
            $this->client->sendTransacEmail($emailData);
        } catch (\Exception $e) {
            // If sending fails, push the recipient into the $failedRecipients array
            if ($failedRecipients !== null) {
                $failedRecipients[] = $message->getTo();
            }
            throw new \Exception("Error sending email via Brevo: " . $e->getMessage());
        }
    }
}
