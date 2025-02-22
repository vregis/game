<?php

namespace backend\helpers;

class Constants
{
    const GAMES = 'Игры';

    public const GAME_SOLO = 'Однопользовательская';
    public const GAME_TEAM = 'Командная';
    public const GAME_QUESTION_LINE = 'Линейка';
    public const GAME_QUESTION_STORM = 'Штурмовка';
    public const GAME_QUESTION_QUEST = 'Квест';

    public static array $gameTypes = [
        1 => self::GAME_SOLO,
        2 => self::GAME_TEAM,
    ];

    public static array $gameQuestionTypes = [
        1 => self::GAME_QUESTION_LINE,
        2 => self::GAME_QUESTION_STORM,
        3 => self::GAME_QUESTION_QUEST,
    ];

}