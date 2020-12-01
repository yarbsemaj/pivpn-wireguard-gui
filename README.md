# PiVPN WireGuard GUI 
###### A simple (unofficial) GUI for PiVPN.  
![Image of WireGuard VPN Home](https://user-images.githubusercontent.com/17494632/100802791-f0982500-3421-11eb-9060-682388e63c3c.png)
Add, revoke and download WireGuard vpn profiles with QR Code support.
## Setup
 1. `composer install`
 2. `cp .env.example .env`
 3. Set `APP_KEY` to a random string.
 4. `cp ./storage/app/users/users.json.example ./storage/app/users/users.json`
 5. Setup a user with a username and password **I strongly use of a UUID as a password**
 6. Serve `./public`
 
 ## Extend
 New drivers can be added by implementing the `VPNDriver.php` interface. 
