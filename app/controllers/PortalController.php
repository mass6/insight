<?php

use Insight\Portal\Repositories\Portal;

class PortalController extends \BaseController {


    /**
     * @var Insight\Portal\Repositories\Portal
     */
    private $portal;
    private $group;

    public function __construct(Portal $portal)
    {
        $this->portal = $portal;
        $this->group = Session::get('company') !== '36s' ? Session::get('company') : '' ;
    }

    public function getAjaxReport($report, $search = null)
    {
        if (Request::ajax())
        {
            if ($search)
            {
                return $this->portal->getQuery($report, $search, 'array');
            } else {
                return $this->portal->getReport($report, 'array');
            }
        }

    }

    public function getUsers()
    {
        return View::make('portal.users.index')->with(['reportName' => 'users']);
    }

    public function getContracts()
    {
        return View::make('portal.contracts.index')->with(['reportName' => 'contracts']);
    }

    public function getProducts()
    {
        return View::make('portal.products.index', compact('products'));
    }

    public function getDoa()
    {
        $doa = $this->portal->getReport('doa', 'array');

        return View::make('portal.doa', compact('doa'));
    }

    public function getApprovals()
    {
        //return $this->portal->getReport('OrdersPendingApproval', 'array');
        return View::make('portal.approvals.index')->with(['reportName' => 'approvals']);
    }

    public function getApprovalStatistics()
    {

    }

    public function getOrders($period = 'today')
    {
        $parts = explode('-', $period);
        $parts = array_map('ucfirst', $parts);

        $reportName = 'Orders' . implode('', $parts);
        $heading = 'Orders: ' . implode(' ', $parts);

        return View::make('portal.orders.index', compact('reportName', 'heading'));
    }

    public function searchOrder($searchTerm)
    {
        $results = null;
        if ($searchTerm){
            $searchResults = $this->portal->getQuery('ordersSearch', $searchTerm, 'array');
            $perPage = 12;
            $currentPage = Input::get('page') - 1;
            $pagedData = array_slice($searchResults, $currentPage * $perPage, $perPage);
            $results = Paginator::make($pagedData, count($searchResults), $perPage);
        }
        return View::make('portal.orders.search', compact('results', 'searchTerm'));
    }

    public function searchRouter()
    {
        // grab the search term
        $searchTerm = Input::get('s', null);
        if ($searchTerm){
            return Redirect::route('portal.orders.search_term', $searchTerm);
        }
        return View::make('portal.orders.search', compact('results'));
    }

    public function getOrderDetails($id)
    {
        $order = $this->portal->getQuery('orderDetails', $id, 'array')[0];
        $items = $this->portal->getQuery('orderItemDetails', $id, 'array');
        $comments = $this->portal->getQuery('orderComments', $id, 'array');

        return View::make('portal.orders.show', compact('order', 'items', 'comments'));
    }

    public function printOrder($id)
    {
        $order = $this->portal->getQuery('orderDetails', $id, 'array')[0];
        $items = $this->portal->getQuery('orderItemDetails', $id, 'array');
        $comments = $this->portal->getQuery('orderComments', $id, 'array');
        return View::make('portal.orders.print', compact('order', 'items', 'comments'));
    }



}
