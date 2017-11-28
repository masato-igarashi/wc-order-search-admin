<?php

namespace WC_Order_Search_Admin\Composer\Installers\Test;

use Composer\Installers\VgmcpInstaller;
use Composer\Package\Package;
use Composer\Composer;
class VgmcpInstallerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var VgmcpInstaller
     */
    private $installer;
    public function setUp()
    {
        $this->installer = new \WC_Order_Search_Admin\Composer\Installers\VgmcpInstaller(new \WC_Order_Search_Admin\Composer\Package\Package('NyanCat', '4.2', '4.2'), new \WC_Order_Search_Admin\Composer\Composer());
    }
    /**
     * @dataProvider packageNameInflectionProvider
     */
    public function testInflectPackageVars($type, $name, $expected)
    {
        $this->assertEquals(array('name' => $expected, 'type' => $type), $this->installer->inflectPackageVars(array('name' => $name, 'type' => $type)));
    }
    public function packageNameInflectionProvider()
    {
        return array(
            // Should keep bundle name StudlyCase
            array('vgmcp-bundle', 'user-profile', 'UserProfile'),
            array('vgmcp-bundle', 'vgmcp-bundle', 'Vgmcp'),
            array('vgmcp-bundle', 'blog', 'Blog'),
            // tests that exactly one '-bundle' is cut off
            array('vgmcp-bundle', 'some-bundle-bundle', 'SomeBundle'),
            // tests that exactly one '-theme' is cut off
            array('vgmcp-theme', 'some-theme-theme', 'SomeTheme'),
            // tests that names without '-theme' suffix stay valid
            array('vgmcp-theme', 'someothertheme', 'Someothertheme'),
            // Should keep theme name StudlyCase
            array('vgmcp-theme', 'adminlte-advanced', 'AdminlteAdvanced'),
        );
    }
}
