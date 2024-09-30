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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Account\Struct\Right;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetRightsRequest extends SoapRequest
{
    /**
     * Specify Access Control Entries to return
     *
     * @var array
     */
    #[Accessor(getter: "getAces", setter: "setAces")]
    #[Type("array<Zimbra\Account\Struct\Right>")]
    #[XmlList(inline: true, entry: "ace", namespace: "urn:zimbraAccount")]
    private $aces = [];

    /**
     * Constructor
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
        $this->aces = array_filter(
            $aces,
            static fn($ace) => $ace instanceof Right
        );
        return $this;
    }

    /**
     * Get aces
     *
     * @return array
     */
    public function getAces(): array
    {
        return $this->aces;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetRightsEnvelope(new GetRightsBody($this));
    }
}
