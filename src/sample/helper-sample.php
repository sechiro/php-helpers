<?php
require_once '../helper/validation_helper.php';

//指定されている場合は、必ず半角英数字に変換する
define('DEFAULT_CONVERT_ALNUM', false);

$whitelists = [
    ['id', ['required', 'not_null', 'is_number', '/.*/'] ],
    ['code', ['required', 'not_null', 'is_alnum', '/.*/'] ],
    ['tel', ['not_null', 'is_telnum'], 'convert_alnum'],
];

$_POST = [];
$_POST['id'] = '11111';
$_POST['code'] = 'aaaaaaaaa';
$_POST['tel'] = '090-0000-0000';

function warn($key, $warning_text){
    echo $warning_text . PHP_EOL;
}
//var_dump($_POST);
//var_dump($whitelists);

function validate_post($whitelists){
    $validated_vars = [];

    foreach ($whitelists as $whitelist){
        $key = $whitelist[0];
        $conditions = $whitelist[1];

        //POST内に変数がなく、かつ、requiredが指定されていた場合だけエラー
        if( !isset($_POST[$key]) ) {
            if ( in_array('required', $conditions) ) {
                warn($key, "必要なキーがPOSTされていません。: $key");
            }
            continue;
        }

        //全角空白含め前後の空白削除
        $value = trim2($_POST[$key]);

        //全角英数字→半角英数字、半角カタカナ→全角カタカナへの変換
        //TODO: 2つ同時変換への対応（やる機会がない？）
        $convert = $whitelist[2] ?? null;
        switch ($convert){
            case 'convert_alnum':
                $value = convert_alnum($value);
                break;
            case 'convert_katakana':
                $value = convert_katakana($value);
                break;
            default:
                if(DEFAULT_CONVERT_ALNUM){
                    $value = convert_alnum($value);
                }
        }

        foreach ( $conditions as $condition ){
            switch ($condition){
                case 'required':
                    //変数未定義の時だけアラートを出すのでここでは処理しない
                    break;
                case 'not_null':
                    if($value === ''){
                        warn($key, "入力してください。");
                        continue 3;
                    }
                    break;
                case 'is_number':
                    if(!is_number($value)){
                        warn($key, "半角数字を入力してください。");
                        continue 3;
                    }
                    break;
                case 'is_alnum':
                    if(!is_alnum($value)){
                        warn($key, "半角英数字を入力してください。");
                        continue 3;
                    }
                    break;
                case 'is_telnum':
                    if(!is_telnum($value)){
                        warn($key, "正しい電話番号を入力してください。");
                        continue 3;
                    }
                    break;
                case preg_match('/^\/.+\/u?$/', $condition) ? true : false:
                    if( !preg_match($condition, $value ) ){
                        echo 'not matched';

                    }
                    break;
                default:
                    echo "対応していないバリデーションルールが設定されています。: $condition" . PHP_EOL;
                    continue 3;
            }
        }
        //ここまで来た変数はバリデート済み
        $validated_vars[$key] = $value;
    }
    return $validated_vars;
}

$validated_vars = validate_post($whitelists);
var_dump($validated_vars);

