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

class release_1_0_3 extends \phpbb\db\migration\migration
{
public function effectively_installed()
	{
		return (isset($this->config['vk_version']) && version_compare($this->config['vk_version'], '1.0.3', '>='));
	}
static public function depends_on()
	{
		return array('\deadromeo\vkfull\migrations\release_1_0_2');
	}		
		
	public function update_data()
	{
		return array(
			array('config.add', array('vkbb_users_on', 0)),
			array('config.add', array('vkbb_users_p', 0)),			
			array('config.add', array('vk_version', '1.0.3')),
			array('if', array(
				(isset($this->config['vk_version']) && version_compare($this->config['vk_version'], '1.0.3', '<')),
				array('config.update', array('vk_version', '1.0.3')),
			)),
			
		);
	}

	public function revert_data()
	{
		return array(
			array('config.remove', array('vkbb_users_on')),
			array('config.remove', array('vkbb_users_p')),
		);
	}
}