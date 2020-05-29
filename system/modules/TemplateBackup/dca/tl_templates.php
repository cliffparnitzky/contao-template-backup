<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2017 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2016-2017
 * @author     Cliff Parnitzky
 * @package    TemplateBackup
 * @license    LGPL
 */

/**
 * Table tl_templates
 */
$GLOBALS['TL_DCA']['tl_templates']['config']['ondelete_callback'][] = array('tl_templates_TemplateBackup', 'backupTemplate');

/**
 * Class tl_templates_TemplateBackup
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * PHP version 5
 * @copyright  Cliff Parnitzky 2016-2016
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_templates_TemplateBackup extends Backend
{
  /**
   * Import the back end user object
   */
  public function __construct()
  {
    parent::__construct();
    $this->import('BackendUser', 'User');
  }

  /**
   * Update stock when deleting the order item
   * @param object
   */
  public function backupTemplate($source, $dc)
  {
    $completePath = TL_ROOT . "/" . $source;
    
    if (is_dir($completePath))
    {
      $command = 'rm -rf '.$source;
      $data[$dc->table][$source] = array('path' => $source, 'type' => 'folder');
      
      $this->recursiveScan($completePath, $data, $dc->table);
    }
    else
    {
      $command = 'rm -f '.$source;
      $data[$dc->table][$source] = array('path' => $source, 'type' => 'file', 'content' => $this->getFileContent($completePath));
    }
    
    $this->Database->prepare("INSERT INTO tl_undo (pid, tstamp, fromTable, query, affectedRows, data) VALUES (?, ?, ?, ?, ?, ?)")
                   ->execute($this->User->id, time(), $dc->table, $command, count($data), serialize($data));
  }
  
  private function recursiveScan($dir, &$data, $strTable)
  {
    $tree = glob(rtrim($dir, '/') . '/*');
    if (is_array($tree))
    {
      foreach($tree as $source)
      {
        $shortenedPath = substr($source, strlen(TL_ROOT . "/"));
        
        if (is_dir($source))
        {
          $data[$strTable][$shortenedPath] = array('path' => $shortenedPath, 'type' => 'folder');
          $this->recursiveScan($source, $data, $strTable);
        }
        else
        {
          $data[$strTable][$shortenedPath] = array('path' => $shortenedPath, 'type' => 'file', 'content' => $this->getFileContent($source));
        }
      }
    }
  }
  
  private function getFileContent($filePath)
  {
    return file_get_contents($filePath, FILE_USE_INCLUDE_PATH);
  }
}

?>