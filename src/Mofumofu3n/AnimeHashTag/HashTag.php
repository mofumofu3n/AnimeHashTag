<?php
namespace Mofumofu3n\AnimeHashTag;

define("HASH_TAG_XML", __DIR__."/data/hashtag.xml");
define("HASH_TAG_URL", "http://zish.jp/hashtag.xml");

class HashTag
{
    private $hashTagList;

    public function __construct()
    {
        $this->hashTagList = $this->createHashTagList();
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
     * createHashTagList
     *
     * @access private
     * @return array
     */
    private function createHashTagList()
    {
        if (file_exists(HASH_TAG_XML) === false) {
            $xmlData = file_get_contents(self::HASH_TAG_URL);
            $result = file_put_contents(HASH_TAG_XML, $xmlData);
            var_dump($result);
        }
        return simplexml_load_file(HASH_TAG_XML);
    }
}
