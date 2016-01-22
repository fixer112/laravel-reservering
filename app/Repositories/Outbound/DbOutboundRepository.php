<?php

namespace App\Repositories\Outbound;
use App\Repositories\DbRepository;
use App\Repositories\Flight\FlightRepository as Flight;
use App\Outbound;

class DbOutboundRepository extends DbRepository implements OutboundRepository {
	/**
	*@var Outbound
	*/
	protected $model;

	/**
	 * @var $flight
	 */
	protected $flight

	/**
	*@param $model
	*@param $flight
	*/
	function __construct(Outbound $model, Flight $flight)
	{
		$this->model = $model;
		$this->flight = $flight;
	}

	/**
	 * request userinput and create an outbound
	 * Save belongsTo relationship with Flight model
	 * @param $request [request all user input]
	 * @param $id      [get booking id]
	 */
	public function addBookingDetail($request, $id)
    {
        $flight = $this->flight->getById($id);
        $givenInput = $request->all();
    	$data = $this->model->create($givenInput);
    	$flight->outbound()->save($data);
    }

}