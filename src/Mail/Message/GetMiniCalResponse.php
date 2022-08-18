<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Mail\Struct\MiniCalError;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetMiniCalResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyinstance © 2020-present by Nguyen Van Nguyen.
 */
class GetMiniCalResponse extends SoapResponse
{
    /**
     * Matching busy dates in format : yyyymmdd
     * 
     * @var array
     */
    #[Accessor(getter: 'getBusyDates', setter: 'setBusyDates')]
    #[Type('array<string>')]
    #[XmlList(inline: true, entry: 'date', namespace: 'urn:zimbraMail')]
    private $busyDates = [];

    /**
     * Error for each calendar folder that couldn't be accessed
     * 
     * @var array
     */
    #[Accessor(getter: 'getErrors', setter: 'setErrors')]
    #[Type('array<Zimbra\Mail\Struct\MiniCalError>')]
    #[XmlList(inline: true, entry: 'error', namespace: 'urn:zimbraMail')]
    private $errors = [];

    /**
     * Constructor
     *
     * @param  array $busyDates
     * @param  array $errors
     * @return self
     */
    public function __construct(array $busyDates = [], array $errors = [])
    {
        $this->setBusyDates($busyDates)
             ->setErrors($errors);
    }

    /**
     * Set busy dates
     *
     * @param  array $busyDates
     * @return self
     */
    public function setBusyDates(array $busyDates): self
    {
        $this->busyDates = array_unique($busyDates);
        return $this;
    }

    /**
     * Get busy dates
     *
     * @return array
     */
    public function getBusyDates(): array
    {
        return $this->busyDates;
    }

    /**
     * Set errors
     *
     * @param  array $errors
     * @return self
     */
    public function setErrors(array $errors): self
    {
        $this->errors = array_filter($errors, static fn ($error) => $error instanceof MiniCalError);
        return $this;
    }

    /**
     * Get errors
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
