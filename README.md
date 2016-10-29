# Twilio Proxy
Using the [Twilio API](https://www.twilio.com/docs/api/rest/sending-messages)
to forward messages to multiple users at once

### Instructions
1. [Install Composer](https://getcomposer.org/download/) if it isn't already.
2. `php composer.phar require twilio/sdk`
3. Create `config.json` and configure it based on the `config_example.json`.
    - Phone numbers should be formatted [correctly](https://www.twilio.com/docs/api/rest/sending-messages#post-parameters) to ensure
    messages are forwarded correctly.
    - Twilio information can be found on the [Console](https://www.twilio.com/console).
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
4. Configure the desired phone number to utilize the proxy webhook by clicking
the desired [phone number](https://www.twilio.com/console/phone-numbers/incoming).
    1. In the "Messaging" section, locate the "Configure with" dropdown and choose `Webhooks/TwiML`
    2. Locate the "Message comes in" dropdown and choose `Webhook`.
    3. In the "Message comes in" input, enter the URL for with this script
    and select `HTTP POST` from the dropdown to the right.
    4. Save the configuration.

### Overview
When the Twilio number you configured receives an SMS message, it will send
a POST request to the Webhook URL containing the message.

The request also contains the AccountSid which is compared with the sid in the
config file to confirm the request is from an authorized source. If this does
not match, no message is sent.

Messages are rate limited to 1 per second.