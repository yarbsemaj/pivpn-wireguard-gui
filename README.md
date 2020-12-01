# PiVPN Wiregaurd GUI 
###### A simple (unofficial) GUI for PiVPN.  
![Image of WireGarurd VPN Home](https://user-images.githubusercontent.com/17494632/100800240-37841b80-341e-11eb-9cdb-b5456f4ede2b.png)
Add, revoke and download Wiregaurd vpn profiles with QR Code support.
## Setup
 1. `composer install`
 2. `cp .env.example .env`
 3. Set `APP_KEY` to a random string.
 4. `cp ./storage/app/users/users.json.example ./storage/app/users/users.json`
 5. Setup a user with a username and password **I strongly use of a UUID as a password**
 6. Serve `./public`
