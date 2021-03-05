<?php
return [
    'adminEmail' => 'info@nays.ru',
    'supportEmail' => 'info@nays.ru',
    'senderEmail' => 'info@nays.ru',
    'senderName' => 'Nays.ru',
    'user.passwordResetTokenExpire' => 3600,

    'retail' => [
        'address' => 'https://fishmen.retailcrm.ru',
        'key' => 'XzyNfS7yG3usu1ESCZy7l0nTAWl7qI15',
    ],

    'from' => [
        'email' => 'info@fishmen.ru',
        'name' => 'Фишмен интернет-магазин',
    ],

    'emails' => [
        //основное
        'to' => 'info@fishmen.ru',
        // копия
        'cc' => null,
        //скрытая копия
        'bcc' => [
            //'klaxwork.dn@gmail.com',
            'klaxwork@yandex.ru',
            //'klaxwork@mail.ru',
            'denis@nays.ru',
        ],
        //кому отвечать
        'ReplyTo' => 'info@fishmen.ru',
    ],

];
