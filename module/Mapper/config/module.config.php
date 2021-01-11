<?php

declare(strict_types=1);

namespace Mapper;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
          'mapper' => [
              'type' => Literal::class,
              'options' => [
                  'route' => '/mapper',
                  'defaults' => [
                      'controller' => Controller\IndexController::class,
                      'action' => 'mapper',
                  ],
              ],
          ],
            'indexcontroller' => [
                'type'    => Segment::class,
                'options' => [
                    //la rotta da impostare è custom
                    'route'    => '/indexcontroller',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'addcontroller' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/addcontroller',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'add',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];