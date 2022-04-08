<?php

use Bramin\CuttlyPHP\CuttlyException;
use Bramin\CuttlyPHP\Cuttly;
use Illuminate\Http\Client\ConnectionException;

it('can ping cuttly', function () {
    $cuttly = new Cuttly();

    $response = $cuttly->ping();

    expect($response)->toBeTrue();
});

it('can recognize a bad key', function () {
    config(['cuttly.key' => 'bad-key']);

    $cuttly = new Cuttly();

    $cuttly->ping();
})->throws(CuttlyException::class, '401: Invalid API key');

it('can recognize a bad url', function () {
    config(['cuttly.key' => 'bad-key']);

    $cuttly = new Cuttly('https://cuttttt.ly');

    $cuttly->ping();
})->throws(ConnectionException::class);

