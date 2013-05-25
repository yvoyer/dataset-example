DataSet Component
=================

This component is used for mapping a php array to an object using Mapping and DataSet.

Examples
--------

# Third party API format

Let's say you are using an API that returns a JSON formated like this:

    {
        "Article":
        [
            {
                "id":1111,
                "name":"article1111",
                "description":"desc1111",
                "Tags":[12,34,56,78]
            },
            {
                "id":2222,
                "name":"article2222",
                "description":"desc2222",
                "Tags":[34,56,78]
            },
            {
                "id":3333,
                "name":"article3333",
                "description":"desc3333",
                "Tags":[56,78]
            },
            {
                "id":4444,
                "name":"article4444",
                "description":"desc4444",
                "Tags":[78]
            }
        ],
        "Tag":[
            {
                "id":12,
                "name":"tag12"
            },
            {
                "id":34,
                "name":"tag34"
            },
            {
                "id":56,
                "name":"tag56"
            },
            {
                "id":78,
                "name":"tag78"
            },
            {
                "id":90,
                "name":"tag90"
            }
        ],
        "Comment":
        [
            {
                "id":7777,
                "content":"content7777",
                "Article":1111
            },
            {
                "id":8888,
                "content":"content8888",
                "Article":1111
            },
            {
                "id":9999,
                "content":"content9999",
                "Article":2222
            }
        ]
    }

You can map this schema to the tag object:

    // $apiResult is the json string from API
    $data = json_decode($apiResult);

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






