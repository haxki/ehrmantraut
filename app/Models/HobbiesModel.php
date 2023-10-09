<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HobbiesModel extends Model
{
    public static function getData() { 
        return [
            [
                'img_src' => "img/film.jpg", 
                'img_alt' => "Фильмы",
                'img_title' => "Breaking Bad",
                'header_id' => "films",
                'header_content' => "Фильмы и сериалы",
                'description' => 'Смотрели "Во все тяжкие"? А "Лучше звоните Солу"? Нет? Ну и ладно...'
            ],
            [
                'img_src' => "img/game.jpg", 
                'img_alt' => "Игры",
                'img_title' => "God of War",
                'header_id' => "games",
                'header_content' => "Компьютерные игры",
                'description' => "Играть все любят, а я так вообще. Устраиваю фотосессии игровых косплеев по четвергам."
            ],
            [
                'img_src' => "img/music.jpg", 
                'img_alt' => "Музыка",
                'img_title' => "Dying Fetus",
                'header_id' => "music",
                'header_content' => "Музыка",
                'description' => "Играю на гитаре в свободное время."
            ]
        ];
    }
}
