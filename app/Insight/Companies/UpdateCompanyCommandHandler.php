<?php namespace Insight\Companies;
use Insight\Companies\Events\CompanyWasUpdated;

/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 1:29 AM
 */

class UpdateCompanyCommandHandler extends CompanyCommandHandlerAbstract
{

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $company = $this->companyRepository->findById($command->id);

        $company->name = $command->name;
        $company->type = $command->type;
        $company->notes = $command->notes;

        $company->save();

        $company->raise(new CompanyWasUpdated($company) );
        $this->dispatchEventsFor($company);

    }
}