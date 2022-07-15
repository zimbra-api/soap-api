<?php declare(strict_types=1);
/**
 * This file is version of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * TestDataSource struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class TestDataSource
{
    /**
     * 0 if data source test failed, 1 if test succeeded
     * 
     * @Accessor(getter="getSuccess", setter="setSuccess")
     * @SerializedName("success")
     * @Type("integer")
     * @XmlAttribute
     */
    private $success;

    /**
     * error message passed by DatImport::test method of the datasource being tested
     * 
     * @Accessor(getter="getError", setter="setError")
     * @SerializedName("error")
     * @Type("string")
     * @XmlAttribute
     */
    private $error;

    /**
     * Constructor method
     * 
     * @param int $success
     * @param string $error
     * @return self
     */
    public function __construct(
        int $success = 0, ?string $error = NULL
    )
    {
        $this->setSuccess($success);
        if (NULL !== $error) {
            $this->setError($error);
        }
    }

    /**
     * Gets success
     *
     * @return int
     */
    public function getSuccess(): int
    {
        return $this->success;
    }

    /**
     * Sets success
     *
     * @param  int $success
     * @return self
     */
    public function setSuccess(int $success): self
    {
        $this->success = $success;
        return $this;
    }

    /**
     * Gets the error
     *
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * Sets the error
     *
     * @param  string $error
     * @return self
     */
    public function setError(string $error): self
    {
        $this->error = $error;
        return $this;
    }
}
