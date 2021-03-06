<?php

namespace Coduo\PHPMatcher\Matcher\Pattern\Expander;

use Coduo\PHPMatcher\Matcher\Pattern\PatternExpander;
use Coduo\ToString\String;

class GreaterThan implements PatternExpander
{
    /**
     * @var
     */
    private $boundary;

    /**
     * @var null|string
     */
    private $error;

    /**
     * @param $boundary
     */
    public function __construct($boundary)
    {
        if (!is_float($boundary) && !is_integer($boundary) && !is_double($boundary)) {
            throw new \InvalidArgumentException(sprintf("Boundary value \"%s\" is not a valid number.", new String($boundary)));
        }

        $this->boundary = $boundary;
    }

    /**
     * @param $value
     * @return boolean
     */
    public function match($value)
    {
        if (!is_float($value) && !is_integer($value) && !is_double($value) && !is_numeric($value)) {
            $this->error = sprintf("Value \"%s\" is not a valid number.", new String($value));
            return false;
        }

        if ($value <= $this->boundary) {
            $this->error = sprintf("Value \"%s\" is not greater than \"%s\".", new String($value), new String($this->boundary));
            return false;
        }

        return $value > $this->boundary;
    }

    /**
     * @return string|null
     */
    public function getError()
    {
        return $this->error;
    }
}
