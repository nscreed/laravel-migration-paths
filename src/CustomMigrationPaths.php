<?php
namespace NsCreed\MigrationPath;


use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class CustomMigrationPaths
{
    protected $paths = [];

    public function __construct(array $config)
    {
        $this->paths = is_array($config['paths']) ? $config['paths'] : [];
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function getRegisteredPaths()
    {
        $paths = [];

        foreach ( $this->paths as $path ) {
            throw_unless(file_exists($path), InvalidPathException::class, $path);
            $paths = array_merge($paths, $this->getPaths($path));
        }

        return $paths;
    }

    private function getPaths($path)
    {
        $paths = [];

        $iterators = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($iterators as $iterator) {

            /** @var \SplFileInfo $iterator */

            switch ( $iterator->getType() ) {
                case 'dir':
                    $paths[] = $iterator->getRealPath();
                    break;
                case 'file':
                    $paths[] = dirname($iterator->getRealPath());
                    break;
            }
        }

        return array_unique($paths);
    }
}
