<?php

/**
*
* @package VKWigets
* @copyright (c) 2021 DeaDRoMeO ; hello-vitebsk.ru
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace deadromeo\vkfull\acp;

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
    exit;
}

/**
* @package acp
*/
class vkfull_module
{
	protected $config;
	protected $request;
	protected $template;
	protected $user;

	public $u_action;

	function main($id, $mode)
	{
		global $config, $request, $template, $user;

		$this->config = $config;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;

		$this->user->add_lang('acp/common');
		$this->tpl_name = 'acp_vkfull';
		$this->page_title = $this->user->lang('VK_BB');

		$form_key = 'acp_vkfull';
		add_form_key($form_key);
		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key($form_key))
			{
				trigger_error($user->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}
			$vk_id = $this->request->variable('vk_id', '');
			$this->config->set('vk_id', $vk_id);
			$vk_token = $this->request->variable('vk_token', '');
			$this->config->set('vk_token', $vk_token);
			$vkbb_on = $this->request->variable('vkbb_on', 0);
			$this->config->set('vkbb_on', $vkbb_on);					
			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
		}
		$vk_id 		= $this->config['vk_id'];
		$vk_token 		= $this->config['vk_token'];
			if (empty($vk_id)) {
				$vkv_info['response']['items'][0]['title'] = '---';
				$vkv_info['response']['items'][0]['icon_75'] = '---';
				$vkv_info['response']['items'][0]['author_url'] = '---';
			}
			else
			{
			$vkv_info = json_decode(file_get_contents('https://api.vk.com/method/apps.get?app_id=' . $vk_id . '&access_token=' . $vk_token . '&v=5.126'),true);}
		
		$template->assign_vars(array(
		    'VK_VERSION'			=> isset($this->config['vk_version']) ? $this->config['vk_version'] : '',
					
			'VKBB_ON'				=> isset($this->config['vkbb_on']) ? $this->config['vkbb_on'] : '',
			'VK_ID'				=> isset($this->config['vk_id']) ? $this->config['vk_id'] : '',
			'VK_TOKEN'				=> isset($this->config['vk_token']) ? $this->config['vk_token'] : '',
			'VKV_NAME'				=> $vkv_info['response']['items'][0]['title'],
			'VKV_LOGO'				=> ' <img src="' . $vkv_info['response']['items'][0]['icon_75']. '" />',
			'VKV_TYPE'				=> $vkv_info['response']['items'][0]['author_url'],
			'U_ACTION'				=> $this->u_action,
		));
	}
}

?>