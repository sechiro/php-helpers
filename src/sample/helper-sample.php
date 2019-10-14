<?php
require_once '../helper/validation_helper.php';

$whitelists = [
    ['code', ['required', 'not_null', 'is_alnum', 'is_number', '/.*/']]
];



$_POST = [];
$_POST['code'] = 'aaaaaaaaa';

function warn($key, $warning_text){
    echo $warning_text . PHP_EOL;
}
//var_dump($_POST);
//var_dump($whitelists);

$validated_vars = [];

foreach ($whitelists as $whitelist){
    $key = $whitelist[0];
    $conditions = $whitelist[1];

    //POST内に変数がなく、かつ、requiredが指定されていた場合だけエラー
    if( !isset($_POST[$key]) && !in_array('required', $conditions)){
        warn($key, "必要なキーがPOSTされていません");
        continue;
    }

    $value = $_POST[$key];
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
            case 'is_alnum':
                if(!is_alnum($value)){
                    warn($key, "半角英数字を入力してください。");
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

    var_dump($validated_vars);
}
