<?php

namespace App\Controller;

use Symfony\Component\Form\FormInterface;

class AbstractController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * Creates and returns a Form instance from the filter.
     * @param string $type
     * @param null $data
     * @param array $options
     * @return FormInterface
     */
    protected function createFilter(string $type, $data = null, array $options = []): FormInterface
    {
        return $this->container->get('form.factory')->createNamed('', $type, $data, $options);
    }
}