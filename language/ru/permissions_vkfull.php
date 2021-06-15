<?php
/**
*
* @package VKWigets
* @copyright (c) 2021 DeaDRoMeO ; hello-vitebsk.ru
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACL_U_VIEWTOPCOM'		=> 'Может видеть топ тем по количеству комментариев',
	'ACL_U_VIEWTOPLIK'		=> 'Может видеть топ тем по количеству Мне нравится',
	'ACL_U_VIEWWALL'		=> 'Может видеть виджет Запись на стене',
	'ACL_U_VIEWPOLL'		=> 'Может видеть виджет Опросы',
	'ACL_U_VIEWCOM'		=> 'Может видеть виджет Комментарии ВКонтакте (на главной и в темах форума)',
	'ACL_U_VIEWUSERS'		=> 'Может видеть виджет Наши пользователи ВКонтакте',
	'ACL_U_VIEWSOC'		=> 'Может видеть виджет Сообщества',
	'ACL_U_VIEWREC'		=> 'Может видеть виджет Рекомендации',
));