<?php

namespace App\View\Common;

use App\Core\DecoratedView;
use App\Core\View;
use App\Core\ViewInterface;

class BaseSkeletonView extends DecoratedView
{
    private string $title;

    function __construct(string $title, View $parent)
    {
        parent::__construct($parent);
        $this->title = $title;
    }

    public function render(): void
    {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $this->title; ?></title>
        </head>

        <body>
            <h2><?php echo $this->title; ?></h2>
            <?php $this->parent->render(); ?>
        </body>

        </html>
<?php
    }
}
