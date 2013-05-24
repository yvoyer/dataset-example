<?php
/**
 * This file is part of the Dataset.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\DataSet;

use Star\Blog\Article;
use Star\Blog\Comment;
use Star\Blog\Tag;
use Star\Mapping\BlogMapping;

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

    public function __construct(array $data = array(), BlogMapping $mapping)
    {
        $this->rawArticles = $data["Article"];
        $this->rawComments = $data["Comment"];
        $this->rawTags     = $data["Tag"];
        $this->articles    = array();
        $this->comments    = array();
        $this->tags        = array();

        foreach ($this->rawTags as $aRow) {
            $tag = new Tag();
            $tag->setId($aRow["id"]);
            $tag->setName($aRow["name"]);

            $this->tags[$aRow["id"]] = $tag;
        }

        foreach ($this->rawArticles as $aRow) {
            $article = new Article();
            $article->setId($aRow["id"]);
            $article->setName($aRow["name"]);
            $article->setDescription($aRow["description"]);

            foreach ($aRow["Tags"] as $tagId) {
                $article->addTag($this->getTag($tagId));
            }

            $this->articles[$aRow["id"]] = $article;
        }

        foreach ($this->rawComments as $aRow) {
            $comment = new Comment();
            $comment->setId($aRow["id"]);
            $comment->setContent($aRow["content"]);
            $comment->setArticle($this->getArticle($aRow["Article"]));

            $this->comments[$aRow["id"]] = $comment;
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
     */
    public function getTag($id)
    {
        return $this->tags[$id];
    }

    /**
     * @param Comment
     */
    public function getComment($id)
    {
        return $this->comments[$id];
    }
}
