<?php

namespace App\Fields\TemplatedFields;

class FieldsMessages
{
    public function imageInstructions($formats, $size, $resolution)
    {
        return 'Please upload image in <span style="font-weight: bold; text-transform: uppercase;">' . $formats . '</span> format, with a maximum size of <span style="font-weight: bold; text-transform: uppercase;">' . $size . '</span> and resolution up to <span style="font-weight: bold;">' . $resolution . '</span>.';
    }

    public function videoInstructions($formats, $size)
    {
        return 'Please upload video in <span style="font-weight: bold; text-transform: uppercase;">' . $formats . '</span> format, with a maximum size of <span style="font-weight: bold; text-transform: uppercase;">' . $size . '</span>.';
    }
}
