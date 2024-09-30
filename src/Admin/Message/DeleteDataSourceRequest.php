<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Admin\Struct\{AdminAttrs, AdminAttrsImplTrait};
use Zimbra\Common\Struct\{Id, SoapEnvelopeInterface, SoapRequest};

/**
 * DeleteDataSourceRequest class
 * Deletes the given data source.
 * Note: this request is by default proxied to the account's home server
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DeleteDataSourceRequest extends SoapRequest implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * Id for an existing account
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private $id;

    /**
     * Data source ID
     *
     * @var Id
     */
    #[Accessor(getter: "getDataSource", setter: "setDataSource")]
    #[SerializedName("dataSource")]
    #[Type(Id::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private Id $dataSource;

    /**
     * Constructor
     *
     * @param Id     $dataSource
     * @param string $id
     * @param array  $attrs
     * @return self
     */
    public function __construct(
        Id $dataSource,
        string $id = "",
        array $attrs = []
    ) {
        $this->setId($id)->setDataSource($dataSource)->setAttrs($attrs);
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get dataSource
     *
     * @return Id
     */
    public function getDataSource(): Id
    {
        return $this->dataSource;
    }

    /**
     * Set dataSource
     *
     * @param  Id $dataSource
     * @return self
     */
    public function setDataSource(Id $dataSource): self
    {
        $this->dataSource = $dataSource;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new DeleteDataSourceEnvelope(new DeleteDataSourceBody($this));
    }
}
