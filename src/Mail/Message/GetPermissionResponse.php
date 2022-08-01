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
use Zimbra\Mail\Struct\AccountACEInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetPermissionResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetPermissionResponse implements SoapResponseInterface
{
    /**
     * Account ACE information
     * 
     * @Accessor(getter="getAces", setter="setAces")
     * @Type("array<Zimbra\Mail\Struct\AccountACEInfo>")
     * @XmlList(inline=true, entry="ace", namespace="urn:zimbraMail")
     */
    private $aces = [];

    /**
     * Constructor method for GetPermissionResponse
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
     * @param  AccountACEInfo $ace
     * @return self
     */
    public function addAce(AccountACEInfo $ace): self
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
        $this->aces = array_filter($aces, static fn ($ace) => $ace instanceof AccountACEInfo);
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
}
