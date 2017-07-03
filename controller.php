<?php
namespace Concrete\Package\L18nAddressFormat;

use Concrete\Core\Package\Package;

class Controller extends Package
{
    /**
     * @var string Package handle.
     */
    protected $pkgHandle = 'l18n_address_format';

    /**
     * @var string Required concrete5 version.
     */
    protected $appVersionRequired = '8.0';

    /**
     * @var string Package version.
     */
    protected $pkgVersion = '0.1';
    
    /**
     * @var array Array of location -> namespace autoloader entries for the package.
     */
    protected $pkgAutoloaderRegistries = ['src/C5j/Localization/Service/Address' => '\C5j\Localization\Service\Address'];
    
    protected $pkgAutoloaderMapCoreExtensions = true;
    
    /**
     * Returns the translated name of the package.
     *
     * @return string
     */
    public function getPackageName()
    {
        return t('Localized Address Format');
    }

    /**
     * Returns the translated package description.
     *
     * @return string
     */
    public function getPackageDescription()
    {
        return t('A helper class to print Localized Address from AddressValue object');
    }

    /**
     * Install process of the package.
     */
    public function install()
    {
        if (!file_exists($this->getPackagePath().'/vendor/autoload.php')) {
            throw new Exception(t('Required libraries are not found.'));
        }
        $this->registerAutoload();
        $pkg = parent::install();
    }

    /**
     * Register autoloader.
     */
    protected function registerAutoload()
    {
        require $this->getPackagePath().'/vendor/autoload.php';
    }

    public function on_start()
    {
        $this->registerAutoload();
    }
}
