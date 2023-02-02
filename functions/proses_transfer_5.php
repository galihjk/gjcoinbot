<?php
function proses_transfer_5($botdata){
    $admacctfdata = explode("_",$botdata["data"]);
    f("bot_kirim_perintah")('answerCallbackQuery',[
        'callback_query_id' => $botdata['id'],
    ]);
    $chat_id = $botdata["message"]["chat"]["id"];
    f("bot_kirim_perintah")("editMessageText",[
        "chat_id"=>$chat_id,
        "text"=>"✅ Disetujui\n".$botdata["from"]["id"]." (".date("Y-m-d H:i:s").")\n\n".$botdata["message"]["text"],
        "message_id"=>$botdata["message"]["message_id"],
    ]);
    $dari_id = $admacctfdata[1];
    $dari_userdata = f("get_user")($dari_id);
    $dari_nama = $dari_userdata["first_name"] ?? "";
    $untuk_id = $admacctfdata[2];
    $untuk_userdata = f("get_user")($untuk_id);
    $untuk_nama = $untuk_userdata["first_name"] ?? "";
    $nominal = $admacctfdata[3];
    $nominal_txt = number_format($nominal);
    $textsend = "<b>PROSES TRANSFER</b>\n✅ BERHASIL!\n";
    $textsend .= "Dari: [$dari_id]\n($dari_nama)\n";
    $textsend .= "Tujuan: [$untuk_id]\n($untuk_nama)\n";
    $textsend .= "Nominal: [$nominal]\n";
    $textsend .= "Waktu: [".date("Y-m-d H:i:s")."]\n";
    f("bot_kirim_perintah")("editMessageText",[
        "chat_id"=>$admacctfdata[4],
        "text"=>$textsend,
        "message_id"=>$admacctfdata[5],
        "parse_mode"=>"HTML",
    ]);
}