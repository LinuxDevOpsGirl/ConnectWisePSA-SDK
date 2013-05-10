<?php namespace ConnectWiseApi;

use ConnectWiseApi\ApiResource,
    ConnectWiseApi\ApiRequestParams,
    ConnectWiseApi\ApiResult,
    ConnectWiseApi\ApiException;

/**
 * @todo Testing...
 */
class ServiceTicket
{
    protected static $currentApi = 'ServiceTicketApi';
    
    /**
     * Adds or updates a service ticket for a company identified by the text-based company id. 
     * If the service ticket number is 0, the service ticket is added. 
     * If non-zero, the existing service ticket with that ticket number is updated.
     *
     * @param string $companyId
     * @param array $serviceTicket
     * @return array
     **/
    public static function addOrUpdateServiceTicketViaCompanyId($companyId, array $serviceTicket)
    {
        ApiRequestParams::set('companyId', $companyId);
        ApiRequestParams::set('serviceTicket', $serviceTicket);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->AddOrUpdateServiceTicketViaCompanyId(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results, 'AddOrUpdateServiceTicketViaCompanyIdResult');

        return ApiResult::getAll();
    }

    /**
     * Adds or updates a service ticket for a company identified by managed id. 
     * If the service ticket number is 0, the service ticket is added. 
     * If non-zero, the existing service ticket with that ticket number is updated.
     * @todo This is untested: need a valid managed id to test this method
     *
     * @param string $managedId
     * @param array $serviceTicket
     * @return array
     **/
    public static function addOrUpdateServiceTicketViaManagedId($managedId, array $serviceTicket)
    {
        ApiRequestParams::set('managedId', $managedId);
        ApiRequestParams::set('serviceTicket', $serviceTicket);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->AddOrUpdateServiceTicketViaManagedId(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results, 'AddOrUpdateServiceTicketViaManagedIdResult');

        return ApiResult::getAll();
    }

    /**
     * Add or update a product on a ticket
     *
     * @param array $ticketProduct
     * @return array
     **/
    public static function addOrUpdateTicketProduct(array $ticketProduct)
    {
        ApiRequestParams::set('ticketProduct', $ticketProduct);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->AddOrUpdateTicketProduct(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results, 'AddOrUpdateTicketProductResult');

        return ApiResult::getAll();
    }

    /**
     * Adds a new service ticket for a company identified by the *text-based* company id
     *
     * @throws ApiException
     * @param string $companyId
     * @param array $serviceTicket
     * @return array
     */
    public static function addServiceTicketViaCompanyId($companyId, array $serviceTicket)
    {
        ApiRequestParams::set('companyId', $companyId);
        ApiRequestParams::set('serviceTicket', $serviceTicket);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->AddServiceTicketViaCompanyId(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results->AddServiceTicketViaCompanyIdResult, 'Ticket');

        return ApiResult::getAll();
    }

    /**
     * Adds a new service ticket for a company identified by managed id
     * @todo This is untested: need a valid managed id to test this method
     *
     * @param string $managedId
     * @param array $serviceTicket
     * @return array
     **/
    public static function addServiceTicketViaManagedId($managedId, array $serviceTicket)
    {
        ApiRequestParams::set('managedId', $managedId);
        ApiRequestParams::set('serviceTicket', $serviceTicket);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->AddServiceTicketViaManagedId(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results, 'AddServiceTicketViaManagedIdResult');

        return ApiResult::getAll();
    }

    /**
     * Add a product on a ticket
     *
     * @param array $ticketProduct
     * @return array
     **/
    public static function addTicketProduct(array $ticketProduct)
    {
        ApiRequestParams::set('ticketProduct', $ticketProduct);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->AddTicketProduct(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results, 'AddTicketProductResult');

        return ApiResult::getAll();
    }

    /**
     * Finds service ticket information by a set of conditions
     *
     * @throws ApiException
     * @param integer $limit
     * @param integer $skip
     * @param string $conditions
     * @param string $orderBy
     * @return array
     */
    public static function findServiceTickets($limit = 100, $skip = 0, $conditions = null, $orderBy = null)
    {
        if (is_int($limit) === false) 
        {
            throw new ApiException('Limit value must be an integer.');
        }

        if (is_int($skip) === false)
        {
            throw new ApiException('Skip value must be an integer.');
        }

        ApiRequestParams::set('limit', $limit);
        ApiRequestParams::set('skip', $skip);
        ApiRequestParams::set('conditions', $conditions);
        ApiRequestParams::set('orderBy', $orderBy);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->FindServiceTickets(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results->FindServiceTicketsResult, 'Ticket');

        return ApiResult::getAll();
    }

    /**
     * Gets the list of statuses available to the specified ticket
     *
     * @throws ApiException
     * @param integer $ticketId
     * @return array
     **/
    public static function getServiceStatuses($ticketId)
    {
        if (is_int($ticketId) === false)
        {
            throw new ApiException('Ticket ID must be an integer.');
        }

        ApiRequestParams::set('ticketNumber', $ticketId);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->GetServiceStatuses(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results, 'GetServiceStatusesResult');

        return ApiResult::getAll();
    }

    /**
     * Gets a serice ticket by the ticket number (id)
     * If no service ticket exists with the given ticket number, an empty array is returned
     *
     * @throws ApiException
     * @param integer $ticketId
     * @return array
     **/
    public static function getServiceTicket($ticketId)
    {
        if (is_int($ticketId) === false)
        {
            throw new ApiException('Ticket ID must be an integer.');
        }

        ApiRequestParams::set('ticketNumber', $ticketId);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->GetServiceTicket(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results, 'GetServiceTicketResult');

        return ApiResult::getAll();
    }

    /**
     * Gets the count of service tickets that meet the specified conditions
     *
     * @param string $conditions
     * @param boolean $isOpen
     * @return array
     **/
    public static function getTicketCount($isOpen = true, $conditions = '')
    {
        if (is_bool($isOpen) === false)
        {
            throw new ApiException('isOpen parameter must be boolean.');
        }

        ApiRequestParams::set('conditions', $conditions);
        ApiRequestParams::set('isOpen', $isOpen);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->GetTicketCount(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results, 'GetTicketCountResult');

        return ApiResult::getAll();
    }

    /**
     * Gets a service ticket by the ticket number.
     * If no service ticket exists with the given #, an error (exception) is thrown
     *
     * @throws ApiException
     * @param integer $ticketId
     * @return array
     **/
    public static function loadServiceTicket($ticketId)
    {
        if (is_int($ticketId) === false)
        {
            throw new ApiException('Ticket ID must be an integer.');
        }

        ApiRequestParams::set('ticketNumber', $ticketId);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->LoadServiceTicket(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results, 'LoadServiceTicketResult');

        return ApiResult::getAll();
    }

    /**
     * Get a list of products for the specified ticket
     *
     * @throws ApiException
     * @param integer $ticketNumber
     * @return array
     **/
    public static function getTicketProductList($ticketNumber)
    {
        if (is_int($ticketNumber) === false)
        {
            throw new ApiException('Ticket number must be an integer.');
        }

        ApiRequestParams::set('ticketNumber', $ticketNumber);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->GetTicketProductList(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results->GetTicketProductListResult, 'TicketProduct');

        return ApiResult::getAll();
    }

    /**
     * Performs a Knowledgebase search using the specified parameters
     *
     * @throws ApiException
     * @param string $terms
     * @param string $type
     * @param string $start
     * @param integer $companyRecId
     * @param integer $limit
     * @param integer $skip
     * @return array
     **/
    public static function searchKnowledgebase($terms, $type, $start, $companyRecId = '', $limit = 100, $skip = 0)
    {
        if (is_int($limit) === false) 
        {
            throw new ApiException('Limit value must be an integer.');
        }

        if (is_int($skip) === false)
        {
            throw new ApiException('Skip value must be an integer.');
        }

        if ($type != 'Any' AND $type != 'All' AND $type != 'Exact')
        {
            throw new ApiException('KB type invalid. Must be "Any", "All" or "Exact".');
        }

        ApiRequestParams::set('searchTerms', $terms);
        ApiRequestParams::set('searchType', $type);
        ApiRequestParams::set('searchStart', $start);
        ApiRequestParams::set('companyRecID', $companyRecId);
        ApiRequestParams::set('limit', $limit);
        ApiRequestParams::set('skip', $skip);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->SearchKnowledgebase(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results->SearchKnowledgebaseResult, 'KnowledgeBaseResult');

        return ApiResult::getAll();
    }

    /**
     * Counts the Knowledgebase records that will be returned by performing the associated search
     *
     * @throws ApiException
     * @param string $terms
     * @param string $type
     * @param string $start
     * @param integer $companyRecId
     * @param integer $limit
     * @param integer $skip
     * @return array
     **/
    public static function searchKnowledgebaseCount($terms, $type, $start, $companyRecId = '')
    {
        if ($type != 'Any' AND $type != 'All' AND $type != 'Exact')
        {
            throw new ApiException('KB type invalid. Must be "Any", "All" or "Exact".');
        }

        ApiRequestParams::set('searchTerms', $terms);
        ApiRequestParams::set('searchType', $type);
        ApiRequestParams::set('searchStart', $start);
        ApiRequestParams::set('companyRecID', $companyRecId);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->SearchKnowledgebaseCount(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results, 'SearchKnowledgebaseCountResult');

        return ApiResult::getAll();
    }

    /**
     * Get the documents attached to the specified ticket
     *
     * @throws ApiException
     * @param integer $ticketNumber
     * @return array
     **/
    public static function getTicketDocuments($ticketNumber)
    {
        if (is_int($ticketNumber) === false)
        {
            throw new ApiException('Ticket number must be an integer.');
        }

        ApiRequestParams::set('ticketNumber', $ticketNumber);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->GetTicketDocuments(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results->GetTicketDocumentsResult, 'DocumentInfo');

        return ApiResult::getAll();
    }

    /**
     * Updates an existing service ticket for a company identified by the text-based company id
     *
     * @param string $companyId
     * @param array $serviceTicket
     * @return array
     **/
    public static function updateServiceTicketViaCompanyId($companyId, array $serviceTicket)
    {
        ApiRequestParams::set('companyId', $companyId);
        ApiRequestParams::set('serviceTicket', $serviceTicket);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->UpdateServiceTicketViaCompanyId(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results, 'UpdateServiceTicketViaCompanyIdResult');

        return ApiResult::getAll();
    }

    /**
     * Updates an existing service ticket for a company identified by managed id
     * @todo This is untested: need a valid managed id to test this method
     *
     * @param string $managedId
     * @param array $serviceTicket
     * @return array
     **/
    public static function updateServiceTicketViaManagedId($managedId, array $serviceTicket)
    {
        ApiRequestParams::set('managedId', $managedId);
        ApiRequestParams::set('serviceTicket', $serviceTicket);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->UpdateServiceTicketViaManagedId(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results, 'UpdateServiceTicketViaManagedIdResult');

        return ApiResult::getAll();
    }

    /**
     * Add a new ticket note or update an existing ticket note by service ticket rec id
     *
     * @throws ApiException
     * @param array $ticket
     * @param integer $serviceRecId
     * @return array
     **/
    public static function updateTicketNote(array $note, $serviceRecId)
    {
        if (is_int($serviceRecId) === false)
        {
            throw new ApiException('Service Rec ID must be an integer.');
        }

        ApiRequestParams::set('note', $note);
        ApiRequestParams::set('srServiceRecid', $serviceRecId);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->UpdateTicketNote(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results, 'UpdateTicketNoteResult');

        return ApiResult::getAll();
    }

    /**
     * Update a product on a ticket
     *
     * @param array $product
     * @return array
     **/
    public static function updateTicketProduct(array $product)
    {
        ApiRequestParams::set('ticketProduct', $product);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->UpdateTicketProduct(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results, 'UpdateTicketProductResult');

        return ApiResult::getAll();
    }

    /**
     * Deletes a service ticket by the ticket number
     *
     * @param integer $ticketId
     * @return array
     **/
    public static function deleteServiceTicket($ticketId)
    {
        ApiRequestParams::set('ticketNumber', $ticketId);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->DeleteServiceTicket(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results);

        return ApiResult::getAll();
    }

    /**
     * Removes the document from the ticket
     *
     * @throws ApiException
     * @param integer $docId
     * @param integer $ticketId
     * @return array
     **/
    public static function deleteTicketDocument($docId, $ticketId)
    {
        if (is_int($docId) === false)
        {
            throw new ApiException('Document ID must be an integer.');
        }

        if (is_int($ticketId) === false)
        {
            throw new ApiException('Ticket ID must be an integer.');
        }

        ApiRequestParams::set('id', $docId);
        ApiRequestParams::set('ticketNumber', $ticketId);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->DeleteTicketDocument(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results);

        return ApiResult::getAll();
    }

    /**
     * Delete product from a ticket
     *
     * @throws ApiException
     * @param integer $productId
     * @param integer $ticketId
     * @return array
     **/
    public static function deleteTicketProduct($productId, $ticketId)
    {
        if (is_int($productId) === false)
        {
            throw new ApiException('Product ID must be an integer.');
        }

        if (is_int($ticketId) === false)
        {
            throw new ApiException('Ticket ID must be an integer.');
        }

        ApiRequestParams::set('id', $productId);
        ApiRequestParams::set('ticketNumber', $ticketId);

        $results = ApiResource::run('api_connection', 'start', static::$currentApi)
            ->DeleteTicketProduct(ApiRequestParams::getAll());

        ApiResult::addResultFromObject($results);

        return ApiResult::getAll();
    }
}