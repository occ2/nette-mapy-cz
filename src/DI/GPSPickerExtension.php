<?php declare(strict_types=1);

namespace MapyCZ\DI;

use Nette\DI\CompilerExtension;
use Nette\PhpGenerator\ClassType;

/**
 * Class GPSPickerExtension
 * @package MapyCZ\DI
 */
class GPSPickerExtension extends CompilerExtension
{
    /**
     * @param ClassType $class
     */
    public function afterCompile(ClassType $class)
    {
        $initialize = $class->methods['initialize'];
        $initialize->addBody(
            'MapyCZ\\Form\\GPSPicker::register();'
        );
    }
}
