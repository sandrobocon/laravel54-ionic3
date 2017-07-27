<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class CategoryForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');
        $this
            ->add('name', 'text', [
                'label' => 'Nome',
                'rules' => 'required|min:2|max:255'
            ]);
    }
}
