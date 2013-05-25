<?php
/**
 * This file is part of the Dataset.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Blog;

/**
 * Class Comment
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Blog
 */
class Comment
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $content;

    /**
     * @var Article
     */
    private $article;

    /**
     * @var integer
     */
    private $articleId;

    /**
     * Set the article.
     *
     * @param \Star\Blog\Article $article
     *
     * @return self
     */
    public function setArticle(Article $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Returns the Article.
     *
     * @return \Star\Blog\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set the content.
     *
     * @param string $content
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Returns the Content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the id.
     *
     * @param int $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Returns the Id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the articleId.
     *
     * @param int $articleId
     *
     * @return self
     */
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;

        return $this;
    }

    /**
     * Returns the ArticleId.
     *
     * @return int
     */
    public function getArticleId()
    {
        return $this->articleId;
    }
}
