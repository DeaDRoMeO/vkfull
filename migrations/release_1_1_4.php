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

class release_1_1_4 extends \phpbb\db\migration\migration
{
public function effectively_installed()
	{
		return (isset($this->config['vk_version']) && version_compare($this->config['vk_version'], '1.1.4', '>='));
	}
static public function depends_on()
	{
		return array('\deadromeo\vkfull\migrations\release_1_1_3');
	}		
	public function update_data()
	{
		return array(
			array('config.add', array('vk_version', '1.1.4')),
			array('if', array(
				(isset($this->config['vk_version']) && version_compare($this->config['vk_version'], '1.1.4', '<')),
				array('config.update', array('vk_version', '1.1.4')),
			)),
			
		);
	}
		
	public function update_schema()
	{
		
	}

	public function revert_schema()
	{
		
	}
	public function revert_data()
	{
		
	}
}