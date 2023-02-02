<?php
function proses_transfer_noacc($botdata){
    $admacctfdata = explode("_",$botdata["data"]);
    f("bot_kirim_perintah")('answerCallbackQuery',[
        'callback_query_id' => $botdata['id'],
    ]);
    $chat_id = $botdata["message"]["chat"]["id"];
    f("bot_kirim_perintah")("editMessageText",[
        "chat_id"=>$chat_id,
        "text"=>"❌Tidak disetujui\n".$botdata["from"]["id"]." (".date("Y-m-d H:i:s").")\n\n".$botdata["message"]["text"],
        "message_id"=>$botdata["message"]["message_id"],
    ]);
    $textsend = "❌Tidak disetujui!";
    f("bot_kirim_perintah")("sendMessage",[
        "chat_id"=>$admacctfdata[1],
        "text"=>$textsend,
        "parse_mode"=>"HTML",
        "reply_to_message_id"=>$admacctfdata[2],
    ]);
}