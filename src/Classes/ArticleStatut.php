<?php

namespace Democvidev\ChessTeam\Classes;

use Democvidev\ChessTeam\Classes\Generique;

class ArticleStatut extends Generique
{
    public const DRAFT = 'brouillon';
    public const PUBLISHED = 'publié';
    public const PRIVATE = 'privé';
    public const HIDDEN = 'caché';
    public const ARCHIVED = 'archivé';

    // Retourne tous les types sous forme de tableau
    public static function getAllTypes()
    {
        return [
            self::DRAFT,
            self::PUBLISHED,
            self::PRIVATE,
            self::HIDDEN,
            self::ARCHIVED
        ];
    }
}
