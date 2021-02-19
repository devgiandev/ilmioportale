<?php

declare(strict_types=1);

namespace Mapper\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction(): ViewModel
    {
        return new ViewModel();
    }

    public function gestionaleAction(): ViewModel
    {
        return new ViewModel();
    }
}