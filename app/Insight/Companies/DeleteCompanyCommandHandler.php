<?php namespace Insight\Companies;
use Insight\Companies\Events\CompanyWasDeleted;

/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 2:05 AM
 */

class DeleteCompanyCommandHandler extends CompanyCommandHandlerAbstract
{

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $savedCompany = clone $command->company;
        $this->companyRepository->delete($command->company->id);

        $savedCompany->raise(new CompanyWasDeleted($savedCompany));
        $this->dispatchEventsFor($savedCompany);

    }
}