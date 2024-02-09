<?php

enum Hora: string
{
    case Primera = '8:30 - 9:30';
    case Segunda = '9:30 - 10:30';
    case Tercera = '10:30 - 11:30';
    case Cuarta = '11:30 - 12:30';
    case Quinta = '12:30 - 13:30';
    case Sexta = "13:30 - 14:30";

    public function codigoHora(): string
    {
        return match ($this) {
            static::Primera => '1',
            static::Segunda => '2',
            static::Tercera => '3',
            static::Cuarta => '4',
            static::Quinta => '5',
            static::Sexta => '6',
        };
    }
}

enum Semana: string
{
    case Lunes = 'L';
    case Martes = 'M';
    case Miércoles = 'X';
    case Jueves = 'J';
    case Viernes = 'V';
}

enum Clase: string
{
    case R1 = 'R01';
    case R2 = 'R02';
    case R3 = 'R03';
    case R4 = 'R04';
}

enum Curso: string
{
    case DAW_1A = '1ADAW';
    case DAW_2A = '2ADAW';
    case DAM_1A = '1ADAM';
    case DAM_2A = '2ADAM';
}

enum Color: string
{
    case Rojo = '#E53229';
    case Azul = '#3A9DD6';
    case Verde = '#29E564';
    case Naranja = '#FC9C1F';
    case Rosa = '#edaaeb';
    case Amarillo = '#f1ef16';
}

enum Materia: string
{
    case DSW = 'DSW';
    case DOR = 'DOR';
    case DEW = 'DEW';
    case PRW = 'PRW';
    case BAE = 'BAE';
    case PRO = 'PRO';
}
