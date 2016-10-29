# Twilio Proxy
Using the [Twilio API](https://www.twilio.com/docs/api/rest/sending-messages)
to forward messages to multiple users at once

### Instructions
1. [Install Composer](https://getcomposer.org/download/) if it isn't already.
2. `php composer.phar require twilio/sdk`
3. Create `config.json` and configure it based on the `config_example.json`.
```
{
    "contacts": {
        "John": "ContactPhoneNumber",
        "Jane": "ContactPhoneNumber"
    },
    "from": "TwilioPhoneNumber",
    "token": "TwilioAuthToken",
    "sid": "TwilioSID"
}
```
- Twilio information can be found on the [Active Phone Numbers](https://www.twilio.com/console/phone-numbers/incoming)
Dashboard.
- Phone numbers should be formatted [correctly](https://www.twilio.com/docs/api/rest/sending-messages#post-parameters) to ensure
messages are forwarded correctly.
