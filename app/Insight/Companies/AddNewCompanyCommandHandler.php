<?php namespace Insight\Companies;

use Exception;
use Insight\Companies\Events\CompanyWasCreated;

/**
 * Insight Client Management Portal:
 * Date: 7/28/14
 * Time: 10:29 PM
 */

class AddNewCompanyCommandHandler extends CompanyCommandHandlerAbstract
{

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        // Create the Company
        try
        {
            $company = $this->companyRepository->create(['name' => $command->name, 'type' => $command->type, 'notes' => $command->notes]);
        }
        catch (Exception $e)
        {
            return 'Could not create company.';
        }

        $company->raise(new CompanyWasCreated($company));
        $this->dispatchEventsFor($company);

    }

}