<?php

use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    /**
     * @test
     */
    public function 半角数字()
    {
        $this->assertTrue(is_number('1'));
    }

    /**
     * @test
     */
    public function 半角英字()
    {
        $this->assertTrue(is_alphabet('a'));
    }

    /**
     * @test
     */
    public function 半角英数字()
    {
        $this->assertTrue(is_alnum('1'));
    }

    /**
     * @test
     */
    public function 半角英数記号()
    {
        $this->assertTrue(is_alnumsymbol('!"#$%&\'()=~||~`P+L>?{}`~*}_*?><MJNBGVFRTU\'I(K<MJ'));
    }

    /**
     * @test
     */
    public function 全角ひらがな()
    {
        $this->assertTrue(is_hiragana('ああああ'));
    }

    /**
     * @test
     */
    public function 全角カタカナ()
    {
        $this->assertTrue(is_katakana('アアアアアア'));
    }

    /**
     * @test
     */
    public function 全角かな()
    {
        $this->assertTrue(is_kana('アアアアアア'));
    }

    /**
     * @test
     */
    public function 半角カタカナ()
    {
        $this->assertTrue(is_hankaku_katakana('ｱｲｳｴｱｦ'));
    }

    /**
     * @test
     */
    public function 全角数字文字列を半角に変換してバリデート()
    {
        $this->assertTrue(is_number(convert_number('１')));
    }

    /**
     * @test
     */
    public function 半角カタカナを全角に変換してバリデート()
    {
        $str = 'ｱｲｳｴｱｦ';
        $this->assertTrue(is_hankaku_katakana($str));
        $this->assertTrue(is_katakana(convert_katakana($str)));
    }

    /**
     * @test
     */
    public function 全角英数字を半角に変換してバリデート()
    {
        $str = '１２３４５６７８９０1234567890Ａzｗｔａｂａａaｙａｎａｔaａｙａｍｂａｐ';
        $str = convert_alnum($str);
        $this->assertTrue(is_alnum($str));
    }

    /**
     * @test
     */
    public function 空白をトリムしてバリデート()
    {
        $str = '　 　ｱｲｳｴｱｦ 　';
        $this->assertTrue(is_hankaku_katakana(trim2($str)));
    }

    /**
     * @test
     */
    public function メールアドレスチェック()
    {
        $str = 'pebble14+test@gmail.com';
        $this->assertTrue(is_email($str));
    }
    /**
     * @test
     */
    public function 電話番号チェック()
    {
        $str = '080-6507-9966';
        $this->assertTrue(is_telnum($str, true));

        $str = '08065079966';
        $this->assertTrue(is_telnum($str, false));
    }

    /**
     * @test
     */
    public function 記号・特殊文字が含まれていないかチェック()
    {
        $str = 'あああ・';
        $this->assertTrue(is_normal_string($str));
    }

}