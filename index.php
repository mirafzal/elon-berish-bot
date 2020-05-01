<?php

include 'Telegram.php';
include 'User.php';
include 'Steps.php';
include "Texts.php";
include "Announcements.php";

$bot_token =
    '1189793533:AAGaucXXv4xdf5lncwrSgRCb8pwZH5YQppo'//    '1289993706:AAGvytXZekHzhk53WQu2P5-XRb2OSfl2wtI'
;

$telegram = new Telegram($bot_token);

$ADMIN_CHAT_ID = 635793263;

$ADMINS = [
    635793263,
    821164626
];

$CHANNEL_ID =
//    -1001469324258
    -1001457080279;

$callback_query = $telegram->Callback_Query();

$data = $telegram->getData();
$message = $data['message'];
$text = $message['text'];
$chatID = $message['chat']['id'];
$username = $message['chat']['username'];
$firstName = $message['chat']['first_name'];
$lastName = $message['chat']['last_name'];

if ($chatID == null) $chatID = $ADMIN_CHAT_ID;

$user = new User($chatID);

$TEXTS = [];

switchLanguage();

echo "<br />";
echo 'vse norm';

// main logic begin

// debug
if ($chatID != $ADMIN_CHAT_ID) {
    $txt = json_encode($data, JSON_PRETTY_PRINT);
    sendMessageToMe($txt);
}


if ($callback_query !== null && $callback_query != '') {

    $callback_data = $telegram->Callback_Data();
    $chatID = $telegram->Callback_ChatID();

    if ($callback_data[0] == "g") {
        $announcementID = substr($callback_data, 1);
        $isEmpty = true;
        $option = [];
        foreach (Announcements::getAnnouncements() as $announcement) {
            if (($announcement['id']) . "" == $announcementID . "") {
                if ($announcement['is_media']) {
                    $content = ['chat_id' => $chatID, 'media' => $announcement['announcement']];
                    $telegram->sendMediaGroup($content);
                } else {
                    $content = ['chat_id' => $chatID, 'text' => $announcement['announcement'], 'disable_web_page_preview' => true, 'parse_mode' => "HTML"];
                    $telegram->sendMessage($content);
                }
                if (!$announcement['is_announced']) {
                    $option = [
                        [$telegram->buildInlineKeyBoardButton("E'lon qilish", "", "publish" . $announcementID)],
                    ];
                } else {
                    $option = [
                        [$telegram->buildInlineKeyBoardButton("Qayta e'lon qilish", "", "publish" . $announcementID)],
                    ];
                }
                $isEmpty = false;
                break;
            }
        }
        if ($isEmpty) {
            $content = array('chat_id' => $telegram->ChatID(), 'text' => "Bunday e'lon yo'q.");
            $telegram->answerCallbackQuery($content);
        } else {
            $content = array('chat_id' => $telegram->ChatID(), 'message_id' => $callback_query['message']['message_id']);
            $telegram->deleteMessage($content);
            $keyb = $telegram->buildInlineKeyBoard($option);
            $content = array('chat_id' => $telegram->ChatID(), 'text' => "E'lonni:", 'reply_markup' => $keyb);
            $telegram->sendMessage($content);
        }
    } elseif ($callback_data[0] == "d") {
        $announcementID = substr($callback_data, 1);
        foreach (Announcements::getAnnouncements() as $announcement) {
            if (($announcement['id']) . "" == $announcementID . "") {
                if ($announcement['is_media']) {
                    $content = ['chat_id' => $chatID, 'media' => $announcement['announcement']];
                    $telegram->sendMediaGroup($content);
                } else {
                    $content = ['chat_id' => $chatID, 'text' => $text, 'disable_web_page_preview' => true, 'parse_mode' => "HTML"];
                    $telegram->sendMessage($content);
                }
            }
        }
        $content = array('chat_id' => $telegram->ChatID(), 'message_id' => $callback_query['message']['message_id']);
        $telegram->deleteMessage($content);
        $option = [
            [$telegram->buildInlineKeyBoardButton($TEXTS['republish'], "", "republlish" . $announcementID)],
            [$telegram->buildInlineKeyboardButton($TEXTS['delete'], "", "mdelete" . $announcementID)],
        ];
        $keyb = $telegram->buildInlineKeyBoard($option);
        $content = array('chat_id' => $telegram->ChatID(), 'text' => $TEXTS['options'] . ":", 'reply_markup' => $keyb);
        $telegram->sendMessage($content);
    } elseif (strpos($callback_data, 'publish') !== false) {
        $announcementID = substr($callback_data, 7);
        foreach (Announcements::getAnnouncements() as $announcement) {
            if (($announcement['id']) . "" == $announcementID . "") {
                if ($announcement['is_media']) {
                    $content = ['chat_id' => $CHANNEL_ID, 'media' => $announcement['announcement']];
                    $telegram->sendMediaGroup($content);
                } else {
                    $content = ['chat_id' => $CHANNEL_ID, 'text' => $announcement['announcement'], 'disable_web_page_preview' => true, 'parse_mode' => "HTML"];
                    $telegram->sendMessage($content);
                }
                Announcements::setAnnounced($announcementID);
                $content = ['chat_id' => $chatID, 'text' => "✅ E'lon kanalda muvaffaqiyatli e'lon qilindi!", 'message_id' => $callback_query['message']['message_id'], 'parse_mode' => "HTML"];
                $telegram->editMessageText($content);
                break;
            }
        }
    } elseif (strpos($callback_data, 'mdelete') !== false) {
        $announcementID = substr($callback_data, 7);
        foreach (Announcements::getAnnouncements() as $announcement) {
            if (($announcement['id']) . "" == $announcementID . "") {
                Announcements::deleteAnnouncement($announcementID);
                $content = ['chat_id' => $chatID, 'text' => $TEXTS['announcement_deleted'], 'message_id' => $callback_query['message']['message_id'], 'parse_mode' => "HTML"];
                $telegram->editMessageText($content);
                break;
            }
        }
    } elseif (strpos($callback_data, 'republlish') !== false) {
        $announcementID = substr($callback_data, 10);
        foreach (Announcements::getAnnouncements() as $announcement) {
            if (($announcement['id']) . "" == $announcementID . "") {
                Announcements::setUnAnnounced($announcementID);
                $content = ['chat_id' => $chatID, 'text' => $TEXTS['announcement_accepted'], 'message_id' => $callback_query['message']['message_id'], 'parse_mode' => "HTML"];
                $telegram->editMessageText($content);
                break;
            }
        }
        // notify admins
        foreach ($ADMINS as $admin_chat_id) {
            if ($user->getMediaArray() == "") {
                $text = $user->getFullAnnouncement();
                $content = ['chat_id' => $admin_chat_id, 'text' => $text, 'disable_web_page_preview' => true, 'parse_mode' => "HTML"];
                $telegram->sendMessage($content);
            } else {
                $media = $user->getFullAnnouncement();
                $content = ['chat_id' => $admin_chat_id, 'media' => $media];
                $telegram->sendMediaGroup($content);
            }
            $option = [
                [$telegram->buildInlineKeyBoardButton("E'lon qilish", "", "publish" . $announcementID)],
                [$telegram->buildInlineKeyboardButton("Rad etish", "", "cancel" . $announcementID)],
            ];
            $keyb = $telegram->buildInlineKeyBoard($option);
            $content = ['chat_id' => $admin_chat_id, 'text' => $TEXTS['new_announcement'], 'reply_markup' => $keyb, 'parse_mode' => "HTML"];
            $telegram->sendMessage($content);
        }

    } elseif (strpos($callback_data, 'cancel') !== false) {
        $announcementID = substr($callback_data, 6);
        foreach (Announcements::getAnnouncements() as $announcement) {
            if (($announcement['id']) . "" == $announcementID . "") {
                Announcements::setRejected($announcementID);
                $content = ['chat_id' => $chatID, 'text' => "⛔ E'lon rad etildi!", 'message_id' => $callback_query['message']['message_id'], 'parse_mode' => "HTML"];
                $telegram->editMessageText($content);
                $mUser = new User($announcement['chat_id']);
                $MTEXTS = [];
                switch ($mUser->getLanguage()) {
                    case 'uz_lotin':
                        $MTEXTS = Texts::UZ_LOTIN;
                        break;
                    case 'uz_kirill':
                        $MTEXTS = Texts::UZ_KIRILL;
                        break;
                    case 'ru':
                        $MTEXTS = Texts::RU;
                        break;
                }
                $content = ['chat_id' => $announcement['chat_id'], 'text' => $MTEXTS['announcement_canceled'], 'parse_mode' => "HTML"];
                $telegram->sendMessage($content);
                break;
            }
        }
    }

    //answer nothing with answerCallbackQuery, because it is required
    $content = ['callback_query_id' => $telegram->Callback_ID(), 'text' => '', 'show_alert' => false];
    $telegram->answerCallbackQuery($content);

} else {
    if (in_array($chatID, $ADMINS)) {
        switch ($text) {
            case "Admin panel":
                $user->setInAdminPanel(1);
                $option = [
                    [$telegram->buildKeyboardButton("E'lon qilinmaganlar"), $telegram->buildKeyboardButton("E'lon qilinganlar")],
                    [$telegram->buildKeyboardButton($TEXTS['main_page'])],
                ];
                $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
                $text = "Admin panelga xush kelibsiz!";
                $content = array('chat_id' => $chatID, 'reply_markup' => $keyb, 'text' => $text, 'parse_mode' => "HTML");
                $telegram->sendMessage($content);
                break;
            case "E'lon qilinmaganlar":
                $option = [];
                $isEmpty = true;
                foreach (Announcements::getAnnouncements() as $announcement) {
                    if ($announcement['is_rejected']) {
                        $isEmpty = false;
                        $option[] = [$telegram->buildInlineKeyBoardButton("E'lon №" . $announcement['id'] . " (Rad etilgan)", $url = "", $callback_data = "g" . $announcement['id'])];
                    } elseif (!$announcement['is_announced']) {
                        $isEmpty = false;
                        $option[] = [$telegram->buildInlineKeyBoardButton("E'lon №" . $announcement['id'] . " (E'lon qilinmagan)", $url = "", $callback_data = "g" . $announcement['id'])];
                    }
                }
                if ($isEmpty) {
                    $content = array('chat_id' => $telegram->ChatID(), 'text' => "Hozircha e'lonlar yo'q.");
                    $telegram->sendMessage($content);
                } else {
                    $keyb = $telegram->buildInlineKeyBoard($option);
                    $content = array('chat_id' => $telegram->ChatID(), 'reply_markup' => $keyb, 'text' => "E'lonni tanlang:");
                    $telegram->sendMessage($content);
                }
                break;
            case "E'lon qilinganlar":
                $option = [];
                $isEmpty = true;
                foreach (Announcements::getAnnouncements() as $announcement) {
                    if ($announcement['is_announced'] && !$announcement['is_rejected']) {
                        $isEmpty = false;
                        $option[] = [$telegram->buildInlineKeyBoardButton("E'lon №" . $announcement['id'] . " (E'lon qilingan)", $url = "", $callback_data = "g" . $announcement['id'])];
                    }
                }
                if ($isEmpty) {
                    $content = array('chat_id' => $telegram->ChatID(), 'text' => "Hozircha e'lonlar yo'q.");
                    $telegram->sendMessage($content);
                } else {
                    $keyb = $telegram->buildInlineKeyBoard($option);
                    $content = array('chat_id' => $telegram->ChatID(), 'reply_markup' => $keyb, 'text' => "E'lonni tanlang:");
                    $telegram->sendMessage($content);
                }
                break;
            case $TEXTS['main_page']:
                $user->setInAdminPanel(0);
                break;

        }
    }

    if ($text == "/start") {
        showStart();
    } elseif ($user->getInAdminPanel() == 1) {

    } else {
        switch ($user->getStep()) {
            case Steps::START:
                switch ($text) {
                    case Texts::LANGS['uz_lotin']:
                        $user->setLanguage('uz_lotin');
                        switchLanguage();
                        showMainPage();
                        break;
                    case Texts::LANGS['uz_kirill']:
                        $user->setLanguage('uz_kirill');
                        switchLanguage();
                        showMainPage();
                        break;
                    case Texts::LANGS['ru']:
                        $user->setLanguage('ru');
                        switchLanguage();
                        showMainPage();
                        break;
                    default:
                        showStart();
                        break;
                }
                break;
            case Steps::PAGE_MAIN:
                switch ($text) {
                    case $TEXTS['sell']:
                        showAnnouncementCategories($TEXTS['choose_announcement_category_sell']);
                        $user->setAnnouncementType('choose_announcement_category_sell');
                        break;
                    case $TEXTS['buy']:
                        showAnnouncementCategories($TEXTS['choose_announcement_category_buy']);
                        $user->setAnnouncementType('choose_announcement_category_buy');
                        break;
                    case $TEXTS['offer']:
                        showAnnouncementCategories($TEXTS['choose_announcement_category_service']);
                        $user->setAnnouncementType('choose_announcement_category_service');
                        break;
                    case $TEXTS['announcements']:
                        showUserAnnouncements();
                        break;
                    case $TEXTS['settings']:
                        showSettings($TEXTS['current_settings']);
                        break;
                    default:
                        showMainPage();
                        break;
                }
                break;
            case Steps::PAGE_SETTINGS:
                switch ($text) {
                    case $TEXTS['change_lang']:
                        showLanguageSettings();
                        break;
                    case $TEXTS['change_number']:
                        showNumberSettings();
                        break;
                    case $TEXTS['main_page']:
                        showMainPage();
                        break;
                    default:
                        showSettings($TEXTS['current_settings']);
                        break;
                }
                break;
            case Steps::SETTINGS_LANGUAGE:
                switch ($text) {
                    case Texts::LANGS['uz_lotin']:
                        $user->setLanguage('uz_lotin');
                        switchLanguage();
                        showSettings($TEXTS['lang_changed']);
                        break;
                    case Texts::LANGS['uz_kirill']:
                        $user->setLanguage('uz_kirill');
                        switchLanguage();
                        showSettings($TEXTS['lang_changed']);
                        break;
                    case Texts::LANGS['ru']:
                        $user->setLanguage('ru');
                        switchLanguage();
                        showSettings($TEXTS['lang_changed']);
                        break;
                    case $TEXTS['settings']:
                        showSettings($TEXTS['current_settings']);
                        break;
                    case $TEXTS['main_page']:
                        showMainPage();
                        break;
                    default:
                        showLanguageSettings();
                        break;
                }
                break;
            case Steps::SETTINGS_PHONE_NUMBER:
                switch ($text) {
                    case $TEXTS['settings']:
                        showSettings($TEXTS['current_settings']);
                        break;
                    case $TEXTS['main_page']:
                        showMainPage();
                        break;
                    default:
                        if ($message['contact']) {
                            $phoneNumber = $message['contact']['phone_number'];
                            if ($phoneNumber[0] == "+") {
                                $user->setPhoneNumber($message['contact']['phone_number']);
                            } else {
                                $user->setPhoneNumber("+" . $message['contact']['phone_number']);
                            }
                            showSettings($TEXTS['phone_number_changed']);
                        } else {
                            if ($text[0] == "+" && is_int((int)(substr($text, 1)))) {
                                $user->setPhoneNumber($text);
                                showSettings($TEXTS['phone_number_changed']);
                            } else {
                                $content = ['chat_id' => $chatID, 'text' => $TEXTS['wrong_phone_number'], 'parse_mode' => "HTML"];
                                $telegram->sendMessage($content);
                            }
                        }
                        break;
                }
                break;
            case Steps::ANNOUNCEMENT_CATEGORIES:
                switch ($text) {
                    case $TEXTS['back']:
                        showMainPage();
                        break;
                    default:
                        if (in_array($text, $TEXTS['categories'])) {
                            $user->setCategory($text);
                            showAnnouncementRegions();
                        } else {
                            showAnnouncementCategories($TEXTS[$user->getAnnouncementType()]);
                        }
                        break;
                }
                break;
            case Steps::ANNOUNCEMENT_REGIONS:
                switch ($text) {
                    case $TEXTS['back']:
                        showAnnouncementCategories($TEXTS[$user->getAnnouncementType()]);
                        break;
                    default:
                        if (in_array($text, $TEXTS['regions'])) {
                            $user->setRegion($text);
                            showAnnouncementTextInput();
                        } else {
                            showAnnouncementRegions();
                        }
                        break;
                }
                break;
            case Steps::ANNOUNCEMENT_TEXT:
                switch ($text) {
                    case $TEXTS['back']:
                        showAnnouncementRegions();
                        break;
                    default:
                        if (strlen($text) > 15) {
                            $user->setAnnouncementText($text);
                            showAnnouncementPhoneNumberInput();
                        } else {
                            $content = ['chat_id' => $chatID, 'text' => $TEXTS['announcement_text_is_too_short'], 'parse_mode' => "HTML"];
                            $telegram->sendMessage($content);
                        }
                        break;
                }
                break;
            case Steps::ANNOUNCEMENT_PHONE_NUMBER:
                switch ($text) {
                    case $TEXTS['back']:
                        showAnnouncementTextInput();
                        break;
                    default:
                        if ($message['contact']) {
                            $phoneNumber = $message['contact']['phone_number'];
                            if ($phoneNumber[0] == "+") {
                                $user->setPhoneNumber($message['contact']['phone_number']);
                            } else {
                                $user->setPhoneNumber("+" . $message['contact']['phone_number']);
                            }
                            showAnnouncementMediaInput();
                        } else {
                            if ($text[0] == "+" && is_int((int)(substr($text, 1)))) {
                                $user->setPhoneNumber($text);
                                showAnnouncementMediaInput();
                            } else {
                                $content = ['chat_id' => $chatID, 'text' => $TEXTS['wrong_phone_number'], 'parse_mode' => "HTML"];
                                $telegram->sendMessage($content);
                            }
                        }
                        break;
                }
                break;
            case Steps::ANNOUNCEMENT_MEDIA:
                switch ($text) {
                    case $TEXTS['back']:
                        showAnnouncementPhoneNumberInput();
                        break;
                    case $TEXTS['continue']:
                        showAnnouncementFull();
                        break;
                    default:
                        if ($message['photo']) {
                            $media = $user->getMediaArray();
                            $media = json_decode($media);
                            if (sizeof($media) >= 10) {
                                $content = ['chat_id' => $chatID, 'text' => $TEXTS['media_limit'], 'parse_mode' => "HTML"];
                                $telegram->sendMessage($content);
                            } else {
                                $media[] = ['type' => 'photo', 'media' => $message['photo'][0]['file_id']];
                                $media = json_encode($media);
                                $user->setMediaArray($media);
                                $content = ['chat_id' => $chatID, 'text' => $TEXTS['photo_accepted']];
                                $telegram->sendMessage($content);
                            }
                        } elseif ($message['video']) {
                            $media = $user->getMediaArray();
                            $media = json_decode($media);
                            if (sizeof($media) >= 10) {
                                $content = ['chat_id' => $chatID, 'text' => $TEXTS['media_limit'], 'parse_mode' => "HTML"];
                                $telegram->sendMessage($content);
                            } else {
                                $media[] = ['type' => 'video', 'media' => $message['video']['file_id']];
                                $media = json_encode($media);
                                $user->setMediaArray($media);
                                $content = ['chat_id' => $chatID, 'text' => $TEXTS['video_accepted']];
                                $telegram->sendMessage($content);
                            }
                        } else {
                            $content = ['chat_id' => $chatID, 'text' => $TEXTS['send_media_or_continue']];
                            $telegram->sendMessage($content);
                        }
                        break;
                }
                break;
            case Steps::ANNOUNCEMENT_CONFIRMATION:
                switch ($text) {
                    case $TEXTS['back']:
                        showAnnouncementMediaInput();
                        break;
                    case $TEXTS['confirm_announcement_button']:
                        showAnnouncementAccepted();
                        break;
                    default:
                        showAnnouncementFull();
                        break;
                }
                break;
        }
    }
}


function showStart()
{
    global $user, $telegram, $chatID;
    $user->setStep(Steps::START);
    $user->setInAdminPanel(0);
    $option = [
        [$telegram->buildKeyboardButton(Texts::LANGS['uz_lotin']), $telegram->buildKeyboardButton(Texts::LANGS['uz_kirill'])],
        [$telegram->buildKeyboardButton(Texts::LANGS['ru'])]
    ];
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyb, 'text' => "Пожалуйста выберите язык. 👇
 \nIltimos, tilni tanlang. 👇");
    $telegram->sendMessage($content);
}

function showMainPage()
{
    global $user, $telegram, $chatID, $TEXTS, $firstName, $lastName, $ADMINS;
    $user->setStep(Steps::PAGE_MAIN);

    $option = [
        [$telegram->buildKeyboardButton($TEXTS['sell']), $telegram->buildKeyboardButton($TEXTS['buy'])],
        [$telegram->buildKeyboardButton($TEXTS['offer']), $telegram->buildKeyboardButton($TEXTS['announcements'])],
        [$telegram->buildKeyboardButton($TEXTS['settings'])]
    ];
    if (in_array($chatID, $ADMINS)) {
        $option[2][1] = $telegram->buildKeyboardButton("Admin panel");
    }
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $text = $TEXTS['choose_category'];
    $text = str_replace('{firstName}', $firstName, $text);
    $text = str_replace('{lastName}', $lastName, $text);
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyb, 'text' => $text, 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}

function showSettings($text)
{
    global $user, $telegram, $chatID, $TEXTS;
    $user->setStep(Steps::PAGE_SETTINGS);

    $option = [
        [$telegram->buildKeyboardButton($TEXTS['change_lang'])],
        [$telegram->buildKeyboardButton($TEXTS['change_number'])],
        [$telegram->buildKeyboardButton($TEXTS['main_page'])]
    ];
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $text = str_replace('{language}', Texts::LANGS[$user->getLanguage()], $text);
    $text = str_replace('{phone_number}', $user->getPhoneNumber(), $text);
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyb, 'text' => $text, 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}

function showLanguageSettings()
{
    global $user, $telegram, $chatID, $TEXTS;
    $user->setStep(Steps::SETTINGS_LANGUAGE);

    $option = [
        [$telegram->buildKeyboardButton(Texts::LANGS['uz_lotin']), $telegram->buildKeyboardButton(Texts::LANGS['uz_kirill'])],
        [$telegram->buildKeyboardButton(Texts::LANGS['ru']), $telegram->buildKeyboardButton($TEXTS['settings'])],
        [$telegram->buildKeyboardButton($TEXTS['main_page'])]
    ];
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $text = $TEXTS['choose_lang'];
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyb, 'text' => $text);
    $telegram->sendMessage($content);
}

function showNumberSettings()
{
    global $user, $telegram, $chatID, $TEXTS;
    $user->setStep(Steps::SETTINGS_PHONE_NUMBER);

    $option = [
        [$telegram->buildKeyboardButton($TEXTS['send_my_phone_number'], $request_contact = true)],
        [$telegram->buildKeyboardButton($TEXTS['settings'])],
        [$telegram->buildKeyboardButton($TEXTS['main_page'])]
    ];
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $text = $TEXTS['enter_phone_number'];
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyb, 'text' => $text, 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}

function showAnnouncementCategories($text)
{
    global $user, $telegram, $chatID, $TEXTS;
    $user->setStep(Steps::ANNOUNCEMENT_CATEGORIES);

    $option = [];
    foreach ($TEXTS['categories'] as $category) {
        $option[] = [$telegram->buildKeyboardButton($category)];
    }
    $option[] = [$telegram->buildKeyboardButton($TEXTS['back'])];
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyb, 'text' => $text, 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}

function showAnnouncementRegions()
{
    global $user, $telegram, $chatID, $TEXTS;
    $user->setStep(Steps::ANNOUNCEMENT_REGIONS);

    $option = [];
    foreach ($TEXTS['regions'] as $category) {
        $option[] = [$telegram->buildKeyboardButton($category)];
    }
    $option[] = [$telegram->buildKeyboardButton($TEXTS['back'])];
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $text = $TEXTS['choose_region'];
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyb, 'text' => $text, 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}

function showAnnouncementTextInput()
{
    global $user, $telegram, $chatID, $TEXTS;
    $user->setStep(Steps::ANNOUNCEMENT_TEXT);

    $option = [
        [$telegram->buildKeyboardButton($TEXTS['back'])]
    ];
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $text = $TEXTS['write_announcement_text'];
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyb, 'text' => $text, 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}

function showAnnouncementPhoneNumberInput()
{
    global $user, $telegram, $chatID, $TEXTS;
    $user->setStep(Steps::ANNOUNCEMENT_PHONE_NUMBER);

    $option = [
        [$telegram->buildKeyboardButton($TEXTS['send_phone_number'], $request_contact = true)],
        [$telegram->buildKeyboardButton($TEXTS['back'])]
    ];
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $text = $TEXTS['enter_announcement_phone_number'];
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyb, 'text' => $text, 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}

function showAnnouncementMediaInput()
{
    global $user, $telegram, $chatID, $TEXTS;
    $user->setStep(Steps::ANNOUNCEMENT_MEDIA);
    $user->setMediaArray("");

    $option = [
        [$telegram->buildKeyboardButton($TEXTS['continue'])],
        [$telegram->buildKeyboardButton($TEXTS['back'])]
    ];
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $text = $TEXTS['send_media'];
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyb, 'text' => $text, 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}

function showAnnouncementFull()
{
    global $telegram, $chatID, $user, $TEXTS, $username;
    $user->setStep(Steps::ANNOUNCEMENT_CONFIRMATION);

    $text = "🔸 ".$TEXTS['category'] . ": " . $user->getCategory() . "\n";
    $text .= "🗺 ".$TEXTS['region'] . ": " . $user->getRegion() . "\n\n";
    $text .= $user->getAnnouncementText() . "\n\n";
    $text .= $TEXTS['contact'] . ":\n";
    if ($username) $text .= "📩 @" . $username . "\n";
    $text .= "📲 " . $user->getPhoneNumber() . "\n\n";
    $text .= 'T.me/oziq_ovqat_savdo ✔️';
    if ($user->getMediaArray() == "") {
        $user->setFullAnnouncement($text);
        $content = ['chat_id' => $chatID, 'text' => $text, 'disable_web_page_preview' => true, 'parse_mode' => "HTML"];
        $telegram->sendMessage($content);
    } else {
        $media = json_decode($user->getMediaArray());
        $media[0]->caption = $text;
        $media[0]->parse_mode = "HTML";
        $media = json_encode($media);
        $user->setFullAnnouncement($media);
        $content = ['chat_id' => $chatID, 'media' => $media];
        $telegram->sendMediaGroup($content);
    }
    $option = [
        [$telegram->buildKeyboardButton($TEXTS['confirm_announcement_button'])],
        [$telegram->buildKeyboardButton($TEXTS['back'])]
    ];
    $keyb = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $text = $TEXTS['confirm_announcement_text'];
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyb, 'text' => $text, 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}

function showAnnouncementAccepted()
{
    global $telegram, $chatID, $TEXTS, $user, $ADMINS;

    $content = ['chat_id' => $chatID, 'text' => $TEXTS['announcement_accepted'], 'parse_mode' => "HTML"];
    $telegram->sendMessage($content);
    showMainPage();

    $announcementID = Announcements::createAnnouncement($chatID, $user->getFullAnnouncement(), ($user->getMediaArray() == "") ? 0 : 1);

    // notify admins
    foreach ($ADMINS as $admin_chat_id) {
        if ($user->getMediaArray() == "") {
            $text = $user->getFullAnnouncement();
            $content = ['chat_id' => $admin_chat_id, 'text' => $text, 'disable_web_page_preview' => true, 'parse_mode' => "HTML"];
            $telegram->sendMessage($content);
        } else {
            $media = $user->getFullAnnouncement();
            $content = ['chat_id' => $admin_chat_id, 'media' => $media];
            $telegram->sendMediaGroup($content);
        }
        $option = [
            [$telegram->buildInlineKeyBoardButton("E'lon qilish", "", "publish" . $announcementID)],
            [$telegram->buildInlineKeyboardButton("Bekor qilish", "", "cancel" . $announcementID)],
        ];
        $keyb = $telegram->buildInlineKeyBoard($option);
        $content = ['chat_id' => $admin_chat_id, 'text' => $TEXTS['new_announcement'], 'reply_markup' => $keyb, 'parse_mode' => "HTML"];
        $telegram->sendMessage($content);
    }
}

function showUserAnnouncements()
{
    global $telegram, $TEXTS;
    $option = [];
    $isEmpty = true;
    foreach (Announcements::getAnnouncements() as $announcement) {
        if ($telegram->ChatID() == $announcement['chat_id']) {
            $isEmpty = false;
            if ($announcement['is_rejected']) {
                $option[] = [$telegram->buildInlineKeyBoardButton($TEXTS['announcement']." №" . $announcement['id'] . " (" . $TEXTS['rejected'] . ")", $url = "", $callback_data = "d" . $announcement['id'])];
            } elseif ($announcement['is_announced']) {
                $option[] = [$telegram->buildInlineKeyBoardButton($TEXTS['announcement']." №" . $announcement['id'] . " (" . $TEXTS['published'] . ")", $url = "", $callback_data = "d" . $announcement['id'])];
            } else {
                $option[] = [$telegram->buildInlineKeyBoardButton($TEXTS['announcement']." №" . $announcement['id'] . " (" . $TEXTS['not_published'] . ")", $url = "", $callback_data = "d" . $announcement['id'])];
            }
        }
    }
    if ($isEmpty) {
        $content = array('chat_id' => $telegram->ChatID(), 'text' => $TEXTS['no_announcements']);
        $telegram->sendMessage($content);
    } else {
        $keyb = $telegram->buildInlineKeyBoard($option);
        $content = array('chat_id' => $telegram->ChatID(), 'reply_markup' => $keyb, 'text' => "E'lonni tanlang:");
        $telegram->sendMessage($content);
    }
}

function switchLanguage()
{
    global $user, $TEXTS;
    switch ($user->getLanguage()) {
        case 'uz_lotin':
            $TEXTS = Texts::UZ_LOTIN;
            break;
        case 'uz_kirill':
            $TEXTS = Texts::UZ_KIRILL;
            break;
        case 'ru':
            $TEXTS = Texts::RU;
            break;
    }
}

function sendMessageToMe($text)
{
    global $ADMIN_CHAT_ID, $telegram;
    $content = ['chat_id' => $ADMIN_CHAT_ID, 'text' => $text];
    $telegram->sendMessage($content);
}
//
//if ($text == '/media') {
//    sendTestMedia();
//}
//
//if ($text == '/reset') {
//    global $user;
//    $user->setMediaArray("");
//}
//
//function sendTestMedia()
//{
//    global $telegram, $chatID, $ADMIN_CHAT_ID, $user;
////    $media = json_encode([
////        [
////            'type' => 'photo',
////            'media' => 'AgACAgIAAxkBAAICYF6oVJC7ItP8e7BSEjmB8RaS-ASCAAItrjEbFMUxSaIwjCl1AVBHykLCki4AAwEAAwIAA20AA0JFAQABGQQ'
////        ],
////        [
////            'type' => 'photo',
////            'media' => 'AgACAgIAAxkBAAICX16oVJDNQ6mklkPx_tBYe1IimCTMAAIsrjEbFMUxSRiSPTa2iynSjLWDki4AAwEAAwIAA3kAA_SrAAIZBA'
////        ],
////        [
////            'type' => 'video',
////            'media' => 'BAACAgIAAxkBAAICy16pQL1kQk_sP6NVre1kCGpczgEpAAIkCQACdv9ISRTI_CSEmjvoGQQ',
////            'caption' => 'ggwp'
////        ],
////    ]);
////    $user->setMediaArray($media);
//    $media = $user->getMediaArray();
//    $media = json_decode($media);
//    $media[0]->caption = "ggwp";
//    sendMessageToMe($media[0]->caption);
////    $temp = $media[sizeof($media) - 1];
////    $media[sizeof($media) - 1] = ['type' => 'photo', 'media' => "AgACAgIAAxkBAAIDCV6pRYR65JpXozF5o_jDVcRwxWrEAALkrjEbMIwJSW9ODlVb-5hEU8PCDwAEAQADAgADbQADTRkGAAEZBA"];
//    $media = json_encode($media);
////    $user->setMediaArray("");
//    $content = ['chat_id' => $ADMIN_CHAT_ID, 'media' => $media];
//    $telegram->sendMediaGroup($content);
//}