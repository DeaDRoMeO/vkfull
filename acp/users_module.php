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
class users_module
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
		$this->tpl_name = 'acp_users';
		$this->page_title = $this->user->lang('VK_USERS');

		$form_key = 'acp_users';
		add_form_key($form_key);
		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key($form_key))
			{
				trigger_error($user->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}
						
			$vkbb_users_on = $this->request->variable('vkbb_users_on', 0);
			$this->config->set('vkbb_users_on', $vkbb_users_on);
			$vkbb_users_p = $this->request->variable('vkbb_users_p', 0);
			$this->config->set('vkbb_users_p', $vkbb_users_p);
			
			
			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
		}
		$template->assign_vars(array(
		    'VK_VERSION'			=> isset($this->config['vk_version']) ? $this->config['vk_version'] : '',
						
			'VKBB_USERS_P'				=> isset($this->config['vkbb_users_p']) ? $this->config['vkbb_users_p'] : '',
			'VKBB_USERS_ON'				=> isset($this->config['vkbb_users_on']) ? $this->config['vkbb_users_on'] : '',
			
			'U_ACTION'				=> $this->u_action,
		));
	}
}

?>