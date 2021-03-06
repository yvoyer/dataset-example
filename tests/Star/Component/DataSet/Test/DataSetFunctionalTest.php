<?php
/**
 * This file is part of the Dataset.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\DataSet\Test;

use Star\Component\DataSet\Stub\Blog\DataSet\BlogDataSet;
use Star\Component\DataSet\Stub\Blog\Entity\Article;
use Star\Component\DataSet\Stub\Blog\Entity\Comment;
use Star\Component\DataSet\Stub\Blog\Entity\Tag;

/**
 * Class DataSetFunctionalTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\DataSet\Test
 */
class DataSetFunctionalTest extends \PHPUnit_Framework_TestCase
{
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

    public function testShouldMapAllTheDataUsingAStub()
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

    public function testShouldBeConfigurableAsExample()
    {
        $data = $this->getData();

        $tagMapper = new \Star\Component\DataSet\Mapping\Mapper('Tag', 'Star\Component\DataSet\Stub\Blog\Entity\Tag');
        $tagMapper->addMap('id', 'setId');
        $tagMapper->addMap('name', 'setName');

        $tagDataSet = new \Star\Component\DataSet\DataSet($data, $tagMapper);
        $result = '';
        foreach ($tagDataSet->toArray() as $object) {
            /**
             * @var $object \Star\Component\DataSet\Stub\Blog\Entity\Tag
             */
            $result .= get_class($object) . ": {$object->getId()} => {$object->getName()}\n";
        }

        // $result contains
        // Star\Component\DataSet\Stub\Blog\Entity\Tag: 12 => tag12
        // Star\Component\DataSet\Stub\Blog\Entity\Tag: 34 => tag34
        // Star\Component\DataSet\Stub\Blog\Entity\Tag: 56 => tag56
        // Star\Component\DataSet\Stub\Blog\Entity\Tag: 78 => tag78
        // Star\Component\DataSet\Stub\Blog\Entity\Tag: 90 => tag90

        $this->assertContains('Star\Component\DataSet\Stub\Blog\Entity\Tag: 12 => tag12', $result);
        $this->assertContains('Star\Component\DataSet\Stub\Blog\Entity\Tag: 34 => tag34', $result);
        $this->assertContains('Star\Component\DataSet\Stub\Blog\Entity\Tag: 56 => tag56', $result);
        $this->assertContains('Star\Component\DataSet\Stub\Blog\Entity\Tag: 78 => tag78', $result);
        $this->assertContains('Star\Component\DataSet\Stub\Blog\Entity\Tag: 90 => tag90', $result);
    }
}
