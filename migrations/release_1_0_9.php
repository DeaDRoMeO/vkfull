<?php

/**
*
* @package VKWigets
* @copyright (c) 2021 DeaDRoMeO ; hello-vitebsk.ru
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace deadromeo\vkfull\migrations;

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
    exit;
}

class release_1_0_9 extends \phpbb\db\migration\migration
{
public function effectively_installed()
	{
		return (isset($this->config['vk_version']) && version_compare($this->config['vk_version'], '1.0.9', '>='));
	}
static public function depends_on()
	{
		return array('\deadromeo\vkfull\migrations\release_1_0_8');
	}		
		
	public function update_data()
	{
		return array(
		array('permission.add', array('u_viewrec')),
			array('config.add', array('vk_version', '1.0.9')),
			array('if', array(
				(isset($this->config['vk_version']) && version_compare($this->config['vk_version'], '1.0.9', '<')),
				array('config.update', array('vk_version', '1.0.9')),
			)),
			
		);
	}

	public function revert_data()
	{
		return array(
			array('permission.remove', array('u_viewrec')),
		);
	}
}