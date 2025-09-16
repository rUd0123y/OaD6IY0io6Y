<?php
// 代码生成时间: 2025-09-16 14:14:37
 * It moves files into subdirectories based on their extensions.
 *
 * @author Your Name
 * @version 1.0
 */

require_once 'vendor/autoload.php';

use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

class FolderStructureOrganizer
{
    private $sourceDirectory;
    private $filesystem;

    /**
     * Constructor
     *
     * @param string $sourceDirectory The source directory to organize
     */
    public function __construct($sourceDirectory)
    {
        $this->sourceDirectory = $sourceDirectory;
        $this->filesystem = new Filesystem();
    }

    /**
     * Organizes the folder structure by moving files into subdirectories based on their extensions.
     *
     * @return void
     */
    public function organize()
    {
        $finder = new Finder();
        $finder->files()->in($this->sourceDirectory);

        foreach ($finder as $file) {
            $extension = $file->getExtension();
            $targetDir = $this->sourceDirectory . '/' . $extension;

            // Create the target directory if it does not exist
            if (!$this->filesystem->exists($targetDir)) {
                $this->filesystem->mkdir($targetDir);
            }

            // Move the file to the target directory
            $this->filesystem->move($file->getRealPath(), $targetDir . '/' . $file->getFilename(), true);
        }
    }
}

// Usage example
try {
    $organizer = new FolderStructureOrganizer('/path/to/your/directory');
    $organizer->organize();
    echo "Folder structure organized successfully.\
";
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage() . "\
";
}
