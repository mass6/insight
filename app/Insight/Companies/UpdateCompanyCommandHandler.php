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
        $company->address1_description = $command->address1_description;
        $company->address1_body = $command->address1_body;
        $company->address2_description = $command->address2_description;
        $company->address2_body = $command->address2_body;
        $company->address3_description = $command->address3_description;
        $company->address3_body = $command->address3_body;
        $company->address4_description = $command->address4_description;
        $company->address4_body = $command->address4_body;

        $company->save();

        $company->raise(new CompanyWasUpdated($company) );
        $this->dispatchEventsFor($company);

    }
}