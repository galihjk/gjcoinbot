<?php
function handle_message_others($botdata){
    $from_id = $botdata["from"]["id"];
    $chat_id = $botdata["chat"]["id"];
    $data_user = f("get_user")($from_id);
    $first_name = $data_user["first_name"];
    $coin = $data_user['coin'] ?? 0;
    $coin_txt = number_format($coin);
    f("bot_kirim_perintah")("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>
            "<b>$first_name</b>\n"
            ."ID: <pre>$from_id</pre>\n"
            ."COIN: $coin_txt\n"
            ."/transfer"
        ,
        "parse_mode"=>"HTML",
    ]);
    return true;
}