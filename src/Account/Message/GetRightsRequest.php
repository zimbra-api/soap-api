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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Account\Struct\Right;
use Zimbra\Soap\Request;

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
 * @AccessType("public_method")
 * @XmlRoot(name="GetRightsRequest")
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
    private $aces;

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
        $this->aces = [];
        foreach ($aces as $ace) {
            if ($ace instanceof Right) {
                $this->aces[] = $ace;
            }
        }
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
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetRightsEnvelope)) {
            $this->envelope = new GetRightsEnvelope(
                new GetRightsBody($this)
            );
        }
    }
}
