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
	'VK_BB'							=> '«VKWigets»',
	'VK_CONFIG'						=> 'Общие настройки',
	'VK_BB_ON'						=> 'Общие настройки виджетов ВКонтакте',
	'VK_BB_ON_EXP'					=> 'Включить виджеты ВКонтакте',
	'VK_BB_ON_EXP1'					=> 'Разрешить глобально отображение виджетов от ВКонтакте',
	'VK_ID'							=> 'ID приложения',
	'VK_ID_EXP'						=> 'Введите ваш <strong>ID приложения</strong> Вконтакте.',
	'VK_TOKEN'							=> 'Сервисный ключ доступа',
	'VK_TOKEN_EXP'						=> 'Введите ваш <strong>Сервисный ключ доступа</strong> Вконтакте.',
	
	'VK_INFO_VK'							=> 'Информация о приложении ВКонтакте',
	'VK_INFO_NAME'							=> 'Название приложения',
	'VK_INFO_AVA'							=> 'Обложка',
	'VK_INFO_AUTHOR'							=> 'Создатель',
	'PROFILE_VK'							=> 'Перейти в профиль',
	'VKBB_PROFILE'							=> 'Профиль ВКонтакте',
	'VKBB_PROFILE_EXP'							=> 'Введите ваш индентификатор ВКонтакте. Он содержится в ссылке на вашу страницу, например, <strong>https://vk.com/dead_romeo</strong> - идентификатор <strong>dead_romeo</strong>, а в <strong>https://vk.com/8902397</strong> - <strong>8902397</strong>',
	'VK_IT'							=> 'Тема ',
	'VK_IU'							=> ' от ',
	'VK_IM'							=> 'Сообщение ',
	'USERS_VK'						=> 'Наши пользователи ВКонтакте',
	'VK_FOLLOW'						=> '<strong>Подписчиков:</strong> ',
	'VK_POST'						=> '<strong>Сообщений на форуме:</strong> ',
	'NO_MEM'						=> 'На форуме нет пользователей, указавших свой ID ВКонтакте',
	'NO_TOP'						=> 'Темы не найдены ...',
	'TOP_C'							=> 'Топ тем по комментариям ВКонтакте',
	'TOP_L'							=> 'Топ тем по отметкам «Мне нравится» ВКонтакте',
	'VK_LIKE'						=> 'Виджет «Мне нравится»',
	'VK_LIKE_EXP'					=> 'Виджет <strong>«Мне нравится»</strong> позволяет Вашим посетителям одним кликом выразить своё отношение к статье или моментально поделиться ссылкой на статью с друзьями. Вы всегда можете просмотреть полный список оценивших статью и поделившихся ссылкой на нее с друзьями. Кроме этого по ссылке «К обзору комментариев» вы можете просмотреть все комментарии, оставленные ВКонтакте к размещенным ссылкам.',
	'VK_LIKE_ON'					=> 'Включить виджет «Мне нравится»',
	'VK_LIKE_ON_EXP'				=> 'Включить отображение виджета <strong>«Мне нравится»</strong> в темах форума.',
	'VK_LIKE_P'						=> 'Расположение виджета «Мне нравится»',
	'VK_LIKE_P_EXP'					=> 'Выберите расположение виджета <strong>«Мне нравится»</strong> в темах форума.',
	'VK_LIKE_P_F'					=> 'Только в первом сообщении темы',
	'VK_LIKE_P_A'					=> 'Во всех сообщениях темы',
	'VK_LIKE_H'						=> 'Высота кнопки',
	'VK_LIKE_H_EXP'					=> 'Установите высоту кнопки в пикселах. Допустимые значения: <strong>18</strong>, <strong>20</strong>, <strong>22</strong>, <strong>24</strong>. Значение по умолчанию - <strong>22</strong>.',
	'VK_BB_TYPE_BUTTON'				=> 'Тип виджета «Мне нравится»',
	'VK_BB_TYPE_BUTTON_EXP'			=> 'Введите тип отображения виджета <strong>«Мне нравится»</strong> (без кавычек): <br/> 1. Кнопка с миниатюрным счётчиком - « <strong>button</strong> »;<br/> 2. Кнопка с текстовым счётчиком - « <strong>full</strong> »;<br/> 3. Миниатюрная кнопка - « <strong>mini</strong> »;<br/> 4. Миниатюрная кнопка, счётчик сверху - « <strong>vertical</strong> ».',
	'VK_LIKE_VER'					=> 'Формулировка текста внутри кнопки',
	'VK_LIKE_VER_EXP'				=> 'Установите вариант формулировки текста внутри кнопки: <strong>Это интересно</strong> либо <strong>Мне нравится</strong>. Значение по умолчанию – <strong>Мне нравится</strong>.',
	'VK_LIKE_VER_I'					=> 'Это интересно',
	'VK_LIKE_VER_N'					=> 'Мне нравится',
	'VK_LIKE_STYLE'					=> 'CSS-стили для кнопки',
	'VK_LIKE_STYLE_EXP'				=> 'При необходимости вы можете прописать для кнопки любые CSS-стили, например, отступы.',	
	'VK_REC'						=> 'Виджет «Рекомендации»',
	'VK_REC_EXP'					=> 'Виджет <strong>«Рекомендации»</strong> создает на Вашем форуме динамический блок с наиболее популярными материалами. Разместив такой блок на главной странице, Вы упростите своим читателям поиск интересных статей. Популярность материалов определяется с помощью виджета <strong>«Мне нравится»</strong>, который необходимо включить перед использованием виджета <strong>«Рекомендации»</strong>. ',
	'VK_REC_ON'						=> 'Включить виджет «Рекомендации»',
	'VK_REC_ON_EXP'					=> 'Включить отображение виджета <strong>«Рекомендации»</strong> на главной странице форума.',
	'VK_REC_P'						=> 'Расположение виджета «Рекомендации»',
	'VK_REC_P_EXP'					=> 'Выберите расположение виджета <strong>«Рекомендации»</strong> на главной странице форума.',
	'VK_REC_P_B'					=> 'Перед списком форумов',
	'VK_REC_P_A'					=> 'После списка форумов',
	'VK_REC_MP'						=> 'Максимальное число страниц',
	'VK_REC_MP_EXP'					=> 'Установите максимальное количество страниц, отображаемых в виджете изначально. Значение по умолчанию – <strong>5</strong>.',
	'VK_REC_MPM'					=> 'Максимальное число страниц после нажатия на «Показать все рекомендации»',
	'VK_REC_MPM_EXP'				=> 'Установите максимальное количество страниц, отображаемых после нажатия на «Показать все рекомендации». Если «Максимальное число страниц» <strong> <= </strong> «Максимальное число страниц после нажатия на «Показать все рекомендации»», то ссылка «Показать все рекомендации» не будет отображаться. Значение по умолчанию – <strong>4 * «Максимальное число страниц»</strong>.',
	'VK_REC_PER'					=> 'Период сбора статистики',
	'VK_REC_PER_EXP'				=> 'Установите отчетный период для статистики. Возможные значения:<br/>1. <strong>day</strong> – учитываются записи за последние 24 часа;<br/>2. <strong>week</strong> – 7 дней;<br/>3. <strong>month</strong> - 30 дней. <br/>Значение по умолчанию – <strong>week</strong>.',
	'VK_REC_VER'						=> 'Формулировка текста внутри блока',
	'VK_REC_VER_EXP'						=> 'Установите вариант формулировки текста внутри блока: <strong>Интересно</strong> либо <strong>Нравится</strong>. Значение по умолчанию – <strong>Нравится</strong>.',
	'VK_REC_VER_I'						=> 'Интересно',
	'VK_REC_VER_N'						=> 'Нравится',	
	'VK_REC_TARG'						=> 'Параметр target ссылок',
	'VK_REC_TARG_EXP'						=> 'Установите параметр <strong>target</strong> у ссылок на страницы сайта. Возможные значения:<br/>1. <strong>blank</strong> - открывать на новой странице;<br/>2. <strong>top</strong> - открывать на полном окне браузера;<br/>3. <strong>parent</strong> - открывать в фрейме, который содержит виджет.<br/> Значение по умолчанию - <strong>parent</strong>.',	


	
	'SOC'						=> 'Виджет «Сообщества»',
	'VK_SOC'						=> 'Виджет «Сообщества»',
	'VK_SOC_EXP'						=> 'Виджет <strong>«Сообщества»</strong> тесно свяжет ваш форум с соответствующей группой или официальной страницей ВКонтакте. Виджет позволяет подписаться на новости сообщества, не покидая страницы. В виджете могут отображаться фотографии друзей пользователя и других участников сообщества. По ссылке «Подписаны..» доступна демографическая статистика по участникам. Вместо фотографий также могут отображаться новости сообщества. В этом случае внизу виджета будет располагаться небольшой блок с фотографией самого близкого друга пользователя из числа подписавшихся и списком остальных друзей, состоящих в сообществе. При прокрутке блока вниз автоматически подгружаются более старые записи.',
	'VK_SOC_ON'						=> 'Включить виджет «Сообщества»',
	'VK_SOC_ON_EXP'						=> 'Включить отображение виджета <strong>«Сообщества»</strong> на главной странице форума.',
	'VK_SOC_P'						=> 'Расположение виджета «Сообщества»',
	'VK_SOC_P_EXP'						=> 'Выберите расположение виджета <strong>«Сообщества»</strong> на главной странице форума.',
	'VK_SOC_ID'						=> 'Идентификатор группы',
	'VK_SOC_ID_EXP'						=> 'Введите идентификатор вашей группы Вконтакте.',
	'VK_SOC_H'						=> 'Высота блока',
	'VK_SOC_H_EXP'						=> 'Установите высоту блока в пикселах (целое число от <strong>200</strong> до <strong>1200</strong>).',
	'VK_SOC_M'						=> 'Стиль отображения',
	'VK_SOC_M_EXP'						=> 'Установите стиль отображения информации в блоке. Возможные варианты:<br/>*. <strong>0</strong> - отображать участников сообщества;<br/>*. <strong>1</strong> - отображать только название сообщества;<br/>*. <strong>2</strong> - отображать стену сообщества.',
	'VK_SOC_MW'						=> 'Режим отображения',
	'VK_SOC_MW_EXP'						=> 'Установите режим отображения информации в блоке. Возможные варианты: <strong>Стандартный</strong> и <strong>Альтернативный</strong>. При Альтернативном режиме меняется отображение списка постов, добавляется <strong>«Мне нравится»</strong> и фотография сообщества.',
	'VK_SOC_MW_S'						=> 'Стандартный',
	'VK_SOC_MW_A'						=> 'Альтернативный',
	'VK_SOC_C_A'						=> 'Цвет фона виджета',
	'VK_SOC_C_A_EXP'						=> 'Установите цвет фона виджета в формате <strong>RRGGBB</strong>. Значение по умолчанию - <strong>FFFFFF</strong>.',
	'VK_SOC_C_B'						=> 'Цвет текста виджета',
	'VK_SOC_C_B_EXP'						=> 'Установите цвет текста виджета в формате <strong>RRGGBB</strong>. Значение по умолчанию - <strong>2B587A</strong>.',
	'VK_SOC_C_C'						=> 'Цвет кнопок виджета',
	'VK_SOC_C_C_EXP'						=> 'Установите цвет кнопок виджета в формате <strong>RRGGBB</strong>. Значение по умолчанию - <strong>5B7FA6</strong>.',
	
	
	
	'VK_COM'						=> 'Виджет «Комментарии»',
	'VK_COML'						=> 'Комментарии Вконтакте',
	'VK_COM_EXP'						=> 'При помощи виджета <strong>«Комментарии»</strong> Вы можете добавить на Ваш форум возможность комментирования статей и других материалов. Пользователи смогут комментировать Ваши материалы без дополнительной регистрации. При желании, каждый оставленный комментарий может транслироваться на страницу комментатора ВКонтакте со ссылкой на исходную статью. Со страницы автора и из раздела Новости о статье узнают друзья автора и смогут присоединиться к дискуссии. В этом случае комментарии второго уровня будут синхронизироваться между ВКонтакте и виджетом на Вашем форуме, так что обсуждение будет происходить одновременно на двух площадках, привлекая внимание новых участников. ',
	'VK_COM_ON'						=> 'Включить виджет «Комментарии»',
	'VK_COM_ON_EXP'						=> 'Включить отображение виджета <strong>«Комментарии»</strong> в темах форума.',
	'VK_COM_P'						=> 'Расположение виджета «Комментарии»',
	'VK_COM_P_EXP'						=> 'Выберите расположение виджета <strong>«Комментарии»</strong> в темах форума.',
	'VK_COM_I_ON'						=> 'Включить виджет «Комментарии» на главной странице',
	'VK_COM_ON_I_EXP'						=> 'Включить отображение виджета <strong>«Комментарии»</strong> на главной странице форума форума. Осуществляется вывод всех комментариев к темам форума.',
	'VK_COM_I_P'						=> 'Расположение виджета «Комментарии»',
	'VK_COM_I_P_EXP'						=> 'Выберите расположение виджета <strong>«Комментарии»</strong> на главной странице форума.',
	'VK_COM_P_B'						=> 'Перед сообщениями темы',
	'VK_COM_P_A'						=> 'После сообщений темы',
	'VK_COM_H'						=> 'Высота блока',
	'VK_COM_H_EXP'						=> 'Установите максимальную высоту виджета в пикселях для блока в темах и на главной странице. Целое число <strong> > 500</strong>. Если равно <strong>0</strong>, то высота не ограничена. Если содержимое виджета больше, чем максимально допустимое, то появляется внутренняя прокрутка. Значение по умолчанию - <strong>0</strong>.',
	'VK_COM_K'						=> 'Количество комментариев',
	'VK_COM_K_EXP'						=> 'Установите количество видимых комментариев для блока в темах и на главной странице (целое число <strong>5-100</strong>).',
	'VK_COM_TOP'						=> 'Топ Х тем и сообщений',
	'VK_COM_TOP_O'						=> 'Включить «Топ Х тем и сообщений»',
	'VK_COM_TOP_O_EXP'						=> 'Включить <strong>«Топ Х тем и сообщений»</strong> на главной странице форума. В топе выводятся темы с наибольшим количеством комментариев ВКонтакте.',
	'VK_COM_TOP_PO'						=> 'Расположение «Топ Х тем и сообщений»',
	'VK_COM_TOP_PO_EXP'						=> 'Выберите расположение <strong>«Топ Х тем и сообщений»</strong> на главной странице форума.',
	'VK_COM_TOPL_O_EXP'						=> 'Включить <strong>«Топ Х тем и сообщений»</strong> на главной странице форума. В топе выводятся темы с наибольшим количеством <strong>«Мне нравится»</strong> ВКонтакте.',
	'VK_COM_DAT'						=> 'Период выборки',
	'VK_COM_DAT_EXP'						=> 'Установите период выборки тем в топе. Допустимые значения (без кавычек):<br/> 1. День - « <strong>day</strong> »;<br/> 2. Неделя - « <strong>week</strong> »;<br/> 3. Месяц - « <strong>month</strong> »;<br/> 4. За все время - « <strong>alltime</strong> ».',
	'VK_COM_NUMB'						=> 'Количество тем в топе',
	'VK_COM_NUMB_EXP'						=> 'Установите количество выводимых тем в топе (целое число от <strong>10</strong> до <strong>200</strong>).',
	
	
	'VK_POLL'						=> 'Виджет «Опросы»',
	'VK_POLL_EXP'						=> 'При помощи виджета <strong>«Опросы»</strong> Вы можете за 5 минут организовать опрос пользователей своего форума. Посетители одним нажатием кнопки мыши могут выразить своё мнение и моментально поделиться им с друзьями, опубликовав результат на своей странице ВКонтакте. Для этого пользователю не придется самому вводить какую-либо информацию, поэтому ссылка на статью с таким опросом сможет распространиться максимально быстро. ',
	'VK_POLL_ID'						=> 'ID опроса',
	'VK_POLL_ID_EXP'						=> 'Введите ID вашего опроса, созданного на <strong><a href="https://vk.com/dev/Poll">данной</a></strong> странице.',
	'VK_POLL_ON'						=> 'Включить виджет «Опросы»',
	'VK_POLL_ON_EXP'						=> 'Включить отображение виджета <strong>«Опросы»</strong> на главной странице форума.',
	'VK_POLL_P'						=> 'Расположение виджета «Опросы»',
	'VK_POLL_P_EXP'						=> 'Выберите расположение виджета <strong>«Опросы»</strong> на главной странице форума.',
	
	
	'VK_WALL'						=> 'Виджет «Запись на стене»',
	'VK_WALL_EXP'						=> 'При помощи виджета <strong>«Запись на стене»</strong> Вы можете встроить на свой форум отдельную запись или комментарий пользователя или сообщества ВКонтакте. Виджет позволяет пользователям Вашего форума не только ознакомиться с самой записью или комментарием, но также моментально оценить ее, поделиться с друзьями или подписаться на страницу автора. А благодаря широким мультимедийным возможностям виджета Вы сможете послушать прикрепленные аудиозаписи, посмотреть видео и рассмотреть фотографии не уходя со страницы с виджетом.',
	'VK_WALL_ID'						=> 'element_id записи',
	'VK_WALL_ID_EXP'						=> 'Введите <strong>element_id</strong> прикрепляемой записи.',
	'VK_WALL_ID1'						=> 'owner_id записи',
	'VK_WALL_ID1_EXP'						=> 'Введите <strong>owner_id</strong> прикрепляемой записи.',
	'VK_WALL_IDPOST'						=> 'post_id записи',
	'VK_WALL_IDPOST_EXP'						=> 'Введите <strong>post_id</strong> прикрепляемой записи.',
	'VK_HASH'						=> 'hash записи',
	'VK_HASH_EXP'						=> 'Введите <strong>hash</strong> прикрепляемой записи.',
	'VK_WALL_ON'						=> 'Включить виджет «Запись на стене»',
	'VK_WALL_ON_EXP'						=> 'Включить отображение виджета <strong>«Запись на стене»</strong> на главной странице форума.',
	'VK_WALL_P'						=> 'Расположение виджета «Запись на стене»',
	'VK_WALL_P_EXP'						=> 'Выберите расположение виджета <strong>«Запись на стене»</strong> на главной странице форума.',
	
	'VK_USERS'						=> 'Виджет «Наши пользователи ВКонтакте»',
	'VK_USERS_EXP'						=> 'При помощи виджета <strong>«Наши пользователи ВКонтакте»</strong> Вы можете вывести на главную страницу блок со  случайными учетными записями пользователей, указавших свой ID ВКонтакте',
	'VK_USERS_ON'						=> 'Включить виджет «Наши пользователи ВКонтакте»',
	'VK_USERS_ON_EXP'						=> 'Включить отображение виджета <strong>«Наши пользователи ВКонтакте»</strong> на главной странице форума.',
	'VK_USERS_P'						=> 'Расположение виджета «Наши пользователи ВКонтакте»',
	'VK_USERS_P_EXP'						=> 'Выберите расположение виджета <strong>«Наши пользователи ВКонтакте»</strong> на главной странице форума.',
	
	'VK_GR'						=> 'Интересные страницы',
	'VK_FR'						=> 'Случайные друзья',
	'NO_GR'						=> 'Пользователь не состоит в группах либо они скрыты настройками приватности ...',
	'NO_FR'						=> 'У пользователя нет друзей либо они скрыты настройками приватности ...',
	'ALL_ALL'						=> 'Всего:',
	
	
	'VK_SAVE'						=> 'Виджет «Публикация ссылок»',
	'VK_SAVE_EXP'						=> 'Активировав на страницах Вашего форума виджет <strong>«Публикация ссылок»</strong>, Вы позволите 100 миллионам пользователей ВКонтакте быстро делиться ссылками на Ваши материалы со своими друзьями. Каждый раз, когда пользователь ВКонтакте нажимает на кнопку на Вашем форуме, на его странице ВКонтакте автоматически создается заметка со ссылкой на Ваш форум. После этого друзья пользователя сразу же смогут узнать о статье со страницы Мои Новости и с личной страницы опубликовавшего пользователя.',
	'VK_SAVE_ON'						=> 'Включить виджет «Публикация ссылок»',
	'VK_SAVE_ON_EXP'						=> 'Включить отображение виджета <strong>«Публикация ссылок»</strong> в футере на всех страницах форума.',
	'VK_SAVE_P'						=> 'Расположение виджета «Публикация ссылок»',
	'VK_SAVE_P_EXP'						=> 'Выберите расположение виджета <strong>«Публикация ссылок»</strong> в футере на страницах форума.',
	'VK_SAVE_L'						=> 'Слева от копирайтов',
	'VK_SAVE_R'						=> 'Справа от копирайтов',
	'VK_SAVE_STYLE'						=> 'Стиль кнопки',
	'VK_SAVE_STYLE_EXP'						=> 'Выберите стиль отображения кнопки. Возможные варианты:<br/>1. <strong>link</strong> - ссылка<br/> 2. <strong>link_noicon</strong> - ссылка без иконки<br/> 3. <strong>round</strong> - кнопка<br/> 4. <strong>round_nocount</strong> - кнопка без счетчика<br/> 5. <strong>custom</strong> - иконка. ',
	'VK_SAVE_TEXT'						=> 'Текст на кнопке',
	'VK_SAVE_TEXT_EXP'						=> 'Введите текст, который будет отображаться на кнопке, если в пункте выше вы выбрали <strong>custom</strong>, то вам нужно ввести HTML-код любой картинки, например, большая русская иконка ВКонтакте:<br/><textarea><img src=\"http://vk.com/images/share_32.png\" width=\"32\" height=\"32\" /></textarea><br/>Большая английская иконка ВКонтакте:<br/><textarea><img src=\"http://vk.com/images/share_32_eng.png\" width=\"32\" height=\"32\" /></textarea>.<br/> Аналогично добавляются любые другие изображения для стиля кнопки <strong>custom</strong>, для остальных же стилей вы просто вводите нужный вам текст.',
	'VK_SAVE_L_ON'						=> 'Ссылка',
	'VK_SAVE_L_EXP'						=> 'Выберите способ формирования ссылки для публикования',
	'ONE'						=> 'Брать ссылку со страницы с кнопкой',
	'TWO'						=> 'Ввести свою ссылку',
	'VK_SAVE_LT'						=> 'Введите ссылку.',
	'VK_SAVE_LT_EXP'						=> 'Введите ссылку для всех кнопок виджета.',
	
	
	'NOT'						=> 'Место для друга',
	'NOT2'						=> 'Место для подписки',
	'VK_COM_T'						=> 'Комментарии ВКонтакте к данной теме',
	'VK_RUL'						=> '<b style="color:red;">Внимание !!! Активируя данный элемент, не забудьте настроить к нему Глобальные права доступа для каждой группы пользователей.</b>',
	
	
	
	'LIKE_S'						=> 'Поделиться сообщением',
	'FOLLOW_S'						=> 'Подписаться на автора',
	'VKON'						=> 'ВКонтакте',
	
	'POSTWALL_EDIT'						=> 'Редактировать запись',
	'NO_POSTWALL'						=> 'Нет сохраненных записей',
	'POSTWALL_ADD'						=> 'Добавить новую запись',
	'POSTWALL_UPD'						=> 'Запись успешно обновлена.',
	'POSTWALL_DELL'						=> 'Запись успешно удалена.',
	'REALY_POSTWALL_DELL'						=> 'Вы действительно хотите удалить эту запись?',
	'POSTWALL_ID'						=> 'ID записи',
	'WALLNAME'						=> 'Описание записи',
	'WALLNAME_EXP'						=> 'Краткое описание вашей записи.',
	'POSTWALL_ADDS'						=> 'Запись была успешно добавлена.',
	'VKV_TYPE'						=> 'Тип',
	'VKV_ERR'						=> '<b style="color:red;">Внимание !!! Не заполнено поле API ID, информация о приложении недоступна.</b>',
	
	'POLL_EDIT'						=> 'Редактировать опрос',
	'NO_POLL'						=> 'Нет сохраненных опросов',
	'POLL_ADD'						=> 'Добавить новый опрос',
	'POLL_UPD'						=> 'Опрос успешно обновлен.',
	'POLL_DELL'						=> 'Опрос успешно удален.',
	'REALY_POLL_DELL'						=> 'Вы действительно хотите удалить этот опрос?',
	'POLL_ID'						=> 'ID опроса',
	'POLLNAME'						=> 'Описание опроса',
	'POLLNAME_EXP'						=> 'Краткое описание вашего опроса.',
	'POLL_ADDS'						=> 'Опрос был успешно добавлен.',
	'NOTSTAT'						=> 'Статус не установлен ...',
	'VK_STATUS'						=> 'Статус пользователя:',
	
	'VK_FOL'						=> 'Подписчики',
	'NO_FOL'						=> 'У пользователя нет подписчиков либо они скрыты настройками приватности ...',
	'NOT_FOLLO'						=> 'Место для подписчика',
	
	'STATVK'						=> 'Профиль ВКонтакте',
	'VK_ALB'						=> 'Альбомов:',
	'VK_VID'						=> 'Видеозаписей:',
	'VK_AUD'						=> 'Аудиозаписей:',
	'VK_PHOT'						=> 'Фотографий:',
	'VK_NOTE'						=> 'Заметок:',
	'VK_FREN'						=> 'Друзей:',
	'VK_GROUP'						=> 'Групп:',
	'VK_ON_FRIE'						=> 'Друзей онлайн:',
	'VK_UPHOT'						=> 'Своих фотографий:',
	'VK_UVID'						=> 'Своих видео:',
	'VK_FOLLL'						=> 'Подписчиков:',
	'VK_SUBS'						=> 'Подписок:',
	'VK_PAGE'						=> 'Интересных страниц:',
	'VK_STAT_NO'						=> 'Информация скрыта настройками приватности',
	
	'DISPLAY_L'						=> 'Включить на главной',
	'DISPLAY_L_EXP'						=> 'Показывать на главной странице форума',
	'TOTAL_POSTWALL'      => array(
      0   => '<strong>0</strong> записей',
      1   => '<strong>%d</strong> запись',
      2   => '<strong>%d</strong> записи',
      3   => '<strong>%d</strong> записей',
   ),   
   'TOTAL_POLL'      => array(
      0   => '<strong>0</strong> опросов',
      1   => '<strong>%d</strong> опрос',
      2   => '<strong>%d</strong> опроса',
      3   => '<strong>%d</strong> опросов',
   ),   
   
));