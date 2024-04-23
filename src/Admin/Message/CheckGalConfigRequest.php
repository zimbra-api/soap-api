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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\{AdminAttrs, AdminAttrsImplTrait, LimitedQuery};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CheckGalConfigRequest request class
 * Check Global Addressbook Configuration
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CheckGalConfigRequest extends SoapRequest implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * Query
     * 
     * @var LimitedQuery
     */
    #[Accessor(getter: 'getQuery', setter: 'setQuery')]
    #[SerializedName('query')]
    #[Type(LimitedQuery::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?LimitedQuery $query;

    /**
     * GAL action
     * 
     * @var string
     */
    #[Accessor(getter: 'getAction', setter: 'setAction')]
    #[SerializedName('action')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAdmin')]
    private $action;

    /**
     * Constructor
     * 
     * @param  LimitedQuery $query
     * @param  string $action
     * @param  array  $attrs
     * @return self
     */
    public function __construct(
        ?LimitedQuery $query = null, ?string $action = null, array $attrs = []
    )
    {
        $this->setAttrs($attrs);
        $this->query = $query;
        if (null !== $action) {
            $this->setAction($action);
        }
    }

    /**
     * Set Exchange CheckGalConfig
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
     * Get Exchange CheckGalConfig
     *
     * @return LimitedQuery
     */
    public function getQuery(): ?LimitedQuery
    {
        return $this->query;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction(): ?string
    {
        return $this->action;
    }

    /**
     * Set action
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CheckGalConfigEnvelope(
            new CheckGalConfigBody($this)
        );
    }
}
