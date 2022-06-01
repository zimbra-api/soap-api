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
use Zimbra\Admin\Struct\ZimletInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAllZimletsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAllZimletsResponse implements ResponseInterface
{
    /**
     * Information on zimlets
     * 
     * @Accessor(getter="getZimlets", setter="setZimlets")
     * @SerializedName("zimlet")
     * @Type("array<Zimbra\Admin\Struct\ZimletInfo>")
     * @XmlList(inline = true, entry = "zimlet")
     */
    private $zimlets = [];

    /**
     * Constructor method for GetAllZimletsResponse
     *
     * @param array $zimlets
     * @return self
     */
    public function __construct(array $zimlets = [])
    {
        $this->setZimlets($zimlets);
    }

    /**
     * Add a zimlet information
     *
     * @param  ZimletInfo $zimlet
     * @return self
     */
    public function addZimlet(ZimletInfo $zimlet): self
    {
        $this->zimlets[] = $zimlet;
        return $this;
    }

    /**
     * Sets zimlet informations
     *
     * @param  array $zimlets
     * @return self
     */
    public function setZimlets(array $zimlets): self
    {
        $this->zimlets = [];
        foreach ($zimlets as $zimlet) {
            if ($zimlet instanceof ZimletInfo) {
                $this->zimlets[] = $zimlet;
            }
        }
        return $this;
    }

    /**
     * Gets zimlet informations
     *
     * @return array
     */
    public function getZimlets(): array
    {
        return $this->zimlets;
    }
}
