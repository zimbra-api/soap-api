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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAllSkinsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAllSkinsResponse implements ResponseInterface
{
    /**
     * Skins
     * 
     * @Accessor(getter="getSkins", setter="setSkins")
     * @SerializedName("skin")
     * @Type("array<Zimbra\Common\Struct\NamedElement>")
     * @XmlList(inline=true, entry="skin", namespace="urn:zimbraAdmin")
     */
    private $skins = [];

    /**
     * Constructor method for GetAllSkinsResponse
     *
     * @param array $skins
     * @return self
     */
    public function __construct(array $skins = [])
    {
        $this->setSkins($skins);
    }

    /**
     * Add a skin
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
        $this->skins = array_filter($skins, static fn ($skin) => $skin instanceof NamedElement);
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
