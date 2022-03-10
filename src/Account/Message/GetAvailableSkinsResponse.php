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
use Zimbra\Struct\NamedElement;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAvailableSkinsResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAvailableSkinsResponse implements ResponseInterface
{
    /**
     * Information about skins
     * 
     * @Accessor(getter="getSkins", setter="setSkins")
     * @SerializedName("skin")
     * @Type("array<Zimbra\Struct\NamedElement>")
     * @XmlList(inline = true, entry = "skin")
     */
    private $skins;

    /**
     * Constructor method for GetAvailableSkinsResponse
     *
     * @param array $skins
     * @return self
     */
    public function __construct(array $skins = [])
    {
        $this->setSkins($skins);
    }

    /**
     * Add skin
     *
     * @param  NamedElement $skin
     * @return self
     */
    public function addSkin(NamedElement $skin): self
    {
        $this->skins[] = $skin;
        return $this;
    }

    /**
     * Sets skins
     *
     * @param  array $skins
     * @return self
     */
    public function setSkins(array $skins): self
    {
        $this->skins = [];
        foreach ($skins as $skin) {
            if ($skin instanceof NamedElement) {
                $this->skins[] = $skin;
            }
        }
        return $this;
    }

    /**
     * Gets skins
     *
     * @return array
     */
    public function getSkins(): array
    {
        return $this->skins;
    }
}
