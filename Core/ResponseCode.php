<?php

namespace Core;

/**
 * Class ResponseCode
 *
 * This class defines constants for common HTTP response codes.
 */
class ResponseCode
{
	/** @var int OK - The request has succeeded. */
	const int OK = 200;
	
	/** @var int CREATED - The request has been fulfilled and resulted in a new resource being created. */
	const int CREATED = 201;
	
	/** @var int ACCEPTED - The request has been accepted for processing, but the processing has not been completed. */
	const int ACCEPTED = 202;
	
	/** @var int NO_CONTENT - The server successfully processed the request, but is not returning any content. */
	const int NO_CONTENT = 204;
	
	/** @var int BAD_REQUEST - The server cannot or will not process the request due to a client error. */
	const int BAD_REQUEST = 400;
	
	/** @var int UNAUTHORIZED - The request requires user authentication. */
	const int UNAUTHORIZED = 401;
	
	/** @var int FORBIDDEN - The server understood the request, but refuses to authorize it. */
	const int FORBIDDEN = 403;
	
	/** @var int NOT_FOUND - The server has not found anything matching the request URI. */
	const int NOT_FOUND = 404;
	
	/** @var int METHOD_NOT_ALLOWED - The method specified in the request is not allowed for the resource identified by the request URI. */
	const int METHOD_NOT_ALLOWED = 405;
	
	/** @var int CONFLICT - The request could not be completed due to a conflict with the current state of the resource. */
	const int CONFLICT = 409;
	
	/** @var int INTERNAL_SERVER_ERROR - The server encountered an unexpected condition which prevented it from fulfilling the request. */
	const int INTERNAL_SERVER_ERROR = 500;
}
