<?php

/**
 * 半角数字を判定
 * @param $str
 * @return bool
 */
function is_number($str){
    if ( preg_match("/^[0-9]+$/",$str) ){
        return true;
    }
    return false;
}

/**
 * 半角英字を判定
 * @param $str
 * @return bool
 */
function is_alphabet($str){
    if ( preg_match("/^[a-zA-Z]+$/",$str) ){
        return true;
    }
    return false;
}

/**
 * 半角英数字を判定
 * @param $str
 * @return bool
 */
function is_alnum($str){
    if ( preg_match("/^[a-zA-Z0-9]+$/",$str) ){
        return true;
    }
    return false;
}

/**
 * 半角英数記号を判定
 * @param $str
 * @return bool
 */
function is_alnumsymbol($str){
    if ( preg_match("/^[!-~]+$/",$str) ){
        return true;
    }
    return false;
}

/**
 * 全角ひらがなを判定
 * @param $str
 * @return bool
 */
function is_hiragana($str){
    if ( preg_match("/^[ぁ-ん]+$/",$str) ){
        return true;
    }
    return false;
}

/**
 * 全角カタカナを判定
 * @param $str
 * @return bool
 */
function is_katakana($str){
    if ( preg_match("/^([ァ-ン]|ー)+$/",$str) ){
        return true;
    }
    return false;
}

/**
 * 半角カタカナを判定
 * @param $str
 * @return bool
 */
function is_hankaku_katakana($str){
    if ( preg_match("/^[ｦ-ﾟ]+$/",$str) ){
        return true;
    }
    return false;
}

/**
 * 全角ひらがな、カタカナを判定
 * @param $str
 * @return bool
 */
function is_kana($str){
    if ( preg_match("/^[ぁ-んァ-ン]+$/",$str) ){
        return true;
    }
    return false;
}

/**
 * RPC違反のキャリアメールアドレスも含めて簡易的にメールアドレスをチェック
 * 以下のＨＴＭＬ５ input[type=email] の仕様に準じる
 * https://html.spec.whatwg.org/multipage/input.html#valid-e-mail-address
 * （現在はマルチバイトのメールアドレスもあり得るが、意図的に除外している）
 * @param $str
 * @return bool
 */
function is_email($str){
    $pattern = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@";
    $pattern .= "[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";
    if ( preg_match($pattern,$str) ){
        return true;
    }
    return false;
}


/****************
 * 文字列コンバート
 ****************/
/**
 * 全角スペースが入っていても変換してtrim
 * @param $str
 * @return string
 */
function trim2($str){
    return trim(mb_convert_kana($str, "s", 'UTF-8'));
}

/**
 * 半角カナを全角カナに変換（濁音・半濁音も一文字に変換）
 * @param $str
 * @return string
 */
function convert_katakana($str){
    return mb_convert_kana($str, "KV");
}

/**
 * 全角英数字を半角に変換
 * @param $str
 * @return string
 */
function convert_alnum($str){
    return mb_convert_kana($str, "a");
}

/**
 * 全角英数字を半角に変換
 * @param $str
 * @return string
 */
function convert_number($str){
    return mb_convert_kana($str, "n");
}

