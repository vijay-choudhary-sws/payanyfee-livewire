<?php

namespace App\Http\Livewire\Admin\Paymentsetting;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\{Paymentsetting, InputType, Field, InputMeta, PaymentsettingMeta, Inputselectdata, MetaOption};
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Validation\ValidationException;


class PaymentsettingEdit extends Component
{
    #[Validate('required')]
    public $title = '';

    #[Validate('required')]
    public $slug = '';

    #[Validate('required')]
    public $email = '';

    #[Validate('required')]
    public $cc_email = '';

    #[Validate('required')]
    public $bcc_email = '';

    #[Validate('required')]
    public $status = '';
    public $id;
    public $Paymentsetting;
    public $showEditModal = false;
    public $Editfields;
    public $heading = 'Paymentsetting';
    public $label;
    public $select_type;
    public $type_id = 1;
    public $input_data;
    public $paymentsetting_id;
    public $input_tag;
    public $input_type;
    public $input_name;
    public $placeholder = '';
    public $is_required = '0';
    public $slug_name;
    public $optionvalue = [];
    public $optionlabel = [];
    public $optionradio;
    public $i = 1;
    public $option = [];
    public $is_option = false;
    public $orderno = 1;

    protected $listeners = ['removeInput'];

    public function create()
    {
        $field = InputType::all();
        $this->showEditModal = true;
        $this->Editfields = $field;
    }


    public function close()
    {
        $this->showEditModal = false;
    }

    public function mount(Paymentsetting $paymentsettings)
    {

        $this->id = $paymentsettings->id;
        $this->title = $paymentsettings->title;
        $this->slug = $paymentsettings->slug;
        $this->email = $paymentsettings->email;
        $this->cc_email = $paymentsettings->cc_email;
        $this->bcc_email = $paymentsettings->bcc_email;
        $this->status = $paymentsettings->status;
        $this->Paymentsetting = $paymentsettings;

        $this->inputDataBox();
    }

    public function isOption()
    {

        if (InputType::whereId($this->input_type)->first()->is_option == '1') {
            $this->is_option = true;
        } else {
            $this->is_option = false;
        }

        $this->i = 1;
        $this->option = [];
        $this->optionvalue = [];
        $this->optionlabel = [];
    }

    public function update()
    {

        $this->validate([
            'title' => 'required',
            'email' => 'required',
            'cc_email' => 'required',
            'bcc_email' => 'required',
            'status' => 'required',
        ]);

        $this->slug = SlugService::createSlug(Paymentsetting::class, 'slug', $this->title);

        if ($this->id) {
            $post = Paymentsetting::findOrFail($this->id);
            $post->update([
                'title' => $this->title,
                'email' => $this->email,
                'cc_email' => $this->cc_email,
                'bcc_email' => $this->bcc_email,
                'status' => $this->status,
            ]);



            $this->dispatch('toastSuccess', $this->heading . ' Update successfully updated.');

            return $this->redirect(route('admin.paymentsettings'), navigate: true);
        }
    }


    public function render()
    {

        $paymentsetting_meta = PaymentsettingMeta::where('paymentsetting_id', $this->id)->get();
        $inputselectdatas = Inputselectdata::all();
        $inputtype = InputType::all();

        $Fields = Field::all();
        $class = "form-control";

        if (!empty($Fields)) {
            return view('livewire.admin.paymentsetting.Paymentsettingedit', compact('paymentsetting_meta', 'inputselectdatas', 'Fields', 'class', 'inputtype'));
        } else {
            return view('livewire.admin.paymentsetting.Paymentsettingedit', compact('paymentsetting_meta', 'inputselectdatas', 'Fields', 'class', 'inputtype'));
        }
    }

    public function Inputdelete()
    {
        // Assuming you want to delete a record based on the label and select type
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

        try {
            if ($this->optionvalue) {
                $validatedData = $this->validate([
                    'label' => 'required',
                    'input_type' => 'required',
                    'input_name' => 'required',
                    'optionvalue' => 'required',
                    'optionlabel' => 'required',
                ]);
            } else {

                $validatedData = $this->validate([
                    'label' => 'required',
                    'input_type' => 'required',
                    'input_name' => 'required',
                ]);
            }

            $lastInputMetaid = InputMeta::create([
                'label' => $this->label,
                'paymentsetting_id' => $this->id,
                'input_type_id' => $this->input_type,
                'input_name' => $this->input_name,
                'placeholder' => $this->placeholder,
                'is_required' => $this->is_required,
                'order_by' => count($this->input_data) + 1,
            ])->id;

            foreach ($this->optionvalue as $key => $val) {
                if ($key == $this->optionradio) {
                    MetaOption::create([
                        'option_value' => $val,
                        'input_meta_id' => $lastInputMetaid,
                        'label' => $this->optionlabel[$key],
                        'is_default' => 1,
                    ]);
                } else {
                    MetaOption::create([
                        'option_value' => $val,
                        'input_meta_id' => $lastInputMetaid,
                        'label' => $this->optionlabel[$key],
                        'is_default' => 0,
                    ]);
                }
            }

            $this->dispatch('toastSuccess', $this->heading . ' create successfully .');

            $this->close();
            $this->reset('label', 'select_type', 'paymentsetting_id', 'input_type', 'input_name', 'placeholder', 'is_required');

            $this->inputDataBox();
            $this->is_option = false;
            $this->i = 1;
            $this->option = [];
        } catch (ValidationException $e) {
            $errors = $e->errors();
            $errorMessages = [];

            foreach ($errors as $field => $messages) {
                $errorMessages[] = $field . ': ' . implode(', ', $messages);
            }

            $errorMessage = implode('<br>', $errorMessages);

            $this->dispatch('toastError', $errorMessage);
        } catch (\Exception $e) {
            $this->dispatch('toastError', 'An error occurred while processing your request.');
        }
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

    public function remove($i)
    {
        unset($this->option[$i]);
    }

    public function updateInputOreder($items)
    {
        // dd($items);
        foreach($items as $item){
           $update = InputMeta::where('id',$item['value'])->update(['order_by'=>$item['order']]);
        }


        $this->inputDataBox();
        $this->dispatch('toastSuccess', 'Input successfully ordered.');

        

      }

     public function inputDataBox(){
        $this->input_data = InputMeta::wherePaymentsetting_id($this->id)->orderBy('order_by','ASC')->get();
     } 
}
