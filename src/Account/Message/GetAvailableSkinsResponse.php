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
use Zimbra\Common\Struct\{NamedElement, SoapResponse};

/**
 * GetAvailableSkinsResponse class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAvailableSkinsResponse extends SoapResponse
{
    /**
     * Information about skins
     *
     * @var array
     */
    #[Accessor(getter: "getSkins", setter: "setSkins")]
    #[Type("array<Zimbra\Common\Struct\NamedElement>")]
    #[XmlList(inline: true, entry: "skin", namespace: "urn:zimbraAccount")]
    private array $skins = [];

    /**
     * Constructor
     *
     * @param array $skins
     * @return self
     */
    public function __construct(array $skins = [])
    {
        $this->setSkins($skins);
    }

    /**
     * Set skins
     *
     * @param  array $skins
     * @return self
     */
    public function setSkins(array $skins): self
    {
        $this->skins = array_filter(
            $skins,
            static fn($skin) => $skin instanceof NamedElement
        );
        return $this;
    }

    /**
     * Get skins
     *
     * @return array
     */
    public function getSkins(): array
    {
        return $this->skins;
    }
}
