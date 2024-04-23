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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class TestDataSource
{
    /**
     * 0 if data source test failed, 1 if test succeeded
     * 
     * @var int
     */
    #[Accessor(getter: 'getSuccess', setter: 'setSuccess')]
    #[SerializedName('success')]
    #[Type('int')]
    #[XmlAttribute]
    private $success;

    /**
     * error message passed by DatImport::test method of the datasource being tested
     * 
     * @var string
     */
    #[Accessor(getter: 'getError', setter: 'setError')]
    #[SerializedName('error')]
    #[Type('string')]
    #[XmlAttribute]
    private $error;

    /**
     * Constructor
     * 
     * @param int $success
     * @param string $error
     * @return self
     */
    public function __construct(
        int $success = 0, ?string $error = null
    )
    {
        $this->setSuccess($success);
        if (null !== $error) {
            $this->setError($error);
        }
    }

    /**
     * Get success
     *
     * @return int
     */
    public function getSuccess(): int
    {
        return $this->success;
    }

    /**
     * Set success
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
     * Get the error
     *
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * Set the error
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
