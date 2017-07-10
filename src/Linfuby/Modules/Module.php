<?php

namespace Linfuby\Modules;


use PHPixie\Framework\Builder;

abstract class Module
{
    /**
     * @var Builder
     */
    protected $frameworkBuilder;
    /**
     * @var array
     */
    protected $data;

    /**
     * Module constructor.
     *
     * @param Builder $frameworkBuilder
     * @param array $data
     */
    public function __construct(Builder $frameworkBuilder, array $data)
    {
        $this->frameworkBuilder = $frameworkBuilder;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public abstract function render();

}
