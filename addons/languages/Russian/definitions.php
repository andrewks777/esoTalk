<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

// This translation is forked from:
//	"author" => "ext2",
//	"authorEmail" => "ext2@ukr.net",
//	"authorURL" => "http://unity-tracker.com",

ET::$languageInfo["Russian"] = array(
	"locale" => "ru-RU",
	"name" => "Русский",
	"description" => "Русский языковой пакет форума esoTalk",
	"version" => ESOTALK_VERSION,
	"author" => "forum330",
	"authorEmail" => "forum330@gmail.com",
	"authorURL" => "http://forum330.com",
	"license" => "GPLv2"
);

// Define the character set that this language uses.
$definitions["charset"] = "utf-8";
$definitions["date.full"] = "d.m.Y H:i:s"; // see http://au.php.net/manual/en/function.date.php for details

$definitions["%d day ago"] = "%d дн. назад";
$definitions["%d days ago"] = "%d дн. назад";
$definitions["%d hour ago"] = "%d ч. назад";
$definitions["%d hours ago"] = "%d ч. назад";
$definitions["%d minute ago"] = "%d мин. назад";
$definitions["%d minutes ago"] = "%d мин. назад";
$definitions["%d month ago"] = "%d мес. назад";
$definitions["%d months ago"] = "%d мес. назад";
$definitions["%d second ago"] = "%d сек. назад";
$definitions["%d seconds ago"] = "%d сек. назад";
$definitions["%d week ago"] = "%d нед. назад";
$definitions["%d weeks ago"] = "%d нед. назад";
$definitions["%d year ago"] = "%d г. назад";
$definitions["%d years ago"] = "%d г. назад";
// months: full
$definitions["January"] = "Январь";
$definitions["February"] = "Февраль";
$definitions["March"] = "Март";
$definitions["April"] = "Апрель";
$definitions["May"] = "Май";
$definitions["June"] = "Июнь";
$definitions["July"] = "Июль";
$definitions["August"] = "Август";
$definitions["September"] = "Сентябрь";
$definitions["October"] = "Октябрь";
$definitions["November"] = "Ноябрь";
$definitions["December"] = "Декабрь";

/*
// months: short
$definitions["Jan"] = "Янв";
$definitions["Feb"] = "Фев";
$definitions["Mar"] = "Мар";
$definitions["Apr"] = "Апр";
$definitions["May"] = "Май";
$definitions["Jun"] = "Июн";
$definitions["Jul"] = "Июл";
$definitions["Aug"] = "Авг";
$definitions["Sep"] = "Сен";
$definitions["Oct"] = "Окт";
$definitions["Nov"] = "Ноя";
$definitions["Dec"] = "Дек";
*/

$definitions["%s and %s"] = "%s и %s";
$definitions["%s can view this conversation."] = "%s может просматривать это обсуждение.";
$definitions["%s changed %s's group to %s."] = "<b>%s</b> изменил группу %s'а на %s.";
$definitions["%s changed your group to %s."] = "<b>%s</b> изменил Вашу группу на %s.";
$definitions["%s conversation"] = "%s обсуждение";
$definitions["%s conversations"] = "%s обсуждения";
$definitions["%s invited you to %s."] = "<b>%s</b> пригласил Вас в %s.";
$definitions["%s joined the forum."] = "<b>%s</b> присоединился к форуму.";
$definitions["Joined"] = "Присоединился";
$definitions["%s post"] = "%s сообщ.";
$definitions["%s posts"] = "%s сообщ.";
$definitions["%s posted %s"] = "%s".", %s";
$definitions["%s posted in %s."] = "<b>%s</b> разместил сообщение в %s.";
$definitions["%s reply"] = "%s ответ";
$definitions["%s replies"] = "%s ответов";
$definitions["%s Settings"] = "%s Настройки";
$definitions["%s started the conversation %s."] = "<b>%s</b> начал обсуждение %s.";
$definitions["%s tagged you in a post."] = "<b>%s</b> упомянул Вас в сообщении.";
$definitions["%s will be able to view this conversation."] = "%s сможет просматривать это обсуждение.";
$definitions["%s will be able to:"] = "%s сможет:";
$definitions["conversations.replies"] = "ответов";
$definitions["conversations.newreplies"] = "новых";
$definitions["conversation.replies"] = "Ответы: ";
$definitions["%s others"] = "%s других";

$definitions["A new version of esoTalk (%s) is available."] = "Новая версия esoTalk (%s) доступна!";
$definitions["a private conversation"] = "частное обсуждение";
$definitions["Access the administrator control panel."] = "Доступ к административной панели управления.";
$definitions["Account type"] = "Тип аккаунта";
$definitions["Activate"] = "Активировать";
$definitions["Activity"] = "Активность";
$definitions["Add"] = "Добавить";
$definitions["Administration"] = "Администрирование";
$definitions["Administrator email"] = "E-mail Администратора";
$definitions["Administrator password"] = "Пароль Администратора";
$definitions["Administrator username"] = "Имя Администратора";
$definitions["Advanced options"] = "Расширенные настройки";
$definitions["All Channels"] = "Все каналы";
$definitions["Already have an account? <a href='%s' class='link-login'>Log in!</a>"] = "У Вас есть аккаунт? <a href='%s' class='link-login'>Войдите!</a>";
$definitions["Don't have an account? <a href='%s' class='link-join'>Sign up!</a>"] = "У Вас нет аккаунта? <a href='%s' class='link-join'>Зарегистрируйтесь!</a>";
$definitions["Keep me logged in"] = "Запомнить меня";
$definitions["Appearance"] = "Оформление";
$definitions["Automatically star conversations that I reply to"] = "Автоматически добавлять в избранное обсуждения, в которых я отвечаю";
$definitions["Avatar"] = "Аватар";

$definitions["Back to channels"] = "Вернуться к списку каналов";
$definitions["Back to conversation"] = "Вернуться к обсуждению";
$definitions["Back to member"] = "Вернуться к участнику";
$definitions["Back to members"] = "Вернуться к участникам";
$definitions["Back to search"] = "Вернуться к поиску";
$definitions["Base URL"] = "Базовый URL форума";
$definitions["Bold"] = "Жирный";
$definitions["By %s"] = "Автор %s";

$definitions["Can suspend/unsuspend members"] = "Может блокировать/разблокировать участников";
$definitions["Cancel"] = "Отмена";
$definitions["Change %s's Permissions"] = "Изменить привилегии %s";
$definitions["Change avatar"] = "Изменить аватар";
$definitions["Change channel"] = "Изменить канал";
$definitions["Change Channel"] = "Изменить канал";
$definitions["Change name"] = "Изменить имя";
$definitions["Change Password or Email"] = "Изменить пароль или e-mail";
$definitions["Change password"] = "Изменить пароль";
$definitions["Change Password"] = "Изменить пароль";
$definitions["Change permissions"] = "Изменить привилегии";
$definitions["Change"] = "Изменить";
$definitions["Channel description"] = "Описание канала";
$definitions["Channel List"] = "Список каналов";
$definitions["Channel title"] = "Название канала";
$definitions["Channel slug"] = "Адрес канала";
$definitions["Channels"] = "Каналы форума";
$definitions["Choose a secure password of at least %s characters"] = "Выберите безопасный пароль из минимум %s символов";
$definitions["Choose what people will see when they first visit your forum."] = "Выберите, что люди будут видеть при первом посещении Вашего форума.";
$definitions["Click on a member's name to remove them."] = "Кликните на именах участников, чтобы удалить их.";
$definitions["Close registration"] = "Закрыть регистрацию";
$definitions["Confirm password"] = "Подтвердите пароль";
$definitions["Context"] = "Контекст";
$definitions["Controls"] = "Управл.";
$definitions["Conversation"] = "Обсуждение";
$definitions["Conversations participated in"] = "Участие в обсуждениях";
$definitions["Conversations started"] = "Обсуждений начато";
$definitions["Conversations"] = "Обсуждения";
$definitions["Copy permissions from"] = "Скопировать разрешения из";
$definitions["Create Channel"] = "Создать канал";
$definitions["Create Group"] = "Создать группу";
$definitions["Create Member"] = "Создать участника";
$definitions["Customize how users can become members of your forum."] = "Настройте, как люди смогут стать участниками Вашего форума.";
$definitions["Dashboard"] = "Панель управления";
$definitions["Default forum language"] = "Язык форума";
$definitions["<strong>Delete</strong> all conversations forever."] = "<strong>Удалить</strong> все обсуждения навсегда!";
$definitions["Delete Channel"] = "Удалить канал";
$definitions["Delete conversation"] = "Удалить обсуждение";
$definitions["Delete member"] = "Удалить участника";
$definitions["Delete Member"] = "Удалить участника";
$definitions["<strong>Delete this member's posts.</strong> All of this member's posts will be marked as deleted, but will be able to be restored manually."] = "<strong>Удалить все сообщения данного участника.</strong> Все сообщения участника будут помечены удаленными, но смогут быть восстановлены вручную.";
$definitions["Delete"] = "Удалить";
$definitions["deleted"] = "удалено";
$definitions["Deleted %s by %s"] = "%s удалено %s";
$definitions["Disable"] = "Отключить";
$definitions["Discard"] = "Удалить";

$definitions["Edit Channel"] = "Редактировать канал";
$definitions["Edit Group"] = "Редактировать группу";
$definitions["Edit member groups"] = "Редактировать группы пользователей";
$definitions["Edit your profile"] = "Редактировать профиль";
$definitions["Edit"] = "Редактировать";
$definitions["Edited %s by %s"] = "%s отредактировано %s";
$definitions["Email me when I'm added to a private conversation"] = "Сообщить на почту, когда меня добавили в частное обсуждение";
$definitions["Email me when someone posts in a conversation I have starred"] = "Сообщить на почту, когда кто-то оставил сообщение в обсуждении из моего избранного";
$definitions["Email"] = "E-mail";
$definitions["Enable"] = "Включить";
$definitions["Enabled"] = "Включен";
$definitions["Enter a conversation title"] = "Введите заголовок";
$definitions["Error"] = "Ошибка";
$definitions["esoTalk version"] = "Версия esoTalk ";
$definitions["Registered members"] = "Участники форума";
$definitions["Everyone"] = "Кто угодно";
$definitions["hidden"] = "скрыто";
$definitions["%d hidden"] = "%d скрытых";
$definitions["Email me when someone posts in a conversation I have followed"] = "Сообщить на почту о новых сообщениях в избранных обсуждениях";
$definitions["Email me when someone mentions me in a post"] = "Сообщить на почту об ответах на мои сообщения";
$definitions["Automatically follow conversations that I reply to"] = "Автоматически добавлять в Избранное обсуждения, в которых я участвую";
$definitions["Automatically follow private conversations that I'm added to"] = "Автоматически добавлять в Избранное частные обсуждения, в которые я добавлен";
$definitions["Don't allow other users to see when I am online"] = "Запретить другим участникам видеть мой Онлайн-статус";
$definitions["Change username"] = "Изменить имя";
$definitions["Choose a Channel"] = "Укажите канал";
$definitions["Older"] = "Ранее";
$definitions["Newer"] = "Новее";
$definitions["Load more posts"] = "Больше сообщений";
$definitions["Back to administration"] = "Вернуться к администрированию";
$definitions["Attach/detach panel"] = "Прикрепить/открепить панель";

$definitions["Fatal Error"] = "Критическая ошибка!";
$definitions["Feed"] = "Лента";
$definitions["Filter by name or group..."] = "Фильтровать по имени или группе...";
$definitions["Filter conversations..."] = "Фильтровать обсуждения...";
$definitions["Find this post"] = "Найти это сообщение";
$definitions["First posted"] = "Первое сообщение";
$definitions["Forgot Password"] = "Восстановление пароля";
$definitions["Forum header"] = "Заголовок форума";
$definitions["Forum language"] = "Язык форума";
$definitions["Forum Settings"] = "Настройки форума";
$definitions["Forum Statistics"] = "Статистика форума";
$definitions["Forum title"] = "Название форума";
$definitions["forumDescription"] = "%s это веб-форум, обсуждающий %s и %s.";

$definitions["Give this group the 'moderate' permission on all existing channels"] = "Дать этой группе модераторские привилегии во всех существующих каналах";
$definitions["Give this group the 'manage KB' permission on all existing channels"] = "Дать этой группе привилегии инженера знаний во всех существующих каналах";
$definitions["Global permissions"] = "Глобальные привилегии";
$definitions["Go to top"] = "Перейти вверх";
$definitions["Group name"] = "Имя группы";
$definitions["group.administrator"] = "Администратор";
$definitions["group.administrator.plural"] = "Администраторы";
$definitions["group.guest"] = "Гость";
$definitions["group.guest.plural"] = "Гости";
$definitions["group.member"] = "Участник";
$definitions["group.member.plural"] = "Участники";
$definitions["group.Moderator"] = "Модератор";
$definitions["group.Moderator.plural"] = "Модераторы";
$definitions["group.suspended"] = "Заблокирован";
$definitions["Groups can be used to categorize members and give them certain privileges."] = "Группы используются для разделения пользователей и раздачи им определенных привилегий.";
$definitions["Groups"] = "Группы";
$definitions["Header"] = "Заголовок";
$definitions["Home page"] = "Домашняя страница";
$definitions["HTML is allowed."] = "HTML разрешен.";

$definitions["If you run into any other problems or just want some help with the installation, feel free to ask for assistance at the <a href='%s'>esoTalk support forum</a>."] = "Если у Вас возникнут проблемы с установкой или работой форума, обращайтесь за помощью на <a href='%s'>форум поддержки esoTalk</a>.";
$definitions["Install esoTalk"] = "Установить форум esoTalk";
$definitions["Install My Forum"] = "Установить мой форум";
$definitions["Installed Languages"] = "Установленные языки";
$definitions["Installed Plugins"] = "Установленные плагины";
$definitions["Installed plugins"] = "Установленные плагины";
$definitions["Installed Skins"] = "Установленные темы";
$definitions["Installed skins"] = "Установленные темы";
$definitions["is %s"] = "сейчас %s";
$definitions["Jump to last"] = "Перейти к последнему";
$definitions["Jump to unread"] = "Перейти к непрочитанному";
$definitions["just now"] = "только что";

$definitions["<strong>Keep this member's posts.</strong> All of this member's posts will remain intact, but will show [deleted] as the author."] = "<strong>Сохранить сообщения этого участника.</strong> Все сообщения участника сохраняются, но будут отображаться как [удаленные] вместе с участником.";
$definitions["label.draft"] = "Черновик";
$definitions["label.locked"] = "Заблокировано";
$definitions["label.muted"] = "Скрыто";
$definitions["label.private"] = "Частное";
$definitions["label.sticky"] = "Прикреплено";
$definitions["label.KB"] = "База знаний";
$definitions["Labels"] = "Метки";
$definitions["Last active %s"] = "Последняя активность %s";
$definitions["Latest News"] = "Последние новости";
$definitions["Loading..."] = "Загрузка...";
$definitions["Lock"] = "Заблокировать";
$definitions["Log In"] = "Вход";
$definitions["Log Out"] = "Выход";

$definitions["Manage Groups"] = "Управление группами";
$definitions["Manage Languages"] = "Управление языками";
$definitions["Mark as read"] = "Пометить прочитанным";
$definitions["Mark all as read"] = "Пометить всё прочитанным";
$definitions["Maximum size of %s. %s."] = "Максимальный размер %s. Формат: %s.";
$definitions["Member groups"] = "Группы участников";
$definitions["Member list"] = "Список участников";
$definitions["Member List"] = "Список участников";
$definitions["Make member list visible to:"] = "Список участников форума могут просматривать";
$definitions["Members Allowed to View this Conversation"] = "Участники, которым разрешено просматривать это обсуждение";
$definitions["Members Online"] = "Участники онлайн";
$definitions["Members"] = "Участники";
$definitions["Mobile skin"] = "Мобильная тема";
$definitions["Moderate"] = "Модерация";
$definitions["Manage KB"] = "Инженер знаний";
$definitions["<strong>Move</strong> conversations to the following channel:"] = "<strong>Переместить</strong> обсуждения в этот канал:";
$definitions["Mute conversation"] = "Скрыть";
$definitions["MySQL database"] = "База данных MySQL";
$definitions["MySQL host address"] = "Адрес хоста MySQL";
$definitions["MySQL password"] = "Пароль MySQL";
$definitions["MySQL queries"] = "Запросы MySQL";
$definitions["MySQL table prefix"] = "Префикс таблиц MySQL";
$definitions["MySQL username"] = "Имя пользователя MySQL";
$definitions["MySQL version"] = "Версия MySQL";
$definitions["Member privacy"] = "Конфиденциальность участников";
$definitions["Make member and online list visible to:"] = "Кто может смотреть участников и их онлайн-статус:";
$definitions["Editing permissions"] = "Настройка разрешений";
$definitions["Allow members to edit their own posts:"] = "Разрешить участникам редактировать свои сообщения:";
$definitions["Forever"] = "Всегда";
$definitions["Until someone replies"] = "Пока кто-то не ответит";
$definitions["For %s seconds"] = "В течение %s секунд";
$definitions["Mark listed as read"] = "Пометить обсуждения из списка прочитанными";

// default Skin
$definitions["Header color"] = "Цвет заголовка";
$definitions["Background color"] = "Цвет фона";
$definitions["Reset"] = "Сбросить";
$definitions["Background image"] = "Фоновое изображение";
$definitions["Use a background image"] = "Использовать фоновое изображение";
$definitions["Don't repeat"] = "Не повторять";

$definitions["Name"] = "Имя";
$definitions["Last active"] = "Активность";
$definitions["never"] = "никогда";
$definitions["New Conversation"] = "Новое обсуждение";
$definitions["New conversation"] = "Новое обсуждение";
$definitions["New conversations in the past week"] = "Новые обсуждения за неделю";
$definitions["New email"] = "Новый e-mail";
$definitions["New members in the past week"] = "Новые пользователи за неделю";
$definitions["New password"] = "Новый пароль";
$definitions["New posts in the past week"] = "Новые сообщения за неделю";
$definitions["New username"] = "Новое имя пользователя";
$definitions["Next Step"] = "Следующий шаг";
$definitions["Next"] = "Далее";
$definitions["No preview"] = "Нет предварительного просмотра";
$definitions["No"] = "Нет";
$definitions["Notifications"] = "Уведомления";
$definitions["Now"] = "Сейчас";

$definitions["OK"] = "OK";
$definitions["Online"] = "Онлайн";
$definitions["online"] = "онлайн";
$definitions["Open registration"] = "Открыть регистрацию";
$definitions["optional"] = "дополнительно";
$definitions["Order By:"] = "Упорядочить по:";
$definitions["Original Post"] = "Оригинальное сообщение";

$definitions["Page Not Found"] = "Страница не найдена";
$definitions["Username or Email"] = "Имя или e-mail";
$definitions["Password"] = "Пароль";
$definitions["Forgot?"] = "Забыли?";
$definitions["PHP version"] = "Версия PHP";
$definitions["Plugins"] = "Плагины";
$definitions["Post a Reply"] = "Ответить";
$definitions["Post count"] = "Счетчик сообщений";
$definitions["Posts"] = "Сообщения";
$definitions["Preview"] = "Предварительный просмотр";
$definitions["Previous"] = "Предыдущий";

$definitions["quote"] = "цитата";
$definitions["Read more"] = "Читать далее";
$definitions["Recent posts"] = "Последние сообщения";
$definitions["Recover Password"] = "Восстановить пароль";
$definitions["Registration"] = "Регистрация";
$definitions["Registration Closed"] = "Регистрация закрыта";
$definitions["Remove avatar"] = "Удалить аватар";
$definitions["Rename Member"] = "Переименовать участника";
$definitions["Reply"] = "Ответ";
$definitions["Start"] = "Начало обсуждения";
$definitions["Report a bug"] = "Сообщить об ошибке";
$definitions["Require users to confirm their email address"] = "Требовать подтверждения пользователями их e-mail";
$definitions["Restore"] = "Восстановить";

$definitions["Save Changes"] = "Сохранить изменения";
$definitions["Save Draft"] = "Сохранить черновик";
$definitions["Search conversations..."] = "Искать обсуждения...";
$definitions["Search within this conversation..."] = "Искать в этом обсуждении...";
$definitions["Search"] = "Искать";
$definitions["See the private conversations I've had with %s"] = "Просмотреть мои частные обсуждения с %s";
$definitions["Settings"] = "Настройки";
$definitions["Set a New Password"] = "Установка нового пароля";
$definitions["Show an image in the header"] = "Показывать логотип в заголовке";
$definitions["Show matching posts"] = "Показывать подходящие сообщения";
$definitions["Show the channel list by default"] = "Показывать список каналов";
$definitions["Show the conversation list by default"] = "Показывать список обсуждений";
$definitions["Show the forum title in the header"] = "Показывать название форума в заголовке";
$definitions["Sign Up"] = "Регистрация";
$definitions["Skins"] = "Темы оформления";
$definitions["Specify Setup Information"] = "Введите информацию для установки";
$definitions["Star to receive notifications"] = "Подписаться для получения уведомлений";
$definitions["Starred"] = "Избранное";
$definitions["Follow"] = "Избранное";
$definitions["Following"] = "Избранное";
$definitions["Follow to receive notifications"] = "Подписаться для получения уведомлений";
$definitions["Start a conversation"] = "Начать обсуждение";
$definitions["Start a private conversation with %s"] = "Начать частное обсуждение с %s";
$definitions["Start Conversation"] = "Начать обсуждение";
$definitions["Starting a conversation"] = "начинает обсуждение";
$definitions["Statistics"] = "Статистика";
$definitions["statistic.conversation.plural"] = "%s обсуждений";
$definitions["statistic.conversation"] = "%s обсуждение";
$definitions["statistic.member.plural"] = "%s участников";
$definitions["statistic.member"] = "%s участник";
$definitions["statistic.online.plural"] = "%s онлайн";
$definitions["statistic.online"] = "%s онлайн";
$definitions["statistic.post.plural"] = "%s сообщений";
$definitions["statistic.post"] = "%s сообщение";
$definitions["Sticky"] = "Прикрепить";
$definitions["toKB"] = "Включить в БЗ";
$definitions["fromKB"] = "Исключить из БЗ";
$definitions["Subscribed"] = "Подписано";
$definitions["Subscription"] = "Подписка";
$definitions["Success!"] = "Успешно!";
$definitions["Suspend member"] = "Заблокировать участника";
$definitions["Suspend members."] = "Заблокировать участников";
$definitions["Suspend"] = "Заблокировать";
$definitions["Try Again"] = "Попробуйте еще раз";

$definitions["Uninstall"] = "Удалить";
$definitions["Unlock"] = "Разблокировать";
$definitions["Unmute conversation"] = "Показать";
$definitions["Unstarred"] = "Не в избранном";
$definitions["Unsticky"] = "Открепить";
$definitions["Unsubscribe new users by default"] = "Отменить подписку новых пользователей по-умолчанию";
$definitions["Unsubscribed"] = "Не подписано";
$definitions["Unsuspend member"] = "Разблокировать участника";
$definitions["Unsuspend"] = "Разблокировать";
$definitions["Untitled conversation"] = "Обсуждение без названия";
$definitions["Upgrade esoTalk"] = "Обновить esoTalk";
$definitions["Use for mobile"] = "Использовать для мобильных устройств";
$definitions["Use friendly URLs"] = "Использовать дружественные URL (ЧПУ)";
$definitions["Used to verify your account and subscribe to conversations"] = "Используется для проверки и активации Вашего аккаунта";
$definitions["Username"] = "Имя пользователя";

$definitions["View %s's profile"] = "Просмотреть профиль %s";
$definitions["View all notifications"] = "Просмотреть все уведомления";
$definitions["View more"] = "Просмотреть больше";
$definitions["View your profile"] = "Просмотреть профиль";
$definitions["View"] = "Просмотр";
$definitions["Viewing: %s"] = "просматривает: %s";
$definitions["Viewing %s"] = "просматривает %s";
$definitions["viewingPosts"] = "<b>%s-%s</b> сообщения %s";
$definitions["Warning"] = "Предупреждение";
$definitions["Write a reply..."] = "Написать ответ...";
$definitions["Yes"] = "Да";
$definitions["You can manage channel-specific permissions on the channels page."] = "Вы можете менять настройки привилегий каналов на странице каналов.";
$definitions["Your current password"] = "Текущий пароль";
$definitions["Privacy"] = "Конфиденциальность";
$definitions["Only allow members of this group to see who else is in it"] = "Только участникам группы разрешено видеть других участников группы";
$definitions["Members who are part of this group can be listed by searching for the group name in the member list."] = "Участники данной группы могут быть найдены поиском по имени группы в общем списке участников";
$definitions["Hide"] = "Скрыть";
$definitions["Unhide"] = "Показать";

// Posts
$definitions["post.byAuthor"] = "автором";
$definitions["post.byAdministrator"] = "администратором";

// Messages.
$definitions["message.404"] = "Запрошенная Вами страница не найдена! Проверьте Ваш запрос или перейдите по другой ссылке.";
$definitions["message.ajaxDisconnected"] = "Невозможно связаться с сервером. Подождите немного и <a href='javascript:jQuery.ETAjax.resumeAfterDisconnection()'>попробуйте снова</a>, или <a href='' onclick='window.location.reload();return false'>обновите страницу</a>.";
$definitions["message.ajaxRequestPending"] = "Подождите! Ваш запрос обрабатывается! Если Вы уйдете с этой страницы, то все сделанные вами изменения будут утеряны.";
$definitions["message.avatarError"] = "Не удалось загрузить Ваш аватар. Проверьте тип используемого изображения (.jpg, .png, .gif) и его размер.";
$definitions["message.cannotDeleteLastChannel"] = "Подождите, Вы не можете удалить последний канал! Где Вы будете вести обсуждения? Подумайте хорошенько.";
$definitions["message.changesSaved"] = "Ваши изменения сохранены.";
$definitions["message.channelsHelp"] = "Каналы используются для разделения обсуждений на категории. Вы можете создать необходимое вам количество каналов и упорядочить/сортировать их, перетаскивая вверх/вниз.";
$definitions["message.channelSlugTaken"] = "Эта метка уже используется другой темой.";
$definitions["message.close"] = "Закрыть";
$definitions["message.confirmDelete"] = "Вы уверены, что хотите удалить это? Вы не сможете это восстановить!";
$definitions["message.confirmDiscardReply"] = "Вы не сохранили Ваш ответ как черновик. Хотите удалить его навсегда?";
$definitions["message.confirmEmail"] = "Перед тем, как Вы сможете использовать аккаунт, необходимо подтвердить Ваш e-mail адрес. В ближайшее время (пару минут) Вы получите e-mail, содержащий инструкции по активации аккаунта.";
$definitions["message.confirmLeave"] = "Подождите, Вы не сохранили то, что редактируете! Если Вы уйдете с этой страницы, то потеряете все изменения. Вы уверены?";
$definitions["message.connectionError"] = "Форум esoTalk не может соединиться с MySQL сервером. Возвращенная ошибка:<br/>%s";
$definitions["message.conversationDeleted"] = "Обсуждение было удалено!";
$definitions["message.conversationNotFound"] = "Это обсуждение не может быть просмотрено. Возможно, Вы не вошли на форум или не имеете права его просмотра, либо оно было удалено.";
$definitions["message.cookieAuthenticationTheft"] = "Возможно, была попытка взлома Вашего аккаунта. Из соображений безопасности, Вам необходимо заново войти в аккаунт.";
$definitions["message.deleteChannelHelp"] = "Если Вы удалите этот канал, то не сможете его восстановить. Вместо этого, все Ваши обсуждения могут быть перемещены в другой канал по Вашему выбору.";
$definitions["message.emailConfirmed"] = "Ваш аккаунт подтвержден и активирован, и Вы можете начинать обсуждения с другими участниками. Почему бы не <a href='".URL("conversation/start")."'>начать</a> прямо сейчас?";
$definitions["message.emailDoesntExist"] = "Этот e-mail адрес не совпадает ни с одним из адресов участников форума. Возможно, Вы ошиблись?";
$definitions["message.emailNotYetConfirmed"] = "Вы должны подтвердить Ваш адрес e-mail перед тем, как сможете войти!<br>Если Вы не получили письмо с подтверждением регистрации, то <a href='%s'>нажмите тут</a> для его повторной отправки.";
$definitions["message.emailTaken"] = "Участник форума с таким e-mail уже зарегистрирован!";
$definitions["message.empty"] = "Вы должны заполнить это поле.";
$definitions["message.emptyPost"] = "Вы должны хоть что-нибудь написать в Вашем сообщении.";
$definitions["message.emptyTitle"] = "Заголовок Вашего сообщения не может быть пустым.";
$definitions["message.esoTalkAlreadyInstalled"] = "<strong>Форум esoTalk уже установлен.</strong><br/><small>Для переустановки esoTalk, Вы должны удалить файл <strong>config/config.php</strong>.</small>";
$definitions["message.esoTalkUpdateAvailable"] = "Новая версия esoTalk, %s, доступна!";
$definitions["message.esoTalkUpdateAvailableHelp"] = "Настоятельно рекомендуется поддерживать esoTalk всегда в обновленном состоянии. Это снижает риск взлома, исправляет ошибки и добавляет новые функции!";
$definitions["message.esoTalkUpToDate"] = "Ваша версия esoTalk самая последняя.";
$definitions["message.esoTalkUpToDateHelp"] = "Если Вам нравится форум, окажите материальную поддержку его <a href='%s' target='_blank'>автору</a>.";
$definitions["message.fatalError"] = "<p>Обнаружена критическая ошибка! Возможно, отсутствует соединение с БД.</p>";
$definitions["message.fatalErrorInstaller"] = "<p>Форум esoTalk обнаружил критическую ошибку, не позволяющую сделать то, что Вы хотели - установку.\n<li><p><strong>Проверьте Ваши настройки.</strong> Также, рекомендуется проверить Вашу базу данных форума.</p></li>";
$definitions["message.fatalErrorUpgrader"] = "<p>Форум esoTalk обнаружил критическую ошибку, не позволяющую сделать то, что Вы хотели - обновление.\n<li><p><strong>Проверьте Ваши настройки.</strong> Также, рекомендуется проверить Вашу базу данных форума.</p></li>";
$definitions["message.fileUploadFailed"] = "Выбранный Вами файл не может быть загружен. Он или слишком велик, или в неправильном формате.";
$definitions["message.fileUploadFailedMove"] = "Загружаемый Вами файл не может быть скопирован в папку назначения. Пожалуйста, свяжитесь с Администрацией форума.";
$definitions["message.fileUploadNotImage"] = "Загружаемый Вами файл не является изображением в допустимом формате!";
$definitions["message.fileUploadTooBig"] = "Выбранный вами файл не может быть загружен т.к. он слишком большой.";
$definitions["message.forgotPasswordHelp"] = "Итак, Вы забыли пароль! Не волнуйтесь, это случается часто и со всеми. Просто введите адрес e-mail Вашего аккаунта, и мы вышлем Вам инструкции по восстановлению пароля.";
$definitions["message.fulltextKeywordWarning"] = "Обратите внимание, что фразы короче 4 символов, а также английские слова 'the' и 'for', не включаются в параметры поиска.";
$definitions["message.gambitsHelp"] = "Теги - это фразы, описывающие то, что Вы хотите найти. Щелкните на теге, чтобы вставить его в поисковое поле. Дважды щелкните на теге для моментального поиска по нему.<br> Обычный поиск тоже работает!";
$definitions["message.gdNotEnabledWarning"] = "Внимание, <strong>GD расширение PHP</strong> не активировано.<br/><small>. Установите или активируйте его.</small>";
$definitions["message.greaterMySQLVersionRequired"] = "На Вашем сервере должен быть установлен <strong>MySQL 4 или выше</strong> и <a href='http://php.net/manual/en/mysql.installation.php' target='_blank'>MySQL-расширение должно быть включено в настройках PHP</a>.<br/>";
$definitions["message.greaterPHPVersionRequired"] = "На Вашем сервере должен быть установлен <strong>PHP 5.0.0 или выше</strong> для запуска esoTalk.<br/><small>Пожалуйста, обновите PHP.</small>";
$definitions["message.imageLoadingError"] = "Ошибка загрузки изображения!";
$definitions["message.incorrectLogin"] = "Ваш логин неправильный.";
$definitions["message.incorrectPassword"] = "Ваш пароль неправильный.";
$definitions["message.installerAdminHelp"] = "Форум esoTalk будет использовать эту информацию для настройки аккаунта Администратора форума.";
$definitions["message.installerFilesNotWritable"] = "Форум esoTalk не имеет прав записи в эти файлы/папки: <strong>%s</strong>.<br/><small>Чтобы исправить это, Вам нужно перейти к этим файлам/папкам в FTP клиенте и выполнить на них команду <strong>chmod</strong> изменив права доступа на <strong>777</strong>.</small>";
$definitions["message.installerMySQLHelp"] = "Форуму esoTalk необходим доступ к базе MySQL для хранения сообщений и других данных форума. Если Вы не уверены в параметрах доступа, то проконсультируйтесь с Вашим администратором или хостинг-провайдером.";
$definitions["message.installerWelcome"] = "<p>Добро пожаловать в установщик форума esoTalk! Нам необходимо уточнить у Вас некоторые параметры для установки форума.</p>\n<p>Если у Вас возникнут трудности в установке, обращайтесь за помощью на <a href='%s'>форум поддержки esoTalk</a>.</p>";
$definitions["message.invalidChannel"] = "Вы выбрали неправильный канал!";
$definitions["message.invalidEmail"] = "Этот e-mail адрес неправильный.";
$definitions["message.invalidUsername"] = "Имя пользователя может содержать буквы, цифры, символы пробела, дефиса и подчёркивания, иметь длину от 2 до 20 символов.";
$definitions["message.javascriptRequired"] = "Эта страница требует включенного JavaScript для корректной работы!";
$definitions["message.languageUninstalled"] = "Язык был удален.";
$definitions["message.locked"] = "Это обсуждение <strong>заблокировано</strong>, поэтому Вы не можете в нём участвовать.";
$definitions["message.lockedCannotChange"] = "Это обсуждение <strong>заблокировано</strong>, поэтому его нельзя изменять.";
$definitions["message.loginToParticipate"] = "Для участия в обсуждениях и размещения сообщений, пожалуйста, войдите на форум.";
$definitions["message.logInToReply"] = "<a href='%1\$s' class='link-login'>Войдите</a> или <a href='%2\$s' class='link-join'>зарегистрируйтесь</a> чтобы ответить!";
$definitions["message.logInToSeeAllConversations"] = "<a href='".URL("user/login")."' class='link-login'>Войдите</a> для просмотра тем/обсуждений скрытых от гостей.";
$definitions["message.memberNotFound"] = "Нет пользователя с таким именем.";
$definitions["message.memberNoPermissionView"] = "Этот участник не может быть добавлен потому, что у него нет разрешения на просмотр канала, к которому принадлежит это обсуждение.";
$definitions["message.nameTaken"] = "Введенное Вами имя занято или зарезервировано. Попробуйте другое.";
$definitions["message.newSearchResults"] =  "Появились новые обсуждения/сообщения, влияющие на результаты Вашего поиска. <a href='%s'>Обновить</a>";
$definitions["message.noActivity"] = "%s еще ничего не сделал на этом форуме.";
$definitions["message.noMembersOnline"] = "Нет пользователей онлайн.";
$definitions["message.noNotifications"] = "У Вас нет уведомлений.";
$definitions["message.noPermission"] = "У Вас нет разрешения выполнять это действие!";
$definitions["message.noPermissionToReplyInChannel"] = "У Вас нет разрешения участвовать в обсуждениях этого канала.";
$definitions["message.noPluginsInstalled"] = "Нет установленных плагинов.";
$definitions["message.noSearchResults"] = "Результатов по Вашему запросу не найдено.";
$definitions["message.noSearchResultsMembers"] = "Пользователей по Вашему запросу не найдено.";
$definitions["message.noSearchResultsPosts"] = "Сообщений по Вашему запросу не найдено.";
$definitions["message.noSkinsInstalled"] = "Нет установленных тем.";
$definitions["message.notWritable"] = "Папки <code>%s</code> не доступны для записи. Попробуйте выполнить команду <code>chmod</code> и сменить права доступа к ним на <code>777</code>, или измените аналогично права доступа к содержащей их вышестоящей папке.";
$definitions["message.oldVersionIE"] = "Внимание! Вы используете устаревшую версию браузера Internet Explorer. Из-за этого часть содержимого форума будет отображаться некорректно, и часть функционала будет недоступна. Настоятельно рекомендуем Вам обновить версию браузера для корректной работы данного форума. Скачать свежую версию можно <a href='http://windows.microsoft.com/ru-ru/internet-explorer/download-ie'>здесь</a>.";
$definitions["message.pageNotFound"] = "Запрошенная вами страница не найдена.";
$definitions["message.passwordChanged"] = "Ваш пароль был изменен. Теперь Вы можете войти!";
$definitions["message.passwordEmailSent"] = "Мы отправили вам e-mail, содержащий ссылку на сброс пароля. Проверьте папку со спамом в Вашем почтовом ящике, если сообщение не придет в течении нескольких минут.";
$definitions["message.passwordsDontMatch"] = "Пароли не совпадают.";
$definitions["message.passwordTooShort"] = "Пароль слишком короткий.";
$definitions["message.pluginCannotBeEnabled"] = "Плагин <em>%s</em> не может быть установлен: %s";
$definitions["message.pluginDependencyNotMet"] = "Для активации этого плагина, Вы должны иметь %s версии %s установленным и активированным.";
$definitions["message.pluginUninstalled"] = "Плагин удален.";
$definitions["message.postNotFound"] = "Запрошенное Вами сообщение не найдено.";
$definitions["message.postTooLong"] = "Ваше сообщение слишком длинное! Максимальная разрешенная длина сообщения %s символов.";
$definitions["message.preInstallErrors"] = "Во время установки esoTalk произошли критические ошибки. Они должны быть устранены до того, как Вы сможете продолжить установку.";
$definitions["message.preInstallWarnings"] = "Во время установки esoTalk произошли ошибки. Вы можете продолжить установку esoTalk без их устранения, но некоторые функции esoTalk будут ограничены или отключены.";
$definitions["message.reduceNumberOfGambits"] = "Уменьшите количество используемых поисковых фраз, чтобы найти более широкий дипазон значений.";
$definitions["message.registerGlobalsWarning"] = "Параметр <strong>register_globals</strong> включен в настройках PHP!<br/><small>Несмотря на то, что esoTalk может работать с этой настройкой, настоятельно рекомендуется отключить ее в целях безопасности.</small>";
$definitions["message.registrationClosed"] = "Свободная регистрация на форуме закрыта. Попробуйте зайти позже.";
$definitions["message.removeDirectoryWarning"] = "Кажется, Вы не удалили папки <code>%s</code>! Вам необходимо это сделать, чтобы обезопасить себя от взлома хакерами!";
$definitions["message.safeModeWarning"] = "<strong>Безопасный режим</strong> включен.<br/><small>Это может привести к возникновению проблем с esoTalk, но Вы можете продолжить если не имеете возможности его отключить.</small>";
$definitions["message.searchAllConversations"] = "Попробуйте поискать это значение по всем обсуждениям.";
$definitions["message.setNewPassword"] = "Какой Вы хотите установить новый пароль?";
$definitions["message.skinUninstalled"] = "Тема оформления была удалена.";
$definitions["message.suspended"] = "Администрация форума <strong>заблокировала</strong> Ваш аккаунт.";
$definitions["message.suspendMemberHelp"] = "Блокировка аккаунта %s запретит ему участвовать в обсуждениях на форуме. После этого аккаунт будет иметь привилегии гостя форума.";
$definitions["message.tablePrefixConflict"] = "Установщик определил, что другая инсталяция esoTalk использует ту же MySQL базу с аналогичными таблицами.<br/>Чтобы перезаписать (удалить) эту инсталяцию esoTalk, нажмите 'Установить мой форум' снова.<strong>Все данные будут утеряны!</strong><br/>Если Вы хотите создать другую инсталяцию esoTalk вместе с существующей, <strong>измените префикс таблиц</strong>.";
$definitions["message.unsuspendMemberHelp"] = "Разблокировка аккаунта %s позволит ему снова участвовать в обсуждениях на форуме.";
$definitions["message.upgradeSuccessful"] = "Форум esoTalk был успешно обновлен!";
$definitions["message.videoLoadingError"] = "Ошибка загрузки видео!";
$definitions["message.waitToReply"] = "Вы должны подождать минимум %s секунд перед началом нового обсуждения или ответом.";
$definitions["message.waitToSearch"] = "Вы пытаетесь выполнить одновременно слишком много поисковых запросов. Подождите %s секунд и попробуйте снова.";

// Emails.
$definitions["email.confirmEmail.body"] = "Кто-то (надеемся, что Вы) хочет зарегистрироваться на нашем форуме '%1\$s' с этим адресом e-mail.\n\nЕсли это были Вы, то просто перейдите по ссылке, и Ваш аккаунт будет активирован:\n%2\$s";
$definitions["email.confirmEmail.disclaimer"] = "\n\n----------------------------------------\n\nПравила форума: %1\$s \n\nОписание возможностей: %2\$s";
$definitions["email.confirmEmail.subject"] = "Подтверждение регистрации пользователя %1\$s";
$definitions["email.footer"] = "\n\nЕсли Вы не хотите получать никаких уведомлений, то <a href='%s'>нажмите тут</a>.";
$definitions["email.forgotPassword.body"] = "Кто-то (надеемся, что Вы) разместил запрос на восстановление пароля к Вашему аккаунту на форуме '%1\$s'. Если это были не Вы, или у Вас нет желания менять пароль, то просто проигнорируйте это сообщение.\n\nЕсли же Вы действительно забыли пароль и хотите его поменять, то перейдите по этой ссылке:\n%2\$s";
$definitions["email.forgotPassword.subject"] = "Вы забыли Ваш пароль, %1\$s?";
$definitions["email.header"] = "Здравствуйте, %s!\n\n";
$definitions["email.mention.body"] = "%1\$s упомянул Вас в сообщении в обсуждении '%2\$s'.\n\nДля просмотра этого сообщения перейдите по этой ссылке:\n%3\$s";
$definitions["email.mention.subject"] = "%1\$s упомянул Вас в сообщении";
$definitions["email.privateAdd.body"] = "Вас добавили к частному обсуждению, озаглавленному '%1\$s'.\n\nДля просмотра этого обсуждения перейдите по этой ссылке:\n%2\$s";
$definitions["email.privateAdd.subject"] = "Вас добавили к частному обсуждению";
$definitions["email.replyToStarred.body"] = "%1\$s ответил на сообщение из Вашего избранного: '%2\$s'.\n\nДля просмотра этого сообщения перейдите по этой ссылке:\n%3\$s";
$definitions["email.replyToStarred.subject"] = "Есть новый ответ на '%1\$s'";

// Translating the gambit system can be quite complex, but we'll do our best to get you through it. :)
// Note: Don't use any html entities in these definitions, except for: &lt; &gt; &amp; &#39;

// Simple gambits
// These gambits are pretty much evaluated as-they-are.
// tag:, author:, contributor:, and quoted: are combined with a value after the colon (:).
// For example: tag:video games, author:myself
$definitions["gambit.author:"] = "автор:";
$definitions["gambit.contributor:"] = "участник:";
$definitions["gambit.member"] = "имя";
$definitions["gambit.myself"] = "я";
$definitions["gambit.draft"] = "черновик";
$definitions["gambit.locked"] = "заблокированные";
$definitions["gambit.has attachments"] = "с вложениями";
$definitions["gambit.order by newest"] = "по новизне";
$definitions["gambit.order by replies"] = "по ответам";
$definitions["gambit.private"] = "частные";
$definitions["gambit.random"] = "случайные";
$definitions["gambit.reverse"] = "обратное";
$definitions["gambit.starred"] = "избранные";
$definitions["gambit.muted"] = "скрытые";
$definitions["gambit.sticky"] = "прикрепленные";
$definitions["gambit.KB"] = "база знаний";
$definitions["gambit.unread"] = "непрочитанные";
$definitions["gambit.more results"] = "больше результатов";

// Aliases
// These are gambits which tell the gambit system to use another gambit.
// In other words, when you type "active today", the gambit system interprets it as if you typed "active 1 day".
// The first of each pair, the alias, can be anything you want.
// The second, however, must fit with the regular expression pattern defined below (more on that later.)
$definitions["gambit.active today"] = "активные сегодня"; // what appears in the gambit cloud
$definitions["gambit.active 1 day"] = "активные 1 день"; // what it actually evaluates to
$definitions["gambit.has replies"] = "с ответами";
$definitions["gambit.has >0 replies"] = "содержит >0 ответов";
$definitions["gambit.has >10 replies"] = "содержит >10 ответов";
$definitions["gambit.has no replies"] = "без ответов";
$definitions["gambit.has 0 replies"] = "содержит 0 ответов";
$definitions["gambit.dead"] = "мертвые";
$definitions["gambit.active >30 day"] = "активные >30 дней";

// Units of time
// These are used in the active gambit.
// ex. "[active] [>|<|>=|<=|last] 180 [second|minute|hour|day|week|month|year]"
$definitions["gambit.second"] = "секунд";
$definitions["gambit.minute"] = "минут";
$definitions["gambit.hour"] = "часов";
$definitions["gambit.day"] = "дней";
$definitions["gambit.week"] = "недель";
$definitions["gambit.month"] = "месяцев";
$definitions["gambit.year"] = "год";
$definitions["gambit.last"] = "за"; // as in "active last 180 days"
$definitions["gambit.active"] = "активные"; // as in "active last 180 days"

// Now the hard bit. This is a regular expression to test for the "active" gambit.
// The group (?<a> ... ) is the comparison operator (>, <, >=, <=, or last).
// The group (?<b> ... ) is the number (ex. 24).
// The group (?<c> ... ) is the unit of time.
// The languages of "last" and the units of time are defined above.
// However, if you need to reorder the groups, do so carefully, and make sure spaces are written as " *".
$definitions["gambit.gambitActive"] = "/^{$definitions["gambit.active"]} *(?<a>>|<|>=|<=|{$definitions["gambit.last"]})? *(?<b>\d+) *(?<c>{$definitions["gambit.second"]}|{$definitions["gambit.minute"]}|{$definitions["gambit.hour"]}|{$definitions["gambit.day"]}|{$definitions["gambit.week"]}|{$definitions["gambit.month"]}|{$definitions["gambit.year"]})/";

// These appear in the tag cloud. They must fit the regular expression pattern where the ? is a number.
// If the regular expression pattern has been reordered, these gambits must also be reordered (as well as the ones in aliases.)
$definitions["gambit.active last ? hours"] = "{$definitions["gambit.active"]} {$definitions["gambit.last"]} ? {$definitions["gambit.hour"]}";
$definitions["gambit.active last ? days"] = "{$definitions["gambit.active"]} {$definitions["gambit.last"]} ? {$definitions["gambit.day"]}";

// This is similar to the regular expression for the active gambit, but for the "has n reply(s)" gambit.
// Usually you just need to change the "has" and "repl".
$definitions["gambit.gambitHasNReplies"] = "/^имеет *(?<a>>|<|>=|<=)? *(?<b>\d+) *сообщ/";

$definitions["settings.topPanel.label"] = "Верхняя панель";
$definitions["setting.topPanelBehavior.ordinary"] = "обычная";
$definitions["setting.topPanelBehavior.movable"] = "выдвигающаяся";
$definitions["setting.topPanelBehavior.automovable"] = "автоматически выдвигающаяся";

$definitions["settings.loadConversation.label"] = "Загрузка обсуждения";
$definitions["setting.loadConversationMode.top"] = "в начало";
$definitions["setting.loadConversationMode.unread"] = "к непрочитанному";
$definitions["setting.loadConversationMode.bottom"] = "в конец";

$definitions["settings.loadPosts.label"] = "Загрузка сообщений";
$definitions["setting.autoLoadNextPagePosts.label"] = "Автоматическая загрузка следующей страницы сообщений";

$definitions["settings.multimediaEmbedding.label"] = "Встраивание мультимедиа";
$definitions["setting.forbidMultimediaEmbedding.label"] = "Запретить встраивание мультимедиа";

$definitions["settings.mainPageRefresh.label"] = "Новые обсуждения на главной";
$definitions["setting.mainPageRefreshMode.refresh"] = "показывать автоматически";
$definitions["setting.mainPageRefreshMode.notify"] = "уведомлять";
$definitions["setting.mainPageRefreshMode.ignore"] = "игнорировать";
