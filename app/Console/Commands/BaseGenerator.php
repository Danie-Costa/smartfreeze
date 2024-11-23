<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
class BaseGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "BaseGenerator:make {model}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Generate a base set of files for a given model";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $modelName = $this->argument("model");
        
        $this->info("Generating model: $modelName");
        $this->call("code:models", ["--table" => Str::plural(strtolower($modelName))]);
        
        $directoryPath = resource_path('views/admin/' . Str::plural(strtolower($modelName)));
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
            $this->info("Directory created: " . $directoryPath);
        } else {
            $this->info("Directory already exists: " . $directoryPath);
        }
        $this->createController($modelName);
        $this->replaceInRoutesFile(Str::plural($modelName));
        return 0;
    }


    private function replaceInRoutesFile($modelName)
    {
        $filePath = base_path('routes/web.php');
        if (!file_exists($filePath)) {
            $this->error('O arquivo não existe.');
            return;
        }
        $content = file_get_contents($filePath);
        $updatedContent = str_replace('//novaRota', 'Route::resource("'.strtolower($modelName).'", '.$modelName.'Controller::class);
    //novaRota', $content);
    $updatedContent = str_replace('//novaControler', 'use App\Http\Controllers\\'.$modelName.'Controller;
//novaControler', $content);

    
        file_put_contents($filePath, $updatedContent);

        $this->info('Substituição realizada com sucesso em routes/web.php.');
    }

    private function createController($modelName)
    {
        
        $lowermodelName = strtolower($modelName);
        $pluralModelName = Str::plural($lowermodelName);
        $controllerName = Str::plural($modelName) . "Controller";
        $controllerDir = app_path("Http/Controllers");
        $controllerFile = $controllerDir . "/" . $controllerName . ".php";
    
        // Verifica se o diretório existe
        if (!file_exists($controllerDir)) {
            mkdir($controllerDir, 0777, true);
        }
    
        // Cria o conteúdo do arquivo do controlador
$content = '<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\\'.$modelName.';

class '.$controllerName.' extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $'.$pluralModelName.' = '.$modelName.'::orderBy("id", "ASC");

        if ($param = $request->search) {
            $'.$pluralModelName.'->where("title", "LIKE", "%{$param}%");
        }

        $'.$pluralModelName.'->paginate(20);
        $'.$pluralModelName.' = $'.$pluralModelName.'->get();
        
        return view("admin.'.$pluralModelName.'.index", compact("'.$pluralModelName.'"));
    }

    public function create()
    {
        $'.$lowermodelName.' = new '.$modelName.'();
        $route = "'.$pluralModelName.'";
        $title = "Novo '.$lowermodelName.'";
        $data = $'.$lowermodelName.';
        return view("admin.automatic.create", compact("data","route","title"));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            '.$modelName.'::create($request->all());
            DB::commit();
            return redirect()->route("admin.'.$pluralModelName.'.index")->with("success", "Item cadastrado com sucesso!");
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $'.$lowermodelName.' = '.$modelName.'::findOrFail($id);
        $route = "'.$pluralModelName.'";
        $title = "Ver '.$lowermodelName.'";
        $data = $'.$lowermodelName.';
        return view("admin.automatic.show", compact("data","route","title"));
    }

    public function edit($id)
    {
        $'.$lowermodelName.' = '.$modelName.'::findOrFail($id);
        $route = "'.$pluralModelName.'";
        $title = "Editar '.$lowermodelName.'";
        $data = $'.$lowermodelName.';
        return view("admin.automatic.edit", compact("data","route","title"));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $'.$lowermodelName.' = '.$modelName.'::findOrFail($id);
            $'.$lowermodelName.'->update($request->all());
            DB::commit();
            return redirect()->route("admin.'.$pluralModelName.'.index");
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $'.$lowermodelName.' = '.$modelName.'::findOrFail($id);
        $'.$lowermodelName.'->delete();
        return redirect()->route("admin.'.$pluralModelName.'.index");
    }
}
';
    
        // Escreve o conteúdo no arquivo
        file_put_contents($controllerFile, $content);
    }
    
}
