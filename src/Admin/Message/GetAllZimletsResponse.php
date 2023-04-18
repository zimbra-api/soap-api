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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\ZimletInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAllZimletsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllZimletsResponse extends SoapResponse
{
    /**
     * Information on zimlets
     * 
     * @Accessor(getter="getZimlets", setter="setZimlets")
     * @Type("array<Zimbra\Admin\Struct\ZimletInfo>")
     * @XmlList(inline=true, entry="zimlet", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getZimlets', setter: 'setZimlets')]
    #[Type('array<Zimbra\Admin\Struct\ZimletInfo>')]
    #[XmlList(inline: true, entry: 'zimlet', namespace: 'urn:zimbraAdmin')]
    private $zimlets = [];

    /**
     * Constructor
     *
     * @param array $zimlets
     * @return self
     */
    public function __construct(array $zimlets = [])
    {
        $this->setZimlets($zimlets);
    }

    /**
     * Set zimlet informations
     *
     * @param  array $zimlets
     * @return self
     */
    public function setZimlets(array $zimlets): self
    {
        $this->zimlets = array_filter(
            $zimlets, static fn ($zimlet) => $zimlet instanceof ZimletInfo
        );
        return $this;
    }

    /**
     * Get zimlet informations
     *
     * @return array
     */
    public function getZimlets(): array
    {
        return $this->zimlets;
    }
}
