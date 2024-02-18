<?php

function displayAuthor(string $authorEmail, array $users): string
{
    foreach ($users as $user) {
        if ($authorEmail === $user['email']) {
            return $user['full_name'] . '(' . $user['age'] . ' ans)';
        }
    }

    return 'Auteur inconnu';
}

function isValidCar(array $car): bool
{
    if (array_key_exists('is_enabled', $car)) {
        $isEnabled = $car['is_enabled'];
    } else {
        $isEnabled = false;
    }

    return $isEnabled;
}

function getCars(array $cars): array
{
    $valid_car = [];

    foreach ($cars as $car) {
        if (isValidCar($car)) {
            $valid_car[] = $car;
        }
    }

    return $valid_car;
}

function redirectToUrl(string $url): never
{
    header("Location: {$url}");
    exit();
}