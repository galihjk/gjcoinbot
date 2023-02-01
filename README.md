# gjcoinbot

...

CREATE TABLE `users` (
  `id` varchar(100) NOT NULL,
  `first_name` text DEFAULT NULL,
  `last_name` text DEFAULT NULL,
  `username` text DEFAULT NULL,
  `coin` int(11) DEFAULT NULL,
  `banned` tinyint(1) NOT NULL,
  `bot_active` datetime DEFAULT NULL
  , PRIMARY KEY (`id`)
)

config.php
<?php
return [
    'bot_token'=>'',
    'botuname'=>'',
    'webhook'=>'/???/webhook_5b56fe073bc03c84eaecabfc6f43a75d.php',
    'bot_admins'=>[
        '227024160',
    ],
    
    'db_database'=>'',
    'db_user'=>'',
    'db_password'=>'',
    
    'admin_chat_id'=>'',
    
];