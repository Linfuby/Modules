<?php

namespace Linfuby;

use PHPixie\Framework\Builder;
use PHPixie\Template\Extensions\Extension;

class Modules implements Extension
{
    /** @var Builder */
    protected $frameworkBuilder;

    /**
     * Modules constructor.
     *
     * @param Builder $frameworkBuilder
     */
    public function __construct(Builder $frameworkBuilder)
    {
        $this->frameworkBuilder = $frameworkBuilder;
    }


    /**
     * @return string
     */
    public function name()
    {
        return 'modules';
    }

    /**
     * @return array
     */
    public function methods()
    {
        return [
            'position' => 'position',
            'createModule' => 'createModule',
        ];
    }

    /**
     * @return array
     */
    public function aliases()
    {
        return [];
    }

    /**
     * @param string $position
     *
     * @return array
     */
    public function position(string $position): array
    {
        $modules = [];
        $repository = $this->frameworkBuilder->components()->orm()->repository('module');
        /** @var \PHPixie\ORM\Wrappers\Type\Database\Query $query */
        $query = $repository->query();
        $query->where('position', $position);
        $query->orderAscendingBy('ordering');
        /** @var \PHPixie\ORM\Wrappers\Type\Database\Entity $module */
        foreach ($query->find() as $module) {
            $this->createModule((array)$module->asObject());
        }
        return $modules;
    }

    /**
     * @param array $module
     *
     * @return Modules\Module
     */
    public function createModule(array $module): Modules\Module
    {
        if (empty($module['type'])) {
            $module['type'] = 'Linfuby\Modules\Html';
        }
        $className = $module['type'];
        if (!class_exists($className)) {
            $className = get_class($this) . '\Html';
        }

        return new $className($this->frameworkBuilder, $module);
    }

}
