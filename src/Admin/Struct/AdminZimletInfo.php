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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Struct\{ZimletConfigInfo, ZimletContextInterface, ZimletDesc, ZimletInterface};

/**
 * AdminZimletInfo class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AdminZimletInfo implements ZimletInterface
{
    /**
     * Zimlet context
     * @Accessor(getter="getZimletContext", setter="setZimletContext")
     * @SerializedName("zimletContext")
     * @Type("Zimbra\Admin\Struct\AdminZimletContext")
     * @XmlElement
     */
    private $zimletContext;

    /**
     * Zimlet description
     * @Accessor(getter="getZimlet", setter="setZimlet")
     * @SerializedName("zimlet")
     * @Type("Zimbra\Admin\Struct\AdminZimletDesc")
     * @XmlElement
     */
    private $zimlet;

    /**
     * Other elements
     * @Accessor(getter="getZimletConfig", setter="setZimletConfig")
     * @SerializedName("zimletConfig")
     * @Type("Zimbra\Admin\Struct\AdminZimletConfigInfo")
     * @XmlElement
     */
    private $zimletConfig;

    /**
     * Constructor method for AdminZimletInfo
     * @param AdminZimletContext $zimletContext
     * @param AdminZimletDesc $zimlet
     * @param AdminZimletConfigInfo $zimletConfig
     * @return self
     */
    public function __construct(
        ?AdminZimletContext $zimletContext = NULL,
        ?AdminZimletDesc $zimlet = NULL,
        ?AdminZimletConfigInfo $zimletConfig = NULL
    )
    {
        if ($zimletContext instanceof AdminZimletContext) {
            $this->setZimletContext($zimletContext);
        }
        if ($zimlet instanceof AdminZimletDesc) {
            $this->setZimlet($zimlet);
        }
        if ($zimletConfig instanceof AdminZimletConfigInfo) {
            $this->setZimletConfig($zimletConfig);
        }
    }

    /**
     * Gets zimletContext
     *
     * @return ZimletContextInterface
     */
    public function getZimletContext(): ?ZimletContextInterface
    {
        return $this->zimletContext;
    }

    /**
     * Sets zimletContext
     *
     * @param  ZimletContextInterface $zimletContext
     * @return self
     */
    public function setZimletContext(ZimletContextInterface $zimletContext): self
    {
        if ($zimletContext instanceof AdminZimletContext) {
            $this->zimletContext = $zimletContext;
        }
        return $this;
    }

    /**
     * Gets zimlet
     *
     * @return ZimletDesc
     */
    public function getZimlet(): ?ZimletDesc
    {
        return $this->zimlet;
    }

    /**
     * Sets zimlet
     *
     * @param  ZimletDesc $zimlet
     * @return self
     */
    public function setZimlet(ZimletDesc $zimlet): self
    {
        if ($zimlet instanceof AdminZimletDesc) {
            $this->zimlet = $zimlet;
        }
        return $this;
    }

    /**
     * Gets zimletConfig
     *
     * @return ZimletConfigInfo
     */
    public function getZimletConfig(): ?ZimletConfigInfo
    {
        return $this->zimletConfig;
    }

    /**
     * Sets zimletConfig
     *
     * @param  ZimletConfigInfo $zimletConfig
     * @return self
     */
    public function setZimletConfig(ZimletConfigInfo $zimletConfig): self
    {
        if ($zimletConfig instanceof AdminZimletConfigInfo) {
            $this->zimletConfig = $zimletConfig;
        }
        return $this;
    }
}
