<?php

namespace app\models;

use Yii;


class Lang extends \yii\base\Model
{
    public $home= ['Главная','Main page', 'Pagină principală', 'Головна', 'Ставка главнокомандованія','الصفحة الرئيسية','Төп бит', 'Die Hauptseite', 'La page principale'];
    public $bugaga=['Бугагагагашеньки','Wow! Bazinga!','Hai,hai!!','Бугага!','У насъ до ужаса смешныя бугагашки!','!بوغاغاغاغا','Әй,буғағағаға!','Bazinga!','Mdr :D '];
    public $poems=['Стихи','Poems', 'Poezii', 'Вірші', 'Стихи', 'القصائد', 'Шиғырҙар', 'Gedichte', 'Les poèmes'];
    public $anecdote=['Анекдоты','Anecdotes', 'Anecdote', 'Анекдоти', 'Забавныя исторіи', 'النكت', 'Анекдоттар', 'Anekdoten und Witze', 'Anecdotes'];
    public $haiku=['Хокку','Haiku', 'Haiku', 'Хайку', 'Хайку', 'هايكو', 'Хайкуҙар', 'Haiku', 'Haїku']; 
    public $about=['О нас','About', 'Despre noi', 'Про нас', 'Информація о насъ', 'استعلامات', 'Мәғлүмәт', 'Über uns', 'L\'information de nous'];
    public $add=['Добавить','Add', 'Adăuga', 'Додати', 'Добавить','إضافة', 'Өҫтәү', 'Hinzufügen', 'Ajouter'];
    public $login= ['Войти','Log in', 'Întra pe site', 'Увійти', 'Посетить страницу', 'افتح حسابك', 'Инеү', 'Logen Sie ein', 'Entrer le site'];
    public $logout=['Выйти','Log out', 'Deconecta', 'Вийти', 'Покинуть страницу', 'اغلق حسابك', 'Сығыу', 'Ausloggen', 'Quitter le site'];
    public $loadmore=['Загрузить еще','Load more...', 'Încărca mai mult', 'Давай ще', 'Баринъ желаетъ болѣ стиховъ!', 'اكثر', 'Тағы ла', 'Mehr', 'Voir plus' ];
    public $connect=['Связь','Contact', 'Conectare cu noi', 'Зв\'язок', 'Телеграфъ', 'العلاقة', 'Бәйләнеш', 'Verbindung', 'Connectez-vous avec nous'];
    public $search=['Поиск','Search', 'Cautare', 'Благаю,шукайте', 'Поискъ стиховъ и рабовъ', 'ابحث هنا', 'Эҙләү', 'Durchsuchung', 'La recherche'];
    public $addpoem=['Стих','A poem', 'O poezie', 'Вірш', 'Стихъ', 'قصيدة', 'Шиғыр', 'Ein gedicht', 'Une poème'];
    public $addanec=['Анекдот','An anecdote', 'O anecdotă', 'Анекдот', 'Забавную исторію', 'نكتة', 'Анекдот', 'Eine Anekdote oder ein Witz', 'Une anecdote'];
    public $addhaiku=['Хокку','Haiku', 'Haiku', 'Хайку', 'Хайку', 'هايكو', 'Хайку', 'Haiku', 'Haїku'];

    public function getIndex($lang)
    {
        switch($lang){
            case 'ru' :                
                return 0;
                break;
            case 'eng' :
                return 1;
                break;
            case 'bib' :
                return 2;
                break;
            default: 
                return null;
                break;    
        }
    }
    
}
