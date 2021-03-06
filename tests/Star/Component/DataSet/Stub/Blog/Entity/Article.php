<?php
/**
 * This file is part of the Dataset.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\DataSet\Stub\Blog\Entity;

/**
 * Class Article
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\DataSet\Stub\Blog\Entity
 */
class Article
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var Tag[]
     */
    private $tags;

    /**
     * @var array
     */
    private $rawTags;

    public function __construct()
    {
        $this->tags    = array();
        $this->rawTags = array();
    }

    /**
     * Set the description.
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Returns the Description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * Set the name.
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Returns the Name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Tag $tag
     *
     * @return $this
     */
    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * @return Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set the rawTags.
     *
     * @param array $rawTags
     *
     * @return self
     */
    public function setRawTags($rawTags)
    {
        $this->rawTags = $rawTags;

        return $this;
    }

    /**
     * Returns the RawTags.
     *
     * @return array
     */
    public function getRawTags()
    {
        return $this->rawTags;
    }
}
