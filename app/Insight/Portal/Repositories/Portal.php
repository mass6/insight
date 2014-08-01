<?php  namespace Insight\Portal\Repositories; /***
 * Created by:
 * User: sam
 * Date: 7/7/14
 * Time: 9:55 PM
 */
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class Portal 
{

    /**
     * @var string
     */
    protected $group;

    /**
     * @var string
     */
    protected $reportURl;

    /**
     * @var string
     */
    protected $queryUrl;

    /**
     *
     */
    public function __construct()
    {
        $this->group = Sentry::getUser()->company !== '36s' ? Sentry::getUser()->company : '' ;
        $this->reportURl = getenv('WS_REPORT_URL');
        $this->queryUrl = getenv('WS_QUERY_URL');
    }

    /**
     * Posts to the portal web service and returns a JSON response
     *
     * @param $reportName
     * @param string $format
     * @internal param string $group
     * @internal param $query
     * @internal param string $type
     * @internal param null $search
     * @return array|mixed
     */
    public function getReport($reportName, $format = 'json')
    {
        $data = array('key'=>sha1(getenv('WS_KEY')), 'url' => $this->reportURl,
            'reportName' => ucwords($reportName), 'group' => $this->group);

        $response = $this->sendRequest($data);

        if ($format === 'array'){
            return object_to_array(json_decode($response));
        } else {
            return $response;
        }

    }

    /**
     * Posts to the portal web service and returns a JSON response
     *
     * @param $reportName
     * @param null $search
     * @param string $format
     * @internal param string $group
     * @internal param $query
     * @internal param string $type
     * @return array|mixed
     */

    public function getQuery($reportName, $search, $format = 'json')
    {
        $data = array('key'=>sha1(getenv('WS_KEY')), 'url' => $this->queryUrl,
            'reportName' => ucwords($reportName), 'search' => $search, 'group' => $this->group);

        $response = $this->sendRequest($data);

        if ($format === 'array'){
            return object_to_array(json_decode($response));
        } else {
            return $response;
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    protected function sendRequest($data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $data['url']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

} 