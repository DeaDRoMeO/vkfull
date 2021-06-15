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
class soc_module
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
		$this->tpl_name = 'acp_soc';
		$this->page_title = $this->user->lang('VK_SOC');

		$form_key = 'acp_soc';
		add_form_key($form_key);
		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key($form_key))
			{
				trigger_error($user->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}
						
			$vkbb_soc_on = $this->request->variable('vkbb_soc_on', 0);
			$this->config->set('vkbb_soc_on', $vkbb_soc_on);
			$vkbb_soc_p = $this->request->variable('vkbb_soc_p', 0);
			$this->config->set('vkbb_soc_p', $vkbb_soc_p);
			$vkbb_soc_id = $this->request->variable('vkbb_soc_id', '');
			$this->config->set('vkbb_soc_id', $vkbb_soc_id);
			$vkbb_soc_h = $this->request->variable('vkbb_soc_h', '');
			$this->config->set('vkbb_soc_h', $vkbb_soc_h);
			$vkbb_soc_m = $this->request->variable('vkbb_soc_m', '');
			$this->config->set('vkbb_soc_m', $vkbb_soc_m);
			$vkbb_soc_mw = $this->request->variable('vkbb_soc_mw', 0);
			$this->config->set('vkbb_soc_mw', $vkbb_soc_mw);
			$vkbb_soc_c_a = $this->request->variable('vkbb_soc_c_a', '');
			$this->config->set('vkbb_soc_c_a', $vkbb_soc_c_a);
			$vkbb_soc_c_b = $this->request->variable('vkbb_soc_c_b', '');
			$this->config->set('vkbb_soc_c_b', $vkbb_soc_c_b);
			$vkbb_soc_c_c = $this->request->variable('vkbb_soc_c_c', '');
			$this->config->set('vkbb_soc_c_c', $vkbb_soc_c_c);
			
			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
		}
		$template->assign_vars(array(
		    'VK_VERSION'			=> isset($this->config['vk_version']) ? $this->config['vk_version'] : '',
						
			'VKBB_SOC_ON'				=> isset($this->config['vkbb_soc_on']) ? $this->config['vkbb_soc_on'] : '',
			'VKBB_SOC_P'				=> isset($this->config['vkbb_soc_p']) ? $this->config['vkbb_soc_p'] : '',
			'VKBB_SOC_ID'				=> isset($this->config['vkbb_soc_id']) ? $this->config['vkbb_soc_id'] : '',
			'VKBB_SOC_H'				=> isset($this->config['vkbb_soc_h']) ? $this->config['vkbb_soc_h'] : '',
			'VKBB_SOC_M'				=> isset($this->config['vkbb_soc_m']) ? $this->config['vkbb_soc_m'] : '',
			'VKBB_SOC_MW'				=> isset($this->config['vkbb_soc_mw']) ? $this->config['vkbb_soc_mw'] : '',
			'VKBB_SOC_C_A'				=> isset($this->config['vkbb_soc_c_a']) ? $this->config['vkbb_soc_c_a'] : '',
			'VKBB_SOC_C_B'				=> isset($this->config['vkbb_soc_c_b']) ? $this->config['vkbb_soc_c_b'] : '',
			'VKBB_SOC_C_C'				=> isset($this->config['vkbb_soc_c_c']) ? $this->config['vkbb_soc_c_c'] : '',
			
			'U_ACTION'				=> $this->u_action,
		));
	}
}

?>