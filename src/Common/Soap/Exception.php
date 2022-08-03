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

use Zimbra\Common\Struct\SoapFaultInterface;

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
     * @var SoapFaultInterface
     */
    private SoapFaultInterface $soapFault;

    /**
     * Constructor
     * 
     * @param SoapFaultInterface $soapFault
     * @param int $code
     */
    public function __construct(SoapFaultInterface $soapFault, int $code = 0)
    {
        parent::__construct($soapFault->faultString(), $code);
        $this->soapFault = $soapFault;
    }

    /**
     * {@inheritdoc}
     */
    public function getSoapFault(): SoapFaultInterface
    {
        return $this->soapFault;
    }
}
