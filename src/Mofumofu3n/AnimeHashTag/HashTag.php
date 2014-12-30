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
            putFile();
        } else {
            if ($this->getUpdateTime('+2 month')) {
                putFile();
            }
        }
        return simplexml_load_file(HASH_TAG_XML);
    }

    protected function getUpdateTime($updateSpan)
    {
        $createTime = $this->getCreateFileTime();
        $updateTime = strtotime($updateSpan, $createTime);

        return time() - $updateTime > 0;
    }

    protected function getCreateFileTime()
    {
        return filemtime(HASH_TAG_XML);
    }

    protected function putFile()
    {
        $xmlData = file_get_contents(HASH_TAG_URL);
        file_put_contents(HASH_TAG_XML, $xmlData);
    }
}
