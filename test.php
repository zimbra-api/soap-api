<?php

require_once 'vendor/autoload.php';

use Zimbra\Account\Struct\AccountDataSource;
use Zimbra\Account\Struct\AccountImapDataSource;
use Zimbra\Account\Struct\AccountPop3DataSource;
use Zimbra\Account\Api;
use Zimbra\Common\SerializerFactory;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\AccessType;
use JMS\Serializer\Annotation\Discriminator;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlKeyValuePairs;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\XmlMap;

use JMS\Serializer\{Context, GraphNavigator};
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Visitor\SerializationVisitorInterface as SerializationVisitor;
use JMS\Serializer\Visitor\DeserializationVisitorInterface as DeserializationVisitor;
/**
 * @XmlNamespace(uri="http://www.w3.org/2003/05/soap-envelope", prefix="soap")
 */
abstract class BasePost
{
}

/**
 * @AccessType("public_method")
 * @XmlRoot(name="post", prefix="soap")
 */
class Post extends BasePost
{
    /**
     * @Accessor(getter="getComments", setter="setComments")
     * @SerializedName("comments")
     * @Type("array<string, Comment>")
     * @XmlMap(keyAttribute = "id")
     * @XmlKeyValuePairs()
     */
    private $comments;

    public function __construct()
    {
        $this->comments = [
            'Foo' => new Comment('Foo'),
            'Bar' => new Comment('Bar'),
        ];
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function setComments(array $comments)
    {
        $this->comments = [];
        foreach ($comments as $comment) {
            if ($comment instanceof Comment) {
                $this->comments[] = $comment;
            }
        }
        return $this;
    }
}

/** @XmlRoot("comment") */
class Comment
{
    /**
     * @Accessor(getter="getText", setter="setText")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $text;

    public function __construct($text)
    {
        $this->text = (string) $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = (string) $text;
        return $this;
    }
}

class SerializerHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => GetInfoResponse::class,
                'method' => 'xmlDeserializeAccountDataSource',
            ],
        ];
    }


    public function xmlDeserializeAccountDataSource(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    )
    {
        var_dump($data);
        exit;
    }
}

/**
 * @XmlRoot(name="GetInfoResponse")
 */
class GetInfoResponse
{

    /**
     * Data sources
     * @Accessor(getter="getDataSources", setter="setDataSources")
     * @SerializedName("dataSources")
     * @Type("array<string, Zimbra\Account\Struct\AccountDataSource>")
     * @XmlKeyValuePairs
     */
    private $dataSources;

    public function __construct()
    {
        $this->dataSources = [
            'imap' => new AccountImapDataSource('abc', 'xyz'),
            'pop3' => new AccountPop3DataSource('asd', 'jkl'),
        ];
        // $this->setDataSources([
        //     'imap' => new AccountImapDataSource('abc', 'xyz'),
        //     'pop3' => new AccountPop3DataSource('asd', 'jkl'),
        // ]);
    }


    /**
     * Set dataSources
     *
     * @param  array $dataSources
     * @return self
     */
    public function setDataSources(array $dataSources): self
    {
        $this->dataSources = [];
        var_dump($dataSources); exit();
        foreach ($dataSources as $dataSource) {
            if ($dataSource instanceof AccountImapDataSource) {
                $this->dataSources['imap'] = $dataSource;
            }
            if ($dataSource instanceof AccountPop3DataSource) {
                $this->dataSources['pop3'] = $dataSource;
            }
            if ($dataSource instanceof AccountDataSource) {
                $this->dataSources['dataSource'] = $dataSource;
            }
        }
        return $this;
    }

    /**
     * Gets dataSources
     *
     * @return array
     */
    public function getDataSources(): array
    {
        return $this->dataSources;
    }
}

SerializerFactory::addSerializerHandler(new SerializerHandler);
$serializer = SerializerFactory::create();
$response = new GetInfoResponse();
$xmlContent = $serializer->serialize($response, 'xml');
var_dump($serializer->deserialize($xmlContent, GetInfoResponse::class, 'xml'));
exit;

$xmlContent = $serializer->serialize(new Post, 'xml');
echo $xmlContent;
// $post = $serializer->deserialize($xmlContent, Post::class, 'xml');
// var_dump($post);
$jsonContent = $serializer->serialize(new Post, 'json');
echo $jsonContent;
// $post = $serializer->deserialize($jsonContent, Post::class, 'json');
// var_dump($post);
exit;

// $api = new Api('https://mail.securemail.vn/service/soap');
// $account = new AccountSelector(AccountBy::NAME(), 'monitoring-sungroup@elpis.vn');
// $response = $api->auth($account, 'ZLnJZy4qAgvKy@4wF');
// $response = $api->auth($account, 'abc');
// $authToken = '0_7e23b62682558060d6c2851d1765eb210c4d97d8_69643d33363a30613539376364352d313336392d343937622d613065612d3864323631653662663330343b6578703d31333a313532393833303939383630323b76763d313a323b747970653d363a7a696d6272613b753d313a613b7469643d31303a323131363030383532363b76657273696f6e3d31333a382e372e375f47415f313738373b';
// $response = $api->authByToken($authToken);
// var_dump($response);
exit;
