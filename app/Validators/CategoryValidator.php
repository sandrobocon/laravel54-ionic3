<?php

namespace CodeFlix\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CategoryValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
		'required|min:2|unique'	=>'	name=>required|min:2|max:255|unique',
	],
        ValidatorInterface::RULE_UPDATE => [
		'required|min:2|unique'	=>'	name=>required|min:2|max:255|unique',
	],
   ];
}
