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
use Zimbra\Mail\Struct\AccountACEinfo;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * GrantPermissionRequest class
 * Grant account level permissions
 * GrantPermissionResponse returns permissions that are successfully granted.
 * Note: to be deprecated in Zimbra 9.  Use zimbraAccount GrantRights instead.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GrantPermissionRequest extends Request
{
    /**
     * Specify Access Control Entries (ACEs)
     * 
     * @Accessor(getter="getAces", setter="setAces")
     * @Type("array<Zimbra\Mail\Struct\AccountACEinfo>")
     * @XmlList(inline=true, entry="ace", namespace="urn:zimbraMail")
     */
    private $aces = [];

    /**
     * Constructor method for GrantPermissionRequest
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
     * @param  AccountACEinfo $ace
     * @return self
     */
    public function addAce(AccountACEinfo $ace): self
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
        $this->aces = array_filter($aces, static fn ($ace) => $ace instanceof AccountACEinfo);
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
        return new GrantPermissionEnvelope(
            new GrantPermissionBody($this)
        );
    }
}