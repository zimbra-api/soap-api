<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Account\Struct\Right;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * GetRightsRequest class
 * Get account level rights.
 * If no <ace> elements are provided, all ACEs are returned in the response.
 * If <ace> elements are provided, only those ACEs with specified rights are returned in the response.
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetRightsRequest extends Request
{
    /**
     * Specify Access Control Entries to return
     * @Accessor(getter="getAces", setter="setAces")
     * @SerializedName("ace")
     * @Type("array<Zimbra\Account\Struct\Right>")
     * @XmlList(inline = true, entry = "ace")
     */
    private $aces = [];

    /**
     * Constructor method for GetRightsRequest
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
        $this->aces = array_filter($aces, static fn($ace) => $ace instanceof Right);
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
        return new GetRightsEnvelope(
            new GetRightsBody($this)
        );
    }
}
