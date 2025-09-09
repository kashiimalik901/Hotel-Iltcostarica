# SendGrid Setup Guide

## 1. Get SendGrid API Key

1. Go to [SendGrid](https://app.sendgrid.com/)
2. Sign up or log in to your account
3. Navigate to Settings > API Keys
4. Create a new API key with "Full Access" permissions
5. Copy the API key (you won't be able to see it again)

## 2. Environment Configuration

Add these variables to your `.env` file:

```env
# SendGrid Configuration
SENDGRID_API_KEY=your_sendgrid_api_key_here

# Mail Configuration
MAIL_MAILER=sendgrid
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

## 3. Alternative SMTP Configuration

If you prefer to use SendGrid's SMTP instead of the API:

```env
# SendGrid SMTP Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your_sendgrid_api_key_here
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

## 4. Domain Authentication (Recommended)

For better deliverability:

1. Go to Settings > Sender Authentication
2. Authenticate your domain
3. Add the required DNS records
4. Verify your domain

## 5. Testing

Test the password reset functionality:

1. Go to the forgot password page
2. Enter a valid email address
3. Check the logs for SendGrid status
4. Check the email inbox

## 6. Troubleshooting

### Common Issues:

1. **API Key Invalid**: Make sure your API key is correct and has proper permissions
2. **Domain Not Verified**: Verify your sending domain in SendGrid
3. **Rate Limits**: Check SendGrid dashboard for rate limit issues
4. **Spam Folder**: Check if emails are going to spam

### Logs:

Check Laravel logs for SendGrid status:
```bash
tail -f storage/logs/laravel.log
```

### Fallback:

The system will automatically fall back to Laravel's default mail system if SendGrid fails.
