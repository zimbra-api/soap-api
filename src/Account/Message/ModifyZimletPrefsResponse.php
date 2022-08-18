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
use Zimbra\Common\Struct\SoapResponse;

/**
 * ModifyZimletPrefsResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyZimletPrefsResponse extends SoapResponse
{
    /**
     * Zimlets
     * 
     * @Accessor(getter="getZimlets", setter="setZimlets")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="zimlet", namespace="urn:zimbraAccount")
     * 
     * @var array
     */
    #[Accessor(getter: 'getZimlets', setter: 'setZimlets')]
    #[Type('array<string>')]
    #[XmlList(inline: true, entry: 'zimlet', namespace: 'urn:zimbraAccount')]
    private $zimlets = [];

    /**
     * Constructor
     * 
     * @param  array $zimlets
     * @return self
     */
    public function __construct(array $zimlets = [])
    {
        $this->setZimlets($zimlets);
    }

    /**
     * Get zimlets
     *
     * @return array
     */
    public function getZimlets()
    {
        return $this->zimlets;
    }

    /**
     * Set zimlets
     *
     * @param  array $zimlets
     * @return self
     */
    public function setZimlets(array $zimlets)
    {
        $this->zimlets = array_unique(array_map(static fn ($zimlet) => trim($zimlet), $zimlets));
        return $this;
    }
}
