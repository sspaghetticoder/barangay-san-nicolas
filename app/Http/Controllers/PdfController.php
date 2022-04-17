<?php

namespace App\Http\Controllers;

use App\Events\DocumentGenerated;
use App\Http\Controllers\Traits\Serialization;
use App\Http\Requests\PrintDocumentRequest;
use App\Models\Activity;
use App\Models\Resident;
use App\Services\ConvertToLocalTimezoneService;
use Carbon\Carbon;
use HeadlessChromium\BrowserFactory;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    use Serialization;

    public Resident $resident;
    public $document;
    public $page;

    public function __construct(PrintDocumentRequest $request)
    {
        $now = (new ConvertToLocalTimezoneService)->convert(Carbon::parse(now()));

        $this->resident = Resident::findOrFail($request->full_id);

        $this->document = $request->route;

        $params = [
            'full_name' => $this->resident->full_name,
            'pronoun' => $this->resident->pronoun,
            'complete_address' => $this->resident->complete_address,
            'prefixed_last_name' => $this->resident->prefixed_last_name,
            'purpose' => $request->purpose === 'Others' ? $request->specified : $request->purpose,
            'pronoun' => $this->resident->pronoun,
            'adjective' => $this->resident->adjective,
            'now' => $now->format('jS').' day of '.$now->format('F Y'),
            'issued_on' => $now->format('m-d-Y'),
            'btc_no' => (Activity::where('description', 'like', '%'.$request->route.'%')->get()->count() + 1).'-'.$now->format('Y'),
        ];

        $stringParams = $this->encode($params);
        
        $routeName = strtolower($request->route);

        $browserFactory = (new BrowserFactory())->createBrowser();
    
        $this->page = $browserFactory->createPage();
    
        $this->page->navigate(route($routeName, ['params' => $stringParams]))->waitForNavigation();

        $filename = ($params['full_name'] ?? 'filename') . ' - ' . $routeName . '.pdf';
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename='.$filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
    }

    public function printPdf()
    {
        event(new DocumentGenerated($this->resident, ucfirst($this->document)));

        echo base64_decode($this->page->pdf(config('headless-chrome.options'))->getBase64());
    }
}
