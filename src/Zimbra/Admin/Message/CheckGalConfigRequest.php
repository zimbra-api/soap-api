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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\AdminAttrs;
use Zimbra\Admin\Struct\AdminAttrsImplTrait;
use Zimbra\Admin\Struct\LimitedQuery;
use Zimbra\Soap\{EnvelopeInterface, RequestInterface};

/**
 * CheckGalConfigRequest request class
 * Check Global Addressbook Configuration
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CheckGalConfigRequest")
 */
class CheckGalConfigRequest implements RequestInterface, AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * Query
     * 
     * @Accessor(getter="getQuery", setter="setQuery")
     * @SerializedName("query")
     * @Type("Zimbra\Admin\Struct\LimitedQuery")
     * @XmlElement
     */
    private $query;

    /**
     * GAL action
     * 
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("string")
     * @XmlElement
     */
    private $action;

    /**
     * Constructor method for CheckGalConfigRequest
     * @param  LimitedQuery  $query
     * @param  string  $action
     * @param  array  $attrs
     * @return self
     */
    public function __construct(LimitedQuery $query = NULL, $action = NULL, array $attrs = [])
    {
        if ($query instanceof LimitedQuery) {
            $this->setQuery($query);
        }
        if (NULL !== $action) {
            $this->setAction($action);
        }
        $this->setAttrs($attrs);
    }

    /**
     * Sets Exchange Auth
     *
     * @param  LimitedQuery $query
     * @return self
     */
    public function setQuery(LimitedQuery $query): self
    {
        $this->query = $query;
        return $this;
    }

    /**
     * Gets Exchange Auth
     *
     * @return LimitedQuery
     */
    public function getQuery(): LimitedQuery
    {
        return $this->query;
    }

    /**
     * Gets action
     *
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Sets action
     *
     * @param  string $action
     * @return self
     */
    public function setAction($action): self
    {
        $this->action = trim($action);
        return $this;
    }

    /**
     * Get soap envelope.
     *
     * @return EnvelopeInterface
     */
    public function getEnvelope(): EnvelopeInterface
    {
        return new CheckGalConfigEnvelope(
            new CheckGalConfigBody($this)
        );
    }
}
