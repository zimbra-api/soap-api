<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Mail\Struct\Right;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * GetPermissionRequest class
 * Get account level permissions
 * If no <ace> elements are provided, all ACEs are returned in the response.
 * If <ace> elements are provided, only those ACEs with specified rights are returned in the response.
 * Note: to be deprecated in Zimbra 9.  Use zimbraAccount GetRights instead.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetPermissionRequest extends Request
{
    /**
     * Specification of rights
     * 
     * @Accessor(getter="getAces", setter="setAces")
     * @Type("array<Zimbra\Mail\Struct\Right>")
     * @XmlList(inline=true, entry="ace", namespace="urn:zimbraMail")
     */
    private $aces = [];

    /**
     * Constructor method for GetPermissionRequest
     *
     * @param  array $aces
     * @return self
     */
    public function __construct(array $aces = [])
    {
        $this->setAces($aces);
    }

    /**
     * Add a ace
     *
     * @param  Right $ace
     * @return self
     */
    public function addAce(Right $ace): self
    {
        $this->aces[] = $ace;
        return $this;
    }

    /**
     * Set aces
     *
     * @param  array $aces
     * @return self
     */
    public function setAces(array $aces): self
    {
        $this->aces = array_filter($aces, static fn ($ace) => $ace instanceof Right);
        return $this;
    }

    /**
     * Gets aces
     *
     * @return array
     */
    public function getAces(): array
    {
        return $this->aces;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetPermissionEnvelope(
            new GetPermissionBody($this)
        );
    }
}