<?php

namespace QuataInvestimentos\Bank\Singulare;

use QuataInvestimentos\Bank\Common;
use QuataInvestimentos\Bank\Singulare\Remittance\Header;
use QuataInvestimentos\Bank\Singulare\Remittance\Transaction1;
use QuataInvestimentos\Bank\Singulare\Remittance\Footer;

class Remittance {
    use 
    Common,
    Header,
    Transaction1,
    Footer;
}