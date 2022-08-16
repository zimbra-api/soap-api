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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Admin\Struct\DataSourceSpecifier;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CreateDataSourceRequest class
 * Creates a data source that imports mail items into the specified folder. 
 * Notes:
 *    Currently the only type supported is pop3. 
 *    Every attribute value is returned except password. 
 *    This request is by default proxied to the account's home server 
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateDataSourceRequest extends SoapRequest
{
    /**
     * Id for an existing Account
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * Details of data source
     * 
     * @var DataSourceSpecifier
     */
    #[Accessor(getter: 'getDataSource', setter: 'setDataSource')]
    #[SerializedName(name: 'dataSource')]
    #[Type(name: DataSourceSpecifier::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $dataSource;

    /**
     * Constructor
     * 
     * @param DataSourceSpecifier $dataSource
     * @param string $id
     * @return self
     */
    public function __construct(
        DataSourceSpecifier $dataSource, string $id = ''
    )
    {
        $this->setId($id)
             ->setDataSource($dataSource);
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
     * Get data source
     *
     * @return DataSourceSpecifier
     */
    public function getDataSource(): DataSourceSpecifier
    {
        return $this->dataSource;
    }

    /**
     * Set data source
     *
     * @param  DataSourceSpecifier $dataSource
     * @return self
     */
    public function setDataSource(DataSourceSpecifier $dataSource): self
    {
        $this->dataSource = $dataSource;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CreateDataSourceEnvelope(
            new CreateDataSourceBody($this)
        );
    }
}
