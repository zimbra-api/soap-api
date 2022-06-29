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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList};
use Zimbra\Admin\Struct\AdminZimletInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAdminExtensionZimletsResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAdminExtensionZimletsResponse implements ResponseInterface
{
    /**
     * Admin zimlet info
     * 
     * @Accessor(getter="getZimlets", setter="setZimlets")
     * @SerializedName("zimlets")
     * @Type("array<Zimbra\Admin\Struct\AdminZimletInfo>")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @XmlList(inline=false, entry="zimlet", namespace="urn:zimbraAdmin")
     */
    private $zimlets = [];

    /**
     * Constructor method for GetAdminExtensionZimletsResponse
     *
     * @param array $zimlets
     * @return self
     */
    public function __construct(array $zimlets = [])
    {
        $this->setZimlets($zimlets);
    }

    /**
     * Add a zimlet
     *
     * @param  AdminZimletInfo $zimlet
     * @return self
     */
    public function addZimlet(AdminZimletInfo $zimlet): self
    {
        $this->zimlets[] = $zimlet;
        return $this;
    }

    /**
     * Sets zimlet sequence
     *
     * @param  array $zimlets
     * @return self
     */
    public function setZimlets(array $zimlets): self
    {
        $this->zimlets = array_filter($zimlets, static fn ($zimlet) => $zimlet instanceof AdminZimletInfo);
        return $this;
    }

    /**
     * Gets zimlet sequence
     *
     * @return array
     */
    public function getZimlets(): array
    {
        return $this->zimlets;
    }
}
