<?php 

namespace QuataInvestimentos\Permissions;

use QuataInvestimentos\Permissions\FileNavigator\Roles;

trait FileNavigator 
{

    public static function getPermissions($role, $profile){

        switch($role) {
            case md5('ADMIN'): return Roles::getAdminPermissions($profile); break;
            case md5('ACQUISITION'): return Roles::getAcquisitionPermissions($profile); break;
            case md5('BACKOFFICE'): return Roles::getBackofficePermissions($profile); break;
            case md5('CHECKING'): return Roles::getCheckingPermissions($profile); break;
            case md5('COMMERCIAL'): return Roles::getCommercialPermissions($profile); break;
            case md5('CREDIT'): return Roles::getCreditPermissions($profile); break;
            case md5('DEVELOPER'): return Roles::getDeveloperPermissions($profile); break;
            case md5('DIGITAL'): return Roles::getDigitalPermissions($profile); break;
            case md5('FINANCIAL'): return Roles::getFinancialPermissions($profile); break;
            case md5('GRO'): return Roles::getGroPermissions($profile); break;
            case md5('HUMAN_RESOURCES'): return Roles::getHumanResourcesPermissions($profile); break;
            case md5('LEGAL'): return Roles::getLegalPermissions($profile); break;
            case md5('MIDDLE'): return Roles::getMiddlePermissions($profile); break;
            case md5('MOP'): return Roles::getMopPermissions($profile); break;
            case md5('STRUCTURING'): return Roles::getStructuringPermissions($profile); break;
            default: return [];
        }
    }

    public static function mergePermission($array1, $array2){
        $mergedArray = $array1;

        foreach ($array2 as $key => $value) {
            if (array_key_exists($key, $mergedArray)) {
                if (is_array($value)) {
                    $mergedArray[$key] = array_unique(array_merge($mergedArray[$key], $value));
                } else {
                    $mergedArray[$key][] = $value;
                    $mergedArray[$key] = array_unique($mergedArray[$key]);
                }
            } else {
                $mergedArray[$key] = $value;
            }
        }

        return $mergedArray;
    }

    public static function hasAccess($path, $permissions) {
        $allowed = false;
    
        foreach ($permissions as $permission) {
   
            if ($permission[0] == '-') {
                $bloked_dir = str_replace(" ", "", substr($permission, 1));
                if ($path == $bloked_dir) {
                    return false;
                }
            } else if ($permission == '*') {
                $allowed = true;
            } else if ($path == $permission) {
                $allowed = true;
            } 
        }
    
        return $allowed;
    }

    public static function filterContentByPermissions($perms, $content) {
        $currentServer = $content['current_server'];
        $currentPath = $content['path'];
        $filteredFiles = [];
        $filteredFolders = [];
    
        if (isset($perms[$currentServer])) {
            foreach ($content['files'] as $file) {
                if($currentPath != null){
                    $filePath = $currentPath . '/' . $file;
                }else{
                    $filePath = $file;
                }
    
                if (self::hasAccess($filePath, $perms[$currentServer])) {
                    $filteredFiles[] = $file;
                }
            }
    
            foreach ($content['folders'] as $folder) {
                if($currentPath != null){
                    $folderPath = $currentPath . '/' . $folder;
                }else{
                    $folderPath = $folder;
                }

                if (self::hasAccess($folderPath, $perms[$currentServer])) {
                    $filteredFolders[] = $folder;
                }
            }
        }

        $content['files'] = $filteredFiles;
        $content['folders'] = $filteredFolders;
    
        return $content;
    }

}