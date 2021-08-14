<?php

class UserForm extends Form
{
    public function build()
    {
        $this->addFormField('nom');
        $this->addFormField('prenom');
        $this->addFormField('day');
        $this->addFormField('month');
        $this->addFormField('year');
        $this->addFormField('adress');
        $this->addFormField('ville');
        $this->addFormField('codePostal');
        $this->addFormField('pays');
        $this->addFormField('phoneNumber');
        $this->addFormField('mail');
        $this->addFormField('password');
    }
}