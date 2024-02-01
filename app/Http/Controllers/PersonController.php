<?php

namespace App\Http\Controllers;

use App\Exceptions\PersonException;
use App\Http\Requests\xmlRequest;
use App\Services\LogService;
use App\Services\PersonService;
use Exception;
use Illuminate\Support\Facades\Log;
use XMLReader;

class PersonController extends Controller
{
    public function __construct(
        private PersonService $personService,
        private LogService $logService
    )
    {}

    public function index()
    {
        $persons = $this->personService->getAll();

        return view('persons/index', [
            'persons' => $persons
        ]);
    }

    public function getOne($id)
    {
        $person = $this->personService->getById($id);

        return response()->json($person);
    }

    public function import(xmlRequest $request){
        $data = $request->validated();

        try{

            $filePath = $request->file('xml_file')->path();

            $logs = [];

            $reader = new XMLReader();
            $reader->open($filePath);

            while($reader->read()){

                if ($reader->nodeType == XMLReader::ELEMENT) {
                    if ($reader->name == 'persons' && !$reader->isEmptyElement) {
                        while ($reader->read() && !($reader->nodeType == XMLReader::END_ELEMENT && $reader->name == 'persons')) {
                            if ($reader->nodeType == XMLReader::ELEMENT) {
                                if ($reader->name == 'person' && !$reader->isEmptyElement) {
                                    $personData = [];
    
                                    while ($reader->read() && !($reader->nodeType == XMLReader::END_ELEMENT && $reader->name == 'person')) {
                                        if ($reader->nodeType == XMLReader::ELEMENT) {
                                            $elementName = $reader->name;
                                            $elementValue = $reader->readString();
    
                                            if($elementName == 'EMAILCIM'){
                                                $personData['email'] = $elementValue;
                                            }else if($elementName == 'AZONOSITO'){
                                                $personData['id'] = $elementValue;
                                            }else{
                                                $personData[strtolower($elementName)] = $elementValue;
                                            }
                                        }
                                    }

                                    $log = [];

                                    try{
                                        $person = $this->personService->insert($personData);

                                        $log = ['type' => 1, 'person_id' => $person->id, 'person' => $person, 'reason' => 'Sikeres importálás'];
                                    }catch(PersonException $e){
                                        $log = ['type' => 0, 'datas' => json_encode($personData), 'reason' => $e->getMessage()];
                                    }

                                    $logs[] = $log;

                                    $this->logService->insert($log);
                                    
                                }
                            }
                        }
                    }
                }
            }

            $reader->close();

        }catch(PersonException $e){
            return back()->with('success', false)->withInput()->with('message', $e->getMessage());
        }catch(Exception $e){
            Log::debug($e->getMessage());
            return back()->with('success', false)->withInput()->with('message', 'Sikertelen importálás');
        }

        return back()->with([
            'success' => true,
            'logs' => $logs
        ])->withInput()->with('message', 'Sikeres importálás');
    }

}
