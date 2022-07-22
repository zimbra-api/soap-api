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
use Zimbra\Admin\Struct\{AdminAttrs, AdminAttrsImplTrait, DataSourceInfo};
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * ModifyDataSourceRequest class
 * Changes attributes of the given data source.
 * Only the attributes specified in the request are modified.
 * To change the name, specify "zimbraDataSourceName" as an attribute. 
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ModifyDataSourceRequest extends Request implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * Zimbra ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Data source specification
     * @Accessor(getter="getDataSource", setter="setDataSource")
     * @SerializedName("dataSource")
     * @Type("Zimbra\Admin\Struct\DataSourceInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private DataSourceInfo $dataSource;

    /**
     * Constructor method for ModifyDataSourceRequest
     * 
     * @param string $id
     * @param DataSourceInfo $dataSource
     * @param array  $attrs
     * @return self
     */
    public function __construct(string $id = '', DataSourceInfo $dataSource, array $attrs = [])
    {
        $this->setId($id)
             ->setDataSource($dataSource)
             ->setAttrs($attrs);
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
     * Gets the data source.
     *
     * @return DataSourceInfo
     */
    public function getDataSource(): DataSourceInfo
    {
        return $this->dataSource;
    }

    /**
     * Sets the data source
     *
     * @param  DataSourceInfo $dataSource
     * @return self
     */
    public function setDataSource(DataSourceInfo $dataSource): self
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
        return new ModifyDataSourceEnvelope(
            new ModifyDataSourceBody($this)
        );
    }
}
