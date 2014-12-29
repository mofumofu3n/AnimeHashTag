<?php
namespace Mofumofu3n\AnimeHashTag;

class HashTag
{
    const HASH_TAG_XML = "http://zish.jp/hashtag.xml";

    private $hashTagList;

    public function __construct() {
        $this->hashTagList = $this->createProgramList();
    }

    public function get($target)
    {
        $shortest = -1;
        foreach ($this->hashTagList as $hashtag) {
            similar_text($target, $hashtag->title, $lev);

            if ($lev > $shortest || $shortest < 0) {
                $closet = $hashtag;
                $shortest = $lev;
            }
        }

        return $closet;
    }

    /**
     * createProgramList
     * アニメタイトルの一覧を返す
     *
     * @access private
     * @return array
     */
    private function createProgramList()
    {
        $programList = array();
        return simplexml_load_file(self::HASH_TAG_XML);
    }
}
