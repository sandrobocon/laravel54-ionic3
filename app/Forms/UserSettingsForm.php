<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class UserSettingsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('password', 'password', [
                'rules' => 'required|min:6|max:40|confirmed'
            ])
            ->add('password_confirmation', 'password');
    }
}
