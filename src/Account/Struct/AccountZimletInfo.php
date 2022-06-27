<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\{ZimletConfigInfo, ZimletContextInterface, ZimletDesc, ZimletInterface};

/**
 * AccountZimletInfo class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AccountZimletInfo implements ZimletInterface
{
    /**
     * Zimlet context
     * @Accessor(getter="getZimletContext", setter="setZimletContext")
     * @SerializedName("zimletContext")
     * @Type("Zimbra\Account\Struct\AccountZimletContext")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private ?ZimletContextInterface $zimletContext = NULL;

    /**
     * Zimlet description
     * @Accessor(getter="getZimlet", setter="setZimlet")
     * @SerializedName("zimlet")
     * @Type("Zimbra\Account\Struct\AccountZimletDesc")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private ?ZimletDesc $zimlet = NULL;

    /**
     * Other elements
     * @Accessor(getter="getZimletConfig", setter="setZimletConfig")
     * @SerializedName("zimletConfig")
     * @Type("Zimbra\Account\Struct\AccountZimletConfigInfo")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private ?ZimletConfigInfo $zimletConfig = NULL;

    /**
     * Constructor method for AccountZimletInfo
     * @param AccountZimletContext $zimletContext
     * @param AccountZimletDesc $zimlet
     * @param AccountZimletConfigInfo $zimletConfig
     * @return self
     */
    public function __construct(
        ?AccountZimletContext $zimletContext = NULL,
        ?AccountZimletDesc $zimlet = NULL,
        ?AccountZimletConfigInfo $zimletConfig = NULL
    )
    {
        if ($zimletContext instanceof AccountZimletContext) {
            $this->setZimletContext($zimletContext);
        }
        if ($zimlet instanceof AccountZimletDesc) {
            $this->setZimlet($zimlet);
        }
        if ($zimletConfig instanceof AccountZimletConfigInfo) {
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
        if ($zimletContext instanceof AccountZimletContext) {
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
        if ($zimlet instanceof AccountZimletDesc) {
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
        if ($zimletConfig instanceof AccountZimletConfigInfo) {
            $this->zimletConfig = $zimletConfig;
        }
        return $this;
    }
}
