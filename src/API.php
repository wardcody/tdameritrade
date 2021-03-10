<?php

namespace TDAmeritrade;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;

class API
{

	protected $api_key;
	protected $base_uri = 'https://api.tdameritrade.com/v1';
	protected $client;

	public function __construct($api_key)
	{
		$this->api_key = $api_key;
		$this->client = new Client();
	}

	/**
	 * Use Guzzle to send HTTP request to the specified endpoint with optional parameters
	 * @param  string $endpoint
	 * @param  array  $parameters
	 * @return string
	 */
	public function sendRequest($endpoint, $parameters=[])
	{	
		$parameters['apikey'] = $this->api_key;

		try {
			$response = $this->client->get($this->base_uri.$endpoint, [
				'query' => $parameters
			]);
		} catch (ServerException $e) {
			if($e->getResponse()->getStatusCode() == 500){
				die('Invalid API key.');
			}
		}

		return $response->getBody()->getContents();
	}

	/**
	 * Returns a quote for a symbol
	 * @param  string $symbol
	 * @return string
	 */
	public function quote($symbol)
	{
		$response = $this->sendRequest("/marketdata/{$symbol}/quotes");
		return $response;
	}

	/**
	 * Returns a quote for multiple symbols
	 * @param  string $symbols
	 * @return string
	 */
	public function quotes($symbols)
	{	
		$response = $this->sendRequest("/marketdata/quotes", ['symbol' => $symbols]);
		return $response;
	}

	/**
	 * Returns price history for a symbol
	 * @param  string $symbol
	 * @param  array  $parameters
	 * @return string
	 */
	public function priceHistory($symbol, $parameters=[])
	{	
		$response = $this->sendRequest("/marketdata/{$symbol}/pricehistory", $parameters);
		return $response;
	}

	/**
	 * Returns the option chain for a symbol
	 * @param  array  $parameters
	 * @return string
	 */
	public function optionChain($parameters=[])
	{
		$response = $this->sendRequest("/marketdata/chains", $parameters);
		return $response;
	}

	/**
	 * Returns the top 10 (up or down) movers by value or percent for a particular market
	 * @param  array  $parameters
	 * @return string
	 */
	public function movers($market, $parameters=[])
	{
		$response = $this->sendRequest("/marketdata/{$market}/movers", $parameters);
		return $response;
	}

}

?>