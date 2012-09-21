<?php
/**
 * GN2_Devito - Main maintenance class
 *
 * @category GN2_Devito
 * @package  GN2_Devito
 * @author   Christoph Stäblein <cs@gn2-netwerk.de>
 * @author   Dave Holloway <dh@gn2-netwerk.de>
 * @license  GNU General Public License, version 2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version  Release: <package_version>
 * @link     http://www.gn2-netwerk.de
 */
class GN2_Devito_Tools
{
    public static $presets = array();
    
    /**
     * looplink;
     * Automatically symlink every file in a specified folder
     * within the module folder to a file with the same path
     * in the root OXID directory.
     * 
     * @param string $dir Parent directory to looplink
     * 
     * @return void
     * 
     */
    function looplink($dir = '')
    {
        if ($handle = opendir($dir)) {
            $files = array();

            $me = dirname(__FILE__);

            while (false !== ($file = readdir($handle))) {
                $path = $dir . '/' . $file;
                if (filetype($path) == "dir" && $file != "." && $file != "..") {
                    self::looplink($path);
                } else if ($file != "." && $file != ".." && $file != ".htaccess") {
                    $destination = str_replace($me . '/', '', $path);

                    $source = 'modules/'.basename(dirname(__FILE__)).'/' . $destination;

                    $shifts = str_repeat('../', substr_count($source, '/') - 2);

                    $create = false;
                    if (file_exists($destination)) {
                        if (linkinfo($destination) == -1) {
                            unlink($destination);
                            $create = true;
                        }
                    } else {
                        $create = true;
                    }
                    if ($create) {
                        @symlink($shifts . $source, $destination);
                    }
                }
            }
            closedir($handle);
        }
    }
    
    function getBaseDir()
    {
        return dirname(__FILE__);
    }

}//end class

$path = dirname(__FILE__);
if (strpos(getcwd(), '/admin') === false) {
    include_once dirname(__FILE__).'/presets.php';
    GN2_Devito_Tools::looplink($path.'/core');
    //GN2_Devito_Tools::looplink($path.'/admin');
    //GN2_Devito_Tools::looplink($path.'/out');
    //GN2_Devito_Tools::looplink($path.'/views');
}

if (array_key_exists('devito', $_REQUEST)) {
    include_once dirname(__FILE__).'/lib/devito.php';
    die();
}

class GN2_Devito_OxOutput extends GN2_Devito_OxOutput_parent
{
}