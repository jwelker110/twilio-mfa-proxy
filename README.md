# Twilio Proxy
Using the [Twilio API](https://www.twilio.com/docs/api/rest/sending-messages)
to forward messages to multiple users at once

### Instructions
1. [Install Composer](https://getcomposer.org/download/) if it isn't already. Paste the following
    lines in terminal.
    
    ```
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('SHA384', 'composer-setup.php') === 'e115a8dc7871f15d853148a7fbac7da27d6c0030b848d9b3dc09e2a0388afed865e6a3d6b3c0fad45c48e2b5fc1196ae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
    ```
    
2. Paste `php composer.phar install` in terminal to install the required Twilio library.
3. Create `config.json` and configure it based on the `config_example.json`.
    - Phone numbers should be formatted [correctly](https://www.twilio.com/docs/api/rest/sending-messages#post-parameters) to ensure
    messages are forwarded correctly. (Include the country code)
    - Twilio information can be found on the [Console](https://www.twilio.com/console).
    ```
    {
        "contacts": {
            "John": "+12223334444",
            "Jane": "+12223334444"
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
