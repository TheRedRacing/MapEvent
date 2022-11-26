@php
    $classes = "";
    switch($level){
        case('danger'):
            $classes = 'flex justify-between items-center gap-5 grow h-12 px-5 bg-red-200 text-red-800 p-4 rounded-lg';
            break;
        
        case('success'):
            $classes = 'flex justify-between items-center gap-5 grow h-12 px-5 bg-green-200 text-green-800 p-4 rounded-lg';
            break;

        case('warning'):
            $classes = 'flex justify-between items-center gap-5 grow h-12 px-5 bg-yellow-200 text-yellow-800 p-4 rounded-lg';
            break;

        case('info'):
            $classes = 'flex justify-between items-center gap-5 grow h-12 px-5 bg-blue-200 text-blue-800 p-4 rounded-lg';
            break;

        default:
            $classes = 'flex justify-between items-center gap-5 grow h-12 px-5 bg-gray-700 text-gray-300 p-4 rounded-lg';
            break;
    }
@endphp
<div {{ $attributes->merge(['class' => $classes]) }} role="alert" id="alert">
   <p class=""> {{ $message }}</p>
   <span class="text-red-500 cursor-pointer" onclick="$('#alert').remove()"><i class="fas fa-fw fa-times"></i></span>
</div>