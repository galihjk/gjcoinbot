<?php
function handle_callback_query_click_check($botdata){
    $last_click = f("data_load")("last_click_".$botdata["message"]["chat"]["id"],0);
    $delay_click = 3;
    if(abs(time()-$last_click) <= $delay_click){
        f("bot_kirim_perintah")('answerCallbackQuery',[
            'callback_query_id' => $botdata['id'],
            'text' => "Tunggu $delay_click detik untuk setiap klik",
            'show_alert' => true,
        ]);
        return true;
    }
    f("data_save")("last_click_".$botdata["message"]["chat"]["id"],time());
    return false;
}