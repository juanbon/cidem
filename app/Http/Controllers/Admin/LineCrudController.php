<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Models\AreaUser;
use App\Models\FinancingType;
use App\Models\Modality;
use App\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;

// VALIDATION: change the requests to match your own file names if you need form validation
/*
use App\Http\Requests\LineRequest as StoreRequest;
use App\Http\Requests\LineRequest as UpdateRequest;  */
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class LineCrudController extends CrudController {
    public function setup() {
        
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Line');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/lines');
        $this->crud->setEntityNameStrings('fuente', 'fuentes');
        $this->crud->enableDetailsRow();
        $this->crud->allowAccess('details_row');
        $this->crud->enableExportButtons();
        
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        
        // $this->crud->setFromDb();
        
        // ------ CRUD FIELDS
        $this->crud->addField([
            'label' => 'Nombre',
            'name' => 'name',
            'type' => 'text'
        ]);


        $this->crud->addField([
            'label' => 'Instituci&oacute;n Convocante',
            'name' => 'institucion',
            'type' => 'text'
        ]);
        
        
        $this->crud->addField([
            'label' => 'Modalidad',
            'type' => 'select2',
            'name' => 'modality_id', // the db column for the foreign key
            'entity' => 'modality', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Modality" // foreign key model
        ]);
        
        $this->crud->addField([
            'label' => 'Fecha de cierre',
            'name' => 'dead_line',
            'type' => 'date_picker',
            'date_picker_options' => [
                'format' => 'dd-mm-yyyy',
                'language' => 'es'
            ]
        ]);
        
        $this->crud->addField([
            'label' => 'Destinatarios',
            'type' => 'select2_multiple',
            'name' => 'recipients', // the method that defines the relationship in your Model
            'entity' => 'line_recipient', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Recipient", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries
        ]);
        
        $this->crud->addField([
            'label' => 'Descripción / objetivos',
            'name' => 'description',
            'type' => 'text'
        ]);
        
        $this->crud->addField([
            'label' => 'Áreas',
            'type' => 'select2_multiple',
            'name' => 'areas', // the method that defines the relationship in your Model
            'entity' => 'area_line', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Area", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries
        ]);
        
        $this->crud->addField([
            'label' => 'Tipo de financiamiento',
            'type' => 'select2',
            'name' => 'financing_type_id', // the db column for the foreign key
            'entity' => 'financingType', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\FinancingType" // foreign key model
        ]);
        
        $this->crud->addField([
            'label' => 'Información sobre presupuesto y montos de financiamiento',
            'name' => 'info',
            'type' => 'text'
        ]);
        
        $this->crud->addField([
            'label' => 'Página web',
            'name' => 'web',
            'type' => 'text',
            'default' => 'http://'
        ]);
        
        $this->crud->addField([
            'label' => 'Habilitada',
            'type' => (backpack_auth()->user()->hasRole(User::ROLE_ADMIN)) ? 'checkbox' : 'hidden',
            'name' => 'is_enabled'
        ]);

        $this->crud->addColumn([
            'label' => "Financiamiento", // Table column heading
            'type' => "select",
            'name' => 'id', // the column that contains the ID of that connected entity;
            'key' => 'financingType_name',
            'entity' => 'financingType', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\FinancingType", // foreign key model
        ]);
        
        $this->crud->addColumn([
            'label' => "Modalidad", // Table column heading
            'type' => "select",
            'name' => 'id', // the column that contains the ID of that connected entity;
            'key' => 'modality_name',
            'entity' => 'modality', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\Modality", // foreign key model
        ]);
        
        $this->crud->addColumn([
            // n-n relationship (with pivot table)
            
            'label' => "Destinatarios", // Table column heading
            'type' => "select_multiple",
            'name' => 'id', // the method that defines the relationship in your Model
            'key' => 'recipients_name',
            'entity' => 'recipients', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\Recipient", // foreign key model
        ]);
        
        $this->crud->addColumn([
            // n-n relationship (with pivot table)
            
            'label' => "Áreas", // Table column heading
            'type' => "select_multiple",
            'name' => 'id', // the method that defines the relationship in your Model
            'key' => 'areas_name',
            'entity' => 'areas', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\Area", // foreign key model
        ]);
        
        $this->crud->addColumn('updated_at');
        
        $this->crud->setColumnDetails('dead_line', ['label' => 'Vencimiento']);
        $this->crud->setColumnDetails('updated_at', ['label' => 'Modificación']);
        $this->crud->setColumnDetails('name', ['label' => 'Nombre']);


        $this->crud->setColumnDetails('institucion', ['label' => 'Instituci&oacute;n Convocante']);

        
        $this->crud->removeColumn('modality_id');
        $this->crud->removeColumn('financing_type_id');
        $this->crud->removeColumn('description');
        $this->crud->removeColumn('info');
        $this->crud->removeColumn('web');
        $this->crud->removeColumn('is_enabled');
        
        $this->crud->addFilter(['type' => 'text', 'name' => 'name', 'label' => 'Nombre'],
            false, // the simple filter has no values, just the "Draft" label specified above
            function ($value) {
                $this->crud->addClause('where', 'name', 'LIKE', "%$value%");
            }
        );
        
        $this->crud->addFilter(['type' => 'date_range', 'name' => 'dead_line', 'label' => 'Vencimiento'],
            false,
            function ($value) { // if the filter is active, apply these constraints
                $dates = json_decode($value);
                $this->crud->addClause('where', 'dead_line', '>=', $dates->from);
                $this->crud->addClause('where', 'dead_line', '<=', $dates->to);
            }
        );
        
        $this->crud->addFilter(['name' => 'financing_type_id', 'type' => 'select2_multiple', 'label' => 'Financiamiento'],
            function () {
                $financingTypes = FinancingType::orderBy('id')->pluck('name')->toArray();
                $newArray = [];
                for ($i = 0; $i < count($financingTypes); $i++) {
                    $newArray[$i + 1] = $financingTypes[$i];
                }
                return $newArray;
            },
            function ($values) {
                foreach (json_decode($values) as $key => $value) {
                    $this->crud->addClause('where', 'financing_type_id', $value);
                }
            });
        
        $this->crud->addFilter(['name' => 'modality_id', 'type' => 'select2_multiple', 'label' => 'Modalidad'],
            function () {
                $modalities = Modality::orderBy('id')->pluck('name')->toArray();
                $newArray = [];
                for ($i = 0; $i < count($modalities); $i++) {
                    $newArray[$i + 1] = $modalities[$i];
                }
                return $newArray;
            },
            function ($values) {
                foreach (json_decode($values) as $key => $value) {
                    $this->crud->addClause('where', 'modality_id', $value);
                }
            });
        
        $this->crud->addFilter(['type' => 'text', 'name' => 'recipients', 'label' => 'Destinatario'],
            false, // the simple filter has no values, just the "Draft" label specified above
            function ($value) {
                $this->crud->addClause('where', 'name', 'LIKE', "%$value%");
            }
        );
        
        $this->crud->addFilter(['type' => 'text', 'name' => 'areas', 'label' => 'Área'],
            false, // the simple filter has no values, just the "Draft" label specified above
            function ($value) {
                $this->crud->addClause('where', 'name', 'LIKE', "%$value%");
            }
        );


        //  $this->crud->setFieldOrder();
        
        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);
        
        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');
        
        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);
        
        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');
        
        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php
        
        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');
        
        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();
        
        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();
        
        // ------ ADVANCED QUERIES
        if (backpack_auth()->user()->hasRole(User::ROLE_USER)) {
            $this->crud->addClause('where', 'is_enabled');
        }
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }
    
    public function store(Request $request) {  // StoreRequest



        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        $this->afterSave($request);
        return $redirect_location;
    }
    
    public function update(UpdateRequest $request) {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
    
    public function showDetailsRow($id) {
        $entry = $this->crud->getEntry($id);

        $text = $entry->description . '<br><a href="' . $entry->web . '">' . $entry->web . '</a>';

        return $text;
    }
    
    private function afterSave($request) {
//        $areaIds = $request->get('areas');
//        $userIds = AreaUser::whereIn('area_id', $areaIds)->pluck('user_id');
//        $areas = Area::whereIn('id', $areaIds)->pluck('name');
//        $users = User::whereIn('id', $userIds)->get();
//
//        foreach ($users as $user) {
            $msg = 'asd';
//            foreach ($areas as $area) {
//                $msg = $msg . '*' . $area . '<br>';
//            }
//            $msg = $msg . 'Datos de la nueva línea de financiamiento: <br>';
//            $msg = $msg . 'Nombre: ' . $request->get('name') . '<br>';
//            $msg = $msg . 'Descripción: ' . $request->get('description') . '<br>';
//            $msg = $msg . 'Web: ' . $request->get('web') . '<br>';
//            $msg = $msg . 'Info: ' . $request->get('info') . '<br>';
//            $msg = $msg . 'Vencimiento: ' . $request->get('dead_line') . '<br>';
            
            $title = 'CIDEM';
            date_default_timezone_set('Etc/UTC');
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Debugoutput = 'html';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth = true;
            $mail->AuthType = 'XOAUTH2';
            $mail->oauthUserEmail = "noreply@untref.edu.ar";
            $mail->oauthClientId = "632843498083-uina36qabor26o83dsvbspl1cii3qp41.apps.googleusercontent.com";
            $mail->oauthClientSecret = "ysbMs6EmQRxrcczC6Et6cSJr";
            $mail->oauthRefreshToken = "1/RsSTXhDWStIbQVpMo2_323LPgG6LvwyGfDtntRUcWL3BactUREZofsF9C7PrpE-j";
            try {
                $mail->setFrom('noreply@untref.edu.ar', 'UNTREF');
            } catch (phpmailerException $exception) {
                dd($exception);
            } catch (Exception $exception) {
                dd($exception);
            }
            $mail->addAddress('rglitvin@gmail.com', 'roman');
            $mail->Subject = $title;
            $mail->msgHTML($msg);
            $mail->AltBody = '';//dd($mail);
            try {
                $mail->send();
            } catch (phpmailerException $exception) {
                dd($exception);
            } catch (Exception $exception) {
                dd($exception);
            }
//        }
    }
}