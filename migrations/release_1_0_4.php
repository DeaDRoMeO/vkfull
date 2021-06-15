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

class release_1_0_4 extends \phpbb\db\migration\migration
{
public function effectively_installed()
	{
		return (isset($this->config['vk_version']) && version_compare($this->config['vk_version'], '1.0.4', '>='));
	}
static public function depends_on()
	{
		return array('\deadromeo\vkfull\migrations\release_1_0_3');
	}		
		
	public function update_data()
	{
		return array(
			array('config.add', array('vkbb_com_on_i', 0)),
			array('config.add', array('vkbb_com_i_p', 0)),			
			array('config.add', array('vk_version', '1.0.4')),
			array('if', array(
				(isset($this->config['vk_version']) && version_compare($this->config['vk_version'], '1.0.4', '<')),
				array('config.update', array('vk_version', '1.0.4')),
			)),
			
			array('module.add', array(
				'acp',
				'VK_BB',
				array(
					'module_basename'	=> '\deadromeo\vkfull\acp\like_module',
					'modes'	=> array('vkfull_like'),
				),
			)),
			array('module.add', array(
				'acp',
				'VK_BB',
				array(
					'module_basename'	=> '\deadromeo\vkfull\acp\rec_module',
					'modes'	=> array('vkfull_rec'),
				),
			)),
			array('module.add', array(
				'acp',
				'VK_BB',
				array(
					'module_basename'	=> '\deadromeo\vkfull\acp\com_module',
					'modes'	=> array('vkfull_com'),
				),
			)),
			array('module.add', array(
				'acp',
				'VK_BB',
				array(
					'module_basename'	=> '\deadromeo\vkfull\acp\polls_module',
					'modes'	=> array('vkfull_polls'),
				),
			)),
			array('module.add', array(
				'acp',
				'VK_BB',
				array(
					'module_basename'	=> '\deadromeo\vkfull\acp\soc_module',
					'modes'	=> array('vkfull_soc'),
				),
			)),
			array('module.add', array(
				'acp',
				'VK_BB',
				array(
					'module_basename'	=> '\deadromeo\vkfull\acp\users_module',
					'modes'	=> array('vkfull_users'),
				),
			)),
			array('module.add', array(
				'acp',
				'VK_BB',
				array(
					'module_basename'	=> '\deadromeo\vkfull\acp\wall_module',
					'modes'	=> array('vkfull_wall'),
				),
			)),
		);
	}

	public function revert_data()
	{
		return array(
			array('config.remove', array('vkbb_com_on_i')),
			array('config.remove', array('vkbb_com_i_p')),
		array('module.remove', array(
				'acp',
				'VK_BB',
				array(
					'module_basename'	=> '\deadromeo\vkfull\acp\like_module',
					'modes'	=> array('vkfull_like'),
				),
			)),
			array('module.remove', array(
				'acp',
				'VK_BB',
				array(
					'module_basename'	=> '\deadromeo\vkfull\acp\rec_module',
					'modes'	=> array('vkfull_rec'),
				),
			)),
			array('module.remove', array(
				'acp',
				'VK_BB',
				array(
					'module_basename'	=> '\deadromeo\vkfull\acp\com_module',
					'modes'	=> array('vkfull_com'),
				),
			)),
			array('module.remove', array(
				'acp',
				'VK_BB',
				array(
					'module_basename'	=> '\deadromeo\vkfull\acp\polls_module',
					'modes'	=> array('vkfull_polls'),
				),
			)),
			array('module.remove', array(
				'acp',
				'VK_BB',
				array(
					'module_basename'	=> '\deadromeo\vkfull\acp\soc_module',
					'modes'	=> array('vkfull_soc'),
				),
			)),
			array('module.remove', array(
				'acp',
				'VK_BB',
				array(
					'module_basename'	=> '\deadromeo\vkfull\acp\users_module',
					'modes'	=> array('vkfull_users'),
				),
			)),
			array('module.remove', array(
				'acp',
				'VK_BB',
				array(
					'module_basename'	=> '\deadromeo\vkfull\acp\wall_module',
					'modes'	=> array('vkfull_wall'),
				),
			)),	
			
		);
	}
}