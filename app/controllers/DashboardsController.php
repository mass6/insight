<?php

use Insight\Portal\Repositories\Portal;

class DashboardsController extends \BaseController {


    /**
     * @var Insight\Portal\Repositories\Portal
     */
    private $portal;

    /**
     * @var string
     */
    private $group;

    public function __construct(Portal $portal)
    {
        $this->portal = $portal;
        $this->group = Session::get('company') !== '36s' ? Session::get('company') : '' ;
    }
	/**
	 * Display default dashboard
	 *
	 * @return Response
	 */
	public function home()
	{
        $ordersTodaySum = $this->portal->getReport('OrdersTodaySum', 'array')[0];
        $ordersPendingApproval = $this->portal->getReport('OrdersPendingApprovalSum', 'array')[0];
        $currentMonthsOrders = $this->portal->getReport('CurrentMonthsOrdersSum', 'array')[0];
        $dailyOrderTotalsThisMonth = $this->portal->getReport('DailyOrderTotalsThisMonth', 'array');
        $thirdPartyOrdersThisMonthSum = $this->portal->getReport('ThirdPartyOrdersThisMonthSum', 'array')[0];
        $spendPerCategoryThisMonthSum = $this->portal->getReport('SpendPerCategoryThisMonthSum', 'array');

        if (empty($dailyOrderTotalsThisMonth)) {
            $dailyOrderTotalsThisMonth = [['day' => '0', 'count' => 0, 'total' => 0 ]];
        }
        if (empty($spendPerCategoryThisMonthSum)) {
            $spendPerCategoryThisMonthSum = [['category' => 'No data yet', 'total' => '0' ]];
        }


        JavaScript::put([
            'ordersTodayCount' => $ordersTodaySum['count'],
            'ordersTodayValue' => $ordersTodaySum['sum'],
            'pendingApprovalCount' => $ordersPendingApproval['count'],
            'pendingApprovalValue' => $ordersPendingApproval['sum'],
            'monthlyOrderCount' => $currentMonthsOrders['count'],
            'monthlyOrderValue' => $currentMonthsOrders['sum'],
            'dailyOrderTotals' => $dailyOrderTotalsThisMonth,
            'thirdPartyOrderCount' => $thirdPartyOrdersThisMonthSum['count'],
            'thirdPartyOrderValue' => $thirdPartyOrdersThisMonthSum['sum'],
            'spendPerCategory' =>  $spendPerCategoryThisMonthSum
        ]);
        return View::make('dashboards.dashboard_01', array('title' => 'Dashboards') );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
