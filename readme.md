## Instruction
1. Add .env file like .env.example
- change DB connections to empty DB
- set `MAIL_USERNAME` and `MAIL_PASSWORD`, `MAIL_FROM_ADDRESS`, `MAIL_CONTACT_EMAIL` - email where will be sent contact form
- set `GOOGLE_RECAPTCHA_KEY` if you use a different domain, not this one `huh-site.loc`

2. run:
 - `php artisan migrate`
 - `php artisan db:seed`
 - `npm run development`

## Admin side:
run the command:
 - `php artisan create:admin admin 123123`

##### Login
got to the page `http://domain/admin` (`http://huh-site.loc/admin`)

user: `admin@admin.com`
password: `123123`

In the tab `Languages` you can add new Language, removes it, and edit exists translations.