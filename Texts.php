<?php


class Texts
{
    const LANGS =
        [
            'uz_lotin' => "🇺🇿 O'zbekcha",
            'uz_kirill' => "🇺🇿 Ўзбекча",
            'ru' => "🇷🇺 Русский",
        ];

    const UZ_LOTIN =
        [
            'back' => "⬅️ Orqaga",
            // main page
            'choose_category' => "<b>Hurmatli {firstName} {lastName}!</b> 

Reklamani to'ldirish bor yo'g'i 1 daqiqa vaqtingizni oladi.

<b>E'lon qo'shish uchun kerakli bo'limni tanlang</b>  👇🏻",
            'sell' => "Sotaman",
            'buy' => "Sotib olaman",
            'offer' => "Xizmat taklif qilaman",
            'announcements' => "🍅 E‘lonlarim",
            'settings' => "⚙️ Sozlamalar",

            // settings
            'current_settings' => "Nomer va tilni quyidagi tugmalar orqali o'zgartirishingiz mumkin.
<b>Til:</b>   {language}
<b>Telefon raqami:</b> {phone_number}",
            'change_lang' => "🌐 Tilni o'zgartirish",
            'change_number' => "📱 Raqamni o'zgartirish",
            'main_page' => "🏠 Bosh sahifa",

            // language settings
            'choose_lang' => "Tilni tanlang 👇🏻",
            'lang_changed' => "✅ Til muvaffaqiyatli o'zgardi!",

            // phone number settings
            'enter_phone_number' => "📲 Telefon raqamingizni <b>+998</b> kodi bilan yozing yoki <b>Telefonimni jo'natish</b> tugmasini bosing.",
            'send_my_phone_number' => "📲 Telefonimni jo'natish",
            'phone_number_changed' => "✅  Telefon raqami muvaffaqiyatli o'zgartirildi!",
            'wrong_phone_number' => "❗️<b>Telefon raqami noto'g'ri!</b> 

Iltimos, telefon raqamini <b>+998</b> kodi bilan to'g'ri yozing yoki yuborish tugmasini bosing!",

            // announcement category
            'choose_announcement_category_sell' => "<b>Nima sotmoqchisiz?</b>
Bo'limni tanlang 👇🏻",
            'choose_announcement_category_buy' => "<b>Nima sotib olmoqchisiz?</b>
Bo'limni tanlang 👇🏻",
            'choose_announcement_category_service' => "<b>Qanday xizmatni taklif qilasiz?</b>
Bo'limni tanlang 👇🏻",
            'categories' => [
                "Meva va sabzavotlar",
                "Margarinlar va yog'lar",
                "Go'sht mahsulotlari",
                "Quritilgan mevalar",
                "Shakar, tuz, asal, novvot",
                "Un, Guruch, Yorma",
                "Muzlatilgan mahsulotlar",
                "Tuxum",
                "Makaron mahsulotlari",
                "Suv va ichimliklar",
                "Choy, kofe",
                "Tort, shirinlik, shokolad",
                "Konserva mahsulotlari",
                "Pista, chips, qurt, popkorn",
                "Yarim tayyor ovqatlar",
                "Ziravorlar, souslar, qo'shimchalar",
                "Non va non mahsulotlari",
                "Boshqa mahsulotlar",
                "Sut va sut mahsulotlari",
                "Hayvonlar ovqatlari",
                "Oziq-ovqat sanoati uskunalari",
                "Qadoqlash xizmatlari",
                "Logistika",
            ],

            // announcement region
            'choose_region' => "<b>Mahsulotingiz qaerda?</b>
Viloyatni tanlang 👇🏻",
            'regions' => [
                "Toshkent shahri",
                "Qoraqalpog'iston Respublikasi",
                "Andijon viloyati",
                "Buxoro viloyati",
                "Jizzax viloyati",
                "Qashqadaryo viloyati",
                "Navoiy viloyati",
                "Namangan viloyati",
                "Samarqand viloyati",
                "Surxondaryo viloyati",
                "Sirdaryo viloyati",
                "Toshkent viloyati",
                "Farg'ona viloyati",
                "Xorazm viloyati",
            ],

            // announcement text
            'write_announcement_text' => "<b>E'lon matnini yozing!</b> Masalan:

Pista yog'i sotaman. Rossiyada ishlab chiqarilgan. 1-3-5 litrlik idishlarda. Eng kam sotishimiz 50 korobka. Birinchi qo'ldan. Ulgurji narhda. 

❌ <b>Bu yerga telefon raqam yozmang!</b>",
            'announcement_text_is_too_short' => "❗️E'lon matnini juda qisqa yozdingiz, iltimos to'liqroq yozing!",

            // announcement phone number
            'enter_announcement_phone_number' => "📲 <b>Telefon raqamni yuborish</b> tugmasini bosing yoki raqamingizni shu ko'rinishda yozing! <b>+998981246999</b>
______________
<b>Agar Sizda 2 ta raqam bo'lsa bunday ko'rinishda yozing:

+998981234567
+998997654321</b>",
            'send_phone_number' => "📲 Telefon raqamni yuborish",

            // announcement media
            'send_media' => "<b>Rasm yoki video yuklang.</b> 📎

1. Rasm yoki video yuklash uchun 📎 belgisini bosing va e'longa tegishli rasm yoki video tanlang. 

2. <b>Esingizda bo'lsin</b> e'lon rasm yoki video bilan xaridorlar e'tiborini yaxshiroq tortadi.

❗️<b>Rasm va videolarni yuklab bo'lgandan so'ng Davom etish ➡️ tugmasini bosing.</b>",
            'continue' => "Davom etish ➡️",
            'media_limit' => "Kechirasiz, yuborilishi mumkin bo'lgan rasm va videolar soni 10 tadan oshmasligi lozim. Iltimos, <b>Davom etish</b> ➡️ tugmasini bosing.",
            'send_media_or_continue' => "Iltimos, rasm va video yuboring yoki davom etish tugmasini bosing.",
            'photo_accepted' => "Rasm muvaffaqiyatli yuklandi ✅",
            'video_accepted' => "Video muvaffaqiyatli yuklandi ✅",

            // announcement full
            'category' => "<b>Bo'lim</b>",
            'region' => "<b>Hudud</b>",
            'contact' => "<b>Murojaat uchun tel</b>",

            // announcement confirmation
            'confirm_announcement_text' => "E'lonni tekshiring xatolari bo'lsa ⬅️<b>Orqaga</b> tugmasini bosib xatolarini to'g'rilab chiqing. 

Yuqoridagi ma'lumotlar to'g'ri bo'lsa ✅ <b>E'lonni yuborish</b> tugmasini bosing!",
            'confirm_announcement_button' => "✅ E'lonni yuborish",

            // announcement accepted
            'announcement_accepted' => "✅ Sizning e'loningiz qabul qilindi. Tez orada e'loningizni ko'rib chiqamiz va kanalda e'lon qilamiz.",

            // admin
            'new_announcement' => "Yangi e'lon keldi",

            // my announcements
            'republish' => "🔄 Qayta e'lon qilish",
            'delete' => "❌ O'chirish",
            'announcement_deleted' => "E'lon muvaffaqiyatli o'chirildi  ✅",
            'no_announcements' => "Hozircha e'lonlar yo'q.",
            'published' => "E'lon qilingan",
            'not_published' => "E'lon qilinmagan",
            'rejected' => "Rad etilgan",
            'options' => "E'lonni",

            // notification
            'announcement_canceled' => "E'loningiz rad etildi.",
            'announcement' => "E'lon",
        ];

    const UZ_KIRILL =
        [
            'back' => "⬅️ Орқага",
            // main page
            'choose_category' => "<b>Ҳурматли {firstName} {lastName}!</b> 

Рекламани тўлдириш бор йўғи 1 дақиқа вақтингизни олади.

<b>Эълон қўшиш учун керакли бўлимни танланг</b>  👇🏻",
            'sell' => "Сотаман",
            'buy' => "Сотиб оламан",
            'offer' => "Хизмат таклиф қиламан",
            'announcements' => "🍅 Эълонларим",
            'settings' => "⚙️ Созламалар",

            // settings
            'current_settings' => "Номер ва тилни қуйидаги тугмалар орқали ўзгартиришингиз мумкин.
<b>Тил:</b>   {language}
<b>Телефон рақами:</b> {phone_number}",
            'change_lang' => "🌐 Тилни ўзгартириш",
            'change_number' => "📱 Рақамни ўзгартириш",
            'main_page' => "🏠 Бош саҳифа",

            // language settings
            'choose_lang' => "Тилни танланг 👇🏻",
            'lang_changed' => "✅ Тил муваффақиятли ўзгарди!",

            // phone number settings
            'enter_phone_number' => "📲 Телефон рақамингизни <b>+998</b> коди билан ёзинг ёки <b>Телефонимни жўнатиш</b> тугмасини босинг.",
            'send_my_phone_number' => "📲 Телефонимни жўнатиш",
            'phone_number_changed' => "✅  Телефон рақами муваффақиятли ўзгартирилди!",
            'wrong_phone_number' => "❗️<b>Телефон рақами нотўғри!</b> 

Илтимос, телефон рақамини <b>+998</b> коди билан тўғри ёзинг ёки юбориш тугмасини босинг!",

            // announcement category
            'choose_announcement_category_sell' => "<b>Нима сотмоқчисиз?</b>
Бўлимни танланг 👇🏻",
            'choose_announcement_category_buy' => "<b>Нима сотиб олмоқчисиз?</b>
Бўлимни танланг 👇🏻",
            'choose_announcement_category_service' => "<b>Қандай хизматни таклиф қиласиз?</b>
Бўлимни танланг 👇🏻",
            'categories' => [
                "Мева ва сабзавотлар",
                "Маргаринлар ва ёғлар",
                "Гўшт маҳсулотлари",
                "Қуритилган мевалар",
                "Шакар, туз, асал, новвот",
                "Ун, Гуруч, Ёрма",
                "Музлатилган маҳсулотлар",
                "Тухум",
                "Макарон маҳсулотлари",
                "Сув ва ичимликлар",
                "Чой, кофе",
                "Торт, ширинлик, шоколад",
                "Консерва маҳсулотлари",
                "Писта, чипс, қурт, попкорн",
                "Ярим тайёр овқатлар",
                "Зираворлар, соуслар, қўшимчалар",
                "Нон ва нон маҳсулотлари",
                "Бошқа маҳсулотлар",
                "Сут ва сут маҳсулотлари",
                "Ҳайвонлар овқатлари",
                "Озиқ-овқат саноати ускуналари",
                "Қадоқлаш хизматлари",
                "Логистика",
            ],

            // announcement region
            'choose_region' => "<b>Маҳсулотингиз қаерда?</b>
Вилоятни танланг 👇🏻",
            'regions' => [
                "Тошкент шаҳри",
                "Қорақалпоғистон Республикаси",
                "Aндижон вилояти",
                "Бухоро вилояти",
                "Жиззах вилояти",
                "Қашқадарё вилояти",
                "Навоий вилояти",
                "Наманган вилояти",
                "Самарқанд вилояти",
                "Сурхондарё вилояти",
                "Сирдарё вилояти",
                "Тошкент вилояти",
                "Фарғона вилояти",
                "Хоразм вилояти",
            ],

            // announcement text
            'write_announcement_text' => "<b>Эълон матнини ёзинг!</b> Масалан:

Писта ёғи сотаман. Россияда ишлаб чиқарилган. 1-3-5 литрлик идишларда. Энг кам сотишимиз 50 коробка. Биринчи қўлдан. Улгуржи нарҳда.

❌ <b>Бу ерга телефон рақам ёзманг!</b>",
            'announcement_text_is_too_short' => "❗️Эълон матнини жуда қисқа ёздингиз, илтимос тўлиқроқ ёзинг!",

            // announcement phone number
            'enter_announcement_phone_number' => "📲 <b>Телефон рақамни юбориш</b> тугмасини босинг ёки рақамингизни шу кўринишда ёзинг! <b>+998981246999</b>
______________
<b>Aгар Сизда 2 та рақам бўлса бундай кўринишда ёзинг:

+998981234567
+998997654321</b>",
            'send_phone_number' => "📲 Телефон рақамни юбориш",

            // announcement media
            'send_media' => "<b>Расм ёки видео юкланг.</b> 📎

1.Расм ёки видео юклаш учун 📎 белгисини босинг ва эълонга тегишли расм ёки видео танланг.

2. <b>Эсингизда бўлсин</b> эълон расм ёки видео билан харидорлар эътиборини яхшироқ тортади.

❗️<b>Расм ва видеоларни юклаб бўлгандан сўнг Давом этиш ➡️ тугмасини босинг.</b>",
            'continue' => "Давом этиш ➡️",
            'media_limit' => "Кечирасиз, юборилиши мумкин бўлган расм ва видеолар сони 10 тадан ошмаслиги лозим. Илтимос, <b>Давом этиш</b> ➡️ тугмасини босинг.",
            'send_media_or_continue' => "Илтимос, расм ва видео юборинг ёки давом этиш тугмасини босинг.",
            'photo_accepted' => "Расм муваффақиятли юкланди ✅",
            'video_accepted' => "Видео муваффақиятли юкланди ✅",

            // announcement full
            'category' => "<b>Бўлим</b>",
            'region' => "<b>Ҳудуд</b>",
            'contact' => "<b>Мурожаат учун тел</b>",

            // announcement confirmation
            'confirm_announcement_text' => "Эълонни текширинг хатолари бўлса ⬅️<b>Орқага</b> тугмасини босиб хатоларини тўғрилаб чиқинг. 

Юқоридаги маълумотлар тўғри бўлса ✅ <b>Эълонни юбориш</b> тугмасини босинг!",
            'confirm_announcement_button' => "✅ Эълонни юбориш",

            // announcement accepted
            'announcement_accepted' => "✅ Сизнинг эълонингиз қабул қилинди. Тез орада эълонингизни кўриб чиқамиз ва каналда эълон қиламиз.",

            // admin
            'new_announcement' => "Янги эълон келди",

            // my announcements
            'republish' => "🔄 Қайта эълон қилиш",
            'delete' => "❌ Ўчириш",
            'announcement_deleted' => "E'lon muvaffaqiyatli o'chirildi  ✅",
            'no_announcements' => "Ҳозирча эълонлар йўқ.",
            'published' => "Эълон қилинган",
            'not_published' => "Эълон қилинмаган",
            'rejected' => "Рад этилган",
            'options' => "Эълонни",

            // notification
            'announcement_canceled' => "Эълонингиз рад этилди.",
            'announcement' => "Эълон",

        ];

    const RU =
        [
            'back' => "⬅️ Назад",
            // main page
            'choose_category' => "<b>Уважаемый {firstName} {lastName}!</b> 

Заполнение объявления займёт 1-2 минут.

<b>Чтобы добавить объявление выберите нужный раздел</b>  👇🏻",
            'sell' => "Продать",
            'buy' => "Купить",
            'offer' => "Предлагать услугу",
            'announcements' => "🍅 Мои объявления",
            'settings' => "⚙️  Настройки",

            // settings
            'current_settings' => "Вы можете изменить свой номер телефона и язык, используя кнопки ниже.
<b>Язык:</b>   {language}
<b>Номер телефона:</b> {phone_number}",
            'change_lang' => "🌐 Изменить язык",
            'change_number' => "📱 Изменить номер",
            'main_page' => "🏠 Главная страница",

            // language settings
            'choose_lang' => "Выберите язык 👇🏻",
            'lang_changed' => "✅ Язык успешно изменен!",

            // phone number settings
            'enter_phone_number' => "📲 Отправьте номер телефона с кодом <b>+998</b> или нажмите на кнопку <b>Отправить мой номер</b>.",
            'send_my_phone_number' => "📲 Отправить мой номер",
            'phone_number_changed' => "✅ Номер телефона успешно изменен!",
            'wrong_phone_number' => "❗️<b>Неверный номер телефона!</b> 

📲 Отправьте номер телефона с кодом <b>+998</b> или нажмите на кнопку <b>Отправить мой номер</b>.",

            // announcement category
            'choose_announcement_category_sell' => "<b>Что вы хотите продать?</b>
Выберите категорию 👇🏻",
            'choose_announcement_category_buy' => "<b>Что вы хотите купить?</b>
Выберите категорию 👇🏻",
            'choose_announcement_category_service' => "<b>Какую услугу вы предлагаете?</b>
Выберите категорию 👇🏻",
            'categories' => [
                "Фрукты и овощи",
                "Маргарины и жиры",
                "Мясные продукты",
                "Сухофрукты",
                "Сахар, соль, мед, хлеб",
                "Мука, Рис, Зерновые",
                "Замороженные продукты",
                "Яйцо", "Паста",
                "Вода и напитки",
                "Чай, кофе",
                "Торт, десерт, шоколад",
                "Консервы",
                "Фисташки, чипсы, курт, попкорн",
                "Полуфабрикаты",
                "Специи, соусы, добавки",
                "Хлеб и хлебобулочные изделия",
                "Другие продукты",
                "Молоко и молочные продукты",
                "Корм для животных",
                "Оборудование для пищевой промышленности",
                "Упаковочные услуги",
                "Логистика"
            ],

            // announcement region
            'choose_region' => "<b>Где находится ваш продукт?</b>
Выберите регион 👇🏻",
            'regions' => [
                "Город Ташкент",
                "Республика Каракалпакстан",
                "Андижанская область",
                "Бухарская область",
                "Джизакская область",
                "Кашкадарьинская область",
                "Навоийская область",
                "Наманганская область",
                "Самаркандская область",
                "Сурхандарьинская область",
                "Сырдарьинская область",
                "Ташкентская область",
                "Ферганская область",
                "Хорезмская область",
            ],

            // announcement text
            'write_announcement_text' => "<b>Введите текст объявления.</b> Например:

Продам сахар по низким ценам. Производство в России. 1 коробка 25 кг. Минимальная партия  - 1 тонна!

❌ <b>Не пишите здесь номер телефона!</b>",
            'announcement_text_is_too_short' => "❗️Описание не должно быть слишком коротким! 
Пожалуйста, опишите более подробно.",

            // announcement phone number
            'enter_announcement_phone_number' => "📲  Отправьте номер телефона или введите правильный номер телефона с кодом <b>+998</b>
______________
<b>Если у Вас есть два номера, тогда напишите таком порядке:

+998981234567
+998997654321</b>",
            'send_phone_number' => "📲 Отправить мой номер",

            // announcement media
            'send_media' => "<b>Загрузите фото или видео.</b> 📎

1. Чтобы загрузить фотографию или видео ролик, нажмите 📎.

2. <b>Имейте в виду,</b> что объявления с изображением или видео выглядит лучше и привлекает внимание клиента.

❗️<b>После загрузки фотографий и видео нажмите кнопку «Продолжить».</b>",
            'continue' => "Продолжить ➡️",
            'media_limit' => "Извините, количество фотографий и видео, которые можно отправить, не должно превышать 10. Пожалуйста, нажмите кнопку <b>«Продолжить».</b>",
            'send_media_or_continue' => "Пожалуйста, отправьте фотографии и видео или нажмите кнопку «Продолжить».",
            'photo_accepted' => "Изображение успешно загружено ✅",
            'video_accepted' => "Видео было успешно загружено ✅",

            // announcement full
            'category' => "<b>Категория</b>",
            'region' => "<b>Регион</b>",
            'contact' => "<b>Контакты</b>",

            // announcement confirmation
            'confirm_announcement_text' => "Пожалуйста, проверьте правописание перед публикацией, если вся информация верны, нажмите на кнопку <b>«✅ Опубликовать»</b>!",
            'confirm_announcement_button' => "✅ Опубликовать",

            // announcement accepted
            'announcement_accepted' => "✅ Ваше объявление принято. Мы скоро рассмотрим ваше объявление и опубликуем его на канале.",

            // admin
            'new_announcement' => "Yangi e'lon keldi",

            // my announcements
            'republish' => "🔄 Опубликовать снова",
            'delete' => "❌ Удалить",
            'announcement_deleted' => "Объявление было успешно удалено  ✅",
            'no_announcements' => "На данный момент нет объявлений.",
            'published' => "Опубликован",
            'not_published' => "Не опубликован",
            'rejected' => "Отклонено",
            'options' => "Действия:",

            // notification
            'announcement_canceled' => "Ваше объявление было отклонено."
        ];
}