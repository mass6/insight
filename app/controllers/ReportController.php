<?php


use Insight\Portal\Repositories\Portal;

class ReportController extends \BaseController {


    /**
     * @var Insight\Portal\Repositories\Portal
     */
    private $portal;

    public function __construct(Portal $portal)
    {
        $this->portal = $portal;
    }

    /**
     * Display the specified resource.
     *
     * @param $report
     * @internal param int $id
     * @return Response
     */
    public function getReport($report)
    {
        return $results = $this->portal->getReport($report);
    }



}
