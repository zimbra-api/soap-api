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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\AdminZimlets;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAdminExtensionZimletsResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAdminExtensionZimletsResponse")
 */
class GetAdminExtensionZimletsResponse implements ResponseInterface
{
    /**
     * Information about Admin Extension Zimlets
     * @Accessor(getter="getAdminZimlets", setter="setAdminZimlets")
     * @SerializedName("zimlets")
     * @Type("Zimbra\Admin\Struct\AdminZimlets")
     * @XmlElement
     */
    private $zimlets;

    /**
     * Constructor method for GetAdminExtensionZimletsResponse
     * @param AdminZimlets $zimlets
     * @return self
     */
    public function __construct(AdminZimlets $zimlets)
    {
        $this->setAdminZimlets($zimlets);
    }

    /**
     * Sets zimlets
     *
     * @param AdminZimlets $zimlets
     * @return self
     */
    public function setAdminZimlets(AdminZimlets $zimlets): self
    {
        $this->zimlets = $zimlets;
        return $this;
    }

    /**
     * Gets zimlets
     *
     * @return AdminZimlets
     */
    public function getAdminZimlets(): AdminZimlets
    {
        return $this->zimlets;
    }
}
