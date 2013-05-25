<?php
/**
 * This file is part of the Dataset.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star;

use Star\Blog\Article;
use Star\Blog\Comment;
use Star\Blog\Tag;
use Star\DataSet\Blog\BlogDataSet;

/**
 * Class DataSetTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star
 */
class DataSetTest extends \PHPUnit_Framework_TestCase
{
    private function getData()
    {
        return array(
            "Article" => array(
                array("id" => 1111, "name" => "article1111", "description" => "desc1111", "Tags" => array(12, 34, 56, 78)),
                array("id" => 2222, "name" => "article2222", "description" => "desc2222", "Tags" => array(34, 56, 78)),
                array("id" => 3333, "name" => "article3333", "description" => "desc3333", "Tags" => array(56, 78)),
                array("id" => 4444, "name" => "article4444", "description" => "desc4444", "Tags" => array(78)),
            ),
            "Tag" => array(
                array("id" => 12, "name" => "tag12"),
                array("id" => 34, "name" => "tag34"),
                array("id" => 56, "name" => "tag56"),
                array("id" => 78, "name" => "tag78"),
                array("id" => 90, "name" => "tag90"),
            ),
            "Comment" => array(
                array("id" => 7777, "content" => "content7777", "Article" => 1111),
                array("id" => 8888, "content" => "content8888", "Article" => 1111),
                array("id" => 9999, "content" => "content9999", "Article" => 2222),
            ),
        );
    }

    public function testImportData()
    {
        $dataSet = new BlogDataSet($this->getData());

        $this->assertCount(4, $dataSet->getArticles());
        $this->assertCount(5, $dataSet->getTags());
        $this->assertCount(3, $dataSet->getComments());

        $this->assertArticleObject($dataSet->getArticle(1111), 1111, "article1111", "desc1111", 4);
        $this->assertArticleObject($dataSet->getArticle(2222), 2222, "article2222", "desc2222", 3);
        $this->assertArticleObject($dataSet->getArticle(3333), 3333, "article3333", "desc3333", 2);
        $this->assertArticleObject($dataSet->getArticle(4444), 4444, "article4444", "desc4444", 1);

        $this->assertCommentObject($dataSet->getComment(7777), 7777, "content7777", 1111);
        $this->assertCommentObject($dataSet->getComment(8888), 8888, "content8888", 1111);
        $this->assertCommentObject($dataSet->getComment(9999), 9999, "content9999", 2222);

        $this->assertTagObject($dataSet->getTag(12), 12, "tag12");
        $this->assertTagObject($dataSet->getTag(34), 34, "tag34");
        $this->assertTagObject($dataSet->getTag(56), 56, "tag56");
        $this->assertTagObject($dataSet->getTag(78), 78, "tag78");
        $this->assertTagObject($dataSet->getTag(90), 90, "tag90");
    }

    private function assertCommentObject(Comment $comment, $id, $content, $articleId)
    {
        $this->assertSame($id, $comment->getId());
        $this->assertSame($content, $comment->getContent());
        $this->assertSame($articleId, $comment->getArticle()->getId());
    }

    private function assertArticleObject(Article $article, $id, $name, $description, $tagCount)
    {
        $this->assertSame($id, $article->getId());
        $this->assertSame($name, $article->getName());
        $this->assertSame($description, $article->getDescription());
        $this->assertCount($tagCount, $article->getTags());
    }

    private function assertTagObject(Tag $tag, $id, $name)
    {
        $this->assertSame($id, $tag->getId());
        $this->assertSame($name, $tag->getName());
    }
}
