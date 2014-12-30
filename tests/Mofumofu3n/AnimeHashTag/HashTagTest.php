<?php
namespace Mofumofu3n\AnimeHashTag;

use Mofumofu3n\AnimeHashTag\HashTag;

class HashTagTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->hashtag = new HashTag();
    }

    public function test類似のタイトルのハッシュタグを返す()
    {
        $target = "『画像』俺、ツインテールになります。の作画!! 今期アニメで一番酷いな…もう笑うしかないよ…";
        $anser = "#ore_twi";
        $result = $this->hashtag->similar($target);
        var_dump($result);
        $this->assertSame($anser, (string) $result->hashtag);
    }
}
