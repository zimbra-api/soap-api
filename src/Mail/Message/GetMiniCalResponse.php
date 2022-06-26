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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Mail\Struct\MiniCalError;
use Zimbra\Soap\ResponseInterface;

/**
 * GetMiniCalResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyinstance © 2013-present by Nguyen Van Nguyen.
 */
class GetMiniCalResponse implements ResponseInterface
{
    /**
     * Matching busy dates in format : yyyymmdd
     * 
     * @Accessor(getter="getBusyDates", setter="setBusyDates")
     * @SerializedName("date")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="date", namespace="urn:zimbraMail")
     */
    private $busyDates = [];

    /**
     * Error for each calendar folder that couldn't be accessed
     * 
     * @Accessor(getter="getErrors", setter="setErrors")
     * @SerializedName("error")
     * @Type("array<Zimbra\Mail\Struct\MiniCalError>")
     * @XmlList(inline=true, entry="error", namespace="urn:zimbraMail")
     */
    private $errors = [];

    /**
     * Constructor method for GetMiniCalResponse
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
     * Add a busy date
     *
     * @param  string $date
     * @return self
     */
    public function addBusyDate(string $date): self
    {
        $date = trim($date);
        if (!empty($date) && !in_array($date, $this->busyDates)) {
            $this->busyDates[] = $date;
        }
        return $this;
    }

    /**
     * Sets busy dates
     *
     * @param  array $dates busyDates
     * @return self
     */
    public function setBusyDates(array $busyDates): self
    {
        $this->busyDates = array_unique($busyDates);
        return $this;
    }

    /**
     * Gets busy dates
     *
     * @return array
     */
    public function getBusyDates(): array
    {
        return $this->busyDates;
    }

    /**
     * Add error
     *
     * @param  MiniCalError $error
     * @return self
     */
    public function addError(MiniCalError $error): self
    {
        $this->errors[] = $error;
        return $this;
    }

    /**
     * Sets errors
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
     * Gets errors
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
