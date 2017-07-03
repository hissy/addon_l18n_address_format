<?php

namespace C5j\Localization\Service\Address;

use CommerceGuys\Addressing\Formatter\DefaultFormatter;
use CommerceGuys\Addressing\Model\Address;
use CommerceGuys\Addressing\Repository\AddressFormatRepository;
use CommerceGuys\Addressing\Repository\CountryRepository;
use CommerceGuys\Addressing\Repository\SubdivisionRepository;
use Concrete\Core\Entity\Attribute\Value\Value\AddressValue;
use Concrete\Core\Localization\Localization;

class Formatter
{
    /** @var DefaultFormatter $formatter */
    private $formatter;
    /** @var Address $address */
    private $address;

    /**
     * Formatter constructor.
     * @param AddressFormatRepository $addressFormatRepository
     * @param CountryRepository $countryRepository
     * @param SubdivisionRepository $subdivisionRepository
     * @param Localization $localization
     * @param array $options
     */
    public function __construct(AddressFormatRepository $addressFormatRepository, CountryRepository $countryRepository, SubdivisionRepository $subdivisionRepository, Localization $localization, $options = [])
    {
        $this->formatter = new DefaultFormatter($addressFormatRepository, $countryRepository, $subdivisionRepository, $localization->getLocale(), $options);
        $this->address = new Address();
        $this->address = $this->address->withLocale($localization->getLocale());
    }

    /**
     * @param AddressValue $addressValue
     * @return string
     */
    public function format(AddressValue $addressValue)
    {
        $address = $this->address
            ->withCountryCode($addressValue->getCountry())
            ->withAdministrativeArea($addressValue->getFullStateProvince())
            ->withLocality($addressValue->getCity())
            ->withPostalCode($addressValue->getPostalCode())
            ->withAddressLine1($addressValue->getAddress1())
            ->withAddressLine2($addressValue->getAddress2());

        return $this->formatter->format($address);
    }
}
