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
 * Table tl_undo
 */
//$GLOBALS['TL_DCA']['tl_undo']['list']['operations']['undo']['href'] = 'act=edit';
//$GLOBALS['TL_DCA']['tl_undo']['list']['operations']['undo']['button_callback'][] = array('tl_undo_TemplateBackup', 'undoButtonCallback');
//$GLOBALS['TL_DCA']['tl_undo']['config']['onundo_callback'][] = array('tl_undo_TemplateBackup', 'restoreTemplate');


/**
 * Class tl_undo_TemplateBackup
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * PHP version 5
 * @copyright  Cliff Parnitzky 2016-2016
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_undo_TemplateBackup extends Backend
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
  public function restoreTemplate($table, $row, $dc)
  {
    //echo $table;
  }
  
  /**
	 * Return the edit article button
	 *
	 * @param array  $row
	 * @param string $href
	 * @param string $label
	 * @param string $title
	 * @param string $icon
	 * @param string $attributes
	 *
	 * @return string
	 */
	public function undoButtonCallback($row, $href, $label, $title, $icon, $attributes)
	{//echo "button Callback";
//return "";
		//return 'öö<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title=".....'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> --';
	} 
}

?>