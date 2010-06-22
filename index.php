<?php

    include __DIR__.DIRECTORY_SEPARATOR.'setup.php';

    Response::redirectDomain('127.0.0.1');

    function debug() {
        echo '<blockquote style="background:#fcc;border:1px solid #900;color:#900;">';
        foreach(func_get_args() as $arg) {
            echo '<pre style="background:#fee;border:1px solid #fcc;margin:2px;overflow:auto;padding:5px;">';
            print_r($arg);
            echo '</pre>';
        }
        echo '</blockquote>';
    }

    //debug($_SERVER, $_POST);
    //TestFormatter();
    TestValidator();

    function TestValidator() {
        debug('Validator & Validation Rules');

        $validator = new Validator();
        $validator->addRule(new Validation_Rule_Length(array(
            'min' => 6,
        )));
        debug($validator);
        if (!$validator->validate('azert')) {
            debug($validator->getErrors());
        } else {
            debug('This is valid.');
        }

        $validator = new Validator();
        $validator->Length(array(
            'min' => 6,
            'max' => 3,
        ));
        debug($validator);
        if (!$validator->validate('azerty')) {
            debug($validator->getErrors());
        } else {
            debug('This is valid.');
        }

        $validator = new Validator();
        $validator->Length(array(
            'min' => 5,
            'max' => 10,
        ));
        debug($validator);
        if (!$validator->validate('azerty')) {
            debug($validator->getErrors());
        } else {
            debug('This is valid.');
        }
    }





    function TestFormatter() {

        debug('Currency::format() - positive');
        debug(
            Currency::format(123.1),
            Currency::format(1234567.89)
        );

        debug('Currency::format() - negative');
        debug(
            Currency::format(-2.999),
            Currency::format(-12345678.90)
        );

        debug('Time::format() - classic');
        debug(
            Time::formatShort(9, 43, 12),
            Time::formatLong(19, 43, 12)
        );

        Time::$amSymbol = 'AM';
        Time::$pmSymbol = 'PM';
        debug('Time::format() - using meridian');
        debug(
            Time::format('hh:mm tt', 9, 43, 12),
            Time::format('hh:mm:ss tt', 19, 43, 12)
        );


        debug('Number::format() - positive');
        debug(
            Number::format(123.1),
            Number::format(1234567.89)
        );

        debug('Number::format() - negative');
        debug(
            Number::format(-2.999),
            Number::format(-12345678.90)
        );

    }