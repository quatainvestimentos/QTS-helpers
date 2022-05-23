<?php

namespace QuataInvestimentos\Bank\Singulare;

use QuataInvestimentos\Bank\Common;
use QuataInvestimentos\Bank\Singulare\Remittance\Init;
use QuataInvestimentos\Bank\Singulare\Remittance\Header;
use QuataInvestimentos\Bank\Singulare\Remittance\Transaction1;
use QuataInvestimentos\Bank\Singulare\Remittance\Footer;

class Remittance {
    use 
    Common,
    Init,
    Header,
    Transaction1,
    Footer;
}