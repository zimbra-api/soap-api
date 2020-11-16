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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Admin\Struct\{AdminAttrs, AdminAttrsImplTrait};
use Zimbra\Soap\Request;
use Zimbra\Struct\Id;

/**
 * DeleteDataSourceRequest class
 * Deletes the given data source.
 * Note: this request is by default proxied to the account's home server
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="DeleteDataSourceRequest")
 */
class DeleteDataSourceRequest extends Request implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * Id for an existing Account
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Data source ID
     * @Accessor(getter="getDataSource", setter="setDataSource")
     * @SerializedName("dataSource")
     * @Type("Zimbra\Struct\Id")
     * @XmlAttribute
     */
    private $dataSource;

    /**
     * Constructor method for DeleteDataSourceRequest
     * @param string  $id
     * @param Id  $dataSource
     * @param array  $attrs
     * @return self
     */
    public function __construct(
        $id,
        Id $dataSource,
        array $attrs = []
    )
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
    public function setId($id): self
    {
        $this->id = trim($id);
        return $this;
    }

    /**
     * Gets dataSource
     *
     * @return Id
     */
    public function getDataSource(): Id
    {
        return $this->dataSource;
    }

    /**
     * Sets dataSource
     *
     * @param  Id $dataSource
     * @return self
     */
    public function setDataSource(Id $dataSource): self
    {
        $this->dataSource = $dataSource;
        return $this;
    }

    protected function internalInit()
    {
        $this->envelope = new DeleteDataSourceEnvelope(
            NULL,
            new DeleteDataSourceBody($this)
        );
    }
}
