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
use Zimbra\Admin\Struct\{AdminAttrs, AdminAttrsImplTrait, LimitedQuery};
use Zimbra\Soap\Request;

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
class CheckGalConfigRequest extends Request implements AdminAttrs
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
     * 
     * @param  LimitedQuery $query
     * @param  string $action
     * @param  array  $attrs
     * @return self
     */
    public function __construct(?LimitedQuery $query = NULL, ?string $action = NULL, array $attrs = [])
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
     * Sets Exchange CheckGalConfig
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
     * Gets Exchange CheckGalConfig
     *
     * @return LimitedQuery
     */
    public function getQuery(): ?LimitedQuery
    {
        return $this->query;
    }

    /**
     * Gets action
     *
     * @return string
     */
    public function getAction(): ?string
    {
        return $this->action;
    }

    /**
     * Sets action
     *
     * @param  string $action
     * @return self
     */
    public function setAction(string $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof CheckGalConfigEnvelope)) {
            $this->envelope = new CheckGalConfigEnvelope(
                new CheckGalConfigBody($this)
            );
        }
    }
}
