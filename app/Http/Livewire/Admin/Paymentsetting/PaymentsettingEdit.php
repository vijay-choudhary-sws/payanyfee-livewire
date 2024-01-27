<?php

namespace App\Http\Livewire\Admin\Paymentsetting;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\{Paymentsetting, InputType, Field, InputMeta, PaymentsettingMeta, Inputselectdata, MetaOption, Paymentgetways, SettingWithGetways, Categories, posts, Multioption};
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Validation\ValidationException;


class PaymentsettingEdit extends Component
{
    #[Validate('required')]
    public $title = '';

    #[Validate('required')]
    public $slug = '';

    // #[Validate('required')]
    // public $email = '';

    // #[Validate('required')]
    // public $cc_email = '';

    // #[Validate('required')]
    // public $bcc_email = '';

    #[Validate('required')]
    public $status = '';
    public $id;

    public $Paymentsetting = [];
    public $showEditModal = false;
    public $Editfields;
    public $heading = 'Payment Setting';
    public $label;
    public $select_type, $getwayId = '';
    public $type_id = 1;
    public $input_data;
    public $paymentsetting_id, $input_select_data, $selectdata, $inputtype;
    public $input_tag;
    public $input_type;
    public $input_name;
    public $placeholder = '';
    public $is_required = '0';
    public $selectType = '1';
    public $slug_name;
    public $optionvalue = [];
    public $optionlabel = [];
    public $optionamount = [];
    public $optionradio;
    public $i = 1;
    public $option = [];
    public $is_option = false;
    public $is_select = false;
    public $is_custom = false;
    public $orderno = 1;
    public $paymentgetways;
    public $showSaveButton = false;
    protected $listeners = ['removeInput'];
    public $amountType;
    public $fixed_amount;
    public $is_amount = false;
    public $is_amount_option = false;
    public $is_one_time = true;
    public $amountc, $is_multiple_required;
    public $muloptions = [];
    public $is_mul = false, $multioption = [], $multioptionname = [], $multioptionlabel = [];

    public function create()
    {
        $inputtypes = InputType::all();

        $isonetime = [];
        foreach ($inputtypes as $types) {
            if ($types->is_one_time) {
                if (InputMeta::where(['paymentsetting_id' => $this->id, 'input_type_id' => $types->id])->count() > 0) {
                    $isonetime = [$types->id];
                }
            }
        }

        $this->inputtype = $inputtypes->whereNotIn('id', $isonetime);

        $this->showEditModal = true;
    }


    public function close()
    {
        $this->showEditModal = false;
    }

    public function mount(Paymentsetting $paymentsettings)
    {

        $this->paymentgetways = Paymentgetways::get();
        // echo"<pre>";print_r($this->paymentgetways);die;
        $this->id = $paymentsettings->id;
        $this->title = $paymentsettings->title;
        $this->slug = $paymentsettings->slug;
        // $this->email = $paymentsettings->email;
        // $this->cc_email = $paymentsettings->cc_email;
        // $this->bcc_email = $paymentsettings->bcc_email;
        $this->status = $paymentsettings->status;
        $this->fixed_amount = $paymentsettings->fixed_amount;
        $this->amountType = $paymentsettings->amount_type;

        $this->Paymentsetting = $paymentsettings;
        $getwayId  = SettingWithGetways::where('paymentsetting_id', $this->id)->select('paymentgetway_id')->get();
        $this->input_select_data = Categories::where('dependency',0)->get();


        $this->selectdata = '';

        $this->inputDataBox();
    }



    public function isOption()
    {
        $input_type = InputType::find($this->input_type);

        $this->is_select = $input_type->type == 'select' || $input_type->type == 'select_amount' ? true : false;
        $this->is_option = $input_type->is_option;
        $this->is_amount_option = $input_type->is_amount_option;

        $this->i = 2;
        $this->option = [1];
        $this->optionvalue = [];
        $this->optionlabel = [];
        $this->optionamount = [];
    }


    public function isAmount()
    {
        $this->amountType = $this->amountType;
        $this->fixed_amount = 0;
    }

    public function isCustom()
    {
        if ($this->selectType == 1) {
            $this->is_custom = false;
            $this->is_option = true;

            $this->i = 2;
            $this->option = [1];
            $this->optionvalue = [];
            $this->optionlabel = [];
            $this->optionamount = [];
        } else {
            $this->is_custom = true;
            $this->is_option = false;
        }
    }

    public function isMultiple()
    {
        if ($this->is_multiple_required == 1) {
            $this->is_mul = true;

            $this->i = 2;
            $this->multioption = [1];
            $this->multioptionname = [];
            $this->multioptionlabel = [];
        } else {
            $this->is_mul = false;
        }
    }

    public function update()
    {

        $this->validate([
            'title' => 'required',
            // 'email' => 'required',
            // 'cc_email' => 'required',
            // 'bcc_email' => 'required',
            'status' => 'required',
        ]);

        $this->slug = SlugService::createSlug(Paymentsetting::class, 'slug', $this->title);

        if ($this->id) {
            $post = Paymentsetting::findOrFail($this->id);

            $post->update([
                'title' => $this->title,
                // 'email' => $this->email,
                // 'cc_email' => $this->cc_email,
                // 'bcc_email' => $this->bcc_email,
                'status' => $this->status,
                'amount_type' => $this->amountType,
                'fixed_amount' => $this->fixed_amount,
            ]);



            $this->dispatch('toastSuccess', $this->heading . ' Update successfully updated.');

            return $this->redirect(route('admin.paymentsettings'), navigate: true);
        }
    }


    public function render()
    {

        $getways = SettingWithGetways::with('getway')->where('paymentsetting_id', $this->id)->get();
        $paymentsetting_meta = PaymentsettingMeta::where('paymentsetting_id', $this->id)->get();
        $inputselectdatas = Inputselectdata::all();

        $Fields = Field::all();
        $class = "form-control";


        return view('livewire.admin.paymentsetting.Paymentsettingedit', compact('paymentsetting_meta', 'inputselectdatas', 'Fields', 'class', 'getways'));
    }

    public function Inputdelete()
    {

        $fieldToDelete = PaymentsettingMeta::where('paymentsetting_id', $this->id)
            ->first();

        if ($fieldToDelete) {
            $fieldToDelete->delete();
            $this->dispatch('toastSuccess', $fieldToDelete->label . ' successfully deleted.');
        } else {
            $this->dispatch('toastError', 'Field not found for deletion.');
        }
    }

    public function store()
    {


        if ($this->optionvalue) {
            $this->validate([
                // 'label' => 'required',
                'input_type' => 'required',
                // 'input_name' => 'required',
                'optionvalue' => 'required',
                'optionlabel' => 'required',
            ]);
        } else {

            $this->validate([
                // 'label' => 'required',
                'input_type' => 'required',
                // 'input_name' => 'required',
            ]);
        }

        $lastInputMetaid = InputMeta::create([
            'label' => $this->label ? $this->label : null,
            'paymentsetting_id' => $this->id,
            'input_type_id' => $this->input_type,
            'input_name' => $this->input_name,
            'placeholder' => $this->placeholder,
            'is_required' => $this->is_required,
            'order_by' => count($this->input_data) + 1,
            'is_custom' => $this->selectType,
            'input_select_data' => $this->selectdata ? $this->selectdata : null,
            'amountchange' => $this->amountc ?? 0,
            'is_multiple_required' => $this->is_multiple_required ?? 0,
        ])->id;


        foreach ($this->optionvalue as $key => $val) {

            $metaoption = MetaOption::firstOrNew(['id' => '']);
            $metaoption->option_value = $val;
            if (sizeof($this->optionamount) > 0) {
                $metaoption->option_amount = $this->optionamount[$key];
            }

            $metaoption->input_meta_id = $lastInputMetaid;
            $metaoption->label = $this->optionlabel[$key];
            $metaoption->is_default = $key == $this->optionradio ? 1 : 0;
            $metaoption->save();
        }

        foreach ($this->multioptionname as $key => $name) {

            $multioption = Multioption::firstOrNew(['id' => '']);
            $multioption->multioptionname = $name;
            $multioption->input_meta_id = $lastInputMetaid;
            $multioption->multioptionlabel = $this->multioptionlabel[$key];
            $multioption->save();
        }


        $this->dispatch('toastSuccess', $this->heading . ' create successfully .');
        $this->close();
        $this->reset('label', 'select_type', 'paymentsetting_id', 'input_type', 'input_name', 'placeholder', 'is_required', 'is_custom', 'is_select', 'selectType', 'selectdata','is_multiple_required');

        $input_type_data = InputType::where('id', $this->input_type)->where('is_one_time', 1)->first();
        if ($input_type_data) {
            $is_one_time = false;
        }
        $this->inputDataBox();
        $this->is_option = false;
        $this->i = 1;
        $this->option = [];
        $this->multioption = [];
        $this->multioptionname = [];
        $this->multioptionlabel = [];
        $this->is_mul = false;
    }


    public function Inputdeletedg($label, $select_type)
    {
        $fieldToDelete = Field::where([
            'label' => $label,
            'select_type' => $select_type,
        ])->first();

        if ($fieldToDelete) {
            $fieldToDelete->delete();
            $this->dispatch('toastSuccess', $fieldToDelete->label . ' successfully deleted.');
        } else {
            $this->dispatch('toastError', 'Field not found for deletion.');
        }
    }

    public function removeInput($id)
    {

        InputMeta::where('id', $id)->delete();
        $this->inputDataBox();
        $this->dispatch('toastSuccess', 'Input successfully deleted.');
    }


    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->option, $i);
    }

    public function multiadd($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->multioption, $i);
    }

    public function remove($i)
    {
        unset($this->option[$i]);
    }

    public function multiremove($i)
    {
        unset($this->multioption[$i]);
    }


    public function updateInputOreder($items)
    {
      
        // dd($items);
        foreach ($items as $item) {
            $update = InputMeta::where('id', $item['value'])->update(['order_by' => $item['order']]);
        }

        $this->inputDataBox();
        $this->dispatch('toastSuccess', 'Order Changed Successfully.');
    }

    public function inputDataBox()
    {
        $this->input_data = InputMeta::with('existingSelect.posts')->wherePaymentsetting_id($this->id)->orderBy('order_by', 'ASC')->get();
        
    }


    public function SettingWithGetway()
    {

        SettingWithGetways::firstOrCreate([
            'paymentsetting_id' => $this->id,
            'paymentgetway_id' => $this->getwayId,
        ]);

        $this->showSaveButton = false;
    }

    public function buttondisbeld()
    {
        $this->showSaveButton = true;
    }


    public function removese($id)
    {


        SettingWithGetways::where('id', $id)->delete();
        $this->dispatch('toastSuccess', 'settingwithgetway remove successfully');
    }
}
