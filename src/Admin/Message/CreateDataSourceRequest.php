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
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CreateDataSourceRequest extends Request
{
    /**
     * Id for an existing Account
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute()
     */
    private $id;

    /**
     * Details of data source
     * @Accessor(getter="getDataSource", setter="setDataSource")
     * @SerializedName("dataSource")
     * @Type("Zimbra\Admin\Struct\DataSourceSpecifier")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private DataSourceSpecifier $dataSource;

    /**
     * Constructor method for CreateDataSourceRequest
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
     * Gets id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets id
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
     * Gets data source
     *
     * @return DataSourceSpecifier
     */
    public function getDataSource(): DataSourceSpecifier
    {
        return $this->dataSource;
    }

    /**
     * Sets data source
     *
     * @param  DataSourceSpecifier $name
     * @return self
     */
    public function setDataSource(DataSourceSpecifier $dataSource): self
    {
        $this->dataSource = $dataSource;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new CreateDataSourceEnvelope(
            new CreateDataSourceBody($this)
        );
    }
}
