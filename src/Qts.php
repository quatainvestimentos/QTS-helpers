<?php

namespace QuataInvestimentos;

use QuataInvestimentos\QtsApi;
use QuataInvestimentos\QtsHelpers;
use QuataInvestimentos\QtsUsers;
use QuataInvestimentos\QtsEs512;
use QuataInvestimentos\QiTech;

/**
 * V01 Integration
 */

use QuataInvestimentos\V01\QtsV01;
use QuataInvestimentos\V01\InstructionController;
use QuataInvestimentos\V01\RemittanceController;
use QuataInvestimentos\V01\UploadController;
use QuataInvestimentos\V01\DischargeController;

class Qts {
    use QtsApi,
    QtsHelpers,
    QtsUsers,
    QtsEs512,
    QiTech,
    QtsV01,
    InstructionController,
    RemittanceController,
    UploadController,
    DischargeController;
}