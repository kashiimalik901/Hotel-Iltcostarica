<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use SendGrid;
use SendGrid\Mail\Mail;
use Exception;
use Illuminate\Support\Facades\Log;

class SendGridChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if (!method_exists($notification, 'toSendGrid')) {
            throw new \InvalidArgumentException('Notification must implement toSendGrid method');
        }

        $message = $notification->toSendGrid($notifiable);
        
        if (!$message) {
            return;
        }

        try {
            $apiKey = config('services.sendgrid.api_key');
            
            if (!$apiKey) {
                Log::warning('SendGrid API key not configured');
                return;
            }

            $email = new Mail();
            $email->setFrom(
                $message['from']['address'],
                $message['from']['name']
            );
            
            $email->addTo($notifiable->getEmailForPasswordReset());
            $email->setSubject($message['subject']);
            
            // Add HTML content
            if (isset($message['html'])) {
                $email->addContent("text/html", $message['html']);
            }
            
            // Add plain text content
            if (isset($message['text'])) {
                $email->addContent("text/plain", $message['text']);
            }

            $sendgrid = new SendGrid($apiKey);
            $response = $sendgrid->send($email);
            
            if ($response->statusCode() >= 200 && $response->statusCode() < 300) {
                Log::info('Password reset email sent successfully via SendGrid');
            } else {
                Log::error('SendGrid email failed', [
                    'status_code' => $response->statusCode(),
                    'body' => $response->body()
                ]);
            }
        } catch (Exception $e) {
            Log::error('SendGrid email exception: ' . $e->getMessage());
        }
    }
}
