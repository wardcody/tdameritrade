# TDAmeritrade API

A simple PHP package to retrieve data from TD Ameritrade's API.

Visit [https://developer.tdameritrade.com/](https://developer.tdameritrade.com/) to register for an account and receive an API key.

## Installation

Use composer to install this package

```bash
composer require wardcody/tdameritrade
```

## Basic Usage

```php
require 'vendor/autoload.php';

$api = new TDAmeritrade\API('APIKEY');
$quote = $api->quote('AAPL');
```

## Available Methods

### Quote

Retrieve a quote for the specified symbol

```php
$quote = $api->quote('AAPL');
```

### Quotes

Retrieve a quote for multiple symbols separated by comma

```php
$quotes = $api->quotes('AAPL,NFLX');
```

### Price History

Retrieve the price history for the specified symbol

See https://developer.tdameritrade.com/price-history/apis/get/marketdata/%7Bsymbol%7D/pricehistory for all available parameters

```php
$price_history = $api->priceHistory('AAPL', [
	'periodType' => 'day',
	'period' => 1,
	'frequencyType' => 'minute',
	'frequency' => 15
]);
```

### Option Chain

Retrieve the option chain for an optionable symbol

See https://developer.tdameritrade.com/option-chains/apis/get/marketdata/chains for all available parameters

```php
$options = $api->optionChain([
	'symbol' => 'AAPL',
	'contractType' => 'CALL',
	'strikeCount' => 10,
	'range' => 'ITM'
]);
```

### Movers

Retrieve the top 10 (up or down) movers by value or percent for a particular market ($COMPX, $DJI, $SPX.X)

See https://developer.tdameritrade.com/movers/apis/get/marketdata/%7Bindex%7D/movers for all available parameters

```php
$movers = $api->movers('$SPX.X', [
	'direction' => 'up',
	'change' => 'value'
]);
```
