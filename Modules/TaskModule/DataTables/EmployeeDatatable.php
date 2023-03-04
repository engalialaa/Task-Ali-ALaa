<?php


namespace Modules\TaskModule\DataTables;

use Illuminate\Support\Facades\App;
use Modules\TaskModule\Entities\Company;
use Modules\TaskModule\Entities\Employee;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;


class EmployeeDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            ->editColumn('id', function ($item){
                return $item->id.'#';

            })->addColumn('image', function ($item){
                return view('actions.image',['item'=>$item]);

            })->addColumn('actions', function ($item){
                return view('actions.actions',[
                    'item'=>$item,
                    'url'=>'employees',
                    'edit'=>true,
                    'delete'=>'true',
                    'show'=>'false',
                ]);
            })
            ->editColumn('company_id', function ($item){
                return $item->company->name;
            })
            ->filterColumn('company_id', function ($item,$keyword){
                return $item->whereHas('company',function ($query) use ($keyword){
                    return $query->where('name','like','%'.$keyword.'%');
                });

            })

            ->rawColumns(['actions']);
    }


    public function query(Employee $model)
    {

        return $model->with('company')->newQuery();

    }
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {

        return $this->builder()
            ->columns($this->getColumns())
            ->dom('Bfrtip')
            ->orderBy(1,'desc')
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [[10, 25, 50, 100], [10, 25, 50, 'All Record']],
                'buttons' => [],
                'language' => $this->DataTableLanguage()
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title('Id'),
            Column::make('company_id')->title('Company'),
            Column::make('name')->title('Name'),
            Column::make('email')->title('Email'),
            Column::make('image')->title('Logo'),
            Column::computed('actions')->title('Actions')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admins_' . date('Y-m-d');
    }

    protected function DataTableButtons()
    {
    }

    protected function DataTableLanguage()
    {
        if(App::getLocale()=='ar')
            return ['url' => url('datatable/ar/datatables.json')];
        return ['url' => url('datatable/en/datatables.json')];
    }
}

