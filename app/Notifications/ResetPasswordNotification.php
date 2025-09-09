<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * The callback that should be used to create the reset password URL.
     *
     * @var \Closure|null
     */
    public static $createUrlCallback;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Create a new notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // Check if SendGrid is configured
        if (config('services.sendgrid.api_key')) {
            return ['sendgrid'];
        }
        
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return $this->buildMailMessage($this->resetUrl($notifiable));
    }

    /**
     * Get the SendGrid representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toSendGrid($notifiable)
    {
        $url = $this->resetUrl($notifiable);
        
        return [
            'from' => [
                'address' => config('mail.from.address', 'noreply@example.com'),
                'name' => config('mail.from.name', config('app.name'))
            ],
            'subject' => 'Password Reset Request - ' . config('app.name'),
            'html' => $this->buildHtmlContent($url),
            'text' => $this->buildTextContent($url)
        ];
    }

    /**
     * Get the reset password URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function resetUrl($notifiable)
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable, $this->token);
        }

        return url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
    }

    /**
     * Build the mail message.
     *
     * @param  string  $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject('Password Reset Request')
            ->greeting('Hello!')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', $url)
            ->line('This password reset link will expire in 60 minutes.')
            ->line('If you did not request a password reset, no further action is required.')
            ->salutation('Regards, ' . config('app.name'));
    }

    /**
     * Build HTML content for the email
     *
     * @param  string  $url
     * @return string
     */
    protected function buildHtmlContent($url)
    {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Password Reset Request</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: #f8f9fa; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
                .content { background: #ffffff; padding: 30px; border: 1px solid #e9ecef; }
                .footer { background: #f8f9fa; padding: 20px; text-align: center; border-radius: 0 0 8px 8px; }
                .btn { display: inline-block; padding: 12px 24px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; margin: 20px 0; }
                .btn:hover { background: #0056b3; }
                .warning { background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 5px; margin: 20px 0; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>' . config('app.name') . '</h1>
                </div>
                <div class="content">
                    <h2>Password Reset Request</h2>
                    <p>Hello!</p>
                    <p>You are receiving this email because we received a password reset request for your account.</p>
                    <p>Click the button below to reset your password:</p>
                    <p style="text-align: center;">
                        <a href="' . $url . '" class="btn">Reset Password</a>
                    </p>
                    <div class="warning">
                        <strong>Important:</strong> This password reset link will expire in 60 minutes.
                    </div>
                    <p>If you did not request a password reset, no further action is required.</p>
                    <p>If the button above doesn\'t work, you can copy and paste this link into your browser:</p>
                    <p style="word-break: break-all; background: #f8f9fa; padding: 10px; border-radius: 3px;">' . $url . '</p>
                </div>
                <div class="footer">
                    <p>Regards,<br>' . config('app.name') . '</p>
                </div>
            </div>
        </body>
        </html>';
    }

    /**
     * Build plain text content for the email
     *
     * @param  string  $url
     * @return string
     */
    protected function buildTextContent($url)
    {
        return "Password Reset Request\n\n" .
               "Hello!\n\n" .
               "You are receiving this email because we received a password reset request for your account.\n\n" .
               "Click the link below to reset your password:\n" .
               $url . "\n\n" .
               "This password reset link will expire in 60 minutes.\n\n" .
               "If you did not request a password reset, no further action is required.\n\n" .
               "Regards,\n" .
               config('app.name');
    }

}