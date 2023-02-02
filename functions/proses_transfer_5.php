<?php
function proses_transfer_5($botdata){
    $admacctfdata = explode("_",$botdata["data"]);
    f("bot_kirim_perintah")('answerCallbackQuery',[
        'callback_query_id' => $botdata['id'],
        'text' => "under5".print_r($admacctfdata,true),
        'show_alert' => true,
    ]);
}