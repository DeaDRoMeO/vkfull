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

class release_1_0_5 extends \phpbb\db\migration\migration
{
public function effectively_installed()
	{
		return (isset($this->config['vk_version']) && version_compare($this->config['vk_version'], '1.0.5', '>='));
	}
static public function depends_on()
	{
		return array('\deadromeo\vkfull\migrations\release_1_0_4');
	}		
		
	public function update_data()
	{
		return array(
			array('config.add', array('vkbb_save_on', 0)),
			array('config.add', array('vkbb_save_p', 0)),	
			array('config.add', array('vkbb_save_l', 0)),
			array('config.add', array('vkbb_save_lt', '')),			
			array('config.add', array('save_style', '')),
			array('config.add', array('save_text', '')),					
			array('config.add', array('vk_version', '1.0.5')),
			array('if', array(
				(isset($this->config['vk_version']) && version_compare($this->config['vk_version'], '1.0.5', '<')),
				array('config.update', array('vk_version', '1.0.5')),
			)),
			
			array('module.add', array(
				'acp',
				'VK_BB',
				array(
					'module_basename'	=> '\deadromeo\vkfull\acp\save_module',
					'modes'	=> array('vkfull_save'),
				),
			)),
		);
	}

	public function revert_data()
	{
		return array(
			array('config.remove', array('vkbb_save_on')),
			array('config.remove', array('vkbb_save_p')),
			array('config.remove', array('vkbb_save_l')),
			array('config.remove', array('vkbb_save_lt')),				
			array('config.remove', array('save_style')),
			array('config.remove', array('save_text')),
		array('module.remove', array(
				'acp',
				'VK_BB',
				array(
					'module_basename'	=> '\deadromeo\vkfull\acp\save_module',
					'modes'	=> array('vkfull_save'),
				),
			)),			
		);
	}
}