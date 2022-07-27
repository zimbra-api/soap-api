<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Soap;

/**
 * Exception class.
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Soap
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Exception extends \RuntimeException implements ExceptionInterface
{
    /**
     * Soap fault
     * 
     * @var Fault
     */
    private Fault $soapFault;

    /**
     * Constructor
     * 
     * @param string $serviceUrl
     */
    public function __construct(Fault $soapFault)
    {
        parent::__construct($soapFault->faultString());
        $this->getSoapFault = $soapFault;
    }

    /**
     * {@inheritdoc}
     */
    public function getSoapFault(): Fault
    {
        return $this->getSoapFault;
    }
}