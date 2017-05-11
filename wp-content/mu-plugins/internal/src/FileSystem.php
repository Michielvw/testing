<?php
class FileSystem
{
    protected $maxScanDepth = 5;



    /**
     * Copy a file, or recursively copy a folder and its contents
     *
     * @author      Aidan Lister <aidan@php.net>
     * @version     1.0.1
     * @link        http://aidanlister.com/2004/04/recursively-copying-directories-in-php/
     *
     * @param       string   $source    Source path
     * @param       string   $dest      Destination path
     * @param       int      $permissions New folder creation permissions
     *
     * @return      bool     Returns true on success, false on failure
     */
    public function copy($source, $dest, $permissions = 0755)
    {
        // Check for symlinks
        if (is_link($source)) {
            return symlink(readlink($source), $dest);
        }

        // Simple copy for a file
        if (is_file($source)) {
            return copy($source, $dest);
        }

        // Make destination directory
        if (!is_dir($dest)) {
            mkdir($dest, $permissions);
        }

        // Loop through the folder
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            // Skip pointers
            if ($entry == '.' || $entry == '..') {
                continue;
            }

            // Deep copy directories
            $this->copy("$source/$entry", "$dest/$entry", $permissions);
        }

        // Clean up
        $dir->close();
        return true;
    }



    /**
     * Thanks for PHP Community
     * - http://php.net/manual/en/function.rmdir.php#110489
     * - http://php.net/manual/de/function.rmdir.php#98622
     *
     * @param   string  $dir    directory to be removed
     *
     * @return  bool
     */
    public function removeDir($dir)
    {
        $files = array_diff(scandir($dir), array('.','..'));

        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? rmdir("$dir/$file") : unlink("$dir/$file");
        }

        return rmdir($dir);
    }



    public function emptyDir($dir)
    {
        $files = array_diff(scandir($dir), array('.','..'));

        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? rmdir("$dir/$file") : unlink("$dir/$file");
        }
    }



    /**
     * Based on scripts by Paul Wenzel (https://github.com/pwenzel)
     * on: Recursively include all PHP files (https://gist.github.com/pwenzel/3438784)
     *
     * @param       string   $type      include/ require/ module
     * @param       string   $dir       directory to scan
     * @param       int      $depth     the depth level
     */
    protected function scanDir($type, $dir, $depth)
    {
        if ($depth > $this->maxScanDepth) return;

        $scan = glob($dir . '/*');

        foreach ($scan as $path) {
            if ($type === 'module') {
                if (is_dir($path)) {
                    $this->scanDir('module', $path, $depth + 1);
                } else {
                    $pos = strpos($path, 'autoload.php');
                    if ($pos !== false) require_once $path;
                }
            } else {
                if (preg_match('/\.php$/', $path)) {
                    if ($type === 'include') {
                        include_once $path;
                    } elseif ($type === 'require') {
                        require_once $path;
                    }
                } elseif (is_dir($path)) {
                    if ($type === 'include') {
                        $this->scanDir('include', $path, $depth + 1);
                    } elseif ($type === 'require') {
                        $this->scanDir('require', $path, $depth + 1);
                    }
                }
            }
        }
    }



    public function loadModules($dir, $maxDepth = 1)
    {
        if ($maxDepth < 1) $maxDepth = 1;

        $this->maxScanDepth = $maxDepth;
        $this->scanDir('module', $dir, 1);
    }



    public function includeAll($dir, $maxDepth = 1)
    {
        if ($maxDepth < 1) $maxDepth = 1;

        $this->maxScanDepth = $maxDepth;
        $this->scanDir('include', $dir, 1);
    }



    public function requireAll($dir, $maxDepth = 1)
    {
        if ($maxDepth < 1) $maxDepth = 1;

        $this->maxScanDepth = $maxDepth;
        $this->scanDir('require', $dir, 1);
    }
}
