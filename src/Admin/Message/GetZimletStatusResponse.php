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
use Zimbra\Admin\Struct\ZimletStatusCos;
use Zimbra\Admin\Struct\ZimletStatusParent;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetZimletStatusResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetZimletStatusResponse extends SoapResponse
{
    /**
     * Zimlet information
     * 
     * @var ZimletStatusParent
     */
    #[Accessor(getter: 'getZimlets', setter: 'setZimlets')]
    #[SerializedName(name: 'zimlets')]
    #[Type(name: ZimletStatusParent::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $zimlets;

    /**
     * Class Of Service (COS) Information
     * 
     * @var array
     */
    #[Accessor(getter: 'getCoses', setter: 'setCoses')]
    #[Type(name: 'array<Zimbra\Admin\Struct\ZimletStatusCos>')]
    #[XmlList(inline: true, entry: 'cos', namespace: 'urn:zimbraAdmin')]
    private $coses = [];

    /**
     * Constructor
     *
     * @param ZimletStatusParent $zimlets
     * @param array $coses
     * @return self
     */
    public function __construct(?ZimletStatusParent $zimlets = NULL, array $coses = [])
    {
        $this->setCoses($coses);
        if ($zimlets instanceof ZimletStatusParent) {
            $this->setZimlets($zimlets);
        }
    }

    /**
     * Get the zimlets.
     *
     * @return ZimletStatusParent
     */
    public function getZimlets(): ?ZimletStatusParent
    {
        return $this->zimlets;
    }

    /**
     * Set the zimlets.
     *
     * @param  ZimletStatusParent $zimlets
     * @return self
     */
    public function setZimlets(ZimletStatusParent $zimlets): self
    {
        $this->zimlets = $zimlets;
        return $this;
    }

    /**
     * Set coses
     *
     * @param  array $coses
     * @return self
     */
    public function setCoses(array $coses): self
    {
        $this->coses = array_filter($coses, static fn ($cos) => $cos instanceof ZimletStatusCos);
        return $this;
    }

    /**
     * Get coses
     *
     * @return array
     */
    public function getCoses(): array
    {
        return $this->coses;
    }
}
