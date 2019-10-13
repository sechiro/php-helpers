<?php

/**
 * 半角数字を判定
 * @param string $str
 * @return bool
 */
function is_number(string $str){
    if ( preg_match("/^[0-9]+$/",$str) ){
        return true;
    }
    return false;
}

/**
 * 半角英字を判定
 * @param string $str
 * @return bool
 */
function is_alphabet(string $str){
    if ( preg_match("/^[a-zA-Z]+$/",$str) ){
        return true;
    }
    return false;
}

/**
 * 半角英数字を判定
 * @param string $str
 * @return bool
 */
function is_alnum(string $str){
    if ( preg_match("/^[a-zA-Z0-9]+$/",$str) ){
        return true;
    }
    return false;
}

/**
 * 半角英数記号を判定
 * @param string $str
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
 * @param string $str
 * @return bool
 */
function is_hiragana(string $str){
    if ( preg_match("/^[ぁ-ん]+$/u",$str) ){
        return true;
    }
    return false;
}

/**
 * 全角カタカナを判定
 * @param string $str
 * @return bool
 */
function is_katakana(string $str){
    if ( preg_match("/^([ァ-ン]|ー)+$/u",$str) ){
        return true;
    }
    return false;
}

/**
 * 半角カタカナを判定
 * @param string $str
 * @return bool
 */
function is_hankaku_katakana(string $str){
    if ( preg_match("/^[ｦ-ﾟ]+$/",$str) ){
        return true;
    }
    return false;
}

/**
 * 全角ひらがな、カタカナを判定
 * @param string $str
 * @return bool
 */
function is_kana(string $str){
    if ( preg_match("/^[ぁ-んァ-ン]+$/u",$str) ){
        return true;
    }
    return false;
}

/**
 * RPC違反のキャリアメールアドレスも含めて簡易的にメールアドレスをチェック
 * 以下のＨＴＭＬ５ input[type=email] の仕様に準じる
 * https://html.spec.whatwg.org/multipage/input.html#valid-e-mail-address
 * （現在はマルチバイトのメールアドレスもあり得るが、意図的に除外している）
 * @param string $str
 * @return bool
 */
function is_email(string $str){
    $pattern = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@";
    $pattern .= "[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";
    if ( preg_match($pattern,$str) ){
        return true;
    }
    return false;
}

/**
 * 電話番号チェック
 * @param string $str
 * @param bool $hyphen
 * @return bool
 */
function is_telnum(string $str, bool $hyphen=true){
    if($hyphen===true){
        $pattern = "/^0\d{2,3}-\d{1,4}-\d{4}$/";
    } else {
        $pattern = "/^0\d{9,10}$/";
    }
    if ( preg_match($pattern, $str) ){
        return true;
    }
    return false;
}

/**
 * 文字列に半角・全角の記号・特殊文字が入っていないか判定
 * （ただし、住所や会社名のチェック等のため、会社名に利用可能な記号と郵便記号は含む）
 * https://office-taniguchi.com/contents_202.html
 * @param string $str
 * @return bool
 */
function is_normal_string(string $str){
    $pattern = "/^[ぁ-んァ-ンーa-zA-Z0-9一-龠０-９\-\r〒＆&・'’,，\.．]+$/u";
    if ( preg_match($pattern, $str) ){
        return true;
    }
    return false;
}



/****************
 * 文字列変換
 ****************/
/**
 * 全角スペースが入っていても変換してtrim
 * @param string $str
 * @return string
 */
function trim2(string $str){
    return trim(mb_convert_kana($str, "s", 'UTF-8'));
}

/**
 * 半角カナを全角カナに変換（濁音・半濁音も一文字に変換）
 * @param string $str
 * @return string
 */
function convert_katakana(string $str){
    return mb_convert_kana($str, "KV");
}

/**
 * 全角英数字を半角に変換
 * @param string $str
 * @return string
 */
function convert_alnum(string $str){
    return mb_convert_kana($str, "a");
}

/**
 * 全角英数字を半角に変換
 * @param string $str
 * @return string
 */
function convert_number(string $str){
    return mb_convert_kana($str, "n");
}

