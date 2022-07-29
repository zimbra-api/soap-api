<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};

/**
 * ZimletStatusParent struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ZimletStatusParent
{
    /**
     * Status information
     * 
     * @Accessor(getter="getZimlets", setter="setZimlets")
     * @Type("array<Zimbra\Admin\Struct\ZimletStatus>")
     * @XmlList(inline=true, entry="zimlet", namespace="urn:zimbraAdmin")
     */
    private $zimlets = [];

    /**
     * Constructor method for ZimletStatusParent
     *
     * @param  array $zimlets
     * @return self
     */
    public function __construct(array $zimlets = [])
    {
        $this->setZimlets($zimlets);
    }

    /**
     * Add a zimlet
     *
     * @param  ZimletStatus $zimlet
     * @return self
     */
    public function addZimlet(ZimletStatus $zimlet): self
    {
        $this->zimlets[] = $zimlet;
        return $this;
    }

    /**
     * Set zimlets
     *
     * @param  array $zimlets
     * @return self
     */
    public function setZimlets(array $zimlets): self
    {
        $this->zimlets = array_filter($zimlets, static fn ($zimlet) => $zimlet instanceof ZimletStatus);
        return $this;
    }

    /**
     * Get zimlets
     *
     * @return array
     */
    public function getZimlets(): array
    {
        return $this->zimlets;
    }
}
