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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\DataSourceSpecifier;
use Zimbra\Soap\Request;

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
 * @AccessType("public_method")
 * @XmlRoot(name="CreateDataSourceRequest")
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
     * @XmlElement()
     */
    private $dataSource;

    /**
     * Constructor method for CreateDataSourceRequest
     * @param string  $id
     * @param DataSourceSpecifier  $dataSource
     * @return self
     */
    public function __construct(
        $id,
        DataSourceSpecifier $dataSource
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
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id): self
    {
        $this->id = trim($id);
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
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof CreateDataSourceEnvelope)) {
            $this->envelope = new CreateDataSourceEnvelope(
                new CreateDataSourceBody($this)
            );
        }
    }
}
