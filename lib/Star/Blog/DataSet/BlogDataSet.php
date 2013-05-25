<?php
/**
 * This file is part of the Dataset.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Blog\DataSet;

use Star\Blog\Article;
use Star\Blog\Comment;
use Star\Blog\Tag;
use Star\DataSet;
use Star\Blog\Mapping\ArticleMapper;
use Star\Blog\Mapping\CommentMapper;
use Star\Blog\Mapping\TagMapper;

/**
 * Class BlogDataSet
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star
 */
class BlogDataSet
{
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
        $tagDataSet = new DataSet($data, new TagMapper());
        $this->tags = $tagDataSet->toArray();

        $articleDataSet = new DataSet($data, new ArticleMapper());
        $this->articles = $articleDataSet->toArray();
        foreach ($this->articles as $article) {
            /**
             * @var $article Article
             */
            foreach ($article->getRawTags() as $tagId) {
                $article->addTag($this->getTag($tagId));
            }
        }

        $commentDataSet = new DataSet($data, new CommentMapper());
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
