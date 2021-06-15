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

class release_1_0_0 extends \phpbb\db\migration\migration
{
	
	public function update_data()
	{
		return array(

			// Add new config vars
			array('config.add', array('vk_version', '1.0.0')),
			array('config.add', array('vkbb_on', 0)),
			array('config.add', array('vk_id', '')),
			array('config.add', array('vk_token', '')),
			
			array('config.add', array('vkbb_like_on', 0)),
			array('config.add', array('vkbb_like_p', 0)),
			array('config.add', array('vkbb_like_h', '')),
			array('config.add', array('vkbb_like_t', '')),
			array('config.add', array('vkbb_like_f', 0)),
			
			array('config.add', array('vkbb_com_on', 0)),
			array('config.add', array('vkbb_com_p', 0)),
			array('config.add', array('vkbb_com_h', '')),
			array('config.add', array('vkbb_com_k', '')),
			
			array('config.add', array('vkbb_rec_on', 0)),
			array('config.add', array('vkbb_rec_p', 0)),
			array('config.add', array('vkbb_rec_mp', '')),
			array('config.add', array('vkbb_rec_mpm', '')),
			array('config.add', array('vkbb_rec_per', '')),
			array('config.add', array('vkbb_rec_ver', 0)),
			array('config.add', array('vkbb_rec_targ', '')),
			
			array('config.add', array('vkbb_soc_on', 0)),
			array('config.add', array('vkbb_soc_p', 0)),
			array('config.add', array('vkbb_soc_id', '')),
			array('config.add', array('vkbb_soc_h', '')),
			array('config.add', array('vkbb_soc_m', '')),
			array('config.add', array('vkbb_soc_mw', 0)),
			array('config.add', array('vkbb_soc_c_a', '')),
			array('config.add', array('vkbb_soc_c_b', '')),
			array('config.add', array('vkbb_soc_c_c', '')),
			
			
			// Add new modules
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'VK_BB'
			)),

			array('module.add', array(
				'acp',
				'VK_BB',
				array(
					'module_basename'	=> '\deadromeo\vkfull\acp\vkfull_module',
					'modes'	=> array('vkfull_config'),
				),
			)),
		);
	}

	public function revert_data()
	{
		return array(
			array('config.remove', array('vk_version')),
			array('config.remove', array('vkbb_on')),
			array('config.remove', array('vk_id')),
			array('config.remove', array('vk_token')),
			
			array('config.remove', array('vkbb_like_on')),
			array('config.remove', array('vkbb_like_p')),
			array('config.remove', array('vkbb_like_h')),
			array('config.remove', array('vkbb_like_t')),
			array('config.remove', array('vkbb_like_f')),
			
			array('config.remove', array('vkbb_com_on')),
			array('config.remove', array('vkbb_com_p')),
			array('config.remove', array('vkbb_com_h')),
			array('config.remove', array('vkbb_com_k')),
			
			array('config.remove', array('vkbb_rec_on')),
			array('config.remove', array('vkbb_rec_p')),
			array('config.remove', array('vkbb_rec_mp')),
			array('config.remove', array('vkbb_rec_mpm')),
			array('config.remove', array('vkbb_rec_per')),
			array('config.remove', array('vkbb_rec_ver')),
			array('config.remove', array('vkbb_rec_targ')),
			
			array('config.remove', array('vkbb_soc_on')),
			array('config.remove', array('vkbb_soc_p')),
			array('config.remove', array('vkbb_soc_id')),
			array('config.remove', array('vkbb_soc_h')),
			array('config.remove', array('vkbb_soc_m')),
			array('config.remove', array('vkbb_soc_mw')),
			array('config.remove', array('vkbb_soc_c_a')),
			array('config.remove', array('vkbb_soc_c_b')),
			array('config.remove', array('vkbb_soc_c_c')),
		
			array('module.remove', array(
				'acp',
				'VK_BB',
				array(
					'module_basename'	=> '\deadromeo\vkfull\acp\vkfull_module',
					'modes'	=> array('vkfull_config'),
				),
			)),
			array('module.remove', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'VK_BB'
			)),
		);
	}
}