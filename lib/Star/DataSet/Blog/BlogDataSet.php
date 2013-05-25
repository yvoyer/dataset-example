<?php
/**
 * This file is part of the Dataset.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\DataSet\Blog;

use Star\Blog\Article;
use Star\Blog\Comment;
use Star\Blog\Tag;
use Star\Mapping\Blog\ArticleMapper;
use Star\Mapping\Blog\CommentMapper;
use Star\Mapping\Blog\TagMapper;

/**
 * Class BlogDataSet
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star
 */
class BlogDataSet
{
    private $rawArticles;
    private $rawComments;
    private $rawTags;

    /**
     * @var Article[]
     */
    private $articles;

    /**
     * @var Comment[]
     */
    private $comments;

    /**
     * @var Tag[]
     */
    private $tags;

    public function __construct(array $data = array())
    {
        $this->rawArticles = $data["Article"];
        $this->rawComments = $data["Comment"];
        $this->rawTags     = $data["Tag"];
        $this->articles    = array();
        $this->comments    = array();

        $tagDataSet = new TagDataSet($data, new TagMapper());
        $this->tags = $tagDataSet->toArray();

        $articleDataSet = new ArticleDataSet($data, new ArticleMapper());
        $this->articles = $articleDataSet->toArray();
        foreach ($this->articles as $article) {
            /**
             * @var $article Article
             */
            foreach ($article->getRawTags() as $tagId) {
                $article->addTag($this->getTag($tagId));
            }
        }

        $commentDataSet = new CommentDataSet($data, new CommentMapper());
        $this->comments = $commentDataSet->toArray();
        foreach ($this->comments as $comment) {
            /**
             * @var $comment Comment
             */
            $comment->setArticle($this->getArticle($comment->getArticleId()));
        }
    }

    /**
     * @return Article[]
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @return Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return Comment[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param $id
     *
     * @return Article
     */
    public function getArticle($id)
    {
        return $this->articles[$id];
    }

    /**
     * @param Tag
     *
     * @return Tag
     */
    public function getTag($id)
    {
        return $this->tags[$id];
    }

    /**
     * @param Comment
     *
     * @return Comment
     */
    public function getComment($id)
    {
        return $this->comments[$id];
    }
}
