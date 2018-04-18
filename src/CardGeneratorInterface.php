<?php

namespace Bingo;

interface CardGeneratorInterface
{
    public function generate(): CardInterface;
}