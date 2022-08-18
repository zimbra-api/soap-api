<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};

/**
 * InviteTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class InviteTest extends FilterTest
{
    /**
     * Methods
     * 
     * @var array
     */
    #[Accessor(getter: 'getMethods', setter: 'setMethods')]
    #[Type('array<string>')]
    #[XmlList(inline: true, entry: 'method', namespace: 'urn:zimbraMail')]
    private $methods;

    /**
     * Constructor
     * 
     * @param int $index
     * @param bool $negative
     * @param array $methods
     * @return self
     */
    public function __construct(
        ?int $index = NULL,
        ?bool $negative = NULL,
        array $methods = []
    )
    {
    	parent::__construct($index, $negative);
        $this->setMethods($methods);
    }

    /**
     * Add a method
     *
     * @param  string $method
     * @return self
     */
    public function addMethod(string $method): self
    {
        $method = trim($method);
        if (!empty($method) && !in_array($method, $this->methods)) {
            $this->methods[] = $method;
        }
        return $this;
    }

    /**
     * Get methods
     *
     * @return array
     */
    public function getMethods(): ?array
    {
        return $this->methods;
    }

    /**
     * Set methods
     *
     * @param  array $methods
     * @return self
     */
    public function setMethods(array $methods)
    {
        $this->methods = [];
        foreach ($methods as $method) {
            $this->addMethod($method);
        }
        return $this;
    }
}
