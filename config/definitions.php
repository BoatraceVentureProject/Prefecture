<?php

declare(strict_types=1);

return [
    'Prefecture' => \DI\create('\Boatrace\Venture\Project\Prefecture')->constructor(
        \DI\get('MainPrefecture')
    ),
    'MainPrefecture' => function ($container) {
        return $container->get('\Boatrace\Venture\Project\MainPrefecture');
    },
];
