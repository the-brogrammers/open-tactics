<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

trait RestControllerTrait
{
	public function index()
    {
        $m = self::MODEL;
		return $this->sendSuccessResponse($m::all());
    }
    public function show($id)
    {
        $m = self::MODEL;
    	if($data = $m::find($id))
        {
			return $this->sendSuccessResponse($data);
        }
        return $this->notFoundResponse();
    }

    public function store(Request $request)
    {
        $m = self::MODEL;
        try
        {
            $v = \Validator::make($request->all(), $this->validationRules);
            if($v->fails())
            {
                throw new \Exception("ValidationException");
            }
            $data = $m::create(\Request::all());
            return $this->createdResponse($data);
        }catch(\Exception $ex)
        {
            //$data = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            $data = ['form_validations' => $v->errors()];
            return $this->clientErrorResponse($data);
        }
    }

    public function update($id)
    {
    	$m = self::MODEL;
        if(!$data = $m::find($id))
        {
            return $this->notFoundResponse();   
        }
        try
        {
            $v = \Validator::make(\Request::all(), $this->validationRules);
            if($v->fails())
            {
                throw new \Exception("ValidationException");
            }
            $data->fill(\Request::all());
            $data->save();
			return $this->sendSuccessResponse($data);
        }catch(\Exception $ex)
        {
            $data = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            return $this->clientErrorResponse($data);
        }
    }

    public function destroy($id)
    {
        $m = self::MODEL;
    	if (!$data = $m::find($id))
        {
            return $this->notFoundResponse();   
        }
        $data->delete();
        return $this->deletedResponse();
    }

    protected function createdResponse($data)
    {
		return $this->sendSuccessResponse($data, 201);
    }

    protected function notFoundResponse()
    {
		return $this->sendErrorResponse([], 404);
    }

    protected function deletedResponse()
    {
		return $this->sendSuccessResponse([], 204);
    }

    protected function clientErrorResponse($data)
    {
		return $this->sendErrorResponse($data, 422);
    }

	protected function sendSuccessResponse($data, $code=200, $message=null) {
		$response = [
			'status' => 'success',
			'data' => $data
		];
		return $this->sendResponse($response, $code, $message);
	}

	protected function sendErrorResponse($data, $code, $message=null) {
		$response = [
			'status' => 'error',
			'data' => $data
		];
		return $this->sendResponse($response, $code, $message);
	}

	protected function sendResponse($data, $code, $message=null) {
		if ($message) {
			$data['message'] = $message;
		}
        return response()->json($data, $code);
	}
}
