<?php

namespace QuataInvestimentos\Bank\Bradesco;

use QuataInvestimentos\Bank\Common;
use QuataInvestimentos\Bank\Bradesco\Remittance\Header;
use QuataInvestimentos\Bank\Bradesco\Remittance\Transaction1;
use QuataInvestimentos\Bank\Bradesco\Remittance\Transaction2;
use QuataInvestimentos\Bank\Bradesco\Remittance\Transaction3;
use QuataInvestimentos\Bank\Bradesco\Remittance\Transaction6;
use QuataInvestimentos\Bank\Bradesco\Remittance\Transaction7;
use QuataInvestimentos\Bank\Bradesco\Remittance\Footer;

class Remittance {
    use 
    Common,
    Header,
    Transaction1,
    Transaction2,
    Transaction3,
    Transaction6,
    Transaction7,
    Footer;
}